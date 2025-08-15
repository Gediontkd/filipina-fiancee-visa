<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\Payment;
use App\Models\UserSubmittedApplication;
use App\Models\AdjustmentType;
use App\Models\User;
use Mail;
use Stripe;
use Auth;
use DB;

class StripeController extends Controller
{
    public function index(Request $request)
    {
        return view('web.visa-application.stripe');
    }
    // public function store(Request $request)
    // {
    //     $applicationId = UserSubmittedApplication::where('user_id', Auth::id())
    //             ->where('application_id', $request->application_id)
    //             ->where('status', 'pending')
    //             ->pluck('id')
    //             ->first();
    //     $request['transaction_id'] = Auth::id().'_1_'.Str::random(5);
    //     $request['status'] = 'pending';
    //     if (isset($applicationId)) {
    //         // Logic for Adjucement of status
    //         $appType = AdjustmentType::where('submitted_app_id', $applicationId)
    //             ->pluck('name')
    //             ->first();
    //         if (isset($appType)) {
    //             $type = $appType == 'Alien' ? 'spouse' : $appType;            
    //             return redirect()->route('adjustmentVisaApplication', $type);
    //         } else {
    //             return redirect()->route($request->route);
    //         }            
    //     } else {
    //         UserSubmittedApplication::create($request->all());            
    //         return redirect()->route($request->route);
    //     }
    // }

    public function store(Request $request)
    {           
        DB::beginTransaction();

        try {

            $user = Auth::user();                     
            $request['status'] = 'pending';          

            Stripe\Stripe::setApiKey(env('STRIPE_LIVE_SECRET'));
            $customer = Stripe\Customer::create([
                'email' => $user->email,
                'name' => $user->name,
                "source" => $request->stripeToken,
                'description' => 'Test Description',
            ]);
            $charge = Stripe\Charge::create([
                "customer" => $customer->id,
                "amount"   => (int)$request->price * 100,
                "currency" => "usd",
                "description" => "This is test description!",
            ]);
            
            User::where('id', $user->id)->update([
                'stripe_customer_id' => $customer->id,
                'application_route' => $request->route,
            ]);

            $request['transaction_id'] = $charge->balance_transaction;     
            UserSubmittedApplication::create($request->all()); 
            $data = [
                'price' => $request->price,
                'transaction_id' => $request->transaction_id,
                'route' => route('user.page', 'progress'),
            ];             
            Mail::to($user->email)->send(new Payment($data));

            DB::commit();            

            return redirect()->route('user.page', 'progress');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }    
    }
}
