<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Auth;

class VisaApplication
{    
    public function handle(Request $request, Closure $next) 
    {
        if (Auth::check() && Auth::user()->chosen_application == '')  {
            return redirect()->route('home')->with('error', 'Please choose appkication type!');          
        } else{
            return $next($request);          
        }
    }
}
