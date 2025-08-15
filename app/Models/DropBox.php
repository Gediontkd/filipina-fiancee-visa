<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DropBox extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
    ];

    protected $appends = ['file_url'];
    
    public function getFileUrlAttribute() 
    {
        return url('storage/dropbox/'.$this->attributes['name']);
    }
}
