<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Spouse\RelationshipRequest;
use App\Http\Services\Spouse\SpouseService;
use App\Models\SpouseStep;
use App\Models\SpouseVisaStep;
use App\Models\UserSubmittedApplication;
use App\Models\SpouseVisaSubmittedStep;
use App\Models\State;
use Auth;

class SpouseVisaApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
           $submission = UserSubmittedApplication::firstOrCreate(
                [
                    'user_id' => Auth::id(),
                    'application_id' => 3,
                ],
                [
                    'status' => 'pending',
                    'submitted_at' => null
                ]
            );
            
            $request['submitted_app_id'] = $submission->id;
            return $next($request);
        });
    }

    public function spouseVisa(Request $request)
    {
        if (Auth::check() && applicationRoute()) {
            return applicationRoute();
        } else {
            return view('web.service.spouse-visa');   
        }
    }
    
    public function index(Request $request)
    {
        $spouseSteps = SpouseStep::select('id', 'name', 'icon', 'slug')->get();
        $step = 'relationship';  // Show relationship form
        $section = 'shared';

        return view('web.visa-application.spouse-visa.index', compact('spouseSteps', 'step', 'section'));
    }

    public function navigate(Request $request)
    {
        try {
            $section = $request->section; // sponsor, beneficiary, or shared
            $form = $request->form; // name, contact, etc.
            
            if (!$section || !$form) {
                return response()->json([
                    'status' => false,
                    'message' => 'Section and form are required'
                ]);
            }
            
            // Get step data based on section
            if ($section === 'sponsor') {
                $stepId = \App\Models\SpouseSponsor::where('user_id', Auth::id())
                    ->where('name', $form)
                    ->pluck('step_id')
                    ->first();
            } elseif ($section === 'beneficiary') {
                $stepId = \App\Models\SpouseBeneficiary::where('user_id', Auth::id())
                    ->where('name', $form)
                    ->pluck('step_id')
                    ->first();
            } else {
                // Shared section (relationship)
                $stepId = SpouseVisaStep::where('user_id', Auth::id())
                    ->where('name', $form)
                    ->pluck('step_id')
                    ->first();
            }
            
            $step = $stepId ? SpouseVisaSubmittedStep::find($stepId) : null;
            
            // Determine view path
            if ($section === 'shared') {
                $viewPath = 'web.visa-application.spouse-visa.' . $form;
            } else {
                $viewPath = 'web.visa-application.spouse-visa.' . $section . '.' . $form;
            }
            
            // Check if view exists
            if (!view()->exists($viewPath)) {
                \Log::error('Spouse Visa View Not Found: ' . $viewPath);
                return response()->json([
                    'status' => false,
                    'message' => 'Form view not found: ' . $viewPath
                ]);
            }
            
            return response()->json([
                'status' => true,
                'step' => view($viewPath, ['step' => $step])->render()
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Spouse Visa Navigate Error: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            
            return response()->json([
                'status' => false,
                'message' => 'Error loading form: ' . $e->getMessage()
            ], 500);
        }
    }

    public function relationship(RelationshipRequest $request, SpouseService $spouseService)
    {
        $step = $spouseService->create($request);
        
        return response()->json([
            'status' => true,
            'message' => 'Relationship information saved successfully',
        ]);
    }

    public function getState(Request $request)
    {
        $countryId = $request->countryId;
        $selectedState = $request->state;
        
        $states = State::where('country_id', $countryId)->get();
        
        $getState = '<option value="">-Select State-</option>';
        $getState .= '<option value="Does Not Apply">Does Not Apply</option>';
        
        foreach ($states as $state) {
            $selected = ($selectedState == $state->name) ? 'selected' : '';
            $getState .= '<option value="'.$state->name.'" '.$selected.'>'.$state->name.'</option>';
        }
        
        return $getState;
    }
}