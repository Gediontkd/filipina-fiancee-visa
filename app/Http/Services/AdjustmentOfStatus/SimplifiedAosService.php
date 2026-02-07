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
                'applicant_other_names' => $request->applicant_other_names,
                'applicant_email' => $request->applicant_email,
                'applicant_phone' => $request->applicant_phone,
                'applicant_address' => $request->applicant_address,
                'applicant_city' => $request->applicant_city,
                'applicant_state' => $request->applicant_state,
                'applicant_zip' => $request->applicant_zip,
                'use_mailing_address' => $request->has('use_mailing_address') ? 1 : 0,
                'mailing_street' => $request->mailing_street,
                'mailing_city' => $request->mailing_city,
                'mailing_state' => $request->mailing_state,
                'mailing_zip' => $request->mailing_zip,
                'applicant_address_history' => $request->applicant_address_history,
                'applicant_dob' => $request->applicant_dob,
                'applicant_place_of_birth' => $request->applicant_place_of_birth,
                'applicant_citizenship' => $request->applicant_citizenship,
                'applicant_alien_number' => $request->applicant_alien_number,
                'uscis_account_number' => $request->uscis_account_number,
                'applicant_ssn' => $request->applicant_ssn,
                'applicant_gender' => $request->applicant_gender,
                'applicant_employment_status' => $request->applicant_employment_status,
                'applicant_employer_name' => $request->applicant_employer_name,
                'applicant_occupation' => $request->applicant_occupation,
                'applicant_employment_history' => $request->applicant_employment_history,

                // Biographic Information
                'ethnicity' => $request->ethnicity,
                'race' => $request->race,
                'height_feet' => $request->height_feet,
                'height_inches' => $request->height_inches,
                'weight_pounds' => $request->weight_pounds,
                'eye_color' => $request->eye_color,
                'hair_color' => $request->hair_color,

                // Family Information
                'parent1_data' => $request->parent1_data,
                'parent2_data' => $request->parent2_data,
                'times_married' => $request->times_married,
                'marital_history' => $request->marital_history,
                'has_children' => $request->has('has_children') ? 1 : 0,
                'children_data' => $request->children_data,
                
                // Immigration Status
                'current_visa_type' => $request->current_visa_type,
                'visa_expiration_date' => $request->visa_expiration_date,
                'i94_number' => $request->i94_number,
                'passport_number' => $request->passport_number,
                'passport_country' => $request->passport_country,
                'passport_expiration' => $request->passport_expiration,
                'entry_date' => $request->entry_date,
                'entry_location' => $request->entry_location,
                'status_at_last_entry' => $request->status_at_last_entry,
                'i94_expiration_date' => $request->i94_expiration_date,
                
                // Part 2: Application Type or Filing Category
                'filing_category' => $request->filing_category,
                'receipt_number_underlying_petition' => $request->receipt_number_underlying_petition,
                'priority_date' => $request->priority_date,
                'is_principal_applicant' => $request->has('is_principal_applicant') ? 1 : 0,
                
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
                
                // Background & Complex Questions
                'arrested_or_convicted' => $request->arrested_or_convicted,
                'immigration_violations' => $request->immigration_violations,
                'public_assistance' => $request->public_assistance,
                'background_explanation' => $request->background_explanation,
                'eligibility_questions' => $request->eligibility_questions,
                'accommodation_details' => $request->accommodation_details,
                'applicant_statement_data' => $request->applicant_statement_data,
                'interpreter_data' => $request->interpreter_data,
                'preparer_data' => $request->preparer_data,
                
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
            // Part 1: Applicant (25%)
            'applicant_first_name', 'applicant_last_name', 'applicant_email',
            'applicant_phone', 'applicant_address', 'applicant_city',
            'applicant_state', 'applicant_zip', 'applicant_dob',
            'applicant_place_of_birth', 'applicant_citizenship', 'applicant_gender',
            
            // Part 7: Biographic (5%)
            'ethnicity', 'race', 'height_feet', 'height_inches', 'weight_pounds',
            
            // Part 3: History (20%)
            'applicant_address_history', 'applicant_employment_history',
            
            // Part 4, 5, 6: Family (15%)
            'parent1_data', 'parent2_data', 'marital_status',
            
            // Part 1 & 2: Immigration Status (20%)
            'current_visa_type', 'visa_expiration_date', 'passport_number',
            'passport_country', 'passport_expiration', 'entry_date',
            'entry_location', 'status_at_last_entry', 'i94_expiration_date',
            
            // Part 2: Eligibility Basis (10%)
            'filing_category',
            
            // Sponsor (10%)
            'sponsor_first_name', 'sponsor_last_name', 'sponsor_relationship',
            'sponsor_citizenship_status',
            
            // Part 8: Eligibility (5%)
            'eligibility_questions'
        ];

        $completedFields = 0;
        $totalFields = count($requiredFields);
        $missingFields = [];

        foreach ($requiredFields as $field) {
            $value = $application->$field;
            if (!empty($value) && $value !== 'N/A') {
                $completedFields++;
            } else {
                $missingFields[] = $field;
            }
        }

        Log::debug('AOS Progress Debug Detail', [
            'user_id' => $application->user_id,
            'completed_count' => $completedFields,
            'total_count' => $totalFields,
            'percentage' => round(($completedFields / $totalFields) * 100),
            'missing_fields' => $missingFields
        ]);

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