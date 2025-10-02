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
// use App\Mail\ComposeMail;
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
        $steps = UserSubmittedApplication::select('application_id', 'created_at')
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();       
        // echo '<pre>';
        // print_r($steps);
        // die; 
        $alienCount = FianceVisaSubmittedStep::AlienCount();
        $sponsorCount = FianceVisaSubmittedStep::SponsorCount();
        $alienChildrenCount = FianceVisaSubmittedStep::AlienChildrenCount();
        $alienTotal = ($alienCount/21)*100;
        $sponsorTotal = ($sponsorCount/10)*100;
        $alienChildrenTotal = ($alienChildrenCount/5)*100;     
        $overAll = FianceVisaSubmittedStep::OverAllCount();
        $overAll = ($overAll/36)*100;    

        // switch (1) {
        //     case 1:
        //         $alienCount = FianceVisaSubmittedStep::AlienCount();
        //         $sponsorCount = FianceVisaSubmittedStep::SponsorCount();
        //         $alienChildrenCount = FianceVisaSubmittedStep::AlienChildrenCount();
        //         $alienTotal = ($alienCount/21)*100;
        //         $sponsorTotal = ($sponsorCount/10)*100;
        //         $alienChildrenTotal = ($alienChildrenCount/5)*100;     
        //         $overAll = FianceVisaSubmittedStep::OverAllCount();
        //         $overAll = ($overAll/36)*100;           
        //     break; 
        //     case 2:
        //         $count = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())
        //             ->count();
        //         $total = 10;
        //     break;
        //     case 3:
        //         $count = SpouseVisaSubmittedStep::where('user_id', Auth::id())
        //             ->count();
        //         $total = 5;
        //     break;
        //     default:
        //         $count = 0;
        //         $total = 0;
        //     break;
        // }
      
        // $sponsor = FianceVisaSubmittedStep::where('user_id', Auth::id())
        //     ->where('type', 'sponsor')
        //     ->count();
        // $sponsor = ($sponsor/10)*100;
        // $alien = FianceVisaSubmittedStep::where('user_id', Auth::id())
        //     ->where('type', 'alien')
        //     ->count();
        // $alien = ($alien/17)*100;
        // $alienChildren = FianceVisaSubmittedStep::where('user_id', Auth::id())
        //     ->where('type', 'alien-children')
        //     ->count();        
        // $alienChildren = ($alienChildren/5)*100;  
        // $overAll = FianceVisaSubmittedStep::where('user_id', Auth::id())
        //     ->count();
        // $overAll = ($overAll/32)*100; 

        return view("web.user.$page", compact('steps', 'sponsorTotal', 'alienTotal', 'alienChildrenTotal', 'overAll'));
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
        // Mail::to($request->to)->send(new ComposeMail());
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
        User::where('id', Auth::id())->update(['chosen_application' => $request->chosen_application]);
        
        DB::commit();
        return redirect()->route('user.page', ['page' => 'progress']);

    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', $e->getMessage());
    }       
}
}
