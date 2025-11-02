<?php

namespace App\Http\Controllers\SpouseVisa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Spouse\SimplifiedSpouseVisaRequest;
use App\Http\Services\Spouse\SimplifiedSpouseVisaService;
use App\Models\SimplifiedSpouseVisaApplication;
use App\Models\UserSubmittedApplication;
use App\Models\State;
use Auth;
use Log;

/**
 * Simplified Spouse Visa Controller
 * Handles CR-1/IR-1 visa applications with a streamlined single-form approach
 */
class SimplifiedSpouseVisaController extends Controller
{
    protected $visaService;

    public function __construct(SimplifiedSpouseVisaService $visaService)
    {
        $this->visaService = $visaService;
        
        // Ensure user has an application record
        $this->middleware(function ($request, $next) {
            $submission = UserSubmittedApplication::firstOrCreate(
                [
                    'user_id' => Auth::id(),
                    'application_id' => 3, // Spouse Visa
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
     * Display the simplified spouse visa application form
     */
    public function index(Request $request)
    {
        try {
            // Get existing application data if any
            $application = SimplifiedSpouseVisaApplication::where('user_id', Auth::id())
                ->where('submitted_app_id', $request->submitted_app_id)
                ->first();

            // Calculate completion percentage
            $completionPercentage = $application 
                ? $this->visaService->calculateCompletion($application)
                : 0;

            return view('web.visa-application.spouse-visa-simplified.index', [
                'application' => $application,
                'completionPercentage' => $completionPercentage,
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error loading spouse visa form', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);
            
            return redirect()->route('service')
                ->with('error', 'Failed to load application form. Please try again.');
        }
    }

    /**
     * Save or update the spouse visa application
     */
    public function store(SimplifiedSpouseVisaRequest $request)
    {
        try {
            $application = $this->visaService->saveApplication($request);
            
            // Calculate completion percentage
            $completionPercentage = $this->visaService->calculateCompletion($application);
            
            return response()->json([
                'status' => true,
                'message' => 'Application saved successfully',
                'completion' => $completionPercentage,
                'can_submit' => $completionPercentage >= 100
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error saving spouse visa application', [
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
     * Submit the completed application
     */
    public function submit(Request $request)
    {
        try {
            $application = SimplifiedSpouseVisaApplication::where('user_id', Auth::id())
                ->where('submitted_app_id', $request->submitted_app_id)
                ->firstOrFail();

            // Verify application is complete
            $completionPercentage = $this->visaService->calculateCompletion($application);
            
            if ($completionPercentage < 100) {
                return response()->json([
                    'status' => false,
                    'message' => 'Please complete all required fields before submitting.'
                ], 422);
            }

            // Submit the application
            $this->visaService->submitApplication($application);
            
            return response()->json([
                'status' => true,
                'message' => 'Application submitted successfully!',
                'redirect' => route('user.page', 'progress')
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error submitting spouse visa application', [
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