<?php
// FILE: app/Http/Services/Spouse/SimplifiedSpouseVisaService.php
// FIXED: Proper handling of "Present" for mailing addresses

namespace App\Http\Services\Spouse;

use App\Models\SimplifiedSpouseVisaApplication;
use App\Models\UserSubmittedApplication;
use Illuminate\Http\Request;
use Auth;
use DB;
use Log;
use Carbon\Carbon;

class SimplifiedSpouseVisaService
{
    /**
     * Save or update spouse visa application
     */
    public function saveApplication(Request $request)
    {
        DB::beginTransaction();

        try {
            // CRITICAL FIX: Force "Present" for mailing addresses BEFORE processing
            $data = $request->all();

            unset($data['beneficiary_passport_na']);
            unset($data['beneficiary_alien_number_na']);
            unset($data['sponsor_mailing_present']);
            unset($data['beneficiary_mailing_present']);

            $data['sponsor_mailing_date_to'] = 'Present';
            $data['beneficiary_mailing_date_to'] = 'Present';

            Log::info('Saving application', [
                'beneficiary_alien_number' => $data['beneficiary_alien_number'] ?? 'NOT SET',
                'beneficiary_passport_number' => $data['beneficiary_passport_number'] ?? 'NOT SET',
            ]);

            // Process address history
            $sponsorAddressHistory = [];
            if (isset($data['sponsor_address_history'])) {
                foreach ($data['sponsor_address_history'] as $address) {
                    if (!empty($address['address']) || !empty($address['city'])) {
                        $sponsorAddressHistory[] = [
                            'address' => $address['address'] ?? '',
                            'apt' => $address['apt'] ?? '',
                            'city' => $address['city'] ?? '',
                            'state' => $address['state'] ?? '',
                            'zip' => $address['zip'] ?? '',
                            'date_from' => $address['date_from'] ?? '',
                            'date_to' => $address['date_to'] ?? '',
                        ];
                    }
                }
            }

            $beneficiaryAddressHistory = [];
            if (isset($data['beneficiary_address_history'])) {
                foreach ($data['beneficiary_address_history'] as $address) {
                    if (!empty($address['address']) || !empty($address['city'])) {
                        $beneficiaryAddressHistory[] = [
                            'address' => $address['address'] ?? '',
                            'apt' => $address['apt'] ?? '',
                            'city' => $address['city'] ?? '',
                            'state' => $address['state'] ?? '',
                            'country' => $address['country'] ?? '',
                            'zip' => $address['zip'] ?? '',
                            'date_from' => $address['date_from'] ?? '',
                            'date_to' => $address['date_to'] ?? '',
                        ];
                    }
                }
            }

            // Process employment history
            $sponsorEmploymentHistory = [];
            if (isset($data['sponsor_employment_history'])) {
                foreach ($data['sponsor_employment_history'] as $job) {
                    if (!empty($job['employer'])) {
                        $sponsorEmploymentHistory[] = [
                            'employer' => $job['employer'] ?? '',
                            'occupation' => $job['occupation'] ?? '',
                            'address' => $job['address'] ?? '',
                            'date_from' => $job['date_from'] ?? '',
                            'date_to' => $job['date_to'] ?? '',
                        ];
                    }
                }
            }

            $beneficiaryEmploymentHistory = [];
            if (isset($data['beneficiary_employment_history'])) {
                foreach ($data['beneficiary_employment_history'] as $job) {
                    if (!empty($job['employer'])) {
                        $beneficiaryEmploymentHistory[] = [
                            'employer' => $job['employer'] ?? '',
                            'occupation' => $job['occupation'] ?? '',
                            'address' => $job['address'] ?? '',
                            'date_from' => $job['date_from'] ?? '',
                            'date_to' => $job['date_to'] ?? '',
                        ];
                    }
                }
            }

            // Prepare application data
            $applicationData = [
                'user_id' => Auth::id(),
                'submitted_app_id' => $data['submitted_app_id'],
                
                // Sponsor Information
                'sponsor_first_name' => $data['sponsor_first_name'] ?? null,
                'sponsor_middle_name' => $data['sponsor_middle_name'] ?? null,
                'sponsor_last_name' => $data['sponsor_last_name'] ?? null,
                'sponsor_sex' => $data['sponsor_sex'] ?? null,
                'sponsor_email' => $data['sponsor_email'] ?? null,
                'sponsor_phone' => $data['sponsor_phone'] ?? null,
                'sponsor_dob' => $data['sponsor_dob'] ?? null,
                'sponsor_place_of_birth' => $data['sponsor_place_of_birth'] ?? null,
                'sponsor_citizenship' => $data['sponsor_citizenship'] ?? null,
                'sponsor_ssn' => $data['sponsor_ssn'] ?? null,
                
                // Sponsor Mailing Address
                'sponsor_mailing_address' => $data['sponsor_mailing_address'] ?? null,
                'sponsor_mailing_apt' => ($data['sponsor_mailing_apt'] ?? null) === 'N/A' ? 'N/A' : ($data['sponsor_mailing_apt'] ?? null),
                'sponsor_mailing_city' => $data['sponsor_mailing_city'] ?? null,
                'sponsor_mailing_state' => $data['sponsor_mailing_state'] ?? null,
                'sponsor_mailing_zip' => $data['sponsor_mailing_zip'] ?? null,
                'sponsor_mailing_date_from' => $data['sponsor_mailing_date_from'] ?? null,
                'sponsor_mailing_date_to' => 'Present', // ALWAYS Present
                
                // Sponsor Physical Address
                'sponsor_same_address' => $data['sponsor_same_address'] ?? null,
                'sponsor_address' => $data['sponsor_address'] ?? null,
                'sponsor_apt' => ($data['sponsor_apt'] ?? null) === 'N/A' ? 'N/A' : ($data['sponsor_apt'] ?? null),
                'sponsor_city' => $data['sponsor_city'] ?? null,
                'sponsor_state' => $data['sponsor_state'] ?? null,
                'sponsor_zip' => $data['sponsor_zip'] ?? null,
                
                // Sponsor History
                'sponsor_address_history' => $sponsorAddressHistory,
                'sponsor_employment_history' => $sponsorEmploymentHistory,
                
                // Sponsor Parents
                'sponsor_parent1_first_name' => $data['sponsor_parent1_first_name'] ?? null,
                'sponsor_parent1_middle_name' => $data['sponsor_parent1_middle_name'] ?? null,
                'sponsor_parent1_last_name' => $data['sponsor_parent1_last_name'] ?? null,
                'sponsor_parent1_dob' => $data['sponsor_parent1_dob'] ?? null,
                'sponsor_parent1_sex' => $data['sponsor_parent1_sex'] ?? null,
                'sponsor_parent1_country' => $data['sponsor_parent1_country'] ?? null,
                
                'sponsor_parent2_first_name' => $data['sponsor_parent2_first_name'] ?? null,
                'sponsor_parent2_middle_name' => $data['sponsor_parent2_middle_name'] ?? null,
                'sponsor_parent2_last_name' => $data['sponsor_parent2_last_name'] ?? null,
                'sponsor_parent2_dob' => $data['sponsor_parent2_dob'] ?? null,
                'sponsor_parent2_sex' => $data['sponsor_parent2_sex'] ?? null,
                'sponsor_parent2_country' => $data['sponsor_parent2_country'] ?? null,
                
                // Sponsor Employment (optional)
                'sponsor_employment_status' => $data['sponsor_employment_status'] ?? null,
                'sponsor_employer_name' => $data['sponsor_employer_name'] ?? null,
                'sponsor_occupation' => $data['sponsor_occupation'] ?? null,
                'sponsor_annual_income' => $data['sponsor_annual_income'] ?? null,
                
                // Beneficiary Information
                'beneficiary_first_name' => $data['beneficiary_first_name'] ?? null,
                'beneficiary_middle_name' => $data['beneficiary_middle_name'] ?? null,
                'beneficiary_last_name' => $data['beneficiary_last_name'] ?? null,
                'beneficiary_sex' => $data['beneficiary_sex'] ?? null,
                'beneficiary_email' => $data['beneficiary_email'] ?? null,
                'beneficiary_phone' => $data['beneficiary_phone'] ?? null,
                'beneficiary_dob' => $data['beneficiary_dob'] ?? null,
                'beneficiary_place_of_birth' => $data['beneficiary_place_of_birth'] ?? null,
                'beneficiary_citizenship' => $data['beneficiary_citizenship'] ?? null,
                'beneficiary_passport_number' => ($data['beneficiary_passport_number'] ?? null) === 'N/A' ? 'N/A' : ($data['beneficiary_passport_number'] ?? null),
                'beneficiary_alien_number' => ($data['beneficiary_alien_number'] ?? null) === 'N/A' ? 'N/A' : ($data['beneficiary_alien_number'] ?? null),
                
                // Beneficiary Mailing Address
                'beneficiary_mailing_address' => $data['beneficiary_mailing_address'] ?? null,
                'beneficiary_mailing_apt' => ($data['beneficiary_mailing_apt'] ?? null) === 'N/A' ? 'N/A' : ($data['beneficiary_mailing_apt'] ?? null),
                'beneficiary_mailing_city' => $data['beneficiary_mailing_city'] ?? null,
                'beneficiary_mailing_state' => $data['beneficiary_mailing_state'] ?? null,
                'beneficiary_mailing_country' => $data['beneficiary_mailing_country'] ?? null,
                'beneficiary_mailing_zip' => $data['beneficiary_mailing_zip'] ?? null,
                'beneficiary_mailing_date_from' => $data['beneficiary_mailing_date_from'] ?? null,
                'beneficiary_mailing_date_to' => 'Present', // ALWAYS Present
                
                // Beneficiary Physical Address
                'beneficiary_same_address' => $data['beneficiary_same_address'] ?? null,
                'beneficiary_address' => $data['beneficiary_address'] ?? null,
                'beneficiary_apt' => ($data['beneficiary_apt'] ?? null) === 'N/A' ? 'N/A' : ($data['beneficiary_apt'] ?? null),
                'beneficiary_city' => $data['beneficiary_city'] ?? null,
                'beneficiary_state' => $data['beneficiary_state'] ?? null,
                'beneficiary_country' => $data['beneficiary_country'] ?? null,
                'beneficiary_zip' => $data['beneficiary_zip'] ?? null,
                
                // Beneficiary History
                'beneficiary_address_history' => $beneficiaryAddressHistory,
                'beneficiary_employment_history' => $beneficiaryEmploymentHistory,
                
                // Beneficiary Parents
                'beneficiary_parent1_first_name' => $data['beneficiary_parent1_first_name'] ?? null,
                'beneficiary_parent1_middle_name' => $data['beneficiary_parent1_middle_name'] ?? null,
                'beneficiary_parent1_last_name' => $data['beneficiary_parent1_last_name'] ?? null,
                'beneficiary_parent1_dob' => $data['beneficiary_parent1_dob'] ?? null,
                'beneficiary_parent1_sex' => $data['beneficiary_parent1_sex'] ?? null,
                'beneficiary_parent1_country' => $data['beneficiary_parent1_country'] ?? null,
                
                'beneficiary_parent2_first_name' => $data['beneficiary_parent2_first_name'] ?? null,
                'beneficiary_parent2_middle_name' => $data['beneficiary_parent2_middle_name'] ?? null,
                'beneficiary_parent2_last_name' => $data['beneficiary_parent2_last_name'] ?? null,
                'beneficiary_parent2_dob' => $data['beneficiary_parent2_dob'] ?? null,
                'beneficiary_parent2_sex' => $data['beneficiary_parent2_sex'] ?? null,
                'beneficiary_parent2_country' => $data['beneficiary_parent2_country'] ?? null,
                
                // Beneficiary Employment (optional)
                'beneficiary_employment_status' => $data['beneficiary_employment_status'] ?? null,
                'beneficiary_employer_name' => $data['beneficiary_employer_name'] ?? null,
                'beneficiary_occupation' => $data['beneficiary_occupation'] ?? null,
                
                // Relationship Information
                'marriage_date' => $data['marriage_date'] ?? null,
                'marriage_location_city' => $data['marriage_location_city'] ?? null,
                'marriage_location_state' => $data['marriage_location_state'] ?? null,
                'marriage_location_province' => $data['marriage_location_province'] ?? null,
                'marriage_location_country' => $data['marriage_location_country'] ?? null,
                'sponsor_times_married' => $data['sponsor_times_married'] ?? null,
                
                // Previous Marriages
                'sponsor_previous_marriages' => $data['sponsor_previous_marriages'] ?? null,
                'sponsor_prev_spouse_first_name' => $data['sponsor_prev_spouse_first_name'] ?? null,
                'sponsor_prev_spouse_last_name' => $data['sponsor_prev_spouse_last_name'] ?? null,
                'sponsor_divorce_date' => $data['sponsor_divorce_date'] ?? null,
                
                'beneficiary_previous_marriages' => $data['beneficiary_previous_marriages'] ?? null,
                'beneficiary_prev_spouse_first_name' => $data['beneficiary_prev_spouse_first_name'] ?? null,
                'beneficiary_prev_spouse_last_name' => $data['beneficiary_prev_spouse_last_name'] ?? null,
                'beneficiary_divorce_date' => $data['beneficiary_divorce_date'] ?? null,
                
                'status' => 'draft'
            ];

            // Update or create application
            $application = SimplifiedSpouseVisaApplication::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'submitted_app_id' => $data['submitted_app_id']
                ],
                $applicationData
            );

            DB::commit();
            
            Log::info('Spouse visa application saved', [
                'user_id' => Auth::id(),
                'application_id' => $application->id,
                'sponsor_mailing_apt' => $application->sponsor_mailing_apt,
                'beneficiary_mailing_apt' => $application->beneficiary_mailing_apt,
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
            // Sponsor (13)
            'sponsor_first_name', 'sponsor_last_name', 'sponsor_sex',
            'sponsor_email', 'sponsor_phone', 'sponsor_mailing_address',
            'sponsor_mailing_city', 'sponsor_mailing_state', 'sponsor_mailing_zip',
            'sponsor_dob', 'sponsor_place_of_birth', 'sponsor_citizenship', 'sponsor_ssn',
            
            // Sponsor Parents (10)
            'sponsor_parent1_first_name', 'sponsor_parent1_last_name',
            'sponsor_parent1_dob', 'sponsor_parent1_sex', 'sponsor_parent1_country',
            'sponsor_parent2_first_name', 'sponsor_parent2_last_name',
            'sponsor_parent2_dob', 'sponsor_parent2_sex', 'sponsor_parent2_country',
            
            // Beneficiary (11)
            'beneficiary_first_name', 'beneficiary_last_name', 'beneficiary_sex',
            'beneficiary_email', 'beneficiary_phone', 'beneficiary_mailing_address',
            'beneficiary_mailing_city', 'beneficiary_mailing_country', 'beneficiary_dob',
            'beneficiary_place_of_birth', 'beneficiary_citizenship',
            
            // Beneficiary Parents (10)
            'beneficiary_parent1_first_name', 'beneficiary_parent1_last_name',
            'beneficiary_parent1_dob', 'beneficiary_parent1_sex', 'beneficiary_parent1_country',
            'beneficiary_parent2_first_name', 'beneficiary_parent2_last_name',
            'beneficiary_parent2_dob', 'beneficiary_parent2_sex', 'beneficiary_parent2_country',
            
            // Marriage (6)
            'marriage_date', 'marriage_location_city', 'marriage_location_country',
            'sponsor_times_married', 'sponsor_previous_marriages', 'beneficiary_previous_marriages'
        ];

        $completedFields = 0;
        $totalFields = count($requiredFields);

        foreach ($requiredFields as $field) {
            $value = $application->$field;
            if (!empty($value) && $value !== null && trim($value) !== '') {
                $completedFields++;
            }
        }

        // Check history (simplified - just need at least one entry)
        $historyCriteria = [
            'sponsor_address_history' => $this->hasAddressHistory($application, 'sponsor'),
            'beneficiary_address_history' => $this->hasAddressHistory($application, 'beneficiary'),
            'sponsor_employment_history' => $this->hasEmploymentHistory($application, 'sponsor'),
            'beneficiary_employment_history' => $this->hasEmploymentHistory($application, 'beneficiary')
        ];

        $totalFields += 4;
        foreach ($historyCriteria as $isComplete) {
            if ($isComplete) {
                $completedFields++;
            }
        }

        $percentage = round(($completedFields / $totalFields) * 100);
        
        Log::info('Completion calculation', [
            'completed' => $completedFields,
            'total' => $totalFields,
            'percentage' => $percentage,
        ]);

        return $percentage;
    }

    private function hasAddressHistory($application, $person)
    {
        $addressHistory = $application->{$person . '_address_history'} ?? [];
        
        if (empty($addressHistory)) {
            return false;
        }

        foreach ($addressHistory as $address) {
            if (!empty($address['address']) && !empty($address['city']) && 
                !empty($address['date_from']) && !empty($address['date_to'])) {
                return true;
            }
        }

        return false;
    }

    private function hasEmploymentHistory($application, $person)
    {
        $employmentHistory = $application->{$person . '_employment_history'} ?? [];
        
        if (empty($employmentHistory)) {
            return false;
        }

        foreach ($employmentHistory as $job) {
            if (!empty($job['employer']) && !empty($job['date_from']) && !empty($job['date_to'])) {
                return true;
            }
        }

        return false;
    }

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