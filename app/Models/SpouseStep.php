<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpouseStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'type', // ADD THIS
    ];

    // Add scope for filtering by type
    public function scopeSponsor($query)
    {
        return $query->where('type', 'sponsor');
    }

    public function scopeBeneficiary($query)
    {
        return $query->where('type', 'beneficiary');
    }

    public function scopeShared($query)
    {
        return $query->where('type', 'shared');
    }
}