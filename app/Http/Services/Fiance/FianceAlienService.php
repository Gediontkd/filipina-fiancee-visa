<?php

namespace App\Http\Services\Fiance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\FianceAlien;
use App\Models\FianceVisaSubmittedStep;
use App\Models\UserSubmittedApplication;
use App\Models\UserFianceVisaType;
use Auth;
use DB;
use Illuminate\Support\Facades\Log;

class FianceAlienService
{
    public function create(Request $request)
    {
        DB::beginTransaction();

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
                'type' => $request->type,
            ];

		    $step = FianceVisaSubmittedStep::updateOrCreate([
                'id' => $request->id
            ], $data);
            
            $userId = Auth::id();
            $name = $request->name;

            FianceAlien::updateOrInsert(
                [
                    'user_id' => $userId,
                    'name' => $name,
                ],
                [
                    'step_id' => $step->id,
                ]
            );

            // if (!FianceAlien::where('user_id', Auth::id())
            //         ->where('name', $request->name)
            //         ->exists()) {
            //     FianceAlien::create([
            //         'user_id' => Auth::id(),
            //         'step_id' => $step->id,
            //         'name' => $request->name,
            //     ]);                    
            // }

            $nextStepId = FianceAlien::where('user_id', Auth::id())
                ->where('name', $request->next)
                ->pluck('step_id')
                ->first();

			DB::commit();
		} catch (\Exception $e) {
            $message['message'] = $e->getMessage();
            DB::rollback();
            Log::info($e->getMessage());
            return response()->json($message, 200);
        }
        return $nextStepId;
    }

    public function next($id)
    {
        return FianceVisaSubmittedStep::where('id', $id)->first();
    }
}
