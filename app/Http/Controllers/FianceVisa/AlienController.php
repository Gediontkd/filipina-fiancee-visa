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
use App\Http\Services\Fiance\FianceAlienService as Alien;
use App\Models\FianceStep;
use App\Models\FianceVisaStep;
use App\Models\FianceAlien;
use App\Models\UserSubmittedApplication;
use App\Models\FianceVisaSubmittedStep;
use App\Models\User;
use App\Models\State;
use App\Models\EmbassyCity;
use App\Models\UserFianceVisaType;
use Auth;

class AlienController extends Controller
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

        if (!UserFianceVisaType::where('user_id', Auth::id())->where('type', 'alien')->exists()) {
            UserFianceVisaType::create([
                'user_id' => Auth::id(),
                'type' => 'alien',
                'status' => 'in-progress'
            ]);
        }
        $fianceSteps = FianceStep::select('id', 'name', 'icon', 'slug')
            ->where('type', 'alien')
            ->get();
        $form = FianceAlien::where('user_id', Auth::id())
            ->orderBy('id', 'DESC')
            ->first();
        $step = @$form->step;
        $name = 'name';
        return view('web.visa-application.fiance-visa.alien.index', compact('fianceSteps', 'step', 'name'));
    }

    public function name(Request $request, Alien $alien)
    {                     
        $step = $alien->create($request);        
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.citizenship', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function citizenship(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.embassy', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function embassy(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.contact', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function contact(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.marital-status', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function maritalStatus(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.parents', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }
    
    public function parents(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.visited-us', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function visitUS(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.address', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function address(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.employment', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function employment(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.schools', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }    

    public function school(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.travel', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function travel(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.military', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }    

    public function military(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.activity', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function activity(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.immigration', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function immigration(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.languages', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function language(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.relatives', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function relative(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.question1', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function question1(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.question2', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function question2(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.question3', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function question3(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.question4', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function question4(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.question5', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function question5(Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        if (FianceAlien::where('user_id', Auth::id())->count() == 21) {
            // FianceAlien::where('user_id', Auth::id())->delete();                    
            UserFianceVisaType::where('user_id', Auth::id())
                ->where('type', 'alien')
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
        $stepId = FianceAlien::where('user_id', Auth::id())
            ->where('name', $request->form)
            ->pluck('step_id')
            ->first();         
        $step = FianceVisaSubmittedStep::where('id', $stepId)
            ->first();  
             
        return response()->json([
            'status' => true,
            'step' => view('web.visa-application.fiance-visa.alien.'.$request->form.'', [
                'step' => $step
            ])->render()
        ]);
    }

    public function getState(Request $request)
    {
        $states = State::where('country_id', $request->countryId)->pluck('name');
        $getState = '<option value="">-Select State-</option>';
        foreach ($states as $state) {
            $selected = isset($request->state) && $state == $request->state ? 'selected' : '';
            $getState .= sprintf('<option %s value="%s">%s</option>', $selected, $state, $state);
        }
        return $getState;
    }

    public function getCities(Request $request)
    {
        $cities = EmbassyCity::where('parent_id', $request->countryId)->pluck('name');
        $getCity = '<option value="">-Select City-</option>';
        foreach ($cities as $city) {
            $selected = isset($request->selected) && $city == $request->selected ? 'selected' : '';
            $getCity .= sprintf('<option %s value="%s">%s</option>', $selected, $city, $city);
        }
        return $getCity;
    }
}
