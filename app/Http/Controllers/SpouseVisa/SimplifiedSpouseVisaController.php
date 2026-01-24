<?php
// app/Http/Controllers/SpouseVisa/SimplifiedSpouseVisaController.php (FIXED)

namespace App\Http\Controllers\SpouseVisa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Spouse\SimplifiedSpouseVisaRequest;
use App\Http\Services\Spouse\SimplifiedSpouseVisaService;
use App\Models\SimplifiedSpouseVisaApplication;
use App\Models\UserSubmittedApplication;
use App\Helpers\PaymentHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SimplifiedSpouseVisaController extends Controller
{
    protected $service;

    public function __construct(SimplifiedSpouseVisaService $service)
    {
        $this->service = $service;
    }

    /**
     * Show the application form
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get the active application
        $submittedApp = UserSubmittedApplication::where('user_id', $user->id)
            ->where('status', 'pending')
            ->where('application_id', 3) // Spouse visa
            ->first();

        if (!$submittedApp) {
            return redirect()->route('service')
                ->with('error', 'Please select Spouse Visa application first.');
        }

        // Get or create the application
        $application = SimplifiedSpouseVisaApplication::firstOrCreate(
            [
                'user_id' => $user->id,
                'submitted_app_id' => $submittedApp->id,
            ],
            [
                'status' => 'draft',
            ]
        );

        $completionPercentage = $this->service->calculateCompletion($application);

        return view('web.visa-application.spouse-visa-simplified.index', compact(
            'application',
            'completionPercentage'
        ));
    }

    /**
     * Save application progress (NO VALIDATION)
     * FIXED: Removed validation to allow partial saves
     */
    public function store(Request $request)
    {
        try {
            // Get submitted app ID
            $submittedApp = UserSubmittedApplication::where('user_id', Auth::id())
                ->where('status', 'pending')
                ->where('application_id', 3)
                ->first();

            if (!$submittedApp) {
                return response()->json([
                    'status' => false,
                    'message' => 'No active application found.',
                ], 400);
            }

            // Add submitted_app_id to request
            $request->merge(['submitted_app_id' => $submittedApp->id]);

            // FIXED: Save WITHOUT validation
            $application = $this->service->saveApplication($request);
            $completion = $this->service->calculateCompletion($application);

            return response()->json([
                'status' => true,
                'message' => 'Progress saved successfully.',
                'completion' => $completion,
            ]);

        } catch (\Exception $e) {
            Log::error('Spouse visa save failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Failed to save: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Submit application (WITH VALIDATION)
     * FIXED: Added payment verification
     */
    public function submit(SimplifiedSpouseVisaRequest $request)
    {
        try {
            $user = Auth::user();
            
            // FIXED: Check payment status BEFORE allowing submission
            $paymentStatus = PaymentHelper::checkPaymentStatus($user->id);
            
            if (!$paymentStatus['has_paid']) {
                return back()->withErrors([
                    'payment' => 'Payment Required - Please complete your payment before submitting your application for review.'
                ])->withInput();
            }

            // Get the application
            $submittedApp = UserSubmittedApplication::where('user_id', $user->id)
                ->where('status', 'pending')
                ->where('application_id', 3)
                ->first();

            if (!$submittedApp) {
                return back()->withErrors([
                    'general' => 'No active application found.'
                ]);
            }

            $application = SimplifiedSpouseVisaApplication::where('user_id', $user->id)
                ->where('submitted_app_id', $submittedApp->id)
                ->first();

            if (!$application) {
                return back()->withErrors([
                    'general' => 'Application not found.'
                ]);
            }

            // Check if application is complete
            if (!$application->isComplete()) {
                return back()->withErrors([
                    'general' => 'Please complete all required fields before submitting.'
                ]);
            }

            // Submit the application
            $this->service->submitApplication($application);

            return redirect()->route('user.page', 'progress')
                ->with('success', 'Application submitted successfully!');

        } catch (\Exception $e) {
            Log::error('Spouse visa submission failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);

            return back()->withErrors([
                'general' => 'Failed to submit application: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Get states for a country (AJAX)
     */
    public function getStates(Request $request)
    {
        try {
            $countryId = $request->get('country_id');
            $selectedState = $request->get('selected_state', '');

            // Get states from your database or use a helper
            $states = \App\Models\State::where('country_id', $countryId)
                ->orderBy('name')
                ->get();

            $html = '<option value="">-Select State-</option>';
            
            foreach ($states as $state) {
                $selected = ($state->id == $selectedState) ? 'selected' : '';
                $html .= sprintf(
                    '<option value="%s" %s>%s</option>',
                    $state->id,
                    $selected,
                    $state->name
                );
            }

            return response($html);

        } catch (\Exception $e) {
            Log::error('Get states failed', [
                'error' => $e->getMessage()
            ]);
            
            return response('<option value="">Error loading states</option>');
        }
    }
}