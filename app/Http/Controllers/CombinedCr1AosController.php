<?php
// app/Http/Controllers/CombinedCr1AosController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Combined\CombinedCr1AosService;
use App\Models\CombinedCr1AosStep;
use App\Models\CombinedCr1AosVisaStep;
use App\Models\CombinedCr1AosSubmittedStep;
use App\Models\UserSubmittedApplication;
use Auth;

class CombinedCr1AosController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $request['submitted_app_id'] = UserSubmittedApplication::where('user_id', Auth::id())
                ->where('application_id', 4) // Combined ID
                ->where('status', 'pending')
                ->pluck('id')
                ->first();
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        if (Auth::check() && applicationRoute()) {
            return applicationRoute();
        }
        
        return view('web.service.combined-cr1-aos');
    }

    public function application(Request $request)
    {
        $combinedSteps = CombinedCr1AosStep::select('id', 'name', 'icon', 'slug')
            ->orderBy('order')
            ->get();
        
        $form = CombinedCr1AosVisaStep::where('user_id', Auth::id())
            ->orderBy('id', 'DESC')
            ->first();
        
        $step = @$form->step ?? null;
        $name = 'petitioner-name';
        
        return view('web.visa-application.combined-cr1-aos.index', compact('combinedSteps', 'step', 'name'));
    }

    // Form step handlers
    public function petitionerName(Request $request, CombinedCr1AosService $service)
    {
        $step = $service->create($request);
        return response()->json([
            'status' => true,
            'data' => view('web.visa-application.combined-cr1-aos.petitioner-contact', [
                'step' => $service->next($step)
            ])->render(),
        ]);
    }

    // Add more step handlers as needed...

    public function previousOrContinue(Request $request)
    {
        $stepId = CombinedCr1AosVisaStep::where('user_id', Auth::id())
            ->where('name', $request->form)
            ->pluck('step_id')
            ->first();
        
        $step = CombinedCr1AosSubmittedStep::where('id', $stepId)->first();
        
        return response()->json([
            'status' => true,
            'step' => view('web.visa-application.combined-cr1-aos.' . $request->form, [
                'step' => $step
            ])->render()
        ]);
    }
}