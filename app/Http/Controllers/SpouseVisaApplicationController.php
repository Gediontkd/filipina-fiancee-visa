<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Spouse\NameRequest;
use App\Http\Requests\Spouse\ContactRequest;
use App\Http\Requests\Spouse\PlaceOfBirthRequest;
use App\Http\Requests\Spouse\StatusRequest;
use App\Http\Requests\Spouse\MaritalStatusRequest;
use App\Http\Requests\Spouse\OtherFilingRequest;
use App\Http\Requests\Spouse\MilitaryConvictionRequest;
use App\Http\Requests\Spouse\AddressRequest;
use App\Http\Requests\Spouse\RelationshipRequest;
use App\Http\Requests\Spouse\EmploymentRequest;
use App\Http\Services\Spouse\SpouseService;
use App\Models\SpouseStep;
use App\Models\SpouseVisaStep;
use App\Models\UserSubmittedApplication;
use App\Models\SpouseVisaSubmittedStep;
use App\Models\User;
use App\Models\State;
use Auth;

class SpouseVisaApplicationController extends Controller
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

    public function spouseVisa(Request $request)
    {
        if (Auth::check() && applicationRoute()) {
            return applicationRoute();
        } else {
            return view('web.service.spouse-visa');   
        }
        // if (applicationRoute() == 'spouse.visa') {
        //     return view('web.service.spouse-visa');     
        // }
        // return redirect()->route(applicationRoute());             
    }
    
    public function index(Request $request)
    {
        $spouseSteps = SpouseStep::select('id', 'name', 'icon', 'slug')->get();
        $form = SpouseVisaStep::where('user_id', Auth::id())
            ->orderBy('id', 'DESC')
            ->first();
        $step = @$form->step;
        $name = 'name';
        return view('web.visa-application.spouse-visa.index', compact('spouseSteps', 'step', 'name'));
    }

    public function name(NameRequest $request, SpouseService $spouseService)
    {                     
        $step = $spouseService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.spouse-visa.contact', [
                'step' => $spouseService->next($step)
            ])->render(),
        ]);
    }

    public function contact(ContactRequest $request, SpouseService $spouseService)
    {                     
        $step = $spouseService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.spouse-visa.place-of-birth', [
                'step' => $spouseService->next($step)
            ])->render(),
        ]);
    }

    public function placeOfBirth(PlaceOfBirthRequest $request, SpouseService $spouseService)
    {                     
        $step = $spouseService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.spouse-visa.status', [
                'step' => $spouseService->next($step)
            ])->render(),
        ]);
    }

    public function status(StatusRequest $request, SpouseService $spouseService)
    {                     
        $step = $spouseService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.spouse-visa.marital-status', [
                'step' => $spouseService->next($step)
            ])->render(),
        ]);
    }

    public function maritalStatus(MaritalStatusRequest $request, SpouseService $spouseService)
    {                     
        $step = $spouseService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.spouse-visa.other-filings', [
                'step' => $spouseService->next($step)
            ])->render(),
        ]);
    }

    public function otherFiling(OtherFilingRequest $request, SpouseService $spouseService)
    {                     
        $step = $spouseService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.spouse-visa.military-convictions', [
                'step' => $spouseService->next($step)
            ])->render(),
        ]);
    }

    public function militaryConviction(MilitaryConvictionRequest $request, SpouseService $spouseService)
    {                     
        $step = $spouseService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.spouse-visa.address', [
                'step' => $spouseService->next($step)
            ])->render(),
        ]);
    }

    public function address(AddressRequest $request, SpouseService $spouseService)
    {                     
        $step = $spouseService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.spouse-visa.relationship', [
                'step' => $spouseService->next($step)
            ])->render(),
        ]);
    }

    public function relationship(RelationshipRequest $request, SpouseService $spouseService)
    {                     
        $step = $spouseService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.spouse-visa.employment', [
                'step' => $spouseService->next($step)
            ])->render(),
        ]);
    }

    public function employment(EmploymentRequest $request, SpouseService $spouseService)
    {                     
        $step = $spouseService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.spouse-visa.name', [
                'step' => $spouseService->next($step)
            ])->render(),
        ]);
    }
   
    public function previousOrContinue(Request $request)
    {
        $stepId = SpouseVisaStep::where('user_id', Auth::id())
            ->where('name', $request->form)
            ->pluck('step_id')
            ->first();         
        $step = SpouseVisaSubmittedStep::where('id', $stepId)
                ->first();       
        return response()->json([
            'status' => true,
            'step' => view('web.visa-application.spouse-visa.'.$request->form.'', [
                'step' => $step
            ])->render()
        ]);
    }

    public function getState(Request $request)
    {
        $states = State::where('country_id', $request->countryId)->pluck('name');
        // $getState = '';
        $getState = '<option value="">-Select State-</option>';
        foreach ($states as $state) {
            $getState .= '<option value='.$state.'>'.$state.'</option>';
        }
        return $getState;
    }
}
