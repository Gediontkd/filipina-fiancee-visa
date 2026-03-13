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
use App\Http\Services\Fiance\FianceSponsorService;
use App\Models\FianceStep;
use App\Models\FianceSponsor;
use App\Models\UserSubmittedApplication;
use App\Models\FianceVisaSubmittedStep;
use App\Models\User;
use App\Models\State;
use App\Models\EmbassyCity;
use App\Models\UserFianceVisaType;
use Auth;
use Illuminate\Support\Facades\Validator;

class SponsorController extends Controller
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

        if (!UserFianceVisaType::where('user_id', Auth::id())->where('type', 'sponsor')->exists()) {
            UserFianceVisaType::create([
                'user_id' => Auth::id(),
                'type' => 'sponsor',
                'status' => 'in-progress'
            ]);
        }
        $fianceSteps = FianceStep::select('id', 'name', 'icon', 'slug')
            ->where('type', 'sponsor')
            ->get();
        $form = FianceSponsor::where('user_id', Auth::id())
            ->orderBy('id', 'DESC')
            ->first();
        $step = @$form->step;
        $name = 'name';
        return view('web.visa-application.fiance-visa.sponsor.index', compact('fianceSteps', 'step', 'name'));
    }

    public function name(Request $request, FianceSponsorService $fianceSponsor)
    {
        $step = $fianceSponsor->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.sponsor.contact', [
                'step' => $fianceSponsor->next($step)
            ])->render(),
        ]);
    }

    public function contact(Request $request, FianceSponsorService $fianceSponsor)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'daytime_telephone_no' => ['required'],
            'mobile_telephone_number' => ['required'],
            'social_sec_no' => ['required'],
            'diffrent_mailing_address' => ['required', 'in:yes,no'],
        ], [
            'email.required' => 'Please enter your email address.',
            'daytime_telephone_no.required' => 'Please enter the daytime phone number.',
            'mobile_telephone_number.required' => 'Please enter the mobile phone number.',
            'social_sec_no.required' => 'Please enter the Social Security Number or mark Does Not Apply.',
            'diffrent_mailing_address.required' => 'Please answer whether your mailing address is different.',
        ]);

        $validator->after(function ($validator) use ($request) {
            $uscisNumber = strtoupper(trim((string) $request->input('uscis_no')));
            if ($uscisNumber === 'N/A') {
                $validator->errors()->add('uscis_no', 'USCIS Online Account Number must be left blank unless USCIS explicitly provided one.');
            }

            $statusStepId = FianceSponsor::where('user_id', Auth::id())
                ->where('name', 'status')
                ->pluck('step_id')
                ->first();
            $statusStep = $statusStepId ? FianceVisaSubmittedStep::find($statusStepId) : null;
            $currentStatus = $statusStep->detail['current_status'] ?? null;
            $sponsorA = strtoupper(trim((string) $request->input('sponsor_a')));

            if ($currentStatus === 'USCitizen' && $sponsorA !== '' && $sponsorA !== 'N/A') {
                $validator->errors()->add('sponsor_a', 'A U.S. citizen petitioner must not have an A-Number.');
            }
        });

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 200);
        }

        $step = $fianceSponsor->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.sponsor.place-of-birth', [
                'step' => $fianceSponsor->next($step)
            ])->render(),
        ]);
    }

    public function placeOfBirth(Request $request, FianceSponsorService $fianceSponsor)
    {
        $step = $fianceSponsor->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.sponsor.status', [
                'step' => $fianceSponsor->next($step)
            ])->render(),
        ]);
    }

    public function status(Request $request, FianceSponsorService $fianceSponsor)
    {
        if ($request->input('current_status') === 'USCitizen') {
            $contactStepId = FianceSponsor::where('user_id', Auth::id())
                ->where('name', 'contact')
                ->pluck('step_id')
                ->first();
            $contactStep = $contactStepId ? FianceVisaSubmittedStep::find($contactStepId) : null;
            $sponsorA = strtoupper(trim((string) ($contactStep->detail['sponsor_a'] ?? '')));

            if ($sponsorA !== '' && $sponsorA !== 'N/A') {
                return response()->json([
                    'status' => false,
                    'message' => 'A U.S. citizen petitioner must not have an A-Number. Please return to the contact step and clear that field.',
                ], 200);
            }
        }

        $step = $fianceSponsor->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.sponsor.marital-status', [
                'step' => $fianceSponsor->next($step)
            ])->render(),
        ]);
    }

    public function maritalStatus(Request $request, FianceSponsorService $fianceSponsor)
    {
        $step = $fianceSponsor->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.sponsor.other-filings', [
                'step' => $fianceSponsor->next($step)
            ])->render(),
        ]);
    }

    public function otherFilings(Request $request, FianceSponsorService $fianceSponsor)
    {
        try {
            // Validate the waiver document based on situation
            $request->validate([
                'i_129F' => 'required|in:yes,no',
                'situation' => 'required_if:i_129F,yes|in:situation1,situation2,situation3,situation4',
                'waiver_document' => [
                    'nullable',
                    'file',
                    'mimes:pdf,doc,docx',
                    'max:10240', // 10MB
                    function ($attribute, $value, $fail) use ($request) {
                        $situation = $request->input('situation');
                        // Require waiver for specific situations if no existing file
                        if (in_array($situation, ['situation1', 'situation2', 'situation3'])) {
                            if (!$value && !$request->input('existing_waiver_document')) {
                                $fail('A waiver document is required for the selected situation.');
                            }
                        }
                    }
                ]
            ], [
                'i_129F.required' => 'Please select whether you have filed Form I-129F before.',
                'situation.required_if' => 'Please select the situation that applies to you.',
                'waiver_document.file' => 'The waiver document must be a valid file.',
                'waiver_document.mimes' => 'Only PDF, DOC, or DOCX files are allowed.',
                'waiver_document.max' => 'The waiver document must not exceed 10MB.'
            ]);

            // Handle file upload if present
            if ($request->hasFile('waiver_document')) {
                $file = $request->file('waiver_document');
                
                // Generate unique filename
                $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $file->getClientOriginalName());
                
                // Store in public disk under waiver_documents folder
                $path = $file->storeAs('waiver_documents', $filename, 'public');
                
                // Add the file path to request data
                $request->merge(['waiver_document_path' => $path]);
                
                \Log::info('Waiver document uploaded', [
                    'user_id' => Auth::id(),
                    'filename' => $filename,
                    'path' => $path
                ]);
            }

            // Create/update the step with all form data
            $step = $fianceSponsor->create($request);
            
            return response()->json([
                'status' => true,
                'data' => view('web.visa-application.fiance-visa.sponsor.military-and-convictions', [
                    'step' => $fianceSponsor->next($step)
                ])->render(),
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed: ' . $e->validator->errors()->first(),
                'errors' => $e->validator->errors()
            ], 422);
            
        } catch (\Exception $e) {
            \Log::error('Error in otherFilings', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while saving the form. Please try again.'
            ], 500);
        }
    }

    public function militaryAndConvictions(Request $request, FianceSponsorService $fianceSponsor)
    {
        $validator = Validator::make($request->all(), [
            'member_of_us' => ['required', 'in:yes,no'],
            'protection' => ['required', 'in:yes,no'],
            'violence' => ['required', 'in:yes,no'],
            'manslaughter' => ['required', 'in:yes,no'],
            'convictions' => ['required', 'in:yes,no'],
            'drug_related' => ['required', 'in:yes,no'],
            'specified_offense' => ['required', 'in:yes,no'],
            'provide_information' => ['nullable', 'string'],
            'provide_information1' => ['nullable', 'string'],
        ], [
            'member_of_us.required' => 'Please choose whether you are currently on active duty.',
            'protection.required' => 'Please answer the protection or restraining order question.',
            'violence.required' => 'Please answer the domestic violence question.',
            'manslaughter.required' => 'Please answer the homicide or rape question.',
            'convictions.required' => 'Please answer the controlled substance or alcohol question.',
            'drug_related.required' => 'Please answer the arrests or convictions question.',
            'specified_offense.required' => 'Please answer the specified offense against a minor question.',
        ]);

        $validator->after(function ($validator) use ($request) {
            if ($request->input('violence') === 'yes' && empty($request->input('battered'))) {
                $validator->errors()->add('battered', 'Please select the explanation that applies to the domestic violence question.');
            }

            $this->validateLegalInfractionRows(
                $request->all(),
                $validator,
                ['protection', 'violence', 'manslaughter', 'convictions', 'drug_related', 'specified_offense'],
                'Petitioner'
            );
        });

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 200);
        }

        $step = $fianceSponsor->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.sponsor.address', [
                'step' => $fianceSponsor->next($step)
            ])->render(),
        ]);
    }

    public function address(Request $request, FianceSponsorService $fianceSponsor)
    {
        $step = $fianceSponsor->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.sponsor.relationship', [
                'step' => $fianceSponsor->next($step)
            ])->render(),
        ]);
    }

    public function relationship(Request $request, FianceSponsorService $fianceSponsor)
    {
        $step = $fianceSponsor->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.fiance-visa.sponsor.employment', [
                'step' => $fianceSponsor->next($step)
            ])->render(),
        ]);
    }

    public function employment(Request $request, FianceSponsorService $fianceSponsor)
    {
        $step = $fianceSponsor->create($request);
        if (FianceSponsor::where('user_id', Auth::id())->count() == 10) {
            // FianceSponsor::where('user_id', Auth::id())
            //     ->delete();                    
            UserFianceVisaType::where('user_id', Auth::id())
                ->where('type', 'sponsor')
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
        $stepId = FianceSponsor::where('user_id', Auth::id())
            ->where('name', $request->form)
            ->pluck('step_id')
            ->first();
        
        $step = FianceVisaSubmittedStep::where('id', $stepId)
            ->first();
       
        return response()->json([
            'status' => true,
            'step' => view('web.visa-application.fiance-visa.sponsor.' . $request->form . '', [
                'step' => $step
            ])->render()
        ]);
    }

    public function getState(Request $request)
    {
        $states = State::where('country_id', $request->countryId)->pluck('name');
        if (isset($request->state) && $request->state == 'N/A') {
            $states = collect($states);
            $states->prepend('N/A');
        }

        $getState = '<option value="">-Select State-</option>';
        foreach ($states as $state) {
            $selected = isset($request->state) && $state == $request->state ? 'selected' : '';
            $getState .= sprintf('<option %s value="%s">%s</option>', $selected, $state, $state);
        }
        return $getState;
    }

    // public function getState(Request $request)
    // {
    //     $states = State::where('country_id', $request->countryId)->pluck('name');
    //     if (isset($request->state) && $request->state == 'N/A') {
    //         $states = collect($states)->prepend('N/A');
    //     }

    //     $options = [
    //         '<option value="">-Select State-</option>'
    //     ];

    //     foreach ($states as $state) {
    //         $selected = isset($request->state) && $state == $request->state ? 'selected' : '';
    //         $options[] = sprintf('<option %s value="%s">%s</option>', $selected, $state, $state);
    //     }

    //     return implode('', $options);
    // }


    public function getCities(Request $request)
    {
        $cities = EmbassyCity::where('parent_id', $request->countryId)->pluck('name');
        $getCity = '<option value="">-Select City-</option>';
        
        foreach ($cities as $city) {
            $selected = isset($request->selected) && $city == $request->selected ? 'selected' : '';
            $getCity .= "<option $selected value=\"$city\">$city</option>";
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
