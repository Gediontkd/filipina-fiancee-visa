<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjustmentStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        $fullName = str_replace("'", '', $this->attributes['name']);
        return str_replace(' ', '', $fullName);
    }
}
