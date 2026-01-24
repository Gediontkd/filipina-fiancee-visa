<?php

namespace App\Http\Services\Fiance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\FianceVisaStep;
use App\Models\FianceVisaSubmittedStep;
use App\Models\UserSubmittedApplication;
use App\Models\UserFianceVisaType;
use Auth;
use DB;

class FianceService
{
    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = [
                'user_id' => Auth::id(),
                'submitted_app_id' => $request->submitted_app_id,
                'step' => $request->name,
                'detail' => serialize($request->all()),
                'type' => $request->type,
            ];

		    $step = FianceVisaSubmittedStep::updateOrCreate([
                'id' => $request->id
            ], $data);
            

            if (!FianceVisaStep::where('user_id', Auth::id())
                    ->where('name', $request->name)
                    ->exists()) {
                if ($request->name == 'question5') {
                    FianceVisaStep::where('user_id', Auth::id())
                        ->delete();                    
                    UserSubmittedApplication::where('user_id', Auth::user()->id)
                        ->where('application_id', 1)
                        ->where('status', 'pending')
                        ->update(['status' => 'progress']);
                } elseif ($request->name == 'status') {
                    FianceVisaStep::where('user_id', Auth::id())
                        ->delete();                   
                    UserSubmittedApplication::where('user_id', Auth::user()->id)
                        ->where('application_id', 1)
                        ->where('status', 'pending')
                        ->update(['status' => 'progress']);
                } else {
                    FianceVisaStep::create([
                        'user_id' => Auth::id(),
                        'step_id' => $step->id,
                        'name' => $request->name,
                    ]);                    
                }
            }

            $nextStepId = FianceVisaStep::where('user_id', Auth::id())
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
        return FianceVisaSubmittedStep::where('id', $id)->first();
    }
}
