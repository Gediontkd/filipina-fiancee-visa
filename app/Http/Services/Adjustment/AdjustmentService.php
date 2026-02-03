<?php

namespace App\Http\Services\Adjustment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\AdjustmentVisaStep;
use App\Models\AdjustmentVisaSubmittedStep;
use App\Models\UserSubmittedApplication;
use Auth;
use DB;

class AdjustmentService
{
    public function create(Request $request)
    {
        try {
            // Filter out any File objects before serialization (prevents 500 error)
            $requestData = array_filter($request->all(), function($value) {
                return !($value instanceof \Illuminate\Http\UploadedFile);
            });

            $data = [
                'user_id' => Auth::id(),
                'submitted_app_id' => $request->submitted_app_id,
                'step' => $request->name,
                'detail' => serialize($requestData),
            ];

		    $step = AdjustmentVisaSubmittedStep::updateOrCreate([
                'id' => $request->id
            ], $data);          

            if (!AdjustmentVisaStep::where('user_id', Auth::id())
                    ->where('name', $request->name)
                    ->exists()) {
                if ($request->name == 'employment') {
                    AdjustmentVisaStep::where('user_id', Auth::id())
                        ->delete();
                    UserSubmittedApplication::where('user_id', Auth::id())
                        ->where('application_id', 2)
                        ->where('status', 'pending')
                        ->update(['status' => 'progress']);
                } else {
                    AdjustmentVisaStep::create([
                        'user_id' => Auth::id(),
                        'step_id' => $step->id,
                        'name' => $request->name,
                    ]);                    
                }
            }

            $nextStepId = AdjustmentVisaStep::where('user_id', Auth::id())
                ->where('name', $request->next)
                ->pluck('step_id')
                ->first();

			DB::commit();
		} catch (\Exception $e) {
            $message['message'] = $e->getMessage();
            DB::rollback();
            return response()->json($message, 200);
        }
        return $nextStepId;
    }

    public function next($id)
    {
        return AdjustmentVisaSubmittedStep::where('id', $id)->first();
    }
}
