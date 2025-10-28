<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PaymentCard;
use App\Models\ComposeMail;
use App\Models\VisaApplication;
use App\Models\UserSubmittedApplication;
use App\Models\FianceVisaSubmittedStep;
use App\Models\AdjustmentVisaSubmittedStep;
use App\Models\SpouseVisaSubmittedStep;
use Mail;
use Auth;
use DB;

class ProfileController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function profile(Request $request, $page)
    {
        $user = Auth::user();
        
        // Get submitted application
        $submission = UserSubmittedApplication::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->with('visaApplication')
            ->first();
        
        // Initialize progress variables
        $sponsorTotal = 0;
        $alienTotal = 0;
        $alienChildrenTotal = 0;
        $spouseSponsorTotal = 0;
        $spouseBeneficiaryTotal = 0;
        $spouseRelationshipTotal = 0;
        $overAll = 0;
        
        // Calculate progress based on application type
        if ($submission) {
            switch ($submission->application_id) {
                case 1: // Fiancée Visa
                    $alienCount = FianceVisaSubmittedStep::where('user_id', Auth::id())
                        ->where('type', 'alien')->count();
                    $sponsorCount = FianceVisaSubmittedStep::where('user_id', Auth::id())
                        ->where('type', 'sponsor')->count();
                    $alienChildrenCount = FianceVisaSubmittedStep::where('user_id', Auth::id())
                        ->where('type', 'alien-children')->count();
                    
                    $alienTotal = ($alienCount / 21) * 100;
                    $sponsorTotal = ($sponsorCount / 10) * 100;
                    $alienChildrenTotal = ($alienChildrenCount / 5) * 100;     
                    $overAll = (($alienCount + $sponsorCount + $alienChildrenCount) / 36) * 100;
                    break;
                    
                case 2: // Adjustment of Status
                    $count = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())->count();
                    $overAll = ($count / 17) * 100;
                    break;
                    
                case 3: // Spouse Visa
                        // Calculate Sponsor Section Progress (9 steps)
                        $sponsorCount = SpouseVisaSubmittedStep::where('user_id', Auth::id())
                            ->where('section', 'sponsor')  // Changed from 'type' to 'section'
                            ->count();
                        $spouseSponsorTotal = ($sponsorCount / 9) * 100;
                        
                        // Calculate Beneficiary Section Progress (7 steps)
                        $beneficiaryCount = SpouseVisaSubmittedStep::where('user_id', Auth::id())
                            ->where('section', 'beneficiary')  // Changed from 'type' to 'section'
                            ->count();
                        $spouseBeneficiaryTotal = ($beneficiaryCount / 7) * 100;
                        
                        // Calculate Relationship/Shared Progress (1 step)
                        $relationshipCount = SpouseVisaSubmittedStep::where('user_id', Auth::id())
                            ->where('section', 'shared')  // Changed from 'type' to 'section'
                            ->count();
                        $spouseRelationshipTotal = ($relationshipCount / 1) * 100;
                        
                        // Overall Spouse Visa Progress (17 total steps)
                        $overAll = (($sponsorCount + $beneficiaryCount + $relationshipCount) / 17) * 100;
                        break;
                    
                case 4: // Combined CR1 + AOS
                    // Add this if you have a CombinedCr1AosSubmittedStep model
                    // $count = CombinedCr1AosSubmittedStep::where('user_id', Auth::id())->count();
                    // $overAll = ($count / 20) * 100;
                    $overAll = 0; // Placeholder until implemented
                    break;
                    
                default:
                    $overAll = 0;
            }
        }
        
        return view("web.user.$page", compact(
            'submission',
            'sponsorTotal', 
            'alienTotal', 
            'alienChildrenTotal',
            'spouseSponsorTotal',
            'spouseBeneficiaryTotal',
            'spouseRelationshipTotal',
            'overAll'
        ));
    }

    public function basicInformation(Request $request)
    {
        User::where('id', Auth::id())->update($request->except('_token'));
        return redirect()->back()->with('success', 'Profile has been updated!');
    }

    public function changePassword(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        if (Hash::check($request->old_password, $user->password)) {
            User::where('id', Auth::id())->update([
                'password' => Hash::make($request->confirm_password),
            ]);
            return redirect()->back()->with('success', 'Password has been updated!');            
        } else {
            return redirect()->back()->with('error', 'Your current password is invalid!');
        }
    }

    public function paymentCard()
    {
        $cards = PaymentCard::where('user_id', Auth::id())->get();
        return view('web.user.payment-card', compact('cards'));
    }

    public function addPaymentCard(Request $request)
    {
        $request['user_id'] = Auth::id();
        PaymentCard::create($request->all());
        return redirect()->back()->with('success', 'Card has been added!');
    }

    public function deletePaymentCard(Request $request, $id)
    {
        PaymentCard::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Card has been deleted!');
    }

    public function mails()
    {
        $mails = ComposeMail::where('user_id', Auth::id())->get();        
        return view('web.user.mail', compact('mails'));
    }

    public function sendMail(Request $request)
    {
        $request['user_id'] = Auth::id();
        ComposeMail::create($request->all());
        return redirect()->back()->with('success', 'Mail has been sent!');
    }

    public function deleteMail(Request $request)
    {
        if (isset($request->ids)) {
            ComposeMail::whereIn('id', $request->ids)->delete();
            return response()->json([
                'status' => true,
                'message' => 'Mail has been deleted!',
                'data' => '',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please choose at least one mail',
                'data' => '',
            ]);
        }
    }

    public function chooseApplication(Request $request)
    {
        DB::beginTransaction();

        try {
            // Map application types to their route names and IDs
            $applicationMap = [
                'fiancee' => [
                    'route' => 'fianceSponsorApplication',
                    'id' => 1,
                    'name' => 'Fiancée Visa (K-1)'
                ],
                'spouse' => [
                    'route' => 'spouseVisaApplication',
                    'id' => 3,
                    'name' => 'Spouse Visa (CR-1/IR-1)'
                ],
                'adjustment' => [
                    'route' => 'adjustment.show',
                    'id' => 2,
                    'name' => 'Adjustment of Status'
                ],
                'combined' => [
                    'route' => 'combinedCr1AosApplication',
                    'id' => 4,
                    'name' => 'Combined CR-1 + AOS Package'
                ]
            ];

            $chosen = $request->chosen_application;
            
            if (!isset($applicationMap[$chosen])) {
                return redirect()->back()->with('error', 'Invalid application type selected');
            }

            $appData = $applicationMap[$chosen];

            // Update user record
            User::where('id', Auth::id())->update([
                'chosen_application' => $chosen,
                'application_route' => $appData['route']
            ]);

            // Create UserSubmittedApplication record if it doesn't exist
            UserSubmittedApplication::firstOrCreate(
                [
                    'user_id' => Auth::id(),
                    'application_id' => $appData['id']
                ],
                [
                    'status' => 'pending',
                    'submitted_at' => null
                ]
            );
            
            DB::commit();
            
            // Redirect to the appropriate application form
            return redirect()->route($appData['route'])
                ->with('success', 'Application type selected. Please complete your application.');

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Choose application error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred. Please try again.');
        }       
    }
}