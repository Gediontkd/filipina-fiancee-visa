<?php

namespace App\Http\Controllers\SpouseVisa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Spouse\NameRequest;
use App\Http\Requests\Spouse\ContactRequest;
use App\Http\Requests\Spouse\PlaceOfBirthRequest;
use App\Http\Requests\Spouse\StatusRequest;
use App\Http\Requests\Spouse\MaritalStatusRequest;
use App\Http\Requests\Spouse\AddressRequest;
use App\Http\Requests\Spouse\EmploymentRequest;
use App\Http\Services\Spouse\SpouseBeneficiaryService;
use App\Models\SpouseStep;
use App\Models\SpouseBeneficiary;
use App\Models\UserSubmittedApplication;
use App\Models\SpouseVisaSubmittedStep;
use App\Models\UserSpouseVisaType;
use App\Models\State;
use Auth;

class BeneficiaryController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $request['submitted_app_id'] = UserSubmittedApplication::where('user_id', Auth::id())
                ->where('application_id', 3)
                ->where('status', 'pending')
                ->pluck('id')
                ->first();
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        // Track beneficiary section progress
        if (!UserSpouseVisaType::where('user_id', Auth::id())->where('type', 'beneficiary')->exists()) {
            UserSpouseVisaType::create([
                'user_id' => Auth::id(),
                'type' => 'beneficiary',
                'status' => 'in-progress'
            ]);
        }

        $spouseSteps = SpouseStep::select('id', 'name', 'icon', 'slug')
            ->where('type', 'beneficiary')
            ->get();
            
        $form = SpouseBeneficiary::where('user_id', Auth::id())
            ->orderBy('id', 'DESC')
            ->first();
            
       // Load existing data if any
        $existingStep = @$form->step;
                
        // Always show the name form as the first step
        $step = 'name';  // THIS IS THE KEY FIX!
        $section = 'beneficiary';

        return view('web.visa-application.spouse-visa.index', compact('spouseSteps', 'step', 'section', 'existingStep'));
    }

    public function name(NameRequest $request, SpouseBeneficiaryService $beneficiaryService)
    {
        $step = $beneficiaryService->create($request);
        return response()->json([
            'status' => true,
            'section' => 'beneficiary',
            'nextForm' => 'contact',
            'data' => view('web.visa-application.spouse-visa.beneficiary.contact', [
                'step' => $beneficiaryService->next($step)
            ])->render(),
        ]);
    }

    public function contact(ContactRequest $request, SpouseBeneficiaryService $beneficiaryService)
    {
        $step = $beneficiaryService->create($request);
        return response()->json([
            'status' => true,
            'section' => 'beneficiary',
            'nextForm' => 'address',
            'data' => view('web.visa-application.spouse-visa.beneficiary.address', [
                'step' => $beneficiaryService->next($step)
            ])->render(),
        ]);
    }

    public function address(AddressRequest $request, SpouseBeneficiaryService $beneficiaryService)
    {
        $step = $beneficiaryService->create($request);
        return response()->json([
            'status' => true,
            'section' => 'beneficiary',
            'nextForm' => 'place-of-birth',
            'data' => view('web.visa-application.spouse-visa.beneficiary.place-of-birth', [
                'step' => $beneficiaryService->next($step)
            ])->render(),
        ]);
    }

    public function placeOfBirth(PlaceOfBirthRequest $request, SpouseBeneficiaryService $beneficiaryService)
    {
        $step = $beneficiaryService->create($request);
        return response()->json([
            'status' => true,
            'section' => 'beneficiary',
            'nextForm' => 'status',
            'data' => view('web.visa-application.spouse-visa.beneficiary.status', [
                'step' => $beneficiaryService->next($step)
            ])->render(),
        ]);
    }

    public function status(StatusRequest $request, SpouseBeneficiaryService $beneficiaryService)
    {
        $step = $beneficiaryService->create($request);
        return response()->json([
            'status' => true,
            'section' => 'beneficiary',
            'nextForm' => 'marital-status',
            'data' => view('web.visa-application.spouse-visa.beneficiary.marital-status', [
                'step' => $beneficiaryService->next($step)
            ])->render(),
        ]);
    }

    public function maritalStatus(MaritalStatusRequest $request, SpouseBeneficiaryService $beneficiaryService)
    {
        $step = $beneficiaryService->create($request);
        return response()->json([
            'status' => true,
            'section' => 'beneficiary',
            'nextForm' => 'employment',
            'data' => view('web.visa-application.spouse-visa.beneficiary.employment', [
                'step' => $beneficiaryService->next($step)
            ])->render(),
        ]);
    }

    public function employment(EmploymentRequest $request, SpouseBeneficiaryService $beneficiaryService)
    {
        $step = $beneficiaryService->create($request);
        
        // Mark beneficiary section as complete
        if (SpouseBeneficiary::where('user_id', Auth::id())->count() == 7) {
            UserSpouseVisaType::where('user_id', Auth::id())
                ->where('type', 'beneficiary')
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
            'section' => 'beneficiary',
            'message' => 'Beneficiary section completed!',
        ]);
    }

    public function previousOrContinue(Request $request)
    {
        $stepId = SpouseBeneficiary::where('user_id', Auth::id())
            ->where('name', $request->form)
            ->pluck('step_id')
            ->first();
            
        $step = SpouseVisaSubmittedStep::where('id', $stepId)->first();
        
        return response()->json([
            'status' => true,
            'step' => view('web.visa-application.spouse-visa.beneficiary.' . $request->form, [
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