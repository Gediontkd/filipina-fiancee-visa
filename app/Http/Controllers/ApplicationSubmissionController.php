<?php
// app/Http/Controllers/ApplicationSubmissionController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VisaApplication;
use App\Models\UserSubmittedApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplicationSubmissionController extends Controller
{
    /**
     * Show final submission page with review
     */
    public function showSubmissionPage()
    {
        $user = Auth::user();
        
        // Check if user has chosen an application type
        if (!$user->chosen_application) {
            return redirect()->route('service')->with('error', 'Please choose an application type first.');
        }

        // Check for existing submission (for resubmission scenario)
        $existingSubmission = UserSubmittedApplication::where('user_id', $user->id)
            ->whereHas('visaApplication', function($q) use ($user) {
                $q->where('name', 'LIKE', '%' . $user->chosen_application . '%');
            })
            ->latest()
            ->first();

        // Get the appropriate visa application
        $visaApplication = $this->getVisaApplicationByType($user->chosen_application);
        
        if (!$visaApplication) {
            return redirect()->route('service')->with('error', 'Invalid application type.');
        }

        // Check completion status (but don't require 100%)
        $completionStatus = $this->checkApplicationCompletion($user);
        
        return view('web.application.submit', compact('user', 'visaApplication', 'completionStatus', 'existingSubmission'));
    }

    /**
     * Submit the application
     */
    public function submitApplication(Request $request)
    {
        $request->validate([
            'confirm_submission' => 'required|accepted',
            'agree_terms' => 'required|accepted',
            'submission_type' => 'required|in:new,update',
        ]);

        $user = Auth::user();
        
        try {
            DB::beginTransaction();

            // Get the appropriate visa application
            $visaApplication = $this->getVisaApplicationByType($user->chosen_application);
            
            if (!$visaApplication) {
                throw new \Exception('Invalid application type.');
            }

            // Check if this is an update or new submission
            $existingSubmission = UserSubmittedApplication::where('user_id', $user->id)
                ->where('application_id', $visaApplication->id)
                ->latest()
                ->first();

            if ($request->submission_type === 'update' && $existingSubmission) {
                // Update existing submission
                $existingSubmission->update([
                    'transaction_id' => $this->generateTransactionId(),
                    'status' => 'pending', // Reset to pending for review
                    'admin_notes' => null, // Clear previous admin notes
                    'reviewed_at' => null,
                    'reviewed_by' => null,
                    'updated_at' => now(),
                ]);
                $submission = $existingSubmission;
                $message = 'Your application has been updated and resubmitted successfully!';
            } else {
                // Create new submission
                $submission = UserSubmittedApplication::create([
                    'user_id' => $user->id,
                    'application_id' => $visaApplication->id,
                    'transaction_id' => $this->generateTransactionId(),
                    'status' => 'pending',
                ]);
                $message = 'Your application has been submitted successfully!';
            }

            DB::commit();

            return redirect()->route('user.page', 'progress')
                ->with('success', $message . ' Our team will review it and contact you soon.');

        } catch (\Exception $e) {
            DB::rollBack();
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
     * Check application completion status (allows partial completion)
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
        
        $submission = UserSubmittedApplication::where('user_id', $user->id)->latest()->first();
        
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