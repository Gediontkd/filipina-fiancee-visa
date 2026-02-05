<?php
// FILE: app/Http/Requests/Spouse/SimplifiedSpouseVisaRequest.php

namespace App\Http\Requests\Spouse;

use Illuminate\Foundation\Http\FormRequest;

class SimplifiedSpouseVisaRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            // ============================================
            // SPONSOR INFORMATION (I-130 Part 2) - REQUIRED
            // ============================================
            
            'sponsor_first_name' => 'required|string|max:50',
            'sponsor_last_name' => 'required|string|max:50',
            'sponsor_middle_name' => 'nullable|string|max:50',
            'sponsor_sex' => 'required|in:Male,Female',
            'sponsor_dob' => 'required|date|before:today',
            'sponsor_place_of_birth' => 'required|string|max:100',
            'sponsor_citizenship' => 'required|string|max:50',

            // Sponsor Adoption Questions (NEW)
            'sponsor_beneficiary_related_by_adoption' => 'required|in:yes,no,n/a',
            'sponsor_gained_status_through_adoption' => 'required|in:yes,no',

            // Sponsor Mailing/Physical Address Country (NEW)
            'sponsor_mailing_country' => 'required|string|max:100',
            'sponsor_country' => 'nullable|string|max:100',

            // Beneficiary Parent Relationship (NEW)
            'beneficiary_parent1_relationship' => 'required|string|max:50',
            'beneficiary_parent2_relationship' => 'required|string|max:50',
            
            // SSN - Format: ###-##-####
            'sponsor_ssn' => [
                'required',
                'string',
                'regex:/^\d{3}-\d{2}-\d{4}$/'
            ],
            
            'sponsor_email' => 'required|email|max:100',
            
            // Phone - Format: (###) ###-####
            'sponsor_phone' => [
                'required',
                'string',
                'regex:/^\(\d{3}\) \d{3}-\d{4}$/'
            ],
            
            // Mailing Address - REQUIRED
            'sponsor_mailing_address' => 'required|string|max:100',
            
            // UPDATED: Apt/Suite/Floor - Format: "Apt:2B" or "Ste:123" or "Flr:5A"
            'sponsor_mailing_apt' => [
                'nullable',
                'string',
                'max:10',
                'regex:/^(Apt|Ste|Flr):[A-Za-z0-9]{1,6}$/'
            ],
            
            'sponsor_mailing_city' => 'required|string|max:50',
            
            // State - Two letter code
            'sponsor_mailing_state' => [
                'required',
                'string',
                'size:2',
                'regex:/^[A-Z]{2}$/'
            ],
            
            // ZIP - 5 or 9 digits
            'sponsor_mailing_zip' => [
                'required',
                'string',
                'regex:/^\d{5}(-\d{4})?$/'
            ],
            
            'sponsor_mailing_date_from' => 'required|date',
            'sponsor_mailing_date_to' => 'required',
            'sponsor_same_address' => 'required|boolean',
            
            // Physical Address (if different) - OPTIONAL
            'sponsor_address' => 'nullable|string|max:100',
            
            // UPDATED: Physical apt format
            'sponsor_apt' => [
                'nullable',
                'string',
                'max:10',
                'regex:/^(Apt|Ste|Flr):[A-Za-z0-9]{1,6}$/'
            ],
            
            'sponsor_city' => 'nullable|string|max:50',
            'sponsor_state' => 'nullable|string|size:2|regex:/^[A-Z]{2}$/',
            'sponsor_zip' => 'nullable|string|regex:/^\d{5}(-\d{4})?$/',
            
            // Address History
            'sponsor_address_history' => 'nullable|array',
            'sponsor_address_history.*.address' => 'required|string|max:100',
            
            // UPDATED: Address history apt format
            'sponsor_address_history.*.apt' => [
                'nullable',
                'string',
                'max:10',
                'regex:/^(Apt|Ste|Flr):[A-Za-z0-9]{1,6}$/'
            ],
            
            'sponsor_address_history.*.city' => 'required|string|max:50',
            'sponsor_address_history.*.state' => 'nullable|string|max:2',
            'sponsor_address_history.*.zip' => 'nullable|string|max:10',
            'sponsor_address_history.*.country' => 'required|string|max:100',
            'sponsor_address_history.*.date_from' => 'required|date',
            'sponsor_address_history.*.date_to' => 'required',
            
            // Employment History
            'sponsor_employment_history' => 'nullable|array',
            'sponsor_employment_history.*.employer' => 'required|string|max:100',
            'sponsor_employment_history.*.occupation' => 'nullable|string|max:100',
            'sponsor_employment_history.*.address' => 'required|string|max:200',
            'sponsor_employment_history.*.date_from' => 'required|date',
            'sponsor_employment_history.*.date_to' => 'required',
            
            // ============================================
            // SPONSOR PARENTS - REQUIRED
            // ============================================
            'sponsor_parent1_first_name' => 'required|string|max:50',
            'sponsor_parent1_middle_name' => 'nullable|string|max:50',
            'sponsor_parent1_last_name' => 'required|string|max:50',
            'sponsor_parent1_dob' => 'required|date|before:sponsor_dob',
            'sponsor_parent1_sex' => 'required|in:Male,Female',
            'sponsor_parent1_country' => 'required|string|max:100',
            
            'sponsor_parent2_first_name' => 'required|string|max:50',
            'sponsor_parent2_middle_name' => 'nullable|string|max:50',
            'sponsor_parent2_last_name' => 'required|string|max:50',
            'sponsor_parent2_dob' => 'required|date|before:sponsor_dob',
            'sponsor_parent2_sex' => 'required|in:Male,Female',
            'sponsor_parent2_country' => 'required|string|max:100',
            
            // ============================================
            // SPONSOR EMPLOYMENT - OPTIONAL (for NVC stage)
            // ============================================
            'sponsor_employment_status' => 'nullable|string|max:50',
            'sponsor_employer_name' => 'nullable|string|max:100',
            'sponsor_occupation' => 'nullable|string|max:100',
            'sponsor_annual_income' => 'nullable|numeric|min:0',
            
            // ============================================
            // BENEFICIARY INFORMATION (I-130 Part 4) - REQUIRED
            // ============================================
            
            'beneficiary_first_name' => 'required|string|max:50',
            'beneficiary_last_name' => 'required|string|max:50',
            'beneficiary_middle_name' => 'nullable|string|max:50',
            'beneficiary_sex' => 'required|in:Male,Female',
            'beneficiary_dob' => 'required|date|before:today',
            'beneficiary_place_of_birth' => 'required|string|max:100',
            'beneficiary_citizenship' => 'required|string|max:100',
            
            // Optional with N/A support
            'beneficiary_passport_number' => 'nullable|string|max:50',
            'beneficiary_alien_number' => 'nullable|string|max:20',
            
            'beneficiary_email' => 'required|email|max:100',
            'beneficiary_phone' => 'required|string|max:50',
            
            // Mailing Address - REQUIRED
            'beneficiary_mailing_address' => 'required|string|max:100',
            
            // UPDATED: Apt format
            'beneficiary_mailing_apt' => [
                'nullable',
                'string',
                'max:10',
                'regex:/^(Apt|Ste|Flr):[A-Za-z0-9]{1,6}$/'
            ],
            
            'beneficiary_mailing_city' => 'required|string|max:50',
            'beneficiary_mailing_state' => 'nullable|string|max:50',
            'beneficiary_mailing_zip' => 'nullable|string|max:20',
            'beneficiary_mailing_country' => 'required|string|max:100',
            'beneficiary_mailing_date_from' => 'required|date',
            'beneficiary_mailing_date_to' => 'required',
            'beneficiary_same_address' => 'required|boolean',
            
            // Physical Address (if different) - OPTIONAL
            'beneficiary_address' => 'nullable|string|max:100',
            
            // UPDATED: Physical apt format
            'beneficiary_apt' => [
                'nullable',
                'string',
                'max:10',
                'regex:/^(Apt|Ste|Flr):[A-Za-z0-9]{1,6}$/'
            ],
            
            'beneficiary_city' => 'nullable|string|max:50',
            'beneficiary_state' => 'nullable|string|max:50',
            'beneficiary_zip' => 'nullable|string|max:20',
            'beneficiary_country' => 'nullable|string|max:100',
            
            // Address History
            'beneficiary_address_history' => 'nullable|array',
            'beneficiary_address_history.*.address' => 'required|string|max:100',
            
            // UPDATED: Address history apt format
            'beneficiary_address_history.*.apt' => [
                'nullable',
                'string',
                'max:10',
                'regex:/^(Apt|Ste|Flr):[A-Za-z0-9]{1,6}$/'
            ],
            
            'beneficiary_address_history.*.city' => 'required|string|max:50',
            'beneficiary_address_history.*.state' => 'nullable|string|max:50',
            'beneficiary_address_history.*.country' => 'nullable|string|max:100',
            'beneficiary_address_history.*.zip' => 'nullable|string|max:20',
            'beneficiary_address_history.*.date_from' => 'required|date',
            'beneficiary_address_history.*.date_to' => 'required',
            
            // Employment History
            'beneficiary_employment_history' => 'nullable|array',
            'beneficiary_employment_history.*.employer' => 'required|string|max:100',
            'beneficiary_employment_history.*.occupation' => 'nullable|string|max:100',
            'beneficiary_employment_history.*.address' => 'required|string|max:200',
            'beneficiary_employment_history.*.date_from' => 'required|date',
            'beneficiary_employment_history.*.date_to' => 'required',
            
            // ============================================
            // BENEFICIARY PARENTS - REQUIRED
            // ============================================
            // Beneficiary Parents (multiple entries)
            'beneficiary_parents_list' => 'required|array|min:2',
            'beneficiary_parents_list.*.first_name' => 'required|string|max:50',
            'beneficiary_parents_list.*.middle_name' => 'nullable|string|max:50',
            'beneficiary_parents_list.*.last_name' => 'required|string|max:50',
            'beneficiary_parents_list.*.relationship' => 'required|string|max:50',
            'beneficiary_parents_list.*.dob' => 'required|date|before:beneficiary_dob',
            'beneficiary_parents_list.*.country' => 'required|string|max:100',
            
            // ============================================
            // BENEFICIARY EMPLOYMENT - OPTIONAL
            // ============================================
            'beneficiary_employment_status' => 'nullable|string|max:50',
            'beneficiary_employer_name' => 'nullable|string|max:100',
            'beneficiary_occupation' => 'nullable|string|max:100',
            
            // ============================================
            // RELATIONSHIP INFORMATION - REQUIRED
            // ============================================
            
            'marriage_date' => 'required|date|before_or_equal:today',
            'marriage_location_city' => 'required|string|max:50',
            'marriage_location_state' => 'nullable|string|size:2|regex:/^[A-Z]{2}$/',
            'marriage_location_province' => 'nullable|string|max:50',
            'marriage_location_country' => 'required|string|max:100',
            'sponsor_times_married' => 'required|integer|min:1',
            
            'sponsor_previous_marriages' => 'required|in:yes,no',
            'sponsor_prev_spouse_first_name' => 'nullable|string|max:50',
            'sponsor_prev_spouse_last_name' => 'nullable|string|max:50',
            'sponsor_divorce_date' => 'nullable|date|before:marriage_date',
            
            'beneficiary_previous_marriages' => 'required|in:yes,no',
            'beneficiary_prev_spouse_first_name' => 'nullable|string|max:50',
            'beneficiary_prev_spouse_last_name' => 'nullable|string|max:50',
            'beneficiary_divorce_date' => 'nullable|date|before:marriage_date',

            // ========================================
            // PREVIOUS MARRIAGES LISTS (MULTIPLE ENTRIES) - ADD THIS
            // ========================================
            'sponsor_previous_marriages_list' => 'nullable|array',
            'sponsor_previous_marriages_list.*.first_name' => 'required|string|max:50',
            'sponsor_previous_marriages_list.*.last_name' => 'required|string|max:50',
            'sponsor_previous_marriages_list.*.date_ended' => 'nullable|date|before:marriage_date',
            'sponsor_previous_marriages_list.*.how_ended' => 'nullable|in:Divorce,Annulment,Death of Spouse',
            
            'beneficiary_previous_marriages_list' => 'nullable|array',
            'beneficiary_previous_marriages_list.*.first_name' => 'required|string|max:50',
            'beneficiary_previous_marriages_list.*.last_name' => 'required|string|max:50',
            'beneficiary_previous_marriages_list.*.date_ended' => 'nullable|date|before:marriage_date',
            'beneficiary_previous_marriages_list.*.how_ended' => 'nullable|in:Divorce,Annulment,Death of Spouse',

            // ========================================
            // SPONSOR ADDITIONAL FIELDS
            // ========================================
            
            // Other Names
            'sponsor_other_names' => 'nullable|array',
            'sponsor_other_names.*.first_name' => 'nullable|string|max:50',
            'sponsor_other_names.*.middle_name' => 'nullable|string|max:50',
            'sponsor_other_names.*.last_name' => 'nullable|string|max:50',
            
            // Additional IDs
            'sponsor_a_number' => 'nullable|string|max:20',
            'sponsor_uscis_account' => 'nullable|string|max:20',
            
            // Citizenship Details
            'sponsor_citizenship_method' => 'required|in:Birth in the United States,Naturalization,Parents',
            'sponsor_certificate_number' => 'nullable|string|max:50',
            'sponsor_certificate_place' => 'nullable|string|max:100',
            'sponsor_certificate_date' => 'nullable|date',
            
            // Biographic Information
            'sponsor_ethnicity' => 'required|in:Hispanic or Latino,Not Hispanic or Latino',
            'sponsor_race' => 'required|array|min:1',
            'sponsor_race.*' => 'in:White,Asian,Black or African American,American Indian or Alaska Native,Native Hawaiian or Other Pacific Islander',
            'sponsor_height_feet' => 'required|numeric|min:0|max:8',
            'sponsor_height_inches' => 'required|numeric|min:0|max:11.99',
            'sponsor_weight' => 'required|numeric|min:0|max:999',
            'sponsor_eye_color' => 'required|string|max:30',
            'sponsor_hair_color' => 'required|string|max:30',
            
            // Parent Residence
            'sponsor_parent1_city_residence' => 'required|string|max:100',
            'sponsor_parent1_country_residence' => 'required|string|max:100',
            'sponsor_parent2_city_residence' => 'required|string|max:100',
            'sponsor_parent2_country_residence' => 'required|string|max:100',
            
            // ========================================
            // BENEFICIARY ADDITIONAL FIELDS
            // ========================================
            
            // Other Names
            'beneficiary_other_names' => 'nullable|array',
            'beneficiary_other_names.*.first_name' => 'nullable|string|max:50',
            'beneficiary_other_names.*.middle_name' => 'nullable|string|max:50',
            'beneficiary_other_names.*.last_name' => 'nullable|string|max:50',
            
            // Additional IDs
            'beneficiary_ssn' => 'nullable|string|regex:/^\d{3}-\d{2}-\d{4}$/',
            'beneficiary_uscis_account' => 'nullable|string|max:20',
            'beneficiary_petition_filed_before' => 'required|in:Yes,No,Unknown',
            
            // Passport Details
            'beneficiary_passport_country' => 'nullable|string|max:100',
            'beneficiary_passport_expiration' => 'nullable|date|after:today',
            
            // Contact
            'beneficiary_daytime_phone' => 'required|string|max:50',
            'beneficiary_mobile_phone' => 'nullable|string|max:50',
            
            // Intended Address
            'beneficiary_intended_address_same' => 'nullable|boolean',
            'beneficiary_intended_address' => 'nullable|string|max:100',
            'beneficiary_intended_apt' => [
                'nullable',
                'string',
                'max:10',
                'regex:/^(Apt|Ste|Flr):[A-Za-z0-9]{1,6}$/'
            ],
            'beneficiary_intended_city' => 'nullable|string|max:50',
            'beneficiary_intended_state' => 'nullable|string|size:2|regex:/^[A-Z]{2}$/',
            'beneficiary_intended_zip' => 'nullable|string|regex:/^\d{5}(-\d{4})?$/',
            
            // Entry Information
            'beneficiary_ever_in_us' => 'required|in:yes,no',
            'beneficiary_class_of_admission' => 'nullable|string|max:20',
            'beneficiary_i94_number' => 'nullable|string|max:20',
            'beneficiary_date_of_arrival' => 'nullable|date|before_or_equal:today',
            'beneficiary_date_authorized_stay_expires' => 'nullable|string|max:20',
            
            // Immigration Proceedings
            'beneficiary_immigration_proceedings' => 'required|in:yes,no',
            'beneficiary_proceedings_types' => 'nullable|array',
            'beneficiary_proceedings_types.*' => 'in:Removal,Exclusion/Deportation,Rescission,Other',
            'beneficiary_proceedings_city' => 'nullable|string|max:100',
            'beneficiary_proceedings_state' => 'nullable|string|size:2|regex:/^[A-Z]{2}$/',
            'beneficiary_proceedings_date' => 'nullable|date|before_or_equal:today',
            
            // Current Employment Full Details
            'beneficiary_employer_address_full' => 'nullable|string|max:100',
            'beneficiary_employer_apt' => [
                'nullable',
                'string',
                'max:10',
                'regex:/^(Apt|Ste|Flr):[A-Za-z0-9]{1,6}$/'
            ],
            'beneficiary_employer_city' => 'nullable|string|max:50',
            'beneficiary_employer_province' => 'nullable|string|max:50',
            'beneficiary_employer_postal' => 'nullable|string|max:20',
            'beneficiary_employer_country' => 'nullable|string|max:100',
            'beneficiary_employment_start_date' => 'nullable|date|before_or_equal:today',
            
            
            // ========================================
            // RELATIONSHIP ADDITIONAL FIELDS
            // ========================================
            
            // Last Lived Together
            'never_lived_together' => 'nullable|boolean',
            'last_lived_together_address' => 'nullable|string|max:100',
            'last_lived_together_apt' => [
                'nullable',
                'string',
                'max:10',
                'regex:/^(Apt|Ste|Flr):[A-Za-z0-9]{1,6}$/'
            ],
            'last_lived_together_city' => 'nullable|string|max:50',
            'last_lived_together_state' => 'nullable|string|size:2|regex:/^[A-Z]{2}$/',
            'last_lived_together_province' => 'nullable|string|max:50',
            'last_lived_together_postal' => 'nullable|string|max:20',
            'last_lived_together_country' => 'nullable|string|max:100',
            'last_lived_together_date_from' => 'nullable|date',
            'last_lived_together_date_to' => 'nullable|date|after_or_equal:last_lived_together_date_from',
            
            // Application Location
            'beneficiary_application_location' => 'required|in:us_adjustment,abroad_consulate',
            'beneficiary_uscis_office_city' => 'nullable|string|max:100',
            'beneficiary_uscis_office_state' => 'nullable|string|size:2|regex:/^[A-Z]{2}$/',
            'beneficiary_consulate_city' => 'nullable|string|max:100',
            'beneficiary_consulate_province' => 'nullable|string|max:100',
            'beneficiary_consulate_country' => 'nullable|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            // Sponsor
            'sponsor_first_name.required' => 'Sponsor first name is required',
            'sponsor_last_name.required' => 'Sponsor last name is required',
            'sponsor_sex.required' => 'Sponsor sex is required',
            'sponsor_email.required' => 'Sponsor email is required',
            'sponsor_email.email' => 'Please enter a valid email address',
            'sponsor_phone.required' => 'Sponsor phone number is required',
            'sponsor_phone.regex' => 'Phone must be in format: (###) ###-####',
            'sponsor_mailing_address.required' => 'Sponsor mailing address is required',
            'sponsor_mailing_city.required' => 'Sponsor mailing city is required',
            'sponsor_mailing_state.required' => 'Sponsor mailing state is required',
            'sponsor_mailing_state.size' => 'State must be exactly 2 letters (e.g., CA)',
            'sponsor_mailing_state.regex' => 'State must be 2 uppercase letters only',
            'sponsor_mailing_zip.required' => 'Sponsor mailing ZIP code is required',
            'sponsor_mailing_zip.regex' => 'ZIP must be 5 digits or 9 digits (12345 or 12345-6789)',
            'sponsor_address_history.*.country.required' => 'Country is required for each address in history',
            'sponsor_address_history.*.country.max' => 'Country name cannot exceed 100 characters',

            'sponsor_beneficiary_related_by_adoption.required' => 'Please indicate if related to beneficiary by adoption',
            'sponsor_gained_status_through_adoption.required' => 'Please indicate if you gained status through adoption',
            'sponsor_mailing_country.required' => 'Sponsor mailing country is required',
            'beneficiary_parent1_relationship.required' => 'Parent 1 relationship is required',
            'beneficiary_parent2_relationship.required' => 'Parent 2 relationship is required',

            // Previous Marriages Lists
            'sponsor_previous_marriages_list.*.first_name.required' => 'Previous spouse first name is required',
            'sponsor_previous_marriages_list.*.last_name.required' => 'Previous spouse last name is required',
            'sponsor_previous_marriages_list.*.date_ended.before' => 'Previous marriage must have ended before current marriage',
            
            'beneficiary_previous_marriages_list.*.first_name.required' => 'Previous spouse first name is required',
            'beneficiary_previous_marriages_list.*.last_name.required' => 'Previous spouse last name is required',
            'beneficiary_previous_marriages_list.*.date_ended.before' => 'Previous marriage must have ended before current marriage',
            
            // UPDATED: Apt validation messages
            'sponsor_mailing_apt.regex' => 'Apt/Suite/Floor must be in format: Apt:2B or Ste:123 or Flr:5A (max 6 characters, alphanumeric only)',
            'sponsor_apt.regex' => 'Apt/Suite/Floor must be in format: Apt:2B or Ste:123 or Flr:5A (max 6 characters, alphanumeric only)',
            'beneficiary_mailing_apt.regex' => 'Apt/Suite/Floor must be in format: Apt:2B or Ste:123 or Flr:5A (max 6 characters, alphanumeric only)',
            'beneficiary_apt.regex' => 'Apt/Suite/Floor must be in format: Apt:2B or Ste:123 or Flr:5A (max 6 characters, alphanumeric only)',
            
            'sponsor_dob.required' => 'Sponsor date of birth is required',
            'sponsor_dob.before' => 'Sponsor date of birth must be in the past',
            'sponsor_place_of_birth.required' => 'Sponsor place of birth is required',
            'sponsor_citizenship.required' => 'Sponsor citizenship is required',
            'sponsor_ssn.required' => 'Sponsor Social Security Number is required',
            'sponsor_ssn.regex' => 'SSN must be in format: ###-##-####',
            
            // Sponsor Parents
            'sponsor_parent1_first_name.required' => 'Parent 1 first name is required',
            'sponsor_parent1_last_name.required' => 'Parent 1 last name is required',
            'sponsor_parent1_dob.required' => 'Parent 1 date of birth is required',
            'sponsor_parent1_dob.before' => 'Parent 1 must be born before sponsor',
            'sponsor_parent1_sex.required' => 'Parent 1 sex is required',
            'sponsor_parent1_country.required' => 'Parent 1 country of birth is required',
            
            'sponsor_parent2_first_name.required' => 'Parent 2 first name is required',
            'sponsor_parent2_last_name.required' => 'Parent 2 last name is required',
            'sponsor_parent2_dob.required' => 'Parent 2 date of birth is required',
            'sponsor_parent2_dob.before' => 'Parent 2 must be born before sponsor',
            'sponsor_parent2_sex.required' => 'Parent 2 sex is required',
            'sponsor_parent2_country.required' => 'Parent 2 country of birth is required',
            
            // Beneficiary
            'beneficiary_first_name.required' => 'Beneficiary first name is required',
            'beneficiary_last_name.required' => 'Beneficiary last name is required',
            'beneficiary_sex.required' => 'Beneficiary sex is required',
            'beneficiary_email.required' => 'Beneficiary email is required',
            'beneficiary_email.email' => 'Please enter a valid email address',
            'beneficiary_phone.required' => 'Beneficiary phone number is required',
            'beneficiary_mailing_address.required' => 'Beneficiary mailing address is required',
            'beneficiary_mailing_city.required' => 'Beneficiary mailing city is required',
            'beneficiary_mailing_country.required' => 'Beneficiary mailing country is required',
            'beneficiary_dob.required' => 'Beneficiary date of birth is required',
            'beneficiary_dob.before' => 'Beneficiary date of birth must be in the past',
            'beneficiary_place_of_birth.required' => 'Beneficiary place of birth is required',
            'beneficiary_citizenship.required' => 'Beneficiary citizenship is required',
            
            // Beneficiary Parents
            'beneficiary_parent1_first_name.required' => 'Parent 1 first name is required',
            'beneficiary_parent1_last_name.required' => 'Parent 1 last name is required',
            'beneficiary_parent1_dob.required' => 'Parent 1 date of birth is required',
            'beneficiary_parent1_dob.before' => 'Parent 1 must be born before beneficiary',
            'beneficiary_parent1_country.required' => 'Parent 1 country of birth is required',
            
            'beneficiary_parent2_first_name.required' => 'Parent 2 first name is required',
            'beneficiary_parent2_last_name.required' => 'Parent 2 last name is required',
            'beneficiary_parent2_dob.required' => 'Parent 2 date of birth is required',
            'beneficiary_parent2_dob.before' => 'Parent 2 must be born before beneficiary',
            'beneficiary_parent2_country.required' => 'Parent 2 country of birth is required',
            
            // Relationship
            'marriage_date.required' => 'Marriage date is required',
            'marriage_date.before_or_equal' => 'Marriage date cannot be in the future',
            'marriage_location_city.required' => 'Marriage location city is required',
            'marriage_location_state.size' => 'State must be exactly 2 letters',
            'marriage_location_state.regex' => 'State must be 2 uppercase letters',
            'marriage_location_country.required' => 'Marriage location country is required',
            'sponsor_times_married.required' => 'Number of times married is required',
            'sponsor_times_married.min' => 'Must have been married at least once',
            'sponsor_previous_marriages.required' => 'Please indicate if sponsor was previously married',
            'beneficiary_previous_marriages.required' => 'Please indicate if beneficiary was previously married',


            // Sponsor
            'sponsor_citizenship_method.required' => 'Please specify how you acquired U.S. citizenship',
            'sponsor_ethnicity.required' => 'Ethnicity is required',
            'sponsor_race.required' => 'Please select at least one race',
            'sponsor_race.min' => 'Please select at least one race',
            'sponsor_height_feet.required' => 'Height in feet is required',
            'sponsor_height_inches.required' => 'Height in inches is required',
            'sponsor_weight.required' => 'Weight is required',
            'sponsor_eye_color.required' => 'Eye color is required',
            'sponsor_hair_color.required' => 'Hair color is required',
            'sponsor_parent1_city_residence.required' => 'Parent 1 city of residence is required',
            'sponsor_parent1_country_residence.required' => 'Parent 1 country of residence is required',
            'sponsor_parent2_city_residence.required' => 'Parent 2 city of residence is required',
            'sponsor_parent2_country_residence.required' => 'Parent 2 country of residence is required',
            
            // Beneficiary
            'beneficiary_ssn.regex' => 'SSN must be in format: ###-##-####',
            'beneficiary_petition_filed_before.required' => 'Please indicate if anyone has filed petition before',
            'beneficiary_daytime_phone.required' => 'Daytime telephone number is required',
            'beneficiary_ever_in_us.required' => 'Please indicate if beneficiary was ever in the US',
            'beneficiary_immigration_proceedings.required' => 'Please indicate if beneficiary was in immigration proceedings',
            
            // Relationship
            'beneficiary_application_location.required' => 'Please specify where beneficiary will apply',
        ];
    }
}