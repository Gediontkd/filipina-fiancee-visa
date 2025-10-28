<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpouseSponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'step_id',
        'name', // Step name: 'name', 'contact', etc.
    ];

    protected $appends = ['step'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submittedStep()
    {
        return $this->belongsTo(SpouseVisaSubmittedStep::class, 'step_id');
    }

    public function getStepAttribute()
    {
        return SpouseVisaSubmittedStep::where('id', $this->attributes['step_id'])
            ->first();
    }

    // Get progress percentage for sponsor section
    public static function getProgress($userId)
    {
        $totalSteps = 9; // sponsor has 9 steps
        $completedSteps = self::where('user_id', $userId)->count();
        
        return ($completedSteps / $totalSteps) * 100;
    }
}