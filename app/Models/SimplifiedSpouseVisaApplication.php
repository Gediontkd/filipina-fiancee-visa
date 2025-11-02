<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Simplified Spouse Visa Application Model
 * Stores all spouse visa application data in a single table
 */
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
        'sponsor_email',
        'sponsor_phone',
        'sponsor_address',
        'sponsor_city',
        'sponsor_state',
        'sponsor_zip',
        'sponsor_country',
        'sponsor_dob',
        'sponsor_place_of_birth',
        'sponsor_citizenship',
        'sponsor_ssn',
        'sponsor_employment_status',
        'sponsor_employer_name',
        'sponsor_occupation',
        'sponsor_annual_income',
        
        // Beneficiary Information
        'beneficiary_first_name',
        'beneficiary_middle_name',
        'beneficiary_last_name',
        'beneficiary_email',
        'beneficiary_phone',
        'beneficiary_address',
        'beneficiary_city',
        'beneficiary_state',
        'beneficiary_zip',
        'beneficiary_country',
        'beneficiary_dob',
        'beneficiary_place_of_birth',
        'beneficiary_citizenship',
        'beneficiary_passport_number',
        'beneficiary_alien_number',
        'beneficiary_employment_status',
        'beneficiary_employer_name',
        'beneficiary_occupation',
        
        // Relationship Information
        'marriage_date',
        'marriage_location_city',
        'marriage_location_country',
        'first_met_date',
        'first_met_location',
        'relationship_description',
        'times_met_in_person',
        'last_meeting_date',
        'communication_methods',
        'sponsor_previous_marriages',
        'beneficiary_previous_marriages',
        'sponsor_divorce_date',
        'beneficiary_divorce_date',
        
        'status',
        'submitted_at'
    ];

    protected $casts = [
        'sponsor_dob' => 'date',
        'beneficiary_dob' => 'date',
        'marriage_date' => 'date',
        'first_met_date' => 'date',
        'last_meeting_date' => 'date',
        'sponsor_divorce_date' => 'date',
        'beneficiary_divorce_date' => 'date',
        'submitted_at' => 'datetime',
        'sponsor_annual_income' => 'decimal:2',
        'times_met_in_person' => 'integer',
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
            'sponsor_first_name', 'sponsor_last_name', 'sponsor_email',
            'sponsor_phone', 'sponsor_address', 'sponsor_city',
            'sponsor_state', 'sponsor_zip', 'sponsor_dob',
            'sponsor_place_of_birth', 'sponsor_citizenship', 'sponsor_ssn',
            'beneficiary_first_name', 'beneficiary_last_name',
            'beneficiary_email', 'beneficiary_phone', 'beneficiary_address',
            'beneficiary_city', 'beneficiary_country', 'beneficiary_dob',
            'beneficiary_place_of_birth', 'beneficiary_citizenship',
            'beneficiary_passport_number', 'marriage_date',
            'marriage_location_city', 'marriage_location_country',
            'first_met_date', 'first_met_location',
            'relationship_description', 'times_met_in_person',
            'communication_methods'
        ];

        foreach ($requiredFields as $field) {
            if (empty($this->$field)) {
                return false;
            }
        }

        return true;
    }
}