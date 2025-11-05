<?php
// app/Http/Services/Spouse/SimplifiedSpouseVisaService.php (FIXED)

namespace App\Http\Services\Spouse;

use App\Models\SimplifiedSpouseVisaApplication;
use App\Models\UserSubmittedApplication;
use Illuminate\Http\Request;
use Auth;
use DB;
use Log;

/**
 * Simplified Spouse Visa Service
 * FIXED: Removed passport from completion calculation
 */
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
                'sponsor_country' => $request->sponsor_country,
                'sponsor_dob' => $request->sponsor_dob,
                'sponsor_place_of_birth' => $request->sponsor_place_of_birth,
                'sponsor_citizenship' => $request->sponsor_citizenship,
                'sponsor_ssn' => $request->sponsor_ssn,
                'sponsor_employment_status' => $request->sponsor_employment_status,
                'sponsor_employer_name' => $request->sponsor_employer_name,
                'sponsor_occupation' => $request->sponsor_occupation,
                'sponsor_annual_income' => $request->sponsor_annual_income,
                
                // Beneficiary Information
                'beneficiary_first_name' => $request->beneficiary_first_name,
                'beneficiary_middle_name' => $request->beneficiary_middle_name,
                'beneficiary_last_name' => $request->beneficiary_last_name,
                'beneficiary_email' => $request->beneficiary_email,
                'beneficiary_phone' => $request->beneficiary_phone,
                'beneficiary_address' => $request->beneficiary_address,
                'beneficiary_city' => $request->beneficiary_city,
                'beneficiary_state' => $request->beneficiary_state,
                'beneficiary_zip' => $request->beneficiary_zip,
                'beneficiary_country' => $request->beneficiary_country,
                'beneficiary_dob' => $request->beneficiary_dob,
                'beneficiary_place_of_birth' => $request->beneficiary_place_of_birth,
                'beneficiary_citizenship' => $request->beneficiary_citizenship,
                'beneficiary_passport_number' => $request->beneficiary_passport_number,
                'beneficiary_alien_number' => $request->beneficiary_alien_number,
                'beneficiary_employment_status' => $request->beneficiary_employment_status,
                'beneficiary_employer_name' => $request->beneficiary_employer_name,
                'beneficiary_occupation' => $request->beneficiary_occupation,
                
                // Relationship Information
                'marriage_date' => $request->marriage_date,
                'marriage_location_city' => $request->marriage_location_city,
                'marriage_location_country' => $request->marriage_location_country,
                'first_met_date' => $request->first_met_date,
                'first_met_location' => $request->first_met_location,
                'relationship_description' => $request->relationship_description,
                'times_met_in_person' => $request->times_met_in_person,
                'last_meeting_date' => $request->last_meeting_date,
                'communication_methods' => $request->communication_methods,
                'sponsor_previous_marriages' => $request->sponsor_previous_marriages,
                'beneficiary_previous_marriages' => $request->beneficiary_previous_marriages,
                'sponsor_divorce_date' => $request->sponsor_divorce_date,
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
     * FIXED: Removed passport from required fields
     */
    public function calculateCompletion($application)
    {
        if (!$application) {
            return 0;
        }

        $requiredFields = [
            // Sponsor required fields (33% weight)
            'sponsor_first_name', 'sponsor_last_name', 'sponsor_email', 
            'sponsor_phone', 'sponsor_address', 'sponsor_city', 
            'sponsor_state', 'sponsor_zip', 'sponsor_dob', 
            'sponsor_place_of_birth', 'sponsor_citizenship', 'sponsor_ssn',
            
            // Beneficiary required fields (33% weight) - passport REMOVED
            'beneficiary_first_name', 'beneficiary_last_name', 
            'beneficiary_email', 'beneficiary_phone', 'beneficiary_address', 
            'beneficiary_city', 'beneficiary_country', 'beneficiary_dob', 
            'beneficiary_place_of_birth', 'beneficiary_citizenship',
            
            // Relationship required fields (34% weight)
            'marriage_date', 'marriage_location_city', 
            'marriage_location_country', 'first_met_date', 
            'first_met_location', 'relationship_description', 
            'times_met_in_person', 'communication_methods'
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