<?php
// FILE: app/Http/Controllers/ApplicationSubmissionController.php
// ACTION: REPLACE the showSubmissionPage() method

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VisaApplication;
use App\Models\UserSubmittedApplication;
use App\Services\ApplicationDataService;
use App\Mail\ApplicationSubmittedMail;
use App\Helpers\PaymentHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ApplicationSubmissionController extends Controller
{
    protected ApplicationDataService $dataService;

    public function __construct(ApplicationDataService $dataService)
    {
        $this->dataService = $dataService;
    }

    /**
     * FIXED: Show final submission page with review
     * Only treat as "existing submission" if it was actually submitted before
     */
    public function showSubmissionPage()
    {
        $user = Auth::user();
        
        // Check if user has chosen an application type
        if (!$user->chosen_application) {
            return redirect()->route('service')->with('error', 'Please choose an application type first.');
        }

        // FIXED: Check payment status BEFORE showing review page
        $paymentStatus = PaymentHelper::checkPaymentStatus($user->id);
        
        if (!$paymentStatus['has_paid']) {
            return redirect()->route('payment.index')
                ->with('info', 'Payment required before submission.');
        }

        // Get the appropriate visa application
        $visaApplication = $this->getVisaApplicationByType($user->chosen_application);
        
        if (!$visaApplication) {
            return redirect()->route('service')->with('error', 'Invalid application type.');
        }

        // FIXED: Only treat as "existing" if it was actually SUBMITTED before
        // Don't count "pending" or "draft" as existing submissions
        $existingSubmission = UserSubmittedApplication::where('user_id', $user->id)
            ->where('application_id', $visaApplication->id)
            ->whereIn('status', ['submitted', 'under_review', 'approved', 'rejected'])
            ->latest()
            ->first();

        // Check completion status
        $completionStatus = $this->checkApplicationCompletion($user);
        
        return view('web.application.submit', compact('user', 'visaApplication', 'completionStatus', 'existingSubmission'));
    }

    /**
     * Submit the application
     * FIXED: Added payment verification
     */
    public function submitApplication(Request $request)
    {
        $request->validate([
            'confirm_submission' => 'required|accepted',
            'agree_terms' => 'required|accepted',
            'submission_type' => 'required|in:new,update',
        ]);

        $user = Auth::user();
        
        // CRITICAL: Verify payment before submission
        $paymentStatus = PaymentHelper::checkPaymentStatus($user->id);
        
        if (!$paymentStatus['has_paid']) {
            Log::warning('Submission blocked - payment not verified', [
                'user_id' => $user->id
            ]);
            
            return back()->withErrors([
                'payment' => 'Payment Required - Please complete your payment before submitting your application for review.'
            ]);
        }
        
        try {
            DB::beginTransaction();

            // Get the appropriate visa application
            $visaApplication = $this->getVisaApplicationByType($user->chosen_application);
            
            if (!$visaApplication) {
                throw new \Exception('Invalid application type.');
            }

            // FIXED: Only look for ACTUALLY submitted applications
            $existingSubmission = UserSubmittedApplication::where('user_id', $user->id)
                ->where('application_id', $visaApplication->id)
                ->whereIn('status', ['submitted', 'under_review', 'approved', 'rejected'])
                ->latest()
                ->first();

            if ($request->submission_type === 'update' && $existingSubmission) {
                // This is a RE-submission (updating previous submission)
                $existingSubmission->update([
                    'transaction_id' => $this->generateTransactionId(),
                    'status' => 'submitted',
                    'submitted_at' => now(),
                    'admin_notes' => null,
                    'reviewed_at' => null,
                    'reviewed_by' => null,
                    'updated_at' => now(),
                ]);
                $submission = $existingSubmission;
                $message = 'Your application has been updated and resubmitted successfully!';
            } else {
                // FIXED: This is a NEW submission (first time)
                // Find or use the pending record
                $pendingRecord = UserSubmittedApplication::where('user_id', $user->id)
                    ->where('application_id', $visaApplication->id)
                    ->where('status', 'pending')
                    ->first();

                if ($pendingRecord) {
                    // Update the pending record to submitted
                    $pendingRecord->update([
                        'transaction_id' => $this->generateTransactionId(),
                        'status' => 'submitted',
                        'submitted_at' => now(),
                    ]);
                    $submission = $pendingRecord;
                } else {
                    // Create new submission
                    $submission = UserSubmittedApplication::create([
                        'user_id' => $user->id,
                        'application_id' => $visaApplication->id,
                        'transaction_id' => $this->generateTransactionId(),
                        'status' => 'submitted',
                        'submitted_at' => now(),
                    ]);
                }
                
                $message = 'Your application has been submitted successfully!';
            }

            // Collect application data
            $applicationData = $this->dataService->collectApplicationData($submission);
            
            // Format as JSON
            $jsonData = $this->dataService->formatAsJson($applicationData);
            
            // Save JSON file
            $filename = sprintf(
                'application_%s_%s.json',
                $submission->transaction_id,
                date('Y-m-d_His')
            );
            $jsonFilePath = $this->dataService->saveJsonFile($jsonData, $filename);

            // Send email with JSON attachment
            $adminEmail = config('mail.admin_email', 'gediondaniel454@gmail.com');
            
            Mail::to($adminEmail)->send(
                new ApplicationSubmittedMail(
                    $applicationData,
                    $jsonFilePath,
                    $user->name,
                    $visaApplication->name
                )
            );

            // Clean up temporary file after sending
            if (File::exists($jsonFilePath)) {
                File::delete($jsonFilePath);
            }

            DB::commit();

            // Log successful submission
            Log::info('Application submitted and emailed', [
                'user_id' => $user->id,
                'application_id' => $submission->id,
                'transaction_id' => $submission->transaction_id,
            ]);

            return redirect()->route('user.page', 'progress')
                ->with('success', $message . ' Our team will review it and contact you soon.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Application submission failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Failed to submit application: ' . $e->getMessage());
        }
    }

    /**
     * Get visa application by type
     */
    private function getVisaApplicationByType($type)
    {
        $mappings = [
            'fiance' => 'Fiance Visa',
            'fiancee' => 'Fiance Visa', 
            'spouse' => 'Spouse Visa',
            'adjustment' => 'Adjustment of Status',
        ];

        $applicationName = $mappings[strtolower($type)] ?? null;
        
        if (!$applicationName) {
            return null;
        }

        return VisaApplication::where('name', 'LIKE', "%{$applicationName}%")->first();
    }

    /**
     * Check application completion status
     */
    private function checkApplicationCompletion($user)
    {
        $sections = [];
        $completedSections = 0;
        $totalSections = 0;

        switch (strtolower($user->chosen_application)) {
            case 'fiance':
            case 'fiancee':
                $sponsorSteps = $user->fianceVisaSteps()->count();
                $alienData = $user->fianceAlien;
                $childrenData = $user->fianceAlienChildren;
                
                $sections['sponsor'] = $sponsorSteps > 0;
                $sections['alien'] = $alienData ? true : false;
                $sections['children'] = $childrenData ? true : false;
                
                $totalSections = 3;
                $completedSections = count(array_filter($sections));
                break;

            case 'spouse':
                $spouseSteps = $user->spouseVisaSteps()->count();
                $sections['spouse'] = $spouseSteps > 0;
                
                $totalSections = 1;
                $completedSections = count(array_filter($sections));
                break;

            case 'adjustment':
                $adjustmentSteps = $user->adjustmentVisaSteps()->count();
                $sections['adjustment'] = $adjustmentSteps > 0;
                
                $totalSections = 1;
                $completedSections = count(array_filter($sections));
                break;
        }

        $percentage = $totalSections > 0 ? round(($completedSections / $totalSections) * 100) : 0;
        
        return [
            'is_complete' => $completedSections === $totalSections,
            'sections' => $sections,
            'completed_sections' => $completedSections,
            'total_sections' => $totalSections,
            'completion_percentage' => $percentage,
            'has_any_data' => $completedSections > 0,
        ];
    }

    /**
     * Generate unique transaction ID
     */
    private function generateTransactionId()
    {
        return 'APP-' . strtoupper(uniqid()) . '-' . time();
    }

    /**
     * Check submission status (for AJAX calls)
     */
    public function checkSubmissionStatus()
    {
        $user = Auth::user();
        
        $submission = UserSubmittedApplication::where('user_id', $user->id)
            ->whereIn('status', ['submitted', 'under_review', 'approved', 'rejected'])
            ->latest()
            ->first();
        
        if ($submission) {
            return response()->json([
                'has_submission' => true,
                'status' => $submission->status,
                'submitted_at' => $submission->created_at->format('M j, Y'),
                'transaction_id' => $submission->transaction_id,
            ]);
        }

        return response()->json(['has_submission' => false]);
    }
}