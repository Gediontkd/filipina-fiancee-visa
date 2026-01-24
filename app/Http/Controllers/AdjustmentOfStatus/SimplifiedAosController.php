<?php
// FILE: app/Http/Controllers/AdjustmentOfStatus/SimplifiedAosController.php
// ACTION: REPLACE your existing file with this version

namespace App\Http\Controllers\AdjustmentOfStatus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdjustmentOfStatus\SimplifiedAosRequest;
use App\Http\Services\AdjustmentOfStatus\SimplifiedAosService;
use App\Models\SimplifiedAosApplication;
use App\Models\UserSubmittedApplication;
use App\Models\State;
use App\Helpers\PaymentHelper;
use Auth;
use Log;

/**
 * Simplified Adjustment of Status Controller - FIXED VERSION
 * 
 * FIXES:
 * - Save progress now works without validation
 * - Payment verification before submission
 */
class SimplifiedAosController extends Controller
{
    protected $aosService;

    public function __construct(SimplifiedAosService $aosService)
    {
        $this->aosService = $aosService;
        
        // Ensure user has an application record
        $this->middleware(function ($request, $next) {
            $submission = UserSubmittedApplication::firstOrCreate(
                [
                    'user_id' => Auth::id(),
                    'application_id' => 2, // AOS
                ],
                [
                    'status' => 'pending',
                    'submitted_at' => null
                ]
            );
            
            $request->merge(['submitted_app_id' => $submission->id]);
            return $next($request);
        });
    }

    /**
     * Display the simplified AOS application form
     */
    public function index(Request $request)
    {
        try {
            // Get existing application data if any
            $application = SimplifiedAosApplication::where('user_id', Auth::id())
                ->where('submitted_app_id', $request->submitted_app_id)
                ->first();

            // Calculate completion percentage
            $completionPercentage = $application 
                ? $this->aosService->calculateCompletion($application)
                : 0;

            return view('web.visa-application.aos-simplified.index', [
                'application' => $application,
                'completionPercentage' => $completionPercentage,
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error loading AOS form', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);
            
            return redirect()->route('service')
                ->with('error', 'Failed to load application form. Please try again.');
        }
    }

    /**
     * FIXED: Save progress WITHOUT validation (allows partial saves)
     */
    public function store(Request $request)
    {
        try {
            // NO VALIDATION HERE - Just save whatever they have
            $application = $this->aosService->saveApplication($request);
            
            // Calculate completion percentage
            $completionPercentage = $this->aosService->calculateCompletion($application);
            
            return response()->json([
                'status' => true,
                'message' => 'Application saved successfully',
                'completion' => $completionPercentage,
                'can_submit' => $completionPercentage >= 100
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error saving AOS application', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'status' => false,
                'message' => 'Failed to save application. Please try again.'
            ], 500);
        }
    }

    /**
     * FIXED: Submit with validation AND payment check
     */
    public function submit(SimplifiedAosRequest $request)
    {
        try {
            $user = Auth::user();
            
            // CRITICAL: Check payment status BEFORE allowing submission
            $paymentStatus = PaymentHelper::checkPaymentStatus($user->id);
            
            if (!$paymentStatus['has_paid']) {
                Log::warning('AOS submission blocked - payment not verified', [
                    'user_id' => $user->id
                ]);
                
                return response()->json([
                    'status' => false,
                    'message' => 'Payment Required - Please complete your payment before submitting your application for review.'
                ], 402);
            }

            // Get the application
            $application = SimplifiedAosApplication::where('user_id', $user->id)
                ->where('submitted_app_id', $request->submitted_app_id)
                ->firstOrFail();

            // Verify application is complete
            $completionPercentage = $this->aosService->calculateCompletion($application);
            
            if ($completionPercentage < 100) {
                return response()->json([
                    'status' => false,
                    'message' => 'Please complete all required fields before submitting.'
                ], 422);
            }

            // Submit the application
            $this->aosService->submitApplication($application);
            
            return response()->json([
                'status' => true,
                'message' => 'Application submitted successfully!',
                'redirect' => route('user.page', 'progress')
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error submitting AOS application', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'status' => false,
                'message' => 'Failed to submit application. Please try again.'
            ], 500);
        }
    }

    /**
     * Get states for a country (AJAX endpoint)
     */
    public function getStates(Request $request)
    {
        $countryId = $request->country_id;
        $selectedState = $request->selected_state;
        
        $states = State::where('country_id', $countryId)
            ->orderBy('name')
            ->pluck('name', 'name');
        
        $html = '<option value="">-Select State-</option>';
        $html .= '<option value="Does Not Apply">Does Not Apply</option>';
        
        foreach ($states as $value => $name) {
            $selected = ($selectedState == $value) ? 'selected' : '';
            $html .= "<option value=\"{$value}\" {$selected}>{$name}</option>";
        }
        
        return response($html);
    }
}