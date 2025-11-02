<?php

namespace App\Http\Requests\Spouse;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Simplified Spouse Visa Request Validation
 * Validates all spouse visa application fields
 */
class SimplifiedSpouseVisaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            // Sponsor Information - Required Fields
            'sponsor_first_name' => 'required|string|max:255',
            'sponsor_last_name' => 'required|string|max:255',
            'sponsor_middle_name' => 'nullable|string|max:255',
            'sponsor_email' => 'required|email|max:255',
            'sponsor_phone' => 'required|string|max:20',
            'sponsor_address' => 'required|string|max:500',
            'sponsor_city' => 'required|string|max:255',
            'sponsor_state' => 'required|string|max:255',
            'sponsor_zip' => 'required|string|max:20',
            'sponsor_country' => 'nullable|string|max:255',
            'sponsor_dob' => 'required|date|before:today',
            'sponsor_place_of_birth' => 'required|string|max:255',
            'sponsor_citizenship' => 'required|string|max:255',
            'sponsor_ssn' => 'required|string|max:20',
            
            // Sponsor Employment - Optional
            'sponsor_employment_status' => 'nullable|string|max:255',
            'sponsor_employer_name' => 'nullable|string|max:255',
            'sponsor_occupation' => 'nullable|string|max:255',
            'sponsor_annual_income' => 'nullable|numeric|min:0',
            
            // Beneficiary Information - Required Fields
            'beneficiary_first_name' => 'required|string|max:255',
            'beneficiary_last_name' => 'required|string|max:255',
            'beneficiary_middle_name' => 'nullable|string|max:255',
            'beneficiary_email' => 'required|email|max:255',
            'beneficiary_phone' => 'required|string|max:20',
            'beneficiary_address' => 'required|string|max:500',
            'beneficiary_city' => 'required|string|max:255',
            'beneficiary_state' => 'nullable|string|max:255',
            'beneficiary_zip' => 'nullable|string|max:20',
            'beneficiary_country' => 'required|string|max:255',
            'beneficiary_dob' => 'required|date|before:today',
            'beneficiary_place_of_birth' => 'required|string|max:255',
            'beneficiary_citizenship' => 'required|string|max:255',
            'beneficiary_passport_number' => 'required|string|max:50',
            'beneficiary_alien_number' => 'nullable|string|max:20',
            
            // Beneficiary Employment - Optional
            'beneficiary_employment_status' => 'nullable|string|max:255',
            'beneficiary_employer_name' => 'nullable|string|max:255',
            'beneficiary_occupation' => 'nullable|string|max:255',
            
            // Relationship Information - Required Fields
            'marriage_date' => 'required|date|before_or_equal:today',
            'marriage_location_city' => 'required|string|max:255',
            'marriage_location_country' => 'required|string|max:255',
            'first_met_date' => 'required|date|before_or_equal:marriage_date',
            'first_met_location' => 'required|string|max:500',
            'relationship_description' => 'required|string|min:50|max:2000',
            'times_met_in_person' => 'required|integer|min:1',
            'last_meeting_date' => 'nullable|date|before_or_equal:today',
            'communication_methods' => 'required|string|max:500',
            
            // Previous Marriages - Conditional
            'sponsor_previous_marriages' => 'nullable|in:yes,no',
            'beneficiary_previous_marriages' => 'nullable|in:yes,no',
            'sponsor_divorce_date' => 'nullable|date|before:marriage_date',
            'beneficiary_divorce_date' => 'nullable|date|before:marriage_date',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages()
    {
        return [
            // Sponsor Messages
            'sponsor_first_name.required' => 'Sponsor first name is required',
            'sponsor_last_name.required' => 'Sponsor last name is required',
            'sponsor_email.required' => 'Sponsor email is required',
            'sponsor_email.email' => 'Please enter a valid email address',
            'sponsor_phone.required' => 'Sponsor phone number is required',
            'sponsor_address.required' => 'Sponsor address is required',
            'sponsor_city.required' => 'Sponsor city is required',
            'sponsor_state.required' => 'Sponsor state is required',
            'sponsor_zip.required' => 'Sponsor ZIP code is required',
            'sponsor_dob.required' => 'Sponsor date of birth is required',
            'sponsor_dob.before' => 'Sponsor date of birth must be in the past',
            'sponsor_place_of_birth.required' => 'Sponsor place of birth is required',
            'sponsor_citizenship.required' => 'Sponsor citizenship is required',
            'sponsor_ssn.required' => 'Sponsor Social Security Number is required',
            
            // Beneficiary Messages
            'beneficiary_first_name.required' => 'Beneficiary first name is required',
            'beneficiary_last_name.required' => 'Beneficiary last name is required',
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
            'beneficiary_passport_number.required' => 'Beneficiary passport number is required',
            
            // Relationship Messages
            'marriage_date.required' => 'Marriage date is required',
            'marriage_date.before_or_equal' => 'Marriage date cannot be in the future',
            'marriage_location_city.required' => 'Marriage location city is required',
            'marriage_location_country.required' => 'Marriage location country is required',
            'first_met_date.required' => 'First meeting date is required',
            'first_met_date.before_or_equal' => 'First meeting must be before or on marriage date',
            'first_met_location.required' => 'First meeting location is required',
            'relationship_description.required' => 'Relationship description is required',
            'relationship_description.min' => 'Please provide at least 50 characters describing your relationship',
            'relationship_description.max' => 'Relationship description cannot exceed 2000 characters',
            'times_met_in_person.required' => 'Number of times met in person is required',
            'times_met_in_person.min' => 'You must have met at least once in person',
            'communication_methods.required' => 'Communication methods are required',
        ];
    }
}