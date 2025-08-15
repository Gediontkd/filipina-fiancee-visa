<?php

namespace App\Http\Services\Spouse;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\SpouseVisaStep;
use App\Models\SpouseVisaSubmittedStep;
use App\Models\UserSubmittedApplication;
use Auth;
use DB;

class SpouseService
{
    public function create(Request $request)
    {
        try {
            $data = [
                'user_id' => Auth::id(),
                'submitted_app_id' => $request->submitted_app_id,
                'step' => $request->name,
                'detail' => serialize($request->all()),
            ];

		    $step = SpouseVisaSubmittedStep::updateOrCreate([
                'id' => $request->id
            ], $data);          

            if (!SpouseVisaStep::where('user_id', Auth::id())
                    ->where('name', $request->name)
                    ->exists()) {
                if ($request->name == 'employment') {
                    SpouseVisaStep::where('user_id', Auth::id())
                        ->delete();
                    UserSubmittedApplication::where('user_id', Auth::user()->id)
                        ->where('application_id', 3)
                        ->where('status', 'pending')
                        ->update(['status' => 'progress']);
                } else {
                    SpouseVisaStep::create([
                        'user_id' => Auth::id(),
                        'step_id' => $step->id,
                        'name' => $request->name,
                    ]);                    
                }
            }

            $nextStepId = SpouseVisaStep::where('user_id', Auth::id())
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
        return SpouseVisaSubmittedStep::where('id', $id)->first();
    }
}
