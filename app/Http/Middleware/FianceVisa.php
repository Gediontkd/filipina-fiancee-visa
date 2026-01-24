<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserFianceVisaType;
use Auth;

class FianceVisa
{    
    public function handle(Request $request, Closure $next)
    {
        // $check = UserFianceVisaType::where('user_id', Auth::id())->exists();
        // if ($check) {
        //     return 'test';
        // } else {
        //     return 'ttt';
        // }
        return $next($request);
    }
}
