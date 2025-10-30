<?php

namespace App\Http\Services\Spouse;

use Illuminate\Http\Request;
use App\Models\SpouseSponsor;
use App\Models\SpouseVisaSubmittedStep;
use App\Models\UserSubmittedApplication;
use App\Models\UserSpouseVisaType;
use Auth;
use DB;
use Log;

class SpouseSponsorService
{
    public function create(Request $request)
    {       
        DB::beginTransaction();

        try {
            $requestData = $request->all();
            
            $data = [
                'user_id' => Auth::id(),
                'submitted_app_id' => $request->submitted_app_id,
                'step' => $request->name,
                'detail' => serialize($requestData),
                'section' => 'sponsor',
            ];

            $step = SpouseVisaSubmittedStep::updateOrCreate(
                ['id' => $request->id], 
                $data
            ); 
            
            // CRITICAL: Track completed steps (same as FianceSponsorService)
            SpouseSponsor::updateOrInsert(
                [
                    'user_id' => Auth::id(),
                    'name' => $request->name,
                ],
                [
                    'step_id' => $step->id,
                ]
            );

            // Mark section complete if all 9 steps done
            if (SpouseSponsor::where('user_id', Auth::id())->count() == 9) {
                UserSpouseVisaType::where('user_id', Auth::id())
                    ->where('type', 'sponsor')
                    ->where('status', 'in-progress')
                    ->update(['status' => 'completed']);
            }

            $nextStepId = SpouseSponsor::where('user_id', Auth::id())
                ->where('name', $request->next)
                ->pluck('step_id')
                ->first();

            DB::commit();
            
            Log::info('Spouse sponsor step saved', [
                'user_id' => Auth::id(),
                'step' => $request->name,
                'total_steps' => SpouseSponsor::where('user_id', Auth::id())->count()
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            
            Log::error('Error saving spouse sponsor step', [
                'user_id' => Auth::id(),
                'step' => $request->name ?? 'unknown',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            throw $e;
        }
        
        return $nextStepId;
    }

    public function next($id)
    {
        return SpouseVisaSubmittedStep::where('id', $id)->first();
    }
}