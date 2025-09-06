<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'chosen_application',
        'stripe_customer_id',
        'application_route',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function userSubmittedApplications()
    {
        return $this->hasMany(UserSubmittedApplication::class);
    }

    public function fianceVisaSteps()
    {
        return $this->hasMany(FianceVisaStep::class);
    }

    public function spouseVisaSteps()
    {
        return $this->hasMany(SpouseVisaStep::class);
    }

    public function adjustmentVisaSteps()
    {
        return $this->hasMany(AdjustmentVisaStep::class);
    }

    public function fianceAlien()
    {
        return $this->hasOne(FianceAlien::class);
    }

    public function fianceAlienChildren()
    {
        return $this->hasOne(FianceAlienChildren::class);
    }
}
