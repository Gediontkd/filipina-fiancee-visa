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

            // ============================================
            // FIX 1: Process "Does Not Apply" Checkboxes
            // ============================================
            
            // Sponsor A-Number
            if (isset($data['sponsor_a_number_na']) && $data['sponsor_a_number_na'] == 1) {
                $data['sponsor_a_number'] = 'N/A';
            }
            unset($data['sponsor_a_number_na']);
            
            // Sponsor USCIS Account
            if (isset($data['sponsor_uscis_account_na']) && $data['sponsor_uscis_account_na'] == 1) {
                $data['sponsor_uscis_account'] = 'N/A';
            }
            unset($data['sponsor_uscis_account_na']);
            
            // Beneficiary SSN
            if (isset($data['beneficiary_ssn_na']) && $data['beneficiary_ssn_na'] == 1) {
                $data['beneficiary_ssn'] = 'N/A';
            }
            unset($data['beneficiary_ssn_na']);
            
            // Beneficiary USCIS Account
            if (isset($data['beneficiary_uscis_account_na']) && $data['beneficiary_uscis_account_na'] == 1) {
                $data['beneficiary_uscis_account'] = 'N/A';
            }
            unset($data['beneficiary_uscis_account_na']);
            
            // Beneficiary Passport
            if (isset($data['beneficiary_passport_na']) && $data['beneficiary_passport_na'] == 1) {
                $data['beneficiary_passport_number'] = 'N/A';
            }
            unset($data['beneficiary_passport_na']);
            
            // Beneficiary Alien Number
            if (isset($data['beneficiary_alien_number_na']) && $data['beneficiary_alien_number_na'] == 1) {
                $data['beneficiary_alien_number'] = 'N/A';
            }
            unset($data['beneficiary_alien_number_na']);

            // Remove other unwanted checkboxes
            unset($data['sponsor_mailing_present']);
            unset($data['beneficiary_mailing_present']);

            // Force Present for mailing addresses
            $data['sponsor_mailing_date_to'] = 'Present';
            $data['beneficiary_mailing_date_to'] = 'Present';

            Log::info('Processing application data', [
                'sponsor_a_number' => $data['sponsor_a_number'] ?? 'NOT SET',
                'beneficiary_alien_number' => $data['beneficiary_alien_number'] ?? 'NOT SET',
            ]);

            Log::info('Saving application', [
                'beneficiary_alien_number' => $data['beneficiary_alien_number'] ?? 'NOT SET',
                'beneficiary_passport_number' => $data['beneficiary_passport_number'] ?? 'NOT SET',
            ]);

            // Process address history
            $sponsorAddressHistory = [];
            if (isset($data['sponsor_address_history'])) {
                foreach ($data['sponsor_address_history'] as $index => $address) {
                    if (!empty($address['address']) || !empty($address['city'])) {
                        // Check if "is_present" hidden field exists
                        $dateToValue = $address['date_to'] ?? '';
                        if (isset($address['is_present']) && $address['is_present'] == 1) {
                            $dateToValue = 'Present';
                        }
                        
                        $sponsorAddressHistory[] = [
                            'address' => $address['address'] ?? '',
                            'apt' => $address['apt'] ?? '',
                            'city' => $address['city'] ?? '',
                            'state' => $address['state'] ?? '',
                            'zip' => $address['zip'] ?? '',
                            'country' => $address['country'] ?? '',
                            'date_from' => $address['date_from'] ?? '',
                            'date_to' => $dateToValue,
                        ];
                    }
                }
            }

            $beneficiaryAddressHistory = [];
            if (isset($data['beneficiary_address_history'])) {
                foreach ($data['beneficiary_address_history'] as $index => $address) {
                    if (!empty($address['address']) || !empty($address['city'])) {
                        $dateToValue = $address['date_to'] ?? '';
                        if (isset($address['is_present']) && $address['is_present'] == 1) {
                            $dateToValue = 'Present';
                        }
                        
                        $beneficiaryAddressHistory[] = [
                            'address' => $address['address'] ?? '',
                            'apt' => $address['apt'] ?? '',
                            'city' => $address['city'] ?? '',
                            'state' => $address['state'] ?? '',
                            'country' => $address['country'] ?? '',
                            'zip' => $address['zip'] ?? '',
                            'date_from' => $address['date_from'] ?? '',
                            'date_to' => $dateToValue,
                        ];
                    }
                }
            }

            // Process employment history
            $sponsorEmploymentHistory = [];
            if (isset($data['sponsor_employment_history'])) {
                foreach ($data['sponsor_employment_history'] as $index => $job) {
                    if (!empty($job['employer'])) {
                        $dateToValue = $job['date_to'] ?? '';
                        if (isset($job['is_present']) && $job['is_present'] == 1) {
                            $dateToValue = 'Present';
                        }
                        
                        $sponsorEmploymentHistory[] = [
                            'employer' => $job['employer'] ?? '',
                            'occupation' => $job['occupation'] ?? '',
                            'address' => $job['address'] ?? '',
                            'date_from' => $job['date_from'] ?? '',
                            'date_to' => $dateToValue,
                        ];
                    }
                }
            }

            $beneficiaryEmploymentHistory = [];
            if (isset($data['beneficiary_employment_history'])) {
                foreach ($data['beneficiary_employment_history'] as $index => $job) {
                    if (!empty($job['employer'])) {
                        $dateToValue = $job['date_to'] ?? '';
                        if (isset($job['is_present']) && $job['is_present'] == 1) {
                            $dateToValue = 'Present';
                        }
                        
                        $beneficiaryEmploymentHistory[] = [
                            'employer' => $job['employer'] ?? '',
                            'occupation' => $job['occupation'] ?? '',
                            'address' => $job['address'] ?? '',
                            'date_from' => $job['date_from'] ?? '',
                            'date_to' => $dateToValue,
                        ];
                    }
                }
            }

            // ========================================
            // PROCESS OTHER NAMES
            // ========================================
            $sponsorOtherNames = [];
            if (isset($data['sponsor_other_names'])) {
                foreach ($data['sponsor_other_names'] as $name) {
                    if (!empty($name['first_name']) || !empty($name['last_name'])) {
                        $sponsorOtherNames[] = [
                            'first_name' => $name['first_name'] ?? '',
                            'middle_name' => $name['middle_name'] ?? '',
                            'last_name' => $name['last_name'] ?? '',
                        ];
                    }
                }
            }

            $beneficiaryOtherNames = [];
            if (isset($data['beneficiary_other_names'])) {
                foreach ($data['beneficiary_other_names'] as $name) {
                    if (!empty($name['first_name']) || !empty($name['last_name'])) {
                        $beneficiaryOtherNames[] = [
                            'first_name' => $name['first_name'] ?? '',
                            'middle_name' => $name['middle_name'] ?? '',
                            'last_name' => $name['last_name'] ?? '',
                        ];
                    }
                }
            }

            // Prepare application data
            $applicationData = [
                'user_id' => Auth::id(),
                'submitted_app_id' => $data['submitted_app_id'],

                // Sponsor Adoption Questions (NEW)
                'sponsor_beneficiary_related_by_adoption' => $data['sponsor_beneficiary_related_by_adoption'] ?? null,
                'sponsor_gained_status_through_adoption' => $data['sponsor_gained_status_through_adoption'] ?? null,

                // Sponsor Mailing/Physical Address Country (NEW)
                'sponsor_mailing_country' => $data['sponsor_mailing_country'] ?? 'US',
                'sponsor_country' => $data['sponsor_country'] ?? 'US',

                // Beneficiary Parent Relationship (NEW)
                'beneficiary_parent1_relationship' => $data['beneficiary_parent1_relationship'] ?? null,
                'beneficiary_parent2_relationship' => $data['beneficiary_parent2_relationship'] ?? null,
                
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
                'beneficiary_parent1_country' => $data['beneficiary_parent1_country'] ?? null,
                
                'beneficiary_parent2_first_name' => $data['beneficiary_parent2_first_name'] ?? null,
                'beneficiary_parent2_middle_name' => $data['beneficiary_parent2_middle_name'] ?? null,
                'beneficiary_parent2_last_name' => $data['beneficiary_parent2_last_name'] ?? null,
                'beneficiary_parent2_dob' => $data['beneficiary_parent2_dob'] ?? null,
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

                // ========================================
                // SPONSOR ADDITIONAL FIELDS
                // ========================================
                'sponsor_other_names' => $sponsorOtherNames,
                'sponsor_a_number' => ($data['sponsor_a_number'] ?? null) === 'N/A' ? 'N/A' : ($data['sponsor_a_number'] ?? null),
                'sponsor_uscis_account' => ($data['sponsor_uscis_account'] ?? null) === 'N/A' ? 'N/A' : ($data['sponsor_uscis_account'] ?? null),
                'sponsor_citizenship_method' => $data['sponsor_citizenship_method'] ?? null,
                'sponsor_certificate_number' => $data['sponsor_certificate_number'] ?? null,
                'sponsor_certificate_place' => $data['sponsor_certificate_place'] ?? null,
                'sponsor_certificate_date' => $data['sponsor_certificate_date'] ?? null,
                'sponsor_ethnicity' => $data['sponsor_ethnicity'] ?? null,
                'sponsor_race' => $data['sponsor_race'] ?? [],
                'sponsor_height_feet' => $data['sponsor_height_feet'] ?? null,
                'sponsor_height_inches' => $data['sponsor_height_inches'] ?? null,
                'sponsor_weight' => $data['sponsor_weight'] ?? null,
                'sponsor_eye_color' => $data['sponsor_eye_color'] ?? null,
                'sponsor_hair_color' => $data['sponsor_hair_color'] ?? null,
                'sponsor_parent1_city_residence' => $data['sponsor_parent1_city_residence'] ?? null,
                'sponsor_parent1_country_residence' => $data['sponsor_parent1_country_residence'] ?? null,
                'sponsor_parent2_city_residence' => $data['sponsor_parent2_city_residence'] ?? null,
                'sponsor_parent2_country_residence' => $data['sponsor_parent2_country_residence'] ?? null,
                
                // ========================================
                // BENEFICIARY ADDITIONAL FIELDS
                // ========================================
                'beneficiary_other_names' => $beneficiaryOtherNames,
                'beneficiary_ssn' => ($data['beneficiary_ssn'] ?? null) === 'N/A' ? 'N/A' : ($data['beneficiary_ssn'] ?? null),
                'beneficiary_uscis_account' => ($data['beneficiary_uscis_account'] ?? null) === 'N/A' ? 'N/A' : ($data['beneficiary_uscis_account'] ?? null),
                'beneficiary_petition_filed_before' => $data['beneficiary_petition_filed_before'] ?? null,
                'beneficiary_passport_country' => $data['beneficiary_passport_country'] ?? null,
                'beneficiary_passport_expiration' => $data['beneficiary_passport_expiration'] ?? null,
                'beneficiary_daytime_phone' => $data['beneficiary_daytime_phone'] ?? null,
                'beneficiary_mobile_phone' => $data['beneficiary_mobile_phone'] ?? null,
                'beneficiary_intended_address_same' => isset($data['beneficiary_intended_address_same']) ? (bool)$data['beneficiary_intended_address_same'] : false,
                'beneficiary_intended_address' => $data['beneficiary_intended_address'] ?? null,
                'beneficiary_intended_apt' => ($data['beneficiary_intended_apt'] ?? null) === 'N/A' ? 'N/A' : ($data['beneficiary_intended_apt'] ?? null),
                'beneficiary_intended_city' => $data['beneficiary_intended_city'] ?? null,
                'beneficiary_intended_state' => $data['beneficiary_intended_state'] ?? null,
                'beneficiary_intended_zip' => $data['beneficiary_intended_zip'] ?? null,
                'beneficiary_ever_in_us' => $data['beneficiary_ever_in_us'] ?? null,
                'beneficiary_class_of_admission' => $data['beneficiary_class_of_admission'] ?? null,
                'beneficiary_i94_number' => $data['beneficiary_i94_number'] ?? null,
                'beneficiary_date_of_arrival' => $data['beneficiary_date_of_arrival'] ?? null,
                'beneficiary_date_authorized_stay_expires' => $data['beneficiary_date_authorized_stay_expires'] ?? null,
                'beneficiary_immigration_proceedings' => $data['beneficiary_immigration_proceedings'] ?? null,
                'beneficiary_proceedings_types' => $data['beneficiary_proceedings_types'] ?? [],
                'beneficiary_proceedings_city' => $data['beneficiary_proceedings_city'] ?? null,
                'beneficiary_proceedings_state' => $data['beneficiary_proceedings_state'] ?? null,
                'beneficiary_proceedings_date' => $data['beneficiary_proceedings_date'] ?? null,
                'beneficiary_employer_name' => $data['beneficiary_employer_name'] ?? null,
                'beneficiary_occupation' => $data['beneficiary_occupation'] ?? null,
                'beneficiary_employer_address_full' => $data['beneficiary_employer_address_full'] ?? null,
                'beneficiary_employer_apt' => ($data['beneficiary_employer_apt'] ?? null) === 'N/A' ? 'N/A' : ($data['beneficiary_employer_apt'] ?? null),
                'beneficiary_employer_city' => $data['beneficiary_employer_city'] ?? null,
                'beneficiary_employer_province' => $data['beneficiary_employer_province'] ?? null,
                'beneficiary_employer_postal' => $data['beneficiary_employer_postal'] ?? null,
                'beneficiary_employer_country' => $data['beneficiary_employer_country'] ?? null,
                'beneficiary_employment_start_date' => $data['beneficiary_employment_start_date'] ?? null,
                
                // ========================================
                // RELATIONSHIP ADDITIONAL FIELDS
                // ========================================
                'never_lived_together' => isset($data['never_lived_together']) ? (bool)$data['never_lived_together'] : false,
                'last_lived_together_address' => $data['last_lived_together_address'] ?? null,
                'last_lived_together_apt' => ($data['last_lived_together_apt'] ?? null) === 'N/A' ? 'N/A' : ($data['last_lived_together_apt'] ?? null),
                'last_lived_together_city' => $data['last_lived_together_city'] ?? null,
                'last_lived_together_state' => $data['last_lived_together_state'] ?? null,
                'last_lived_together_province' => $data['last_lived_together_province'] ?? null,
                'last_lived_together_postal' => $data['last_lived_together_postal'] ?? null,
                'last_lived_together_country' => $data['last_lived_together_country'] ?? null,
                'last_lived_together_date_from' => $data['last_lived_together_date_from'] ?? null,
                'last_lived_together_date_to' => $data['last_lived_together_date_to'] ?? null,
                'beneficiary_application_location' => $data['beneficiary_application_location'] ?? null,
                'beneficiary_uscis_office_city' => $data['beneficiary_uscis_office_city'] ?? null,
                'beneficiary_uscis_office_state' => $data['beneficiary_uscis_office_state'] ?? null,
                'beneficiary_consulate_city' => $data['beneficiary_consulate_city'] ?? null,
                'beneficiary_consulate_province' => $data['beneficiary_consulate_province'] ?? null,
                'beneficiary_consulate_country' => $data['beneficiary_consulate_country'] ?? null,
                
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
            // Sponsor Basic (13 + 7 biographic + 2 citizenship)
            'sponsor_first_name', 'sponsor_last_name', 'sponsor_sex',
            'sponsor_email', 'sponsor_phone', 'sponsor_mailing_address',
            'sponsor_mailing_city', 'sponsor_mailing_state', 'sponsor_mailing_zip',
            'sponsor_dob', 'sponsor_place_of_birth', 'sponsor_citizenship', 'sponsor_ssn',
            
            // Biographic (7)
            'sponsor_ethnicity', 'sponsor_height_feet', 'sponsor_height_inches',
            'sponsor_weight', 'sponsor_eye_color', 'sponsor_hair_color',
            
            // Citizenship (2)
            'sponsor_citizenship_method',
            
            // Sponsor Parents (14 - added residence info)
            'sponsor_parent1_first_name', 'sponsor_parent1_last_name',
            'sponsor_parent1_dob', 'sponsor_parent1_sex', 'sponsor_parent1_country',
            'sponsor_parent1_city_residence', 'sponsor_parent1_country_residence',
            'sponsor_parent2_first_name', 'sponsor_parent2_last_name',
            'sponsor_parent2_dob', 'sponsor_parent2_sex', 'sponsor_parent2_country',
            'sponsor_parent2_city_residence', 'sponsor_parent2_country_residence',
            
            // Beneficiary Basic (13)
            'beneficiary_first_name', 'beneficiary_last_name', 'beneficiary_sex',
            'beneficiary_email', 'beneficiary_daytime_phone', 'beneficiary_mailing_address',
            'beneficiary_mailing_city', 'beneficiary_mailing_country', 'beneficiary_dob',
            'beneficiary_place_of_birth', 'beneficiary_citizenship',
            'beneficiary_petition_filed_before',
            'beneficiary_ever_in_us',
            
            // Beneficiary Parents (16 - added city info)
            'beneficiary_parent1_first_name', 'beneficiary_parent1_last_name',
            'beneficiary_parent1_dob', 'beneficiary_parent1_country',
            'beneficiary_parent2_first_name', 'beneficiary_parent2_last_name',
            'beneficiary_parent2_dob', 'beneficiary_parent2_country',
            
            // Relationship (7)
            'marriage_date', 'marriage_location_city', 'marriage_location_country',
            'sponsor_times_married', 'sponsor_previous_marriages', 'beneficiary_previous_marriages',
            'beneficiary_application_location'
        ];

        $completedFields = 0;
        $totalFields = count($requiredFields);

        foreach ($requiredFields as $field) {
            $value = $application->$field;
            if (!empty($value) && $value !== null && trim($value) !== '') {
                $completedFields++;
            }
        }

        // Check race (must have at least one selected)
        if (!empty($application->sponsor_race) && is_array($application->sponsor_race) && count($application->sponsor_race) > 0) {
            $completedFields++;
        }
        $totalFields++;

        // Check immigration proceedings details (conditional)
        if ($application->beneficiary_immigration_proceedings === 'no') {
            $completedFields++; // Auto-complete if no proceedings
        }
        $totalFields++;

        // Check history (4 fields)
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