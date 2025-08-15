<?php

namespace App\Http\Services\Fiance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\FianceAlienChildren;
use App\Models\FianceVisaSubmittedStep;
use App\Models\UserSubmittedApplication;
use App\Models\UserFianceVisaType;
use Auth;
use DB;

class FianceAlieChildrenService
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
                'type' => 'alien-children',
            ];

		    $step = FianceVisaSubmittedStep::updateOrCreate([
                'id' => $request->id
            ], $data);
            

            if (!FianceAlienChildren::where('user_id', Auth::id())
                    ->where('name', $request->name)
                    ->exists()) {
                FianceAlienChildren::create([
                    'user_id' => Auth::id(),
                    'step_id' => $step->id,
                    'name' => $request->name,
                ]);                    
            }

            $nextStepId = FianceAlienChildren::where('user_id', Auth::id())
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
