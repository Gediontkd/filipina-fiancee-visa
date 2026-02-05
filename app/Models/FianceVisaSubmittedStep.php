<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class FianceVisaSubmittedStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'submitted_app_id',
        'step',
        'detail',
        'type',
    ];

    public function getDetailAttribute()
    {
        return isset($this->attributes['detail']) ? unserialize($this->attributes['detail']) : [];
    }

    public function getCreatedAtAttribute()
    {
        return date('d/m/Y A', strtotime($this->attributes['created_at']));
    }

    public function scopeAlienCount($query)
    {
        return $query->where('user_id', Auth::id())->where('type', 'alien')->count();
    }
    
    public function scopeSponsorCount($query)
    {
        return $query->where('user_id', Auth::id())->where('type', 'sponsor')->count();
    }
    
    public function scopeAlienChildrenCount($query)
    {
        return $query->where('user_id', Auth::id())->where('type', 'alien-children')->count();
    }
    
    public function scopeOverAllCount($query)
    {
        return $query->where('user_id', Auth::id())->count();
    }
}
