<?php
// FILE: app/Services/ApplicationDataService.php
// FIXED: Complete data formatting for all application types

namespace App\Services;

use App\Models\User;
use App\Models\UserSubmittedApplication;
use App\Models\FianceVisaSubmittedStep;
use App\Models\SpouseVisaSubmittedStep;
use App\Models\AdjustmentVisaSubmittedStep;
use App\Models\SimplifiedSpouseVisaApplication;
use App\Models\SimplifiedAosApplication;
use Illuminate\Support\Facades\Log;

class ApplicationDataService
{
    public function collectApplicationData(UserSubmittedApplication $application): array
    {
        $user = $application->user;
        $applicationType = $application->visaApplication->name;

        $data = [
            'application_info' => [
                'id' => $application->id,
                'transaction_id' => $application->transaction_id,
                'type' => $applicationType,
                'status' => $application->status,
                'submitted_at' => $application->created_at->toDateTimeString(),
            ],
            'user_info' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? 'N/A',
            ],
            'form_data' => []
        ];

        // Get form data based on application type
        if (stripos($applicationType, 'Fiance') !== false) {
            $data['form_data'] = $this->getFianceData($user->id);
        } elseif (stripos($applicationType, 'Spouse') !== false) {
            $data['form_data'] = $this->getSpouseData($user->id, $application->id);
        } elseif (stripos($applicationType, 'Adjustment') !== false) {
            $data['form_data'] = $this->getAdjustmentData($user->id, $application->id);
        }

        Log::info('Application data collected', [
            'application_id' => $application->id,
            'type' => $applicationType,
            'has_data' => !empty($data['form_data']),
            'data_keys' => array_keys($data['form_data'])
        ]);

        return $data;
    }

    /**
     * Get Fiance Visa data (OLD STEP SYSTEM)
     */
    private function getFianceData($userId): array
    {
        $steps = FianceVisaSubmittedStep::where('user_id', $userId)
            ->orderBy('id', 'asc')
            ->get();

        $data = [
            'sponsor' => [],
            'alien' => [],
            'children' => [],
        ];

        foreach ($steps as $step) {
            $detail = $step->detail;
            
            if ($step->type === 'sponsor') {
                $data['sponsor'][$step->step] = $detail;
            } elseif ($step->type === 'alien') {
                $data['alien'][$step->step] = $detail;
            } elseif ($step->type === 'alien-children') {
                $data['children'][$step->step] = $detail;
            }
        }

        return $data;
    }

    /**
     * Get Spouse Visa data (BOTH OLD AND NEW SYSTEMS)
     */
    private function getSpouseData($userId, $submittedAppId): array
    {
        // Check for NEW simplified spouse visa application
        $simplified = SimplifiedSpouseVisaApplication::where('user_id', $userId)
            ->where('submitted_app_id', $submittedAppId)
            ->first();

        if ($simplified) {
            return $this->formatSimplifiedSpouseData($simplified);
        }

        // Fallback to OLD step-based system
        $steps = SpouseVisaSubmittedStep::where('user_id', $userId)
            ->orderBy('id', 'asc')
            ->get();

        if ($steps->isEmpty()) {
            return [];
        }

        $data = [];
        foreach ($steps as $step) {
            $data[$step->step] = $step->detail;
        }

        return $data;
    }

    /**
     * Get Adjustment of Status data (BOTH OLD AND NEW SYSTEMS)
     */
    private function getAdjustmentData($userId, $submittedAppId): array
    {
        // Check for NEW simplified AOS application
        $simplified = SimplifiedAosApplication::where('user_id', $userId)
            ->where('submitted_app_id', $submittedAppId)
            ->first();

        if ($simplified) {
            return $this->formatSimplifiedAosData($simplified);
        }

        // Fallback to OLD step-based system
        $steps = AdjustmentVisaSubmittedStep::where('user_id', $userId)
            ->orderBy('id', 'asc')
            ->get();

        if ($steps->isEmpty()) {
            return [];
        }

        $data = [];
        foreach ($steps as $step) {
            $data[$step->step] = $step->detail;
        }

        return $data;
    }

    /**
     * FIXED: Format simplified spouse visa data with ALL fields
     */
    private function formatSimplifiedSpouseData(SimplifiedSpouseVisaApplication $app): array
    {
        return [
            'sponsor' => [
                'personal_information' => [
                    'first_name' => $app->sponsor_first_name,
                    'middle_name' => $app->sponsor_middle_name,
                    'last_name' => $app->sponsor_last_name,
                    'sex' => $app->sponsor_sex,
                    'date_of_birth' => $app->sponsor_dob?->format('m/d/Y'),
                    'place_of_birth' => $app->sponsor_place_of_birth,
                    'citizenship' => $app->sponsor_citizenship,
                    'ssn' => $app->sponsor_ssn,
                ],
                'contact_information' => [
                    'email' => $app->sponsor_email,
                    'phone' => $app->sponsor_phone,
                ],
                'mailing_address' => [
                    'street' => $app->sponsor_mailing_address,
                    'apt_suite_floor' => $app->sponsor_mailing_apt,
                    'city' => $app->sponsor_mailing_city,
                    'state' => $app->sponsor_mailing_state,
                    'zip' => $app->sponsor_mailing_zip,
                    'date_from' => $app->sponsor_mailing_date_from,
                    'date_to' => $app->sponsor_mailing_date_to ?? 'Present',
                ],
                'same_physical_address' => $app->sponsor_same_address,
                'physical_address' => [
                    'street' => $app->sponsor_address,
                    'apt_suite_floor' => $app->sponsor_apt,
                    'city' => $app->sponsor_city,
                    'state' => $app->sponsor_state,
                    'zip' => $app->sponsor_zip,
                ],
                'address_history' => $app->sponsor_address_history ?? [],
                'parents' => [
                    'parent_1' => [
                        'first_name' => $app->sponsor_parent1_first_name,
                        'middle_name' => $app->sponsor_parent1_middle_name,
                        'last_name' => $app->sponsor_parent1_last_name,
                        'date_of_birth' => $app->sponsor_parent1_dob?->format('m/d/Y'),
                        'sex' => $app->sponsor_parent1_sex,
                        'country_of_birth' => $app->sponsor_parent1_country,
                    ],
                    'parent_2' => [
                        'first_name' => $app->sponsor_parent2_first_name,
                        'middle_name' => $app->sponsor_parent2_middle_name,
                        'last_name' => $app->sponsor_parent2_last_name,
                        'date_of_birth' => $app->sponsor_parent2_dob?->format('m/d/Y'),
                        'sex' => $app->sponsor_parent2_sex,
                        'country_of_birth' => $app->sponsor_parent2_country,
                    ],
                ],
                'employment' => [
                    'status' => $app->sponsor_employment_status,
                    'employer' => $app->sponsor_employer_name,
                    'occupation' => $app->sponsor_occupation,
                    'annual_income' => $app->sponsor_annual_income,
                ],
                'employment_history' => $app->sponsor_employment_history ?? [],
            ],
            'beneficiary' => [
                'personal_information' => [
                    'first_name' => $app->beneficiary_first_name,
                    'middle_name' => $app->beneficiary_middle_name,
                    'last_name' => $app->beneficiary_last_name,
                    'sex' => $app->beneficiary_sex,
                    'date_of_birth' => $app->beneficiary_dob?->format('m/d/Y'),
                    'place_of_birth' => $app->beneficiary_place_of_birth,
                    'citizenship' => $app->beneficiary_citizenship,
                    'passport_number' => $app->beneficiary_passport_number,
                    'alien_number' => $app->beneficiary_alien_number,
                ],
                'contact_information' => [
                    'email' => $app->beneficiary_email,
                    'phone' => $app->beneficiary_phone,
                ],
                'mailing_address' => [
                    'street' => $app->beneficiary_mailing_address,
                    'apt_suite_floor' => $app->beneficiary_mailing_apt,
                    'city' => $app->beneficiary_mailing_city,
                    'state' => $app->beneficiary_mailing_state,
                    'country' => $app->beneficiary_mailing_country,
                    'zip' => $app->beneficiary_mailing_zip,
                    'date_from' => $app->beneficiary_mailing_date_from,
                    'date_to' => $app->beneficiary_mailing_date_to ?? 'Present',
                ],
                'same_physical_address' => $app->beneficiary_same_address,
                'physical_address' => [
                    'street' => $app->beneficiary_address,
                    'apt_suite_floor' => $app->beneficiary_apt,
                    'city' => $app->beneficiary_city,
                    'state' => $app->beneficiary_state,
                    'country' => $app->beneficiary_country,
                    'zip' => $app->beneficiary_zip,
                ],
                'address_history' => $app->beneficiary_address_history ?? [],
                'parents' => [
                    'parent_1' => [
                        'first_name' => $app->beneficiary_parent1_first_name,
                        'middle_name' => $app->beneficiary_parent1_middle_name,
                        'last_name' => $app->beneficiary_parent1_last_name,
                        'date_of_birth' => $app->beneficiary_parent1_dob?->format('m/d/Y'),
                        'sex' => $app->beneficiary_parent1_sex,
                        'country_of_birth' => $app->beneficiary_parent1_country,
                    ],
                    'parent_2' => [
                        'first_name' => $app->beneficiary_parent2_first_name,
                        'middle_name' => $app->beneficiary_parent2_middle_name,
                        'last_name' => $app->beneficiary_parent2_last_name,
                        'date_of_birth' => $app->beneficiary_parent2_dob?->format('m/d/Y'),
                        'sex' => $app->beneficiary_parent2_sex,
                        'country_of_birth' => $app->beneficiary_parent2_country,
                    ],
                ],
                'employment' => [
                    'status' => $app->beneficiary_employment_status,
                    'employer' => $app->beneficiary_employer_name,
                    'occupation' => $app->beneficiary_occupation,
                ],
                'employment_history' => $app->beneficiary_employment_history ?? [],
            ],
            'relationship' => [
                'marriage_information' => [
                    'marriage_date' => $app->marriage_date?->format('m/d/Y'),
                    'marriage_city' => $app->marriage_location_city,
                    'marriage_state' => $app->marriage_location_state,
                    'marriage_province' => $app->marriage_location_province,
                    'marriage_country' => $app->marriage_location_country,
                    'sponsor_times_married' => $app->sponsor_times_married,
                ],
                'previous_marriages' => [
                    'sponsor_previous_marriages' => $app->sponsor_previous_marriages,
                    'sponsor_previous_spouse_first_name' => $app->sponsor_prev_spouse_first_name,
                    'sponsor_previous_spouse_last_name' => $app->sponsor_prev_spouse_last_name,
                    'sponsor_divorce_date' => $app->sponsor_divorce_date?->format('m/d/Y'),
                    'beneficiary_previous_marriages' => $app->beneficiary_previous_marriages,
                    'beneficiary_previous_spouse_first_name' => $app->beneficiary_prev_spouse_first_name,
                    'beneficiary_previous_spouse_last_name' => $app->beneficiary_prev_spouse_last_name,
                    'beneficiary_divorce_date' => $app->beneficiary_divorce_date?->format('m/d/Y'),
                ],
            ],
            'metadata' => [
                'status' => $app->status,
                'submitted_at' => $app->submitted_at?->format('m/d/Y H:i:s'),
                'last_updated' => $app->updated_at->format('m/d/Y H:i:s'),
            ],
        ];
    }

    /**
     * Format simplified AOS data for display
     */
    private function formatSimplifiedAosData(SimplifiedAosApplication $app): array
    {
        return [
            'applicant' => [
                'personal_information' => [
                    'first_name' => $app->applicant_first_name,
                    'middle_name' => $app->applicant_middle_name,
                    'last_name' => $app->applicant_last_name,
                    'date_of_birth' => $app->applicant_dob?->format('m/d/Y'),
                    'place_of_birth' => $app->applicant_place_of_birth,
                    'citizenship' => $app->applicant_citizenship,
                    'alien_number' => $app->applicant_alien_number,
                    'ssn' => $app->applicant_ssn,
                ],
                'contact_information' => [
                    'email' => $app->applicant_email,
                    'phone' => $app->applicant_phone,
                ],
                'address' => [
                    'street' => $app->applicant_address,
                    'city' => $app->applicant_city,
                    'state' => $app->applicant_state,
                    'zip' => $app->applicant_zip,
                ],
                'employment' => [
                    'status' => $app->applicant_employment_status,
                    'employer' => $app->applicant_employer_name,
                    'occupation' => $app->applicant_occupation,
                ],
            ],
            'immigration_status' => [
                'current_visa' => [
                    'type' => $app->current_visa_type,
                    'expiration_date' => $app->visa_expiration_date?->format('m/d/Y'),
                    'i94_number' => $app->i94_number,
                ],
                'passport' => [
                    'number' => $app->passport_number,
                    'country' => $app->passport_country,
                    'expiration' => $app->passport_expiration?->format('m/d/Y'),
                ],
                'entry' => [
                    'date' => $app->entry_date?->format('m/d/Y'),
                    'location' => $app->entry_location,
                ],
                'marital_status' => [
                    'status' => $app->marital_status,
                    'marriage_date' => $app->marriage_date?->format('m/d/Y'),
                    'spouse_name' => $app->spouse_name,
                ],
            ],
            'sponsor' => [
                'personal_information' => [
                    'first_name' => $app->sponsor_first_name,
                    'middle_name' => $app->sponsor_middle_name,
                    'last_name' => $app->sponsor_last_name,
                    'relationship' => $app->sponsor_relationship,
                    'citizenship_status' => $app->sponsor_citizenship_status,
                    'ssn' => $app->sponsor_ssn,
                ],
                'contact_information' => [
                    'email' => $app->sponsor_email,
                    'phone' => $app->sponsor_phone,
                ],
                'address' => [
                    'street' => $app->sponsor_address,
                    'city' => $app->sponsor_city,
                    'state' => $app->sponsor_state,
                    'zip' => $app->sponsor_zip,
                ],
            ],
            'background_questions' => [
                'arrested_or_convicted' => $app->arrested_or_convicted,
                'immigration_violations' => $app->immigration_violations,
                'public_assistance' => $app->public_assistance,
                'explanation' => $app->background_explanation,
            ],
            'metadata' => [
                'status' => $app->status,
                'submitted_at' => $app->submitted_at?->format('m/d/Y H:i:s'),
                'last_updated' => $app->updated_at->format('m/d/Y H:i:s'),
            ],
        ];
    }

    /**
     * Format data as JSON
     */
    public function formatAsJson(array $data): string
    {
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Save JSON to file
     */
    public function saveJsonFile(string $jsonData, string $filename): string
    {
        $tempPath = storage_path('app/temp');
        if (!file_exists($tempPath)) {
            mkdir($tempPath, 0755, true);
        }
        $filePath = $tempPath . '/' . $filename;
        file_put_contents($filePath, $jsonData);
        return $filePath;
    }
}