<?php
// FILE: app/Http/Services/Spouse/SimplifiedSpouseVisaService.php
// FIXED: Financial fields are NOT required for I-130 completion

namespace App\Http\Services\Spouse;

use App\Models\SimplifiedSpouseVisaApplication;
use App\Models\UserSubmittedApplication;
use Illuminate\Http\Request;
use Auth;
use DB;
use Log;

class SimplifiedSpouseVisaService
{
    /**
     * Save or update spouse visa application
     */
    public function saveApplication(Request $request)
    {
        DB::beginTransaction();

        try {
            // Prepare application data
            $applicationData = [
                'user_id' => Auth::id(),
                'submitted_app_id' => $request->submitted_app_id,
                
                // Sponsor Information (I-130 Part 2)
                'sponsor_first_name' => $request->sponsor_first_name,
                'sponsor_middle_name' => $request->sponsor_middle_name,
                'sponsor_last_name' => $request->sponsor_last_name,
                'sponsor_sex' => $request->sponsor_sex,
                'sponsor_email' => $request->sponsor_email,
                'sponsor_phone' => $request->sponsor_phone,
                'sponsor_address' => $request->sponsor_address,
                'sponsor_apt' => $request->sponsor_apt === 'N/A' ? 'N/A' : $request->sponsor_apt,
                'sponsor_city' => $request->sponsor_city,
                'sponsor_state' => $request->sponsor_state,
                'sponsor_zip' => $request->sponsor_zip,
                'sponsor_dob' => $request->sponsor_dob,
                'sponsor_place_of_birth' => $request->sponsor_place_of_birth,
                'sponsor_citizenship' => $request->sponsor_citizenship,
                'sponsor_ssn' => $request->sponsor_ssn,
                
                // Sponsor Parents (I-130 Items 25-35)
                'sponsor_parent1_first_name' => $request->sponsor_parent1_first_name,
                'sponsor_parent1_middle_name' => $request->sponsor_parent1_middle_name,
                'sponsor_parent1_last_name' => $request->sponsor_parent1_last_name,
                'sponsor_parent1_dob' => $request->sponsor_parent1_dob,
                'sponsor_parent1_sex' => $request->sponsor_parent1_sex,
                'sponsor_parent1_country' => $request->sponsor_parent1_country,
                
                'sponsor_parent2_first_name' => $request->sponsor_parent2_first_name,
                'sponsor_parent2_middle_name' => $request->sponsor_parent2_middle_name,
                'sponsor_parent2_last_name' => $request->sponsor_parent2_last_name,
                'sponsor_parent2_dob' => $request->sponsor_parent2_dob,
                'sponsor_parent2_sex' => $request->sponsor_parent2_sex,
                'sponsor_parent2_country' => $request->sponsor_parent2_country,
                
                // Sponsor Employment - OPTIONAL, saved but not required
                'sponsor_employment_status' => $request->sponsor_employment_status,
                'sponsor_employer_name' => $request->sponsor_employer_name,
                'sponsor_occupation' => $request->sponsor_occupation,
                'sponsor_annual_income' => $request->sponsor_annual_income,
                
                // Beneficiary Information (I-130 Part 4)
                'beneficiary_first_name' => $request->beneficiary_first_name,
                'beneficiary_middle_name' => $request->beneficiary_middle_name,
                'beneficiary_last_name' => $request->beneficiary_last_name,
                'beneficiary_sex' => $request->beneficiary_sex,
                'beneficiary_email' => $request->beneficiary_email,
                'beneficiary_phone' => $request->beneficiary_phone,
                'beneficiary_address' => $request->beneficiary_address,
                'beneficiary_apt' => $request->beneficiary_apt === 'N/A' ? 'N/A' : $request->beneficiary_apt,
                'beneficiary_city' => $request->beneficiary_city,
                'beneficiary_state' => $request->beneficiary_state,
                'beneficiary_zip' => $request->beneficiary_zip,
                'beneficiary_country' => $request->beneficiary_country,
                'beneficiary_dob' => $request->beneficiary_dob,
                'beneficiary_place_of_birth' => $request->beneficiary_place_of_birth,
                'beneficiary_citizenship' => $request->beneficiary_citizenship,
                'beneficiary_passport_number' => $request->beneficiary_passport_number === 'N/A' ? 'N/A' : $request->beneficiary_passport_number,
                'beneficiary_alien_number' => $request->beneficiary_alien_number === 'N/A' ? 'N/A' : $request->beneficiary_alien_number,
                
                // Beneficiary Parents
                'beneficiary_parent1_first_name' => $request->beneficiary_parent1_first_name,
                'beneficiary_parent1_middle_name' => $request->beneficiary_parent1_middle_name,
                'beneficiary_parent1_last_name' => $request->beneficiary_parent1_last_name,
                'beneficiary_parent1_dob' => $request->beneficiary_parent1_dob,
                'beneficiary_parent1_sex' => $request->beneficiary_parent1_sex,
                'beneficiary_parent1_country' => $request->beneficiary_parent1_country,
                
                'beneficiary_parent2_first_name' => $request->beneficiary_parent2_first_name,
                'beneficiary_parent2_middle_name' => $request->beneficiary_parent2_middle_name,
                'beneficiary_parent2_last_name' => $request->beneficiary_parent2_last_name,
                'beneficiary_parent2_dob' => $request->beneficiary_parent2_dob,
                'beneficiary_parent2_sex' => $request->beneficiary_parent2_sex,
                'beneficiary_parent2_country' => $request->beneficiary_parent2_country,
                
                // Beneficiary Employment - OPTIONAL
                'beneficiary_employment_status' => $request->beneficiary_employment_status,
                'beneficiary_employer_name' => $request->beneficiary_employer_name,
                'beneficiary_occupation' => $request->beneficiary_occupation,
                
                // Relationship Information - ONLY I-130 fields
                'marriage_date' => $request->marriage_date,
                'marriage_location_city' => $request->marriage_location_city,
                'marriage_location_state' => $request->marriage_location_state,
                'marriage_location_province' => $request->marriage_location_province,
                'marriage_location_country' => $request->marriage_location_country,
                'sponsor_times_married' => $request->sponsor_times_married,
                
                // Previous Marriages
                'sponsor_previous_marriages' => $request->sponsor_previous_marriages,
                'sponsor_prev_spouse_first_name' => $request->sponsor_prev_spouse_first_name,
                'sponsor_prev_spouse_last_name' => $request->sponsor_prev_spouse_last_name,
                'sponsor_divorce_date' => $request->sponsor_divorce_date,
                
                'beneficiary_previous_marriages' => $request->beneficiary_previous_marriages,
                'beneficiary_prev_spouse_first_name' => $request->beneficiary_prev_spouse_first_name,
                'beneficiary_prev_spouse_last_name' => $request->beneficiary_prev_spouse_last_name,
                'beneficiary_divorce_date' => $request->beneficiary_divorce_date,
                
                'status' => 'draft'
            ];

            // Update or create application
            $application = SimplifiedSpouseVisaApplication::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'submitted_app_id' => $request->submitted_app_id
                ],
                $applicationData
            );

            DB::commit();
            
            Log::info('Spouse visa application saved', [
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
     * CRITICAL FIX: Financial fields are NOT required for I-130 submission
     */
    public function calculateCompletion($application)
    {
        if (!$application) {
            return 0;
        }

        // ONLY fields required for Form I-130 submission
        // Financial info is NOT required until NVC stage (after approval)
        $requiredFields = [
            // ==========================================
            // SPONSOR BASIC INFO (13 fields)
            // ==========================================
            'sponsor_first_name',
            'sponsor_last_name',
            'sponsor_sex',
            'sponsor_email',
            'sponsor_phone',
            'sponsor_address',
            'sponsor_city',
            'sponsor_state',
            'sponsor_zip',
            'sponsor_dob',
            'sponsor_place_of_birth',
            'sponsor_citizenship',
            'sponsor_ssn',
            
            // ==========================================
            // SPONSOR PARENTS (10 fields - 5 per parent)
            // ==========================================
            'sponsor_parent1_first_name',
            'sponsor_parent1_last_name',
            'sponsor_parent1_dob',
            'sponsor_parent1_sex',
            'sponsor_parent1_country',
            
            'sponsor_parent2_first_name',
            'sponsor_parent2_last_name',
            'sponsor_parent2_dob',
            'sponsor_parent2_sex',
            'sponsor_parent2_country',
            
            // ==========================================
            // BENEFICIARY BASIC INFO (11 fields)
            // ==========================================
            'beneficiary_first_name',
            'beneficiary_last_name',
            'beneficiary_sex',
            'beneficiary_email',
            'beneficiary_phone',
            'beneficiary_address',
            'beneficiary_city',
            'beneficiary_country',
            'beneficiary_dob',
            'beneficiary_place_of_birth',
            'beneficiary_citizenship',
            
            // ==========================================
            // BENEFICIARY PARENTS (10 fields - 5 per parent)
            // ==========================================
            'beneficiary_parent1_first_name',
            'beneficiary_parent1_last_name',
            'beneficiary_parent1_dob',
            'beneficiary_parent1_sex',
            'beneficiary_parent1_country',
            
            'beneficiary_parent2_first_name',
            'beneficiary_parent2_last_name',
            'beneficiary_parent2_dob',
            'beneficiary_parent2_sex',
            'beneficiary_parent2_country',
            
            // ==========================================
            // MARRIAGE INFO (6 fields)
            // ==========================================
            'marriage_date',
            'marriage_location_city',
            'marriage_location_country',
            'sponsor_times_married',
            'sponsor_previous_marriages',
            'beneficiary_previous_marriages'
            
            // ==========================================
            // NOT REQUIRED (excluded from calculation):
            // ==========================================
            // - sponsor_employment_status
            // - sponsor_employer_name
            // - sponsor_occupation
            // - sponsor_annual_income
            // - beneficiary_employment_status
            // - beneficiary_employer_name
            // - beneficiary_occupation
            // - sponsor_apt (optional)
            // - beneficiary_apt (optional)
            // - middle names (optional)
            // - passport number (optional)
            // - alien number (optional)
        ];

        $completedFields = 0;
        $totalFields = count($requiredFields); // Should be 50 fields

        foreach ($requiredFields as $field) {
            $value = $application->$field;
            
            // Field is complete if it has a value and is not N/A (unless N/A is intentional)
            if (!empty($value) && $value !== null && trim($value) !== '') {
                $completedFields++;
            }
        }

        $percentage = round(($completedFields / $totalFields) * 100);
        
        // Log for debugging
        Log::info('Completion calculation', [
            'completed' => $completedFields,
            'total' => $totalFields,
            'percentage' => $percentage
        ]);

        return $percentage;
    }

    /**
     * Submit the application
     */
    public function submitApplication($application)
    {
        DB::beginTransaction();

        try {
            // Update application status
            $application->update([
                'status' => 'submitted',
                'submitted_at' => now()
            ]);

            // Update main submission record
            UserSubmittedApplication::where('id', $application->submitted_app_id)
                ->update([
                    'status' => 'submitted',
                    'submitted_at' => now()
                ]);

            DB::commit();
            
            Log::info('Spouse visa application submitted', [
                'user_id' => $application->user_id,
                'application_id' => $application->id
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}