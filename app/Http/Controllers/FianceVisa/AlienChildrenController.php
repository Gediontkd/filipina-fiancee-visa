<?php

namespace App\Http\Controllers\FianceVisa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Fiance\NameRequest;
use App\Http\Requests\Fiance\CitizenshipRequest;
use App\Http\Requests\Fiance\EmbassyRequest;
use App\Http\Requests\Fiance\ContactRequest;
use App\Http\Requests\Fiance\ParentsRequest;
use App\Http\Requests\Fiance\VisitUSRequest;
use App\Http\Requests\Fiance\PlaceOfBirthRequest;
use App\Http\Requests\Fiance\StatusRequest;
use App\Http\Requests\Fiance\MaritalStatusRequest;
use App\Http\Requests\Fiance\OtherFilingRequest;
use App\Http\Requests\Fiance\AddressRequest;
use App\Http\Requests\Fiance\RelationshipRequest;
use App\Http\Requests\Fiance\EmploymentRequest;
use App\Http\Requests\Fiance\SchoolRequest;
use App\Http\Requests\Fiance\TravelRequest;
use App\Http\Requests\Fiance\MilitaryRequest;
use App\Http\Requests\Fiance\ActivityRequest;
use App\Http\Requests\Fiance\ImmigrationRequest;
use App\Http\Requests\Fiance\LanguageRequest;
use App\Http\Requests\Fiance\RelativeRequest;
use App\Http\Requests\Fiance\Ques1Request;
use App\Http\Requests\Fiance\Ques2Request;
use App\Http\Requests\Fiance\Ques3Request;
use App\Http\Requests\Fiance\Ques4Request;
use App\Http\Requests\Fiance\Ques5Request;
use App\Http\Services\Fiance\FianceAlieChildrenService as Alien;
use App\Models\FianceStep;
use App\Models\FianceVisaStep;
use App\Models\FianceAlienChildren;
use App\Models\UserSubmittedApplication;
use App\Models\FianceVisaSubmittedStep;
use App\Models\User;
use App\Models\State;
use App\Models\EmbassyCity;
use App\Models\UserFianceVisaType;
use Auth;

class AlienChildrenController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
           $request['submitted_app_id'] = UserSubmittedApplication::where('user_id', Auth::user()->id)
                ->where('application_id', 1)
                ->where('status', 'pending')
                ->pluck('id')
                ->first();
            return $next($request);
        });
    }

    public function index(Request $request)
    {

        if (!UserFianceVisaType::where('user_id', Auth::id())->where('type', 'alien-children')->exists()) {
            UserFianceVisaType::create([
                'user_id' => Auth::id(),
                'type' => 'alien-children',
                'status' => 'in-progress'
            ]);
        }
        $fianceSteps = FianceStep::select('id', 'name', 'icon', 'slug')
            ->where('type', 'alien-children')
            ->get();
        $form = FianceAlienChildren::where('user_id', Auth::id())
            ->orderBy('id', 'DESC')
            ->first();
        $step = @$form->step;
        $name = 'name';
        return view('web.visa-application.fiance-visa.alien-children.index', compact('fianceSteps', 'step', 'name'));
    }    

    public function child1(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien-children.child-2', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function child2(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien-children.child-3', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function child3(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien-children.child-4', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function child4(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien-children.child-5', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function child5(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        if (FianceAlienChildren::where('user_id', Auth::id())->count() == 5) {
            // FianceAlienChildren::where('user_id', Auth::id())->delete();                    
            UserFianceVisaType::where('user_id', Auth::id())
                ->where('type', 'alien-children')
                ->where('status', 'in-progress')
                ->update(['status' => 'completed']);             
        }
        if (FianceVisaSubmittedStep::where('user_id', Auth::id())->count() == 36) {
            UserSubmittedApplication::where('user_id', Auth::id())->where('application_id', 1)->where('status', 'pending')->update(['status' => 'progress']);
        }
        return response()->json([
            'status' => true,            
        ]);
    }

    public function previousOrContinue(Request $request)
    {
        $stepId = FianceAlienChildren::where('user_id', Auth::id())
            ->where('name', $request->form)
            ->pluck('step_id')
            ->first();         
        $step = FianceVisaSubmittedStep::where('id', $stepId)
                ->first();       
        return response()->json([
            'status' => true,
            'step' => view('web.visa-application.fiance-visa.alien-children.'.$request->form.'', [
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

    public function getCities(Request $request)
    {
        $cities = EmbassyCity::where('parent_id', $request->countryId)->pluck('name');
        $getCity = '<option value="">-Select State-</option>';
        foreach ($cities as $city) {
            $getCity .= '<option value='.$city.'>'.$city.'</option>';
        }
        return $getCity;
    }
}
