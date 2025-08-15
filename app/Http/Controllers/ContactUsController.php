<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\ContactUsNotification;
use App\Models\User;
use App\Models\ContactUs;
use App\Models\NewsLetter;
use App\Mail\ContactUsMail;
use Validator;
use DB;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('web.contact-us');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required",
            "subject" => "required",
            "message" => "required",
            'captcha' => 'required|captcha'
        ],[
            'captcha.required' => 'Please enter captcha!',
            'captcha.captcha' => 'Please enter a valid captcha!'
        ]);      

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            
            $contactUs = ContactUs::create($request->all());
            $details = [
                'email' => $contactUs->email,
                'message' => $contactUs->message,
            ];
            // $admin = User::where('email', 'developerindiit@gmail.com')->first();
            // $contactUs = ContactUs::where('email', $request->email)->first();
            // $admin->notify(new ContactUsNotification($contactUs));
            \Mail::to('support@filipinafianceevisa.com')->send(new ContactUsMail($details));

            DB::commit();
            return redirect()->route('home')->with('success', 'Success! Message has been sent!');
            
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }        
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function newsletter(Request $request)
    {
        if (!NewsLetter::where('email', $request->email)->exists()) {
            NewsLetter::create($request->all());
            return redirect()->route('home')->with('success', 'You have subscribed the NewsLetter!');
        } else {
            return redirect()->route('home')->with('error', 'This email has already exist!');
        }
    }
}
