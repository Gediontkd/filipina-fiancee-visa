<?php

namespace App\Http\Services\AdjustmentOfStatus;

use App\Models\SimplifiedAosApplication;
use App\Models\UserSubmittedApplication;
use Illuminate\Http\Request;
use Auth;
use DB;
use Log;

/**
 * Simplified AOS Service
 * Handles business logic for Adjustment of Status applications
 */
class SimplifiedAosService
{
    /**
     * Save or update AOS application
     */
    public function saveApplication(Request $request)
    {
        DB::beginTransaction();

        try {
            $applicationData = [
                'user_id' => Auth::id(),
                'submitted_app_id' => $request->submitted_app_id,
                
                // Applicant Information
                'applicant_first_name' => $request->applicant_first_name,
                'applicant_middle_name' => $request->applicant_middle_name,
                'applicant_last_name' => $request->applicant_last_name,
                'applicant_email' => $request->applicant_email,
                'applicant_phone' => $request->applicant_phone,
                'applicant_address' => $request->applicant_address,
                'applicant_city' => $request->applicant_city,
                'applicant_state' => $request->applicant_state,
                'applicant_zip' => $request->applicant_zip,
                'applicant_dob' => $request->applicant_dob,
                'applicant_place_of_birth' => $request->applicant_place_of_birth,
                'applicant_citizenship' => $request->applicant_citizenship,
                'applicant_alien_number' => $request->applicant_alien_number,
                'applicant_ssn' => $request->applicant_ssn,
                'applicant_employment_status' => $request->applicant_employment_status,
                'applicant_employer_name' => $request->applicant_employer_name,
                'applicant_occupation' => $request->applicant_occupation,
                
                // Immigration Status
                'current_visa_type' => $request->current_visa_type,
                'visa_expiration_date' => $request->visa_expiration_date,
                'i94_number' => $request->i94_number,
                'passport_number' => $request->passport_number,
                'passport_country' => $request->passport_country,
                'passport_expiration' => $request->passport_expiration,
                'entry_date' => $request->entry_date,
                'entry_location' => $request->entry_location,
                
                // Sponsor Information
                'sponsor_first_name' => $request->sponsor_first_name,
                'sponsor_middle_name' => $request->sponsor_middle_name,
                'sponsor_last_name' => $request->sponsor_last_name,
                'sponsor_email' => $request->sponsor_email,
                'sponsor_phone' => $request->sponsor_phone,
                'sponsor_address' => $request->sponsor_address,
                'sponsor_city' => $request->sponsor_city,
                'sponsor_state' => $request->sponsor_state,
                'sponsor_zip' => $request->sponsor_zip,
                'sponsor_relationship' => $request->sponsor_relationship,
                'sponsor_citizenship_status' => $request->sponsor_citizenship_status,
                'sponsor_ssn' => $request->sponsor_ssn,
                
                // Marital Information
                'marital_status' => $request->marital_status,
                'marriage_date' => $request->marriage_date,
                'spouse_name' => $request->spouse_name,
                
                // Background Questions
                'arrested_or_convicted' => $request->arrested_or_convicted,
                'immigration_violations' => $request->immigration_violations,
                'public_assistance' => $request->public_assistance,
                'background_explanation' => $request->background_explanation,
                
                'status' => 'draft'
            ];

            $application = SimplifiedAosApplication::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'submitted_app_id' => $request->submitted_app_id
                ],
                $applicationData
            );

            DB::commit();
            
            Log::info('AOS application saved', [
                'user_id' => Auth::id(),
                'application_id' => $application->id
            ]);

            return $application;
            
        } catch (\Exception $e) {
            DB::rollback();
            
            Log::error('Error in saveApplication', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            throw $e;
        }
    }

    /**
     * Calculate application completion percentage
     */
    public function calculateCompletion($application)
    {
        if (!$application) {
            return 0;
        }

        $requiredFields = [
            // Applicant (40%)
            'applicant_first_name', 'applicant_last_name', 'applicant_email',
            'applicant_phone', 'applicant_address', 'applicant_city',
            'applicant_state', 'applicant_zip', 'applicant_dob',
            'applicant_place_of_birth', 'applicant_citizenship',
            
            // Immigration Status (30%)
            'current_visa_type', 'visa_expiration_date', 'passport_number',
            'passport_country', 'passport_expiration', 'entry_date',
            'entry_location',
            
            // Sponsor (20%)
            'sponsor_first_name', 'sponsor_last_name', 'sponsor_email',
            'sponsor_phone', 'sponsor_address', 'sponsor_city',
            'sponsor_state', 'sponsor_zip', 'sponsor_relationship',
            'sponsor_citizenship_status', 'sponsor_ssn',
            
            // Marital (10%)
            'marital_status'
        ];

        $completedFields = 0;
        $totalFields = count($requiredFields);

        foreach ($requiredFields as $field) {
            if (!empty($application->$field) && $application->$field !== 'N/A') {
                $completedFields++;
            }
        }

        return round(($completedFields / $totalFields) * 100);
    }

    /**
     * Submit the application
     */
    public function submitApplication($application)
    {
        DB::beginTransaction();

        try {
            $application->update([
                'status' => 'submitted',
                'submitted_at' => now()
            ]);

            UserSubmittedApplication::where('id', $application->submitted_app_id)
                ->update([
                    'status' => 'submitted',
                    'submitted_at' => now()
                ]);

            DB::commit();
            
            Log::info('AOS application submitted', [
                'user_id' => $application->user_id,
                'application_id' => $application->id
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}