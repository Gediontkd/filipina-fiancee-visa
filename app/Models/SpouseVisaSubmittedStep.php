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
}
