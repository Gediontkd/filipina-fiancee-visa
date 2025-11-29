<?php
// FILE: app/Models/SimplifiedSpouseVisaApplication.php
// FIXED: date_to fields can be "Present" string OR date

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimplifiedSpouseVisaApplication extends Model
{
    use HasFactory;

    protected $table = 'simplified_spouse_visa_applications';

    protected $fillable = [
        'user_id',
        'submitted_app_id',
        
        // Sponsor Information
        'sponsor_first_name',
        'sponsor_middle_name',
        'sponsor_last_name',
        'sponsor_sex',
        'sponsor_email',
        'sponsor_phone',
        'sponsor_address',
        'sponsor_apt',
        'sponsor_city',
        'sponsor_state',
        'sponsor_zip',
        'sponsor_country',
        'sponsor_dob',
        'sponsor_place_of_birth',
        'sponsor_citizenship',
        'sponsor_ssn',
        
        // Sponsor Mailing Address
        'sponsor_mailing_address',
        'sponsor_mailing_apt',
        'sponsor_mailing_city',
        'sponsor_mailing_state',
        'sponsor_mailing_zip',
        'sponsor_mailing_date_from',
        'sponsor_mailing_date_to',
        'sponsor_same_address',
        
        // Sponsor Parents
        'sponsor_parent1_first_name',
        'sponsor_parent1_middle_name',
        'sponsor_parent1_last_name',
        'sponsor_parent1_dob',
        'sponsor_parent1_sex',
        'sponsor_parent1_country',
        'sponsor_parent2_first_name',
        'sponsor_parent2_middle_name',
        'sponsor_parent2_last_name',
        'sponsor_parent2_dob',
        'sponsor_parent2_sex',
        'sponsor_parent2_country',
        
        // Sponsor History
        'sponsor_address_history',
        'sponsor_employment_history',
        
        // Sponsor Employment - OPTIONAL
        'sponsor_employment_status',
        'sponsor_employer_name',
        'sponsor_occupation',
        'sponsor_annual_income',
        
        // Beneficiary Information
        'beneficiary_first_name',
        'beneficiary_middle_name',
        'beneficiary_last_name',
        'beneficiary_sex',
        'beneficiary_email',
        'beneficiary_phone',
        'beneficiary_address',
        'beneficiary_apt',
        'beneficiary_city',
        'beneficiary_state',
        'beneficiary_zip',
        'beneficiary_country',
        'beneficiary_dob',
        'beneficiary_place_of_birth',
        'beneficiary_citizenship',
        'beneficiary_passport_number',
        'beneficiary_alien_number',
        
        // Beneficiary Mailing Address
        'beneficiary_mailing_address',
        'beneficiary_mailing_apt',
        'beneficiary_mailing_city',
        'beneficiary_mailing_state',
        'beneficiary_mailing_zip',
        'beneficiary_mailing_country',
        'beneficiary_mailing_date_from',
        'beneficiary_mailing_date_to',
        'beneficiary_same_address',

        'beneficiary_parents_list',
        
        // Beneficiary Parents
        'beneficiary_parent2_sex',
        
        // Beneficiary History
        'beneficiary_address_history',
        'beneficiary_employment_history',
        
        // Beneficiary Employment - OPTIONAL
        'beneficiary_employment_status',
        'beneficiary_employer_name',
        'beneficiary_occupation',
        
        // Relationship Information
        'marriage_date',
        'marriage_location_city',
        'marriage_location_state',
        'marriage_location_province',
        'marriage_location_country',
        'sponsor_times_married',
        'sponsor_previous_marriages',
        'sponsor_prev_spouse_first_name',
        'sponsor_prev_spouse_last_name',
        'sponsor_divorce_date',
        'beneficiary_previous_marriages',
        'beneficiary_prev_spouse_first_name',
        'beneficiary_prev_spouse_last_name',
        'beneficiary_divorce_date',

        // Previous Marriages (multiple entries)
        'sponsor_previous_marriages_list',
        'beneficiary_previous_marriages_list',

        // ========================================
        // SPONSOR ADDITIONAL FIELDS
        // ========================================
        'sponsor_other_names',
        'sponsor_a_number',
        'sponsor_uscis_account',
        'sponsor_citizenship_method',
        'sponsor_certificate_number',
        'sponsor_certificate_place',
        'sponsor_certificate_date',
        'sponsor_ethnicity',
        'sponsor_race',
        'sponsor_height_feet',
        'sponsor_height_inches',
        'sponsor_weight',
        'sponsor_eye_color',
        'sponsor_hair_color',
        'sponsor_parent1_city_residence',
        'sponsor_parent1_country_residence',
        'sponsor_parent2_city_residence',
        'sponsor_parent2_country_residence',
        
        'sponsor_beneficiary_related_by_adoption',
        'sponsor_gained_status_through_adoption',

        // Sponsor Mailing/Physical Address Country (NEW)
        'sponsor_mailing_country',
        'sponsor_country',
        
        // ========================================
        // BENEFICIARY ADDITIONAL FIELDS
        // ========================================
        'beneficiary_other_names',
        'beneficiary_ssn',
        'beneficiary_uscis_account',
        'beneficiary_petition_filed_before',
        'beneficiary_passport_country',
        'beneficiary_passport_expiration',
        'beneficiary_daytime_phone',
        'beneficiary_mobile_phone',
        'beneficiary_intended_address_same',
        'beneficiary_intended_address',
        'beneficiary_intended_apt',
        'beneficiary_intended_city',
        'beneficiary_intended_state',
        'beneficiary_intended_zip',
        'beneficiary_ever_in_us',
        'beneficiary_class_of_admission',
        'beneficiary_i94_number',
        'beneficiary_date_of_arrival',
        'beneficiary_date_authorized_stay_expires',
        'beneficiary_immigration_proceedings',
        'beneficiary_proceedings_types',
        'beneficiary_proceedings_city',
        'beneficiary_proceedings_state',
        'beneficiary_proceedings_date',
        'beneficiary_employer_address_full',
        'beneficiary_employer_apt',
        'beneficiary_employer_city',
        'beneficiary_employer_province',
        'beneficiary_employer_postal',
        'beneficiary_employer_country',
        'beneficiary_employment_start_date',
        
        
        // ========================================
        // RELATIONSHIP ADDITIONAL FIELDS
        // ========================================
        'never_lived_together',
        'last_lived_together_address',
        'last_lived_together_apt',
        'last_lived_together_city',
        'last_lived_together_state',
        'last_lived_together_province',
        'last_lived_together_postal',
        'last_lived_together_country',
        'last_lived_together_date_from',
        'last_lived_together_date_to',
        'beneficiary_application_location',
        'beneficiary_uscis_office_city',
        'beneficiary_uscis_office_state',
        'beneficiary_consulate_city',
        'beneficiary_consulate_province',
        'beneficiary_consulate_country',
        
        'status',
        'submitted_at'
    ];

    protected $casts = [
        'sponsor_dob' => 'date',
        'sponsor_parent1_dob' => 'date',
        'sponsor_parent2_dob' => 'date',
        'sponsor_divorce_date' => 'date',
        'beneficiary_dob' => 'date',
        'beneficiary_parent1_dob' => 'date',
        'beneficiary_parent2_dob' => 'date',
        'beneficiary_divorce_date' => 'date',
        'marriage_date' => 'date',
        'submitted_at' => 'datetime',
        'sponsor_annual_income' => 'decimal:2',
        'sponsor_times_married' => 'integer',

        // Sponsor additional casts
        'sponsor_certificate_date' => 'date',
        'sponsor_other_names' => 'array',
        'sponsor_race' => 'array',
        'sponsor_height_feet' => 'integer',
        'sponsor_height_inches' => 'integer',
        'sponsor_weight' => 'integer',

        'sponsor_previous_marriages_list' => 'array',
        'beneficiary_previous_marriages_list' => 'array',

        // Beneficiary additional casts
        'beneficiary_other_names' => 'array',
        'beneficiary_passport_expiration' => 'date',
        'beneficiary_date_of_arrival' => 'date',
        'beneficiary_proceedings_date' => 'date',
        'beneficiary_proceedings_types' => 'array',
        'beneficiary_employment_start_date' => 'date',
        'beneficiary_intended_address_same' => 'boolean',
        
        // Relationship additional casts
        'never_lived_together' => 'boolean',
        'last_lived_together_date_from' => 'date',
        'last_lived_together_date_to' => 'date',
        
        // CRITICAL FIX: Only cast date_from as date, NOT date_to (can be "Present")
        'sponsor_mailing_date_from' => 'date',
        'beneficiary_mailing_date_from' => 'date',
        // REMOVED: 'sponsor_mailing_date_to' => 'date',
        // REMOVED: 'beneficiary_mailing_date_to' => 'date',
        
        'sponsor_same_address' => 'boolean',
        'beneficiary_same_address' => 'boolean',
        'sponsor_address_history' => 'array',
        'beneficiary_address_history' => 'array',
        'sponsor_employment_history' => 'array',
        'beneficiary_employment_history' => 'array',
        'beneficiary_parents_list' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submittedApplication()
    {
        return $this->belongsTo(UserSubmittedApplication::class, 'submitted_app_id');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeSubmitted($query)
    {
        return $query->where('status', 'submitted');
    }

    /**
     * Check if I-130 application is complete
     * FIXED: Financial fields are NOT required
     */
    public function isComplete()
    {
        $requiredFields = [
            // Sponsor Basic (13)
            'sponsor_first_name', 'sponsor_last_name', 'sponsor_sex',
            'sponsor_email', 'sponsor_phone', 'sponsor_mailing_address',
            'sponsor_mailing_city', 'sponsor_mailing_state', 'sponsor_mailing_zip',
            'sponsor_dob', 'sponsor_place_of_birth',
            'sponsor_citizenship', 'sponsor_ssn',
            
            // Sponsor Parents (10)
            'sponsor_parent1_first_name', 'sponsor_parent1_last_name',
            'sponsor_parent1_dob', 'sponsor_parent1_sex', 'sponsor_parent1_country',
            'sponsor_parent2_first_name', 'sponsor_parent2_last_name',
            'sponsor_parent2_dob', 'sponsor_parent2_sex', 'sponsor_parent2_country',
            
            // Beneficiary Basic (11)
            'beneficiary_first_name', 'beneficiary_last_name', 'beneficiary_sex',
            'beneficiary_email', 'beneficiary_phone', 'beneficiary_mailing_address',
            'beneficiary_mailing_city', 'beneficiary_mailing_country', 'beneficiary_dob',
            'beneficiary_place_of_birth', 'beneficiary_citizenship',
            
            // Marriage (6)
            'marriage_date', 'marriage_location_city', 'marriage_location_country',
            'sponsor_times_married', 'sponsor_previous_marriages', 'beneficiary_previous_marriages'
        ];

        foreach ($requiredFields as $field) {
            if (empty($this->$field) || $this->$field === null || trim($this->$field) === '') {
                return false;
            }
        }

        return true;
    }
}