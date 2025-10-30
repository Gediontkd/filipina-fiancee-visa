<?php

namespace App\Http\Controllers\SpouseVisa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Spouse\NameRequest;
use App\Http\Requests\Spouse\ContactRequest;
use App\Http\Requests\Spouse\PlaceOfBirthRequest;
use App\Http\Requests\Spouse\StatusRequest;
use App\Http\Requests\Spouse\MaritalStatusRequest;
use App\Http\Requests\Spouse\OtherFilingRequest;
use App\Http\Requests\Spouse\MilitaryConvictionRequest;
use App\Http\Requests\Spouse\AddressRequest;
use App\Http\Requests\Spouse\EmploymentRequest;
use App\Http\Services\Spouse\SpouseSponsorService;
use App\Models\SpouseStep;
use App\Models\SpouseSponsor;
use App\Models\UserSubmittedApplication;
use App\Models\SpouseVisaSubmittedStep;
use App\Models\UserSpouseVisaType;
use App\Models\State;
use Auth;

class SponsorController extends Controller
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

    public function index(Request $request)
    {
        // Track sponsor section progress
        if (!UserSpouseVisaType::where('user_id', Auth::id())->where('type', 'sponsor')->exists()) {
            UserSpouseVisaType::create([
                'user_id' => Auth::id(),
                'type' => 'sponsor',
                'status' => 'in-progress'
            ]);
        }

        $spouseSteps = SpouseStep::select('id', 'name', 'icon', 'slug')
            ->where('type', 'sponsor')
            ->get();
            
        $form = SpouseSponsor::where('user_id', Auth::id())
            ->orderBy('id', 'DESC')
            ->first();
            
        // Load existing data if any
        $existingStep = @$form->step;
                
        // Always show the name form as the first step
        $step = 'name';  // THIS IS THE KEY FIX!
        $section = 'sponsor';

        return view('web.visa-application.spouse-visa.index', compact('spouseSteps', 'step', 'section', 'existingStep'));
    }

    public function name(NameRequest $request, SpouseSponsorService $sponsorService)
    {
        $step = $sponsorService->create($request);
        return response()->json([
            'status' => true,
            'section' => 'sponsor',
            'nextForm' => 'contact',
            'data' => view('web.visa-application.spouse-visa.sponsor.contact', [
                'step' => $sponsorService->next($step)
            ])->render(),
        ]);
    }

    public function contact(ContactRequest $request, SpouseSponsorService $sponsorService)
    {
        $step = $sponsorService->create($request);
        return response()->json([
            'status' => true,
            'section' => 'sponsor',
            'nextForm' => 'address',
            'data' => view('web.visa-application.spouse-visa.sponsor.address', [
                'step' => $sponsorService->next($step)
            ])->render(),
        ]);
    }

    public function address(AddressRequest $request, SpouseSponsorService $sponsorService)
    {
        $step = $sponsorService->create($request);
        return response()->json([
            'status' => true,
            'section' => 'sponsor',
            'nextForm' => 'place-of-birth',
            'data' => view('web.visa-application.spouse-visa.sponsor.place-of-birth', [
                'step' => $sponsorService->next($step)
            ])->render(),
        ]);
    }

    public function placeOfBirth(PlaceOfBirthRequest $request, SpouseSponsorService $sponsorService)
    {
        $step = $sponsorService->create($request);
        return response()->json([
            'status' => true,
            'section' => 'sponsor',
            'nextForm' => 'status',
            'data' => view('web.visa-application.spouse-visa.sponsor.status', [
                'step' => $sponsorService->next($step)
            ])->render(),
        ]);
    }

    public function status(StatusRequest $request, SpouseSponsorService $sponsorService)
    {
        $step = $sponsorService->create($request);
        return response()->json([
            'status' => true,
            'section' => 'sponsor',
            'nextForm' => 'marital-status',
            'data' => view('web.visa-application.spouse-visa.sponsor.marital-status', [
                'step' => $sponsorService->next($step)
            ])->render(),
        ]);
    }

    public function maritalStatus(MaritalStatusRequest $request, SpouseSponsorService $sponsorService)
    {
        $step = $sponsorService->create($request);
        return response()->json([
            'status' => true,
            'section' => 'sponsor',
            'nextForm' => 'other-filings',
            'data' => view('web.visa-application.spouse-visa.sponsor.other-filings', [
                'step' => $sponsorService->next($step)
            ])->render(),
        ]);
    }

    public function otherFiling(OtherFilingRequest $request, SpouseSponsorService $sponsorService)
    {
        $step = $sponsorService->create($request);
        return response()->json([
            'status' => true,
            'section' => 'sponsor',
            'nextForm' => 'military-convictions',
            'data' => view('web.visa-application.spouse-visa.sponsor.military-convictions', [
                'step' => $sponsorService->next($step)
            ])->render(),
        ]);
    }

    public function militaryConviction(MilitaryConvictionRequest $request, SpouseSponsorService $sponsorService)
    {
        $step = $sponsorService->create($request);
        return response()->json([
            'status' => true,
            'section' => 'sponsor',
            'nextForm' => 'employment',
            'data' => view('web.visa-application.spouse-visa.sponsor.employment', [
                'step' => $sponsorService->next($step)
            ])->render(),
        ]);
    }

    public function employment(EmploymentRequest $request, SpouseSponsorService $sponsorService)
    {
        $step = $sponsorService->create($request);
        
        // Mark sponsor section as complete
        if (SpouseSponsor::where('user_id', Auth::id())->count() == 9) {
            UserSpouseVisaType::where('user_id', Auth::id())
                ->where('type', 'sponsor')
                ->where('status', 'in-progress')
                ->update(['status' => 'completed']);
        }
        
        // Check if entire application is complete
        if (SpouseVisaSubmittedStep::where('user_id', Auth::id())->count() >= 16) {
            UserSubmittedApplication::where('user_id', Auth::id())
                ->where('application_id', 3)
                ->where('status', 'pending')
                ->update(['status' => 'progress']);
        }
        
        return response()->json([
            'status' => true,
            'section' => 'sponsor',
            'message' => 'Sponsor section completed! You can now proceed to the Beneficiary section.',
        ]);
    }

    public function previousOrContinue(Request $request)
    {
        $stepId = SpouseSponsor::where('user_id', Auth::id())
            ->where('name', $request->form)
            ->pluck('step_id')
            ->first();
            
        $step = SpouseVisaSubmittedStep::where('id', $stepId)->first();
        
        return response()->json([
            'status' => true,
            'step' => view('web.visa-application.spouse-visa.sponsor.' . $request->form, [
                'step' => $step
            ])->render()
        ]);
    }

    public function getState(Request $request)
    {
        $states = State::where('country_id', $request->countryId)->pluck('name');
        $getState = '<option value="">-Select State-</option>';
        foreach ($states as $state) {
            $selected = isset($request->selected) && $state == $request->selected ? 'selected' : '';
            $getState .= "<option $selected value=\"$state\">$state</option>";
        }
        return $getState;
    }
}