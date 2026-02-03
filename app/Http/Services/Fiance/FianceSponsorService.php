<?php

namespace App\Http\Services\Fiance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\FianceSponsor;
use App\Models\FianceVisaSubmittedStep;
use App\Models\UserSubmittedApplication;
use App\Models\UserFianceVisaType;
use Auth;
use DB;

class FianceSponsorService
{
    public function create(Request $request)
    {       
        DB::beginTransaction();

        try {
            // Get all request data and filter out any File objects
            // PHP cannot serialize File objects, which causes a 500 error
            $requestData = array_filter($request->all(), function($value) {
                return !($value instanceof \Illuminate\Http\UploadedFile);
            });
            
            // If waiver_document_path was added by controller, ensure it's in the filtered data
            if ($request->has('waiver_document_path')) {
                $requestData['waiver_document_path'] = $request->waiver_document_path;
            }

            $data = [
                'user_id' => Auth::id(),
                'submitted_app_id' => $request->submitted_app_id,
                'step' => $request->name,
                'detail' => serialize($requestData),
                'type' => $request->type,
            ];

            $step = FianceVisaSubmittedStep::updateOrCreate(['id' => $request->id], $data); 
            
            $userId = Auth::id();
            $name = $request->name;

            FianceSponsor::updateOrInsert(
                [
                    'user_id' => $userId,
                    'name' => $name,
                ],
                [
                    'step_id' => $step->id,
                ]
            );

            $nextStepId = FianceSponsor::where('user_id', Auth::id())
                ->where('name', $request->next)
                ->pluck('step_id')
                ->first();

            DB::commit();
            
            // Log successful save for debugging
            Log::info('Fiance sponsor step saved', [
                'user_id' => Auth::id(),
                'step' => $request->name,
                'has_waiver' => $request->has('waiver_document_path')
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            
            Log::error('Error saving fiance sponsor step', [
                'user_id' => Auth::id(),
                'step' => $request->name ?? 'unknown',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            throw $e; // Re-throw to be caught by controller
        }
        
        return $nextStepId;
    }

    public function next($id)
    {
        return FianceVisaSubmittedStep::where('id', $id)->first();
    }
}