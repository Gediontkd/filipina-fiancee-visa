<?php

namespace App\Http\Requests\AdjustmentOfStatus;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Simplified AOS Request Validation
 * Validates all Adjustment of Status application fields
 */
class SimplifiedAosRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            // Applicant Information - Required
            'applicant_first_name' => 'required|string|max:255',
            'applicant_last_name' => 'required|string|max:255',
            'applicant_middle_name' => 'nullable|string|max:255',
            'applicant_email' => 'required|email|max:255',
            'applicant_phone' => 'required|string|max:20',
            'applicant_address' => 'required|string|max:500',
            'applicant_city' => 'required|string|max:255',
            'applicant_state' => 'required|string|max:255',
            'applicant_zip' => 'required|string|max:20',
            'applicant_dob' => 'required|date|before:today',
            'applicant_place_of_birth' => 'required|string|max:255',
            'applicant_citizenship' => 'required|string|max:255',
            'applicant_alien_number' => 'nullable|string|max:20',
            'applicant_ssn' => 'nullable|string|max:20',
            
            // Current Immigration Status - Required
            'current_visa_type' => 'required|string|max:50',
            'visa_expiration_date' => 'required|date',
            'i94_number' => 'nullable|string|max:50',
            'passport_number' => 'required|string|max:50',
            'passport_country' => 'required|string|max:255',
            'passport_expiration' => 'required|date|after:today',
            'entry_date' => 'required|date|before_or_equal:today',
            'entry_location' => 'required|string|max:255',
            
            // Sponsor/Petitioner Information - Required
            'sponsor_first_name' => 'required|string|max:255',
            'sponsor_last_name' => 'required|string|max:255',
            'sponsor_middle_name' => 'nullable|string|max:255',
            'sponsor_email' => 'required|email|max:255',
            'sponsor_phone' => 'required|string|max:20',
            'sponsor_address' => 'required|string|max:500',
            'sponsor_city' => 'required|string|max:255',
            'sponsor_state' => 'required|string|max:255',
            'sponsor_zip' => 'required|string|max:20',
            'sponsor_relationship' => 'required|string|max:255',
            'sponsor_citizenship_status' => 'required|string|max:255',
            'sponsor_ssn' => 'required|string|max:20',
            
            // Employment - Optional
            'applicant_employment_status' => 'nullable|string|max:255',
            'applicant_employer_name' => 'nullable|string|max:255',
            'applicant_occupation' => 'nullable|string|max:255',
            
            // Marital Information
            'marital_status' => 'required|string|max:50',
            'marriage_date' => 'nullable|date|before_or_equal:today',
            'spouse_name' => 'nullable|string|max:255',
            
            // Background Questions
            'arrested_or_convicted' => 'nullable|in:yes,no',
            'immigration_violations' => 'nullable|in:yes,no',
            'public_assistance' => 'nullable|in:yes,no',
            'background_explanation' => 'nullable|string|max:2000',
        ];
    }

    public function messages()
    {
        return [
            // Applicant
            'applicant_first_name.required' => 'First name is required',
            'applicant_last_name.required' => 'Last name is required',
            'applicant_email.required' => 'Email is required',
            'applicant_phone.required' => 'Phone number is required',
            'applicant_address.required' => 'Address is required',
            'applicant_dob.required' => 'Date of birth is required',
            'applicant_citizenship.required' => 'Citizenship is required',
            
            // Immigration Status
            'current_visa_type.required' => 'Current visa type is required',
            'visa_expiration_date.required' => 'Visa expiration date is required',
            'passport_number.required' => 'Passport number is required',
            'entry_date.required' => 'Entry date is required',
            
            // Sponsor
            'sponsor_first_name.required' => 'Sponsor first name is required',
            'sponsor_relationship.required' => 'Relationship to sponsor is required',
            'sponsor_citizenship_status.required' => 'Sponsor citizenship status is required',
            
            // Marital
            'marital_status.required' => 'Marital status is required',
        ];
    }
}