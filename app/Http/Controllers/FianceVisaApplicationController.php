<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\FianceStep;
use App\Models\FianceVisaStep;
use App\Models\UserSubmittedApplication;
use App\Models\FianceVisaSubmittedStep;
use App\Models\User;
use App\Models\State;
use App\Models\EmbassyCity;
use App\Models\UserFianceVisaType;
use App\Models\FianceSponsor;
use Auth;

class FianceVisaApplicationController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        if (Auth::check() && applicationRoute()) {
            return redirect()->route(applicationRoute());
        } else {
            return view('web.service.fiancee-visa');
        }
        // if (applicationRoute() == 'fiancee.visa') {
        //     return view('web.service.fiancee-visa');            
        // }
        // return redirect()->route(applicationRoute());
    }    

    public function previousOrContinue(Request $request)
    {
        $stepId = FianceVisaStep::where('user_id', Auth::id())
            ->where('name', $request->form)
            ->pluck('step_id')
            ->first();         
        $step = FianceVisaSubmittedStep::where('id', $stepId)
                ->first();       
        return response()->json([
            'status' => true,
            'step' => view('web.visa-application.fiance-visa.'.$request->type.'.'.$request->form.'', [
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
