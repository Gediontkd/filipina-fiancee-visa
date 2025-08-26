<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // No authentication required for viewing service pages
    }

    /**
     * Display the Removal of Conditions (ROC) service page.
     *
     * @return \Illuminate\Http\Response
     */
    public function removalOfConditions()
    {
        // Check if user has active application that should redirect
        if (Auth::check() && applicationRoute() && applicationRoute() !== 'removal.conditions') {
            return applicationRoute();
        }
        
        return view('web.service.removal-of-conditions');
    }

    /**
     * Display the IR5 Parent Visa service page.
     *
     * @return \Illuminate\Http\Response
     */
    public function ir5ParentVisa()
    {
        // Check if user has active application that should redirect
        if (Auth::check() && applicationRoute() && applicationRoute() !== 'ir5.parent.visa') {
            return applicationRoute();
        }
        
        return view('web.service.ir5-parent-visa');
    }

    /**
     * Display the Child Petition service page.
     *
     * @return \Illuminate\Http\Response
     */
    public function petitionChild()
    {
        // Check if user has active application that should redirect
        if (Auth::check() && applicationRoute() && applicationRoute() !== 'petition.child') {
            return applicationRoute();
        }
        
        return view('web.service.petition-child');
    }

    /**
     * Display the Naturalization service page.
     *
     * @return \Illuminate\Http\Response
     */
    public function naturalization()
    {
        // Check if user has active application that should redirect
        if (Auth::check() && applicationRoute() && applicationRoute() !== 'naturalization') {
            return applicationRoute();
        }
        
        return view('web.service.naturalization');
    }

    /**
     * Display the Combined CR-1 + AOS service page.
     *
     * @return \Illuminate\Http\Response
     */
    public function combinedCr1Aos()
    {
        // Check if user has active application that should redirect
        if (Auth::check() && applicationRoute() && applicationRoute() !== 'combined.cr1.aos') {
            return applicationRoute();
        }
        
        return view('web.service.combined-cr1-aos');
    }
}