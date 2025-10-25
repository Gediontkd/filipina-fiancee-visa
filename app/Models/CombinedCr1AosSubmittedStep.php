<?php
// app/Models/CombinedCr1AosSubmittedStep.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CombinedCr1AosSubmittedStep extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'step'];
}