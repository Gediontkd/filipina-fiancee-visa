<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjustmentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'submitted_app_id',
    ];

    public function getNameAttribute()
    {
        if ($this->attributes['name'] == 'spouse') {
            return 'Alien';
        } else {
            return $this->attributes['name'];
        }
    }
}
