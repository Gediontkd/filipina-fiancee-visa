<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Session;

class LocalizationController extends Controller
{   
    public function changeLang(Request $request)
    {
        Session::forget('locale');
        App::setLocale($request->lang);
        Session::put('locale', $request->lang);  
        return redirect()->back();
    }
}