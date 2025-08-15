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
    ];

    protected $appends = ['application'];

    public function getApplicationAttribute()
    {
        return VisaApplication::where('id', $this->attributes['application_id'])
            ->pluck('name')
            ->first();
    }

    public function getCreatedAtAttribute()
    {
        return date('d/m/Y A', strtotime($this->attributes['created_at']));
    }
}
