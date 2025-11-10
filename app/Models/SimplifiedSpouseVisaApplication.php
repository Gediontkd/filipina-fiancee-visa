<?php
// FILE: app/Models/SimplifiedSpouseVisaApplication.php
// FIXED: Financial fields are optional, not required for I-130

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
        
        // Beneficiary Parents
        'beneficiary_parent1_first_name',
        'beneficiary_parent1_middle_name',
        'beneficiary_parent1_last_name',
        'beneficiary_parent1_dob',
        'beneficiary_parent1_sex',
        'beneficiary_parent1_country',
        'beneficiary_parent2_first_name',
        'beneficiary_parent2_middle_name',
        'beneficiary_parent2_last_name',
        'beneficiary_parent2_dob',
        'beneficiary_parent2_sex',
        'beneficiary_parent2_country',
        
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

        'sponsor_mailing_address',
        'sponsor_mailing_apt',
        'sponsor_mailing_city',
        'sponsor_mailing_state',
        'sponsor_mailing_zip',
        'sponsor_mailing_date_from',
        'sponsor_mailing_date_to',
        'sponsor_same_address',
        'sponsor_address_history',
        'beneficiary_address_history',
        'sponsor_employment_history',
        'beneficiary_employment_history',
        
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
        'sponsor_mailing_date_from' => 'date',
        'sponsor_mailing_date_to' => 'date',
        'sponsor_same_address' => 'boolean',
        'sponsor_address_history' => 'array',
        'beneficiary_address_history' => 'array',
        'sponsor_employment_history' => 'array',
        'beneficiary_employment_history' => 'array',
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
 * Check if address history covers 5 years
 */
public function hasCompleteFiveYearAddressHistory($person = 'sponsor')
{
    $field = $person . '_address_history';
    $addresses = $this->$field ?? [];
    
    if (empty($addresses)) {
        return false;
    }
    
    // Sort by date_from descending
    usort($addresses, function($a, $b) {
        return strtotime($b['date_from']) - strtotime($a['date_from']);
    });
    
    $oldestDate = strtotime($addresses[count($addresses) - 1]['date_from']);
    $fiveYearsAgo = strtotime('-5 years');
    
    return $oldestDate <= $fiveYearsAgo;
}

/**
 * Check if employment history covers 5 years
 */
public function hasCompleteFiveYearEmploymentHistory($person = 'sponsor')
{
    $field = $person . '_employment_history';
    $employment = $this->$field ?? [];
    
    if (empty($employment)) {
        return false;
    }
    
    // Sort by date_from descending
    usort($employment, function($a, $b) {
        return strtotime($b['date_from']) - strtotime($a['date_from']);
    });
    
    $oldestDate = strtotime($employment[count($employment) - 1]['date_from']);
    $fiveYearsAgo = strtotime('-5 years');
    
    return $oldestDate <= $fiveYearsAgo;
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
            'sponsor_email', 'sponsor_phone', 'sponsor_address',
            'sponsor_city', 'sponsor_state', 'sponsor_zip',
            'sponsor_dob', 'sponsor_place_of_birth',
            'sponsor_citizenship', 'sponsor_ssn',
            
            // Sponsor Parents (10)
            'sponsor_parent1_first_name', 'sponsor_parent1_last_name',
            'sponsor_parent1_dob', 'sponsor_parent1_sex', 'sponsor_parent1_country',
            'sponsor_parent2_first_name', 'sponsor_parent2_last_name',
            'sponsor_parent2_dob', 'sponsor_parent2_sex', 'sponsor_parent2_country',
            
            // Beneficiary Basic (11)
            'beneficiary_first_name', 'beneficiary_last_name', 'beneficiary_sex',
            'beneficiary_email', 'beneficiary_phone', 'beneficiary_address',
            'beneficiary_city', 'beneficiary_country', 'beneficiary_dob',
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

        foreach ($requiredFields as $field) {
            if (empty($this->$field) || $this->$field === null || trim($this->$field) === '') {
                return false;
            }
        }

        return true;
    }
}