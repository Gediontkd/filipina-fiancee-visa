<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Adjustment\NameRequest;
use App\Http\Requests\Adjustment\PlaceOfBirthRequest;
use App\Http\Requests\Adjustment\visaInfoRequest;
use App\Http\Requests\Adjustment\AddressRequest;
use App\Http\Requests\Adjustment\CivilStatusRequest;
use App\Http\Requests\Adjustment\SponsorPart1Request;
use App\Http\Requests\Adjustment\SponsorPart2Request;
use App\Http\Requests\Adjustment\QusPart1Request;
use App\Http\Requests\Adjustment\QusPart2Request;
use App\Http\Requests\Adjustment\QusPart3Request;
use App\Http\Requests\Adjustment\QusPart4Request;
use App\Http\Requests\Adjustment\QusPart5Request;
use App\Http\Requests\Adjustment\EadRequest;
use App\Http\Requests\Adjustment\AccommodationRequest;
use App\Http\Requests\Adjustment\InterpreterRequest;
use App\Http\Requests\Adjustment\ChildrenRequest;
use App\Http\Requests\Adjustment\AffiliationRequest;
use App\Http\Requests\Adjustment\AlienParentsRequest;
use App\Http\Services\Adjustment\AdjustmentService;
use App\Models\AdjustmentStep;
use App\Models\AdjustmentVisaStep;
use App\Models\UserSubmittedApplication;
use App\Models\AdjustmentVisaSubmittedStep;
use App\Models\User;
use App\Models\State;
use App\Models\EmbassyCity;
use App\Models\AdjustmentType;
use Auth;

class AdjustmentOfStatusController extends Controller
{

    public function __construct(Request $request)
    {        
        $this->middleware(function ($request, $next) {                      
            $request['submitted_app_id'] = UserSubmittedApplication::where('user_id', Auth::id())
                ->where('application_id', 2)
                ->where('status', 'pending')
                ->pluck('id')
                ->first();
            $request['type'] = AdjustmentType::where('submitted_app_id', $request->submitted_app_id)
                ->pluck('name')
                ->first();       
            return $next($request);
        });            
    }

    public function index(Request $request)
    {
        if (Auth::check() && applicationRoute()) {
            return applicationRoute();
        } else {
            return view('web.service.adjustment-visa.index');  
        }
        // if (applicationRoute() == 'adjustment.visa') {
        //     return view('web.service.adjustment-visa.index');         
        // }
        // return redirect()->route(applicationRoute());                        
    }

    public function show()
    {        
        return view('web.service.adjustment-visa.show');        
    }

    public function application(Request $request, $applicationType)
    {        
        $adjustmentSteps = AdjustmentStep::select('id', 'name', 'icon', 'slug')->get();
        if (!AdjustmentType::where('submitted_app_id', $request->submitted_app_id)
                ->exists()) {
            $appType = AdjustmentType::create([
                'user_id' => Auth::id(),
                'name' => $applicationType,
                'submitted_app_id' => $request->submitted_app_id,
            ]);
            $request['type'] = $appType->name;
        }
        $form = AdjustmentVisaStep::where('user_id', Auth::id())
            ->orderBy('id', 'DESC')
            ->first();
        $step = @$form->step;
        $name = 'name';
        $type = $request->type;
        return view('web.visa-application.adjustment-of-status.index', compact('adjustmentSteps', 'step', 'name', 'type'));
    }

    public function name(NameRequest $request, AdjustmentService $adjustmentService)
    {
        $step = $adjustmentService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.adjustment-of-status.place-of-birth', [
                'step' => $adjustmentService->next($step),
                'type' => $request->type
            ])->render(),
        ]);
    }

    public function placeOfBirth(PlaceOfBirthRequest $request, AdjustmentService $adjustmentService)
    {
        $step = $adjustmentService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.adjustment-of-status.visa-info', [
                'step' => $adjustmentService->next($step),
                'type' => $request->type
            ])->render(),
        ]);
    }

    public function visaInfo(visaInfoRequest $request, AdjustmentService $adjustmentService)
    {
        $step = $adjustmentService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.adjustment-of-status.address', [
                'step' => $adjustmentService->next($step),
                'type' => $request->type
            ])->render(),
        ]);
    }

    public function address(AddressRequest $request, AdjustmentService $adjustmentService)
    {
        $step = $adjustmentService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.adjustment-of-status.civil-status', [
                'step' => $adjustmentService->next($step),
                'type' => $request->type
            ])->render(),
        ]);
    }

    public function civilStatus(CivilStatusRequest $request, AdjustmentService $adjustmentService)
    {
        $step = $adjustmentService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.adjustment-of-status.sponsor-part-1', [
                'step' => $adjustmentService->next($step),
                'type' => $request->type
            ])->render(),
        ]);
    }

    public function sponsorPart1(SponsorPart1Request $request, AdjustmentService $adjustmentService)
    {
        $step = $adjustmentService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.adjustment-of-status.sponsor-part-2', [
                'step' => $adjustmentService->next($step),
                'type' => $request->type
            ])->render(),
        ]);
    }

    public function sponsorPart2(SponsorPart2Request $request, AdjustmentService $adjustmentService)
    {
        $step = $adjustmentService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.adjustment-of-status.questions-part-1', [
                'step' => $adjustmentService->next($step),
                'type' => $request->type
            ])->render(),
        ]);
    }

    public function qusPart1(QusPart1Request $request, AdjustmentService $adjustmentService)
    {
        $step = $adjustmentService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.adjustment-of-status.questions-part-2', [
                'step' => $adjustmentService->next($step),
                'type' => $request->type
            ])->render(),
        ]);
    }

    public function qusPart2(QusPart2Request $request, AdjustmentService $adjustmentService)
    {
        $step = $adjustmentService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.adjustment-of-status.questions-part-3', [
                'step' => $adjustmentService->next($step),
                'type' => $request->type
            ])->render(),
        ]);
    }

    public function qusPart3(QusPart3Request $request, AdjustmentService $adjustmentService)
    {
        $step = $adjustmentService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.adjustment-of-status.questions-part-4', [
                'step' => $adjustmentService->next($step),
                'type' => $request->type
            ])->render(),
        ]);
    }

    public function qusPart4(QusPart4Request $request, AdjustmentService $adjustmentService)
    {
        $step = $adjustmentService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.adjustment-of-status.questions-part-5', [
                'step' => $adjustmentService->next($step),
                'type' => $request->type
            ])->render(),
        ]);
    }

    public function qusPart5(QusPart5Request $request, AdjustmentService $adjustmentService)
    {
        $step = $adjustmentService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.adjustment-of-status.ead', [
                'step' => $adjustmentService->next($step),
                'type' => $request->type
            ])->render(),
        ]);
    }

    public function ead(EadRequest $request, AdjustmentService $adjustmentService)
    {
        $step = $adjustmentService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.adjustment-of-status.accommodations', [
                'step' => $adjustmentService->next($step),
                'type' => $request->type
            ])->render(),
        ]);
    }

    public function accommodation(AccommodationRequest $request, AdjustmentService $adjustmentService)
    {
        $step = $adjustmentService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.adjustment-of-status.interpreter', [
                'step' => $adjustmentService->next($step),
                'type' => $request->type
            ])->render(),
        ]);
    }

    public function interpreter(InterpreterRequest $request, AdjustmentService $adjustmentService)
    {
        $step = $adjustmentService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.adjustment-of-status.children', [
                'step' => $adjustmentService->next($step),
                'type' => $request->type
            ])->render(),
        ]);
    }

    public function children(ChildrenRequest $request, AdjustmentService $adjustmentService)
    {
        $step = $adjustmentService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.adjustment-of-status.affiliations', [
                'step' => $adjustmentService->next($step),
                'type' => $request->type
            ])->render(),
        ]);
    }

    public function affiliation(AffiliationRequest $request, AdjustmentService $adjustmentService)
    {
        $step = $adjustmentService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.adjustment-of-status.alien-parents', [
                'step' => $adjustmentService->next($step),
                'type' => $request->type
            ])->render(),
        ]);
    }

    public function alienParents(AlienParentsRequest $request, AdjustmentService $adjustmentService)
    {
        $step = $adjustmentService->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.adjustment-of-status.employment', [
                'step' => $adjustmentService->next($step),
                'type' => $request->type
            ])->render(),
        ]);
    }
    
    public function alienEmployement(Request $request, AdjustmentService $adjustmentService)
    {
        $step = $adjustmentService->create($request);        
        return response()->json([
            'status' => true,            
        ]);
    }

    public function previousOrContinue(Request $request)
    {
        $stepId = AdjustmentVisaStep::where('user_id', Auth::id())
            ->where('name', $request->form)
            ->pluck('step_id')
            ->first();         
        $step = AdjustmentVisaSubmittedStep::where('id', $stepId)
                ->first();       
        return response()->json([
            'status' => true,
            'step' => view('web.visa-application.adjustment-of-status.'.$request->form.'', [
                'step' => $step,
                'type' => $request->type
            ])->render()
        ]);
    }

    public function getState(Request $request)
    {
        $states = State::where('country_id', $request->countryId)->pluck('name');
        $getState = '<option value="">-Select State-</option>';
        foreach ($states as $state) {
            $getState .= '<option value='.$state.'>'.$state.'</option>';
        }
        return $getState;
    }

    public function getCities(Request $request)
    {
        $cities = EmbassyCity::where('parent_id', $request->countryId)->pluck('name');
        $getCity = '<option value="">-Select City-</option>';
        foreach ($cities as $city) {
            $getCity .= '<option value='.$city.'>'.$city.'</option>';
        }
        return $getCity;
    }
}
