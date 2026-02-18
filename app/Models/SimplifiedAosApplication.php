<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Simplified AOS Application Model
 * Stores all Adjustment of Status application data in a single table
 */
class SimplifiedAosApplication extends Model
{
    use HasFactory;

    protected $table = 'simplified_aos_applications';

    protected $fillable = [
        'user_id',
        'submitted_app_id',
        
        // Applicant Information
        'applicant_first_name',
        'applicant_middle_name',
        'applicant_last_name',
        'has_other_names',
        'applicant_other_names',
        'applicant_email',
        'applicant_phone',
        'applicant_mobile_phone',
        'applicant_address',
        'applicant_city',
        'applicant_state',
        'applicant_zip',
        'applicant_address_history',
        'applicant_dob',
        'applicant_place_of_birth',
        'applicant_citizenship',
        'applicant_alien_number',
        'has_a_number',
        'a_number',
        'has_other_a_numbers',
        'other_a_numbers',
        'applicant_birth_country',
        'has_other_dob',
        'other_dobs',
        
        // Detailed Address Fields
        'applicant_in_care_of',
        'applicant_apt_ste_flr',
        'applicant_date_resided_from',
        'mailing_in_care_of',
        'mailing_apt_ste_flr',
        'foreign_address_data',
        'prior_addresses_data',
        
        // Passport and Immigration
        'passport_number',
        'passport_expiration_date',
        'passport_issuing_country',
        'nonimmigrant_visa_number',
        'nonimmigrant_visa_issue_date',
        'last_arrival_city',
        'last_arrival_state',
        'last_arrival_date',
        'immigration_entry_type',
        'immigration_entry_status',

        'uscis_account_number',
        'applicant_ssn',
        'applicant_gender',
        'applicant_employment_status',
        'applicant_employer_name',
        'applicant_occupation',
        'applicant_employment_history',

        // Biographic Information (Part 7)
        'ethnicity',
        'race',
        'height_feet',
        'height_inches',
        'weight_pounds',
        'eye_color',
        'hair_color',
        
        // Family Information (Part 4, 5, 6)
        'parent1_data',
        'parent2_data',
        'times_married',
        'marital_history',
        'has_children',
        'total_children_count',
        'children_data',

        // Immigration Status
        'current_visa_type',
        'visa_expiration_date',
        'i94_number',
        'passport_number',
        'passport_country',
        'passport_expiration',
        'entry_date',
        'entry_location',
        
        // Sponsor Information
        'sponsor_first_name',
        'sponsor_middle_name',
        'sponsor_last_name',
        'sponsor_email',
        'sponsor_phone',
        'sponsor_address',
        'sponsor_city',
        'sponsor_state',
        'sponsor_zip',
        'sponsor_relationship',
        'sponsor_citizenship_status',
        'sponsor_ssn',
        
        // Marital Information
        'marital_status',
        'marriage_date',
        'spouse_name',
        
        // Background & Complex Questions (Part 8-12)
        'arrested_or_convicted',
        'immigration_violations',
        'public_assistance',
        'background_explanation',
        'eligibility_questions',
        'accommodation_details',
        'applicant_statement_data',
        'interpreter_data',
        'preparer_data',
        
        'submitted_at',

        // New I-485 Standard Fields (Part 1 & 2)
        'status_at_last_entry',
        'i94_expiration_date',
        'use_mailing_address',
        'mailing_street',
        'mailing_city',
        'mailing_state',
        'mailing_zip',
        'filing_category',
        'receipt_number_underlying_petition',
        'priority_date',
        'is_principal_applicant',
        'filing_with_eoir',
        'derivative_principal_first_name',
        'derivative_principal_last_name',
        'derivative_principal_middle_name',
        'derivative_principal_a_number',
        'derivative_principal_dob',
        'immigrant_category',
        'immigrant_category_detail',

        // New Detailed Immigration Status
        'was_last_arrival_first_time',
        'current_immigration_status',
        'current_immigration_status_expiration_date',
        'current_immigration_status_ds',
        'ever_issued_alien_crewman_visa',
        'last_arrival_as_crewman',
        'i94_last_name',
        'i94_first_name',
        'i94_expiration_date_ds',
        'i94_status',
        'resided_at_current_address_5_years',
        'most_recent_foreign_address',
        'ssa_ever_issued_card',
        'ssa_issue_card_request',
        'ssa_consent_disclosure',
        'employment_categories_data',
        'special_immigrant_categories_data',
        'asylee_refugee_data',
        'trafficking_crime_victim_data',
        'special_program_categories_data',
        'additional_options_data',
        'applying_under_245i',
        'applying_under_cspa',
        'i864_exemption',
        'applied_for_immigrant_visa_abroad',
        'immigrant_visa_location_city',
        'immigrant_visa_location_country',
        'immigrant_visa_decision',
        'immigrant_visa_decision_date',
        'applied_for_permanent_residence_us',
        'rescinded_lpr_status',

        // New Detailed Marital History fields
        'spouse_is_military',
        'spouse_a_number',
        'spouse_dob',
        'spouse_birth_country',
        'spouse_address_data',
        'spouse_marriage_place_data',
        'spouse_applying_with_you',
        'prior_marriages_full_data',
    ];

    protected $casts = [
        'resided_at_current_address_5_years' => 'boolean',
        'most_recent_foreign_address' => 'array',
        'ssa_ever_issued_card' => 'boolean',
        'ssa_issue_card_request' => 'boolean',
        'ssa_consent_disclosure' => 'boolean',
        'applicant_dob' => 'date',
        'has_other_dob' => 'boolean',
        'has_other_names' => 'boolean',
        'other_dobs' => 'array',
        'visa_expiration_date' => 'date',
        'passport_expiration' => 'date',
        'entry_date' => 'date',
        'marriage_date' => 'date',
        'submitted_at' => 'datetime',
        'applicant_other_names' => 'array',
        'applicant_address_history' => 'array',
        'applicant_employment_history' => 'array',
        'parent1_data' => 'array',
        'parent2_data' => 'array',
        'marital_history' => 'array',
        'children_data' => 'array',
        'eligibility_questions' => 'array',
        'accommodation_details' => 'array',
        'applicant_statement_data' => 'array',
        'interpreter_data' => 'array',
        'preparer_data' => 'array',
        'has_children' => 'boolean',
        'i94_expiration_date' => 'date',
        'priority_date' => 'date',
        'use_mailing_address' => 'boolean',
        'is_principal_applicant' => 'boolean',
        'filing_with_eoir' => 'boolean',
        'derivative_principal_dob' => 'date',
        'was_last_arrival_first_time' => 'boolean',
        'current_immigration_status_expiration_date' => 'date',
        'current_immigration_status_ds' => 'boolean',
        'ever_issued_alien_crewman_visa' => 'boolean',
        'last_arrival_as_crewman' => 'boolean',
        'i94_expiration_date_ds' => 'boolean',
        'applicant_date_resided_from' => 'date',
        'foreign_address_data' => 'array',
        'prior_addresses_data' => 'array',
        'employment_categories_data' => 'array',
        'special_immigrant_categories_data' => 'array',
        'asylee_refugee_data' => 'array',
        'trafficking_crime_victim_data' => 'array',
        'special_program_categories_data' => 'array',
        'additional_options_data' => 'array',
        'applying_under_245i' => 'boolean',
        'applying_under_cspa' => 'boolean',
        'applied_for_immigrant_visa_abroad' => 'boolean',
        'immigrant_visa_decision_date' => 'date',
        'applied_for_permanent_residence_us' => 'boolean',
        'rescinded_lpr_status' => 'boolean',
        'spouse_is_military' => 'boolean',
        'spouse_dob' => 'date',
        'spouse_address_data' => 'array',
        'spouse_marriage_place_data' => 'array',
        'spouse_applying_with_you' => 'boolean',
        'prior_marriages_full_data' => 'array',
        'part9_data' => 'array',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submittedApplication()
    {
        return $this->belongsTo(UserSubmittedApplication::class, 'submitted_app_id');
    }

    /**
     * Scopes
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeSubmitted($query)
    {
        return $query->where('status', 'submitted');
    }

    /**
     * Check if application is complete
     */
    public function isComplete()
    {
        $requiredFields = [
            'applicant_first_name', 'applicant_last_name', 'applicant_email',
            'applicant_phone', 'applicant_address', 'applicant_dob',
            'applicant_citizenship', 'current_visa_type', 'passport_number',
            'entry_date', 'sponsor_first_name', 'sponsor_last_name',
            'sponsor_relationship', 'marital_status'
        ];

        foreach ($requiredFields as $field) {
            if (empty($this->$field)) {
                return false;
            }
        }

        return true;
    }
}