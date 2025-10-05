<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubmittedApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'application_id',
        'transaction_id',
        'status',
        'admin_notes',        // Add this for admin notes
        'reviewed_at',        // Add this for review timestamp
        'reviewed_by',
        'payment_completed',
        'payment_intent_id',
        'payment_amount',
        'paid_at',
    ];

    protected $appends = ['application'];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public function getApplicationAttribute()
    {
        return VisaApplication::where('id', $this->attributes['application_id'])
            ->pluck('name')
            ->first();
    }

    // Keep your existing date format or use both
    public function getFormattedCreatedAtAttribute()
    {
        return date('d/m/Y A', strtotime($this->attributes['created_at']));
    }

    // Add relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Add relationship to VisaApplication
    public function visaApplication()
    {
        return $this->belongsTo(VisaApplication::class, 'application_id');
    }

    // Add relationship to reviewing admin
    public function reviewer()
    {
        return $this->belongsTo(Admin::class, 'reviewed_by');
    }

    // Status check methods
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isUnderReview(): bool
    {
        return $this->status === 'under_review';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}