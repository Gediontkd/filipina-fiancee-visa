<?php
// app/Models/CombinedCr1AosStep.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CombinedCr1AosStep extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon', 'order'];
}