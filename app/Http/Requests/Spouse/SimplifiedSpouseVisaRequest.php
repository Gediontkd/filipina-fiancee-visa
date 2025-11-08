<?php
// FILE: app/Http/Requests/Spouse/SimplifiedSpouseVisaRequest.php
// FIXED: Financial fields are optional (not required for I-130)

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
            
            // Address
            'sponsor_address' => 'required|string|max:100',
            'sponsor_apt' => 'nullable|string|max:20',
            'sponsor_city' => 'required|string|max:50',
            
            // State - Two letter code
            'sponsor_state' => [
                'required',
                'string',
                'size:2',
                'regex:/^[A-Z]{2}$/'
            ],
            
            // ZIP - 5 or 9 digits
            'sponsor_zip' => [
                'required',
                'string',
                'regex:/^\d{5}(-\d{4})?$/'
            ],
            
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
            
            // Address
            'beneficiary_address' => 'required|string|max:100',
            'beneficiary_apt' => 'nullable|string|max:20',
            'beneficiary_city' => 'required|string|max:50',
            'beneficiary_state' => 'nullable|string|max:50',
            'beneficiary_zip' => 'nullable|string|max:20',
            'beneficiary_country' => 'required|string|max:100',
            
            // ============================================
            // BENEFICIARY PARENTS - REQUIRED
            // ============================================
            'beneficiary_parent1_first_name' => 'required|string|max:50',
            'beneficiary_parent1_middle_name' => 'nullable|string|max:50',
            'beneficiary_parent1_last_name' => 'required|string|max:50',
            'beneficiary_parent1_dob' => 'required|date|before:beneficiary_dob',
            'beneficiary_parent1_sex' => 'required|in:Male,Female',
            'beneficiary_parent1_country' => 'required|string|max:100',
            
            'beneficiary_parent2_first_name' => 'required|string|max:50',
            'beneficiary_parent2_middle_name' => 'nullable|string|max:50',
            'beneficiary_parent2_last_name' => 'required|string|max:50',
            'beneficiary_parent2_dob' => 'required|date|before:beneficiary_dob',
            'beneficiary_parent2_sex' => 'required|in:Male,Female',
            'beneficiary_parent2_country' => 'required|string|max:100',
            
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
            'sponsor_address.required' => 'Sponsor address is required',
            'sponsor_city.required' => 'Sponsor city is required',
            'sponsor_state.required' => 'Sponsor state is required',
            'sponsor_state.size' => 'State must be exactly 2 letters (e.g., CA)',
            'sponsor_state.regex' => 'State must be 2 uppercase letters only',
            'sponsor_zip.required' => 'Sponsor ZIP code is required',
            'sponsor_zip.regex' => 'ZIP must be 5 digits or 9 digits (12345 or 12345-6789)',
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
            'beneficiary_address.required' => 'Beneficiary address is required',
            'beneficiary_city.required' => 'Beneficiary city is required',
            'beneficiary_country.required' => 'Beneficiary country is required',
            'beneficiary_dob.required' => 'Beneficiary date of birth is required',
            'beneficiary_dob.before' => 'Beneficiary date of birth must be in the past',
            'beneficiary_place_of_birth.required' => 'Beneficiary place of birth is required',
            'beneficiary_citizenship.required' => 'Beneficiary citizenship is required',
            
            // Beneficiary Parents
            'beneficiary_parent1_first_name.required' => 'Parent 1 first name is required',
            'beneficiary_parent1_last_name.required' => 'Parent 1 last name is required',
            'beneficiary_parent1_dob.required' => 'Parent 1 date of birth is required',
            'beneficiary_parent1_dob.before' => 'Parent 1 must be born before beneficiary',
            'beneficiary_parent1_sex.required' => 'Parent 1 sex is required',
            'beneficiary_parent1_country.required' => 'Parent 1 country of birth is required',
            
            'beneficiary_parent2_first_name.required' => 'Parent 2 first name is required',
            'beneficiary_parent2_last_name.required' => 'Parent 2 last name is required',
            'beneficiary_parent2_dob.required' => 'Parent 2 date of birth is required',
            'beneficiary_parent2_dob.before' => 'Parent 2 must be born before beneficiary',
            'beneficiary_parent2_sex.required' => 'Parent 2 sex is required',
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
        ];
    }
}