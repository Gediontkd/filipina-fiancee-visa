<?php
// app/Http/Services/Combined/CombinedCr1AosService.php

namespace App\Http\Services\Combined;

use Illuminate\Http\Request;
use App\Models\CombinedCr1AosVisaStep;
use App\Models\CombinedCr1AosSubmittedStep;
use App\Models\UserSubmittedApplication;
use Auth;
use DB;

class CombinedCr1AosService
{
    public function create(Request $request)
    {
        DB::beginTransaction();
        
        try {
            // Filter out any File objects (prevents serialization issues)
            $requestData = array_filter($request->all(), function($value) {
                return !($value instanceof \Illuminate\Http\UploadedFile);
            });

            $data = [
                'user_id' => Auth::id(),
                'submitted_app_id' => $request->submitted_app_id,
                'step' => $request->name,
                'detail' => $requestData,
            ];

            $step = CombinedCr1AosSubmittedStep::updateOrCreate([
                'id' => $request->id
            ], $data);

            if (!CombinedCr1AosVisaStep::where('user_id', Auth::id())
                    ->where('name', $request->name)
                    ->exists()) {
                    
                // If it's the last step, mark as complete
                if ($request->name == 'work-authorization') {
                    CombinedCr1AosVisaStep::where('user_id', Auth::id())->delete();
                    UserSubmittedApplication::where('user_id', Auth::id())
                        ->where('application_id', 4) // Combined ID
                        ->where('status', 'pending')
                        ->update(['status' => 'progress']);
                } else {
                    CombinedCr1AosVisaStep::create([
                        'user_id' => Auth::id(),
                        'step_id' => $step->id,
                        'name' => $request->name,
                    ]);
                }
            }

            $nextStepId = CombinedCr1AosVisaStep::where('user_id', Auth::id())
                ->where('name', $request->next)
                ->pluck('step_id')
                ->first();

            DB::commit();
            
            // Fix: If next step not found (not visited yet), return null or handle it
            // Ideally, we want to return the submitted step if it exists, otherwise null
            return $nextStepId;
            
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 200);
        }
    }

    public function next($id)
    {
        if (!$id) {
            return new CombinedCr1AosSubmittedStep();
        }
        return CombinedCr1AosSubmittedStep::where('id', $id)->first() ?? new CombinedCr1AosSubmittedStep();
    }
}