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
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'number_and_street' => ['required'],
            'apartment_suite_or_floor' => ['required'],
            'apartment_suite_or_floor_no' => ['required'],
            'town_or_city' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
            'province' => ['required'],
            'postal_code' => ['required'],
            'date_from' => ['required'],
            'native_alphabet_name' => ['required'],
            'native_alphabet_address' => ['required'],
        ], [
            'native_alphabet_name.required' => 'Please enter the beneficiary native alphabet name or N/A.',
            'native_alphabet_address.required' => 'Please enter the beneficiary native alphabet address or N/A.',
        ]);

        $validator->after(function ($validator) use ($request) {
            if ($request->input('country') === 'Philippines') {
                $nativeName = strtoupper(trim((string) $request->input('native_alphabet_name')));
                $nativeAddress = strtoupper(trim((string) $request->input('native_alphabet_address')));

                if ($nativeName !== 'N/A' || $nativeAddress !== 'N/A') {
                    $validator->errors()->add('native_alphabet_name', 'For Philippine cases, the native alphabet section must be completed as N/A.');
                }
            }
        });

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 200);
        }

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
            'data' => view('web.visa-application.fiance-visa.alien.travel', [
            // 'data' => view('web.visa-application.fiance-visa.alien.schools', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }    

    // public function school(Request $request, Alien $alien)
    // {
    //     $step = $alien->create($request);
    //     return response()->json([
    //         'status' => true,
    //         'data' => view('web.visa-application.fiance-visa.alien.travel', [
    //             'step' => $alien->next($step)
    //         ])->render(),
    //     ]);
    // } 

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

    public function activity(ActivityRequest $request, Alien $alien)
    {
        $validator = Validator::make($request->all(), [
            'org_name1' => ['required_if:organization,yes'],
            'clan_tribe_name' => ['required_if:clan_tribe,yes'],
            'explain_conviction' => ['nullable', 'string'],
        ], [
            'org_name1.required_if' => 'Please enter at least one organization name.',
            'clan_tribe_name.required_if' => 'Please enter the clan or tribe name.',
        ]);

        $validator->after(function ($validator) use ($request) {
            $this->validateLegalInfractionRows(
                $request->all(),
                $validator,
                ['arrested_convicted'],
                'Beneficiary'
            );
        });

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 200);
        }

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

    public function question1(Ques1Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.question2', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function question2(Ques2Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.question3', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function question3(Ques3Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.question4', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function question4(Ques4Request $request, Alien $alien)
    {
        $step = $alien->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.alien.question5', [
                'step' => $alien->next($step)
            ])->render(),
        ]);
    }

    public function question5(Ques5Request $request, Alien $alien)
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

    private function validateLegalInfractionRows(array $data, $validator, array $triggerFields, string $label): void
    {
        $requiresRows = false;

        foreach ($triggerFields as $field) {
            if (($data[$field] ?? null) === 'yes') {
                $requiresRows = true;
                break;
            }
        }

        if (!$requiresRows) {
            return;
        }

        $completedRows = 0;

        for ($i = 1; $i <= 5; $i++) {
            $charge = trim((string) ($data["legal_infraction_charge_name{$i}"] ?? ''));
            $date = trim((string) ($data["legal_infraction_charge_date{$i}"] ?? ''));
            $outcome = trim((string) ($data["legal_infraction_outcome{$i}"] ?? ''));

            if ($charge === '' && $date === '' && $outcome === '') {
                continue;
            }

            if ($charge === '' || $date === '' || $outcome === '') {
                $validator->errors()->add(
                    "legal_infraction_charge_name{$i}",
                    "{$label} legal infractions require the exact charge name, mm/dd/yyyy date, and final outcome on each row used."
                );

                continue;
            }

            if (!$this->isValidUsDate($date)) {
                $validator->errors()->add(
                    "legal_infraction_charge_date{$i}",
                    "{$label} legal infraction dates must be in mm/dd/yyyy format."
                );

                continue;
            }

            $completedRows++;
        }

        if ($completedRows === 0) {
            $validator->errors()->add(
                'legal_infraction_charge_name1',
                "{$label} legal infractions must be entered one charge per row with exact charge name, mm/dd/yyyy date, and final outcome."
            );
        }
    }

    private function isValidUsDate(string $value): bool
    {
        $date = \DateTime::createFromFormat('m/d/Y', $value);

        return $date !== false && $date->format('m/d/Y') === $value;
    }
}
