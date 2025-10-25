<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class VisaApplication
{    
    public function handle(Request $request, Closure $next) 
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // If no application chosen, redirect to home with modal
            if (empty($user->chosen_application)) {
                return redirect()->route('home')
                    ->with('show_modal', true)
                    ->with('error', 'Please choose an application type!');
            }
            
            // If application chosen but no route set, update it
            if (empty($user->application_route)) {
                $routeMap = [
                    'fiancee' => 'fianceSponsorApplication',
                    'spouse' => 'spouseVisaApplication',
                    'adjustment' => 'adjustment.show',
                    'combined' => 'combinedCr1AosApplication'
                ];
                
                $route = $routeMap[$user->chosen_application] ?? null;
                if ($route) {
                    $user->update(['application_route' => $route]);
                }
            }
        }
        
        return $next($request);          
    }
}