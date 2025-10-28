<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSpouseVisaType extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type', // 'sponsor' or 'beneficiary'
        'status', // 'in-progress' or 'completed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Check if section is completed
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in-progress');
    }

    // Check if specific type exists for user
    public static function isSectionCompleted($userId, $type)
    {
        return self::where('user_id', $userId)
            ->where('type', $type)
            ->where('status', 'completed')
            ->exists();
    }
}