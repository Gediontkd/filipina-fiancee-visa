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
        'applicant_email',
        'applicant_phone',
        'applicant_address',
        'applicant_city',
        'applicant_state',
        'applicant_zip',
        'applicant_dob',
        'applicant_place_of_birth',
        'applicant_citizenship',
        'applicant_alien_number',
        'applicant_ssn',
        'applicant_employment_status',
        'applicant_employer_name',
        'applicant_occupation',
        
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
        
        // Background Questions
        'arrested_or_convicted',
        'immigration_violations',
        'public_assistance',
        'background_explanation',
        
        'status',
        'submitted_at'
    ];

    protected $casts = [
        'applicant_dob' => 'date',
        'visa_expiration_date' => 'date',
        'passport_expiration' => 'date',
        'entry_date' => 'date',
        'marriage_date' => 'date',
        'submitted_at' => 'datetime',
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