<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpouseVisaSubmittedStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'submitted_app_id',
        'section', // ADD THIS - 'sponsor', 'beneficiary', or 'shared'
        'step',
        'detail',
    ];

    public function getDetailAttribute()
    {
        return unserialize($this->attributes['detail']);
    }

    public function getCreatedAtAttribute()
    {
        return date('d/m/Y A', strtotime($this->attributes['created_at']));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submittedApplication()
    {
        return $this->belongsTo(UserSubmittedApplication::class, 'submitted_app_id');
    }

    // Scope for filtering by section
    public function scopeSponsor($query)
    {
        return $query->where('section', 'sponsor');
    }

    public function scopeBeneficiary($query)
    {
        return $query->where('section', 'beneficiary');
    }

    public function scopeShared($query)
    {
        return $query->where('section', 'shared');
    }
}