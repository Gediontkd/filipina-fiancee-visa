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
}