<?php
// FILE: app/Http/Services/Spouse/SimplifiedSpouseVisaService.php
// UPDATED: Added mailing address, address history, employment history

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
            // Process address history
            $sponsorAddressHistory = [];
            if ($request->has('sponsor_address_history')) {
                foreach ($request->sponsor_address_history as $address) {
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
            if ($request->has('beneficiary_address_history')) {
                foreach ($request->beneficiary_address_history as $address) {
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
            if ($request->has('sponsor_employment_history')) {
                foreach ($request->sponsor_employment_history as $job) {
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
            if ($request->has('beneficiary_employment_history')) {
                foreach ($request->beneficiary_employment_history as $job) {
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
                'submitted_app_id' => $request->submitted_app_id,
                
                // Sponsor Information (I-130 Part 2)
                'sponsor_first_name' => $request->sponsor_first_name,
                'sponsor_middle_name' => $request->sponsor_middle_name,
                'sponsor_last_name' => $request->sponsor_last_name,
                'sponsor_sex' => $request->sponsor_sex,
                'sponsor_email' => $request->sponsor_email,
                'sponsor_phone' => $request->sponsor_phone,
                'sponsor_dob' => $request->sponsor_dob,
                'sponsor_place_of_birth' => $request->sponsor_place_of_birth,
                'sponsor_citizenship' => $request->sponsor_citizenship,
                'sponsor_ssn' => $request->sponsor_ssn,
                
                // Sponsor Mailing Address
                'sponsor_mailing_address' => $request->sponsor_mailing_address,
                'sponsor_mailing_apt' => $request->sponsor_mailing_apt === 'N/A' ? 'N/A' : $request->sponsor_mailing_apt,
                'sponsor_mailing_city' => $request->sponsor_mailing_city,
                'sponsor_mailing_state' => $request->sponsor_mailing_state,
                'sponsor_mailing_zip' => $request->sponsor_mailing_zip,
                'sponsor_mailing_date_from' => $request->sponsor_mailing_date_from,
                'sponsor_mailing_date_to' => $request->sponsor_mailing_date_to,
                
                // Sponsor Physical Address (if different)
                'sponsor_same_address' => $request->sponsor_same_address,
                'sponsor_address' => $request->sponsor_address,
                'sponsor_apt' => $request->sponsor_apt === 'N/A' ? 'N/A' : $request->sponsor_apt,
                'sponsor_city' => $request->sponsor_city,
                'sponsor_state' => $request->sponsor_state,
                'sponsor_zip' => $request->sponsor_zip,
                
                // Sponsor History
                'sponsor_address_history' => $sponsorAddressHistory,
                'sponsor_employment_history' => $sponsorEmploymentHistory,
                
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
                'beneficiary_dob' => $request->beneficiary_dob,
                'beneficiary_place_of_birth' => $request->beneficiary_place_of_birth,
                'beneficiary_citizenship' => $request->beneficiary_citizenship,
                'beneficiary_passport_number' => $request->beneficiary_passport_number === 'N/A' ? 'N/A' : $request->beneficiary_passport_number,
                'beneficiary_alien_number' => $request->beneficiary_alien_number === 'N/A' ? 'N/A' : $request->beneficiary_alien_number,
                
                // Beneficiary Mailing Address
                'beneficiary_mailing_address' => $request->beneficiary_mailing_address,
                'beneficiary_mailing_apt' => $request->beneficiary_mailing_apt === 'N/A' ? 'N/A' : $request->beneficiary_mailing_apt,
                'beneficiary_mailing_city' => $request->beneficiary_mailing_city,
                'beneficiary_mailing_state' => $request->beneficiary_mailing_state,
                'beneficiary_mailing_country' => $request->beneficiary_mailing_country,
                'beneficiary_mailing_zip' => $request->beneficiary_mailing_zip,
                'beneficiary_mailing_date_from' => $request->beneficiary_mailing_date_from,
                'beneficiary_mailing_date_to' => $request->beneficiary_mailing_date_to,
                
                // Beneficiary Physical Address (if different)
                'beneficiary_same_address' => $request->beneficiary_same_address,
                'beneficiary_address' => $request->beneficiary_address,
                'beneficiary_apt' => $request->beneficiary_apt === 'N/A' ? 'N/A' : $request->beneficiary_apt,
                'beneficiary_city' => $request->beneficiary_city,
                'beneficiary_state' => $request->beneficiary_state,
                'beneficiary_country' => $request->beneficiary_country,
                'beneficiary_zip' => $request->beneficiary_zip,
                
                // Beneficiary History
                'beneficiary_address_history' => $beneficiaryAddressHistory,
                'beneficiary_employment_history' => $beneficiaryEmploymentHistory,
                
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
                'application_id' => $application->id,
                'address_history_count' => count($sponsorAddressHistory) + count($beneficiaryAddressHistory),
                'employment_history_count' => count($sponsorEmploymentHistory) + count($beneficiaryEmploymentHistory)
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
            'sponsor_dob',
            'sponsor_place_of_birth',
            'sponsor_citizenship',
            'sponsor_ssn',
            
            // Mailing address (6 fields)
            'sponsor_mailing_address',
            'sponsor_mailing_city',
            'sponsor_mailing_state',
            'sponsor_mailing_zip',
            'sponsor_mailing_date_from',
            'sponsor_mailing_date_to',
            
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
            'beneficiary_dob',
            'beneficiary_place_of_birth',
            'beneficiary_citizenship',
            
            // Mailing address (6 fields)
            'beneficiary_mailing_address',
            'beneficiary_mailing_city',
            'beneficiary_mailing_country',
            'beneficiary_mailing_date_from',
            'beneficiary_mailing_date_to',
            
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
        ];

        $completedFields = 0;
        $totalFields = count($requiredFields); // 62 fields

        foreach ($requiredFields as $field) {
            $value = $application->$field;
            
            // Field is complete if it has a value and is not N/A (unless N/A is intentional)
            if (!empty($value) && $value !== null && trim($value) !== '') {
                $completedFields++;
            }
        }

        // Check 5-year coverage for address and employment history
        $historyCriteria = [
            'sponsor_address_history' => $this->hasAddressHistory($application, 'sponsor'),
            'beneficiary_address_history' => $this->hasAddressHistory($application, 'beneficiary'),
            'sponsor_employment_history' => $this->hasEmploymentHistory($application, 'sponsor'),
            'beneficiary_employment_history' => $this->hasEmploymentHistory($application, 'beneficiary')
        ];

        // Add 4 more criteria to total fields
        $totalFields += 4;
        foreach ($historyCriteria as $criterion => $isComplete) {
            if ($isComplete) {
                $completedFields++;
            }
        }

        $percentage = round(($completedFields / $totalFields) * 100);
        
        // Log for debugging
        Log::info('Completion calculation', [
            'completed' => $completedFields,
            'total' => $totalFields,
            'percentage' => $percentage,
            'history_status' => $historyCriteria
        ]);

        return $percentage;
    }

    /**
     * Check if address history covers at least 5 years
     */
    private function hasCompleteFiveYearAddressHistory($application, $person)
    {
        $addressHistory = $application->{$person . '_address_history'} ?? [];
        
        if (empty($addressHistory)) {
            return false;
        }

        // Get mailing address dates
        $mailingDateTo = $application->{$person . '_mailing_date_to'};
        $currentDate = $mailingDateTo === 'Present' ? now() : Carbon::parse($mailingDateTo);
        $fiveYearsAgo = $currentDate->copy()->subYears(5);

        // Collect all date ranges
        $dateRanges = [];
        
        // Add mailing address period
        $mailingDateFrom = Carbon::parse($application->{$person . '_mailing_date_from'});
        $dateRanges[] = [
            'from' => $mailingDateFrom,
            'to' => $currentDate
        ];

        // Add address history periods
        foreach ($addressHistory as $address) {
            if (!empty($address['date_from']) && !empty($address['date_to'])) {
                $from = Carbon::parse($address['date_from']);
                $to = $address['date_to'] === 'Present' ? now() : Carbon::parse($address['date_to']);
                $dateRanges[] = [
                    'from' => $from,
                    'to' => $to
                ];
            }
        }

        // Sort ranges by start date
        usort($dateRanges, function($a, $b) {
            return $a['from']->timestamp - $b['from']->timestamp;
        });

        // Find earliest date covered
        if (!empty($dateRanges)) {
            $earliestDate = $dateRanges[0]['from'];
            return $earliestDate->lte($fiveYearsAgo);
        }

        return false;
    }

    /**
     * Check if employment history covers at least 5 years
     */
    private function hasCompleteFiveYearEmploymentHistory($application, $person)
    {
        $employmentHistory = $application->{$person . '_employment_history'} ?? [];
        
        if (empty($employmentHistory)) {
            return false;
        }

        $currentDate = now();
        $fiveYearsAgo = $currentDate->copy()->subYears(5);

        // Collect all date ranges
        $dateRanges = [];
        
        foreach ($employmentHistory as $job) {
            if (!empty($job['date_from']) && !empty($job['date_to'])) {
                $from = Carbon::parse($job['date_from']);
                $to = $job['date_to'] === 'Present' ? now() : Carbon::parse($job['date_to']);
                $dateRanges[] = [
                    'from' => $from,
                    'to' => $to
                ];
            }
        }

        // Sort ranges by start date
        usort($dateRanges, function($a, $b) {
            return $a['from']->timestamp - $b['from']->timestamp;
        });

        // Find earliest date covered
        if (!empty($dateRanges)) {
            $earliestDate = $dateRanges[0]['from'];
            return $earliestDate->lte($fiveYearsAgo);
        }

        return false;
    }


    /**
     * UPDATED: Simple check - just verify at least one address exists
     */
    private function hasAddressHistory($application, $person)
    {
        $addressHistory = $application->{$person . '_address_history'} ?? [];
        
        // Just check if there's at least one address entry with required fields
        if (empty($addressHistory)) {
            return false;
        }

        foreach ($addressHistory as $address) {
            if (!empty($address['address']) && !empty($address['city']) && 
                !empty($address['date_from']) && !empty($address['date_to'])) {
                return true; // At least one complete address found
            }
        }

        return false;
    }

    /**
     * UPDATED: Simple check - just verify at least one employment exists
     */
    private function hasEmploymentHistory($application, $person)
    {
        $employmentHistory = $application->{$person . '_employment_history'} ?? [];
        
        // Just check if there's at least one employment entry with required fields
        if (empty($employmentHistory)) {
            return false;
        }

        foreach ($employmentHistory as $job) {
            if (!empty($job['employer']) && !empty($job['date_from']) && !empty($job['date_to'])) {
                return true; // At least one complete job found
            }
        }

        return false;
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