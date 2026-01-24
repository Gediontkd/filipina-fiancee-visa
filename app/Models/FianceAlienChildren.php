<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class FianceAlienChildren extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'step_id',
        'name',
    ];

    protected $appends = ['step'];    

    public function getStepAttribute()
    {
        switch ($this->attributes['name']) {            
            case 'child-1':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'child-2')
                    ->where('type', 'alien-children')
                    ->first();
                $form['next'] = 'child-2'; 
                return $form;
            break;
            case 'child-2':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'child-3')
                    ->where('type', 'alien-children')
                    ->first();
                $form['next'] = 'child-3'; 
                return $form;
            break;
            case 'child-3':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'child-4')
                    ->where('type', 'alien-children')
                    ->first();
                $form['next'] = 'child-4'; 
                return $form;
            break;
            case 'child-4':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'child-5')
                    ->where('type', 'alien-children')
                    ->first();
                $form['next'] = 'child-5'; 
                return $form;
            break;
            case 'child-5':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'child-5')
                    ->where('type', 'alien-children')
                    ->first();
                $form['next'] = 'child-5'; 
                return $form;
            break;
        }
    }

    public function previous()
    {
        return FianceVisaSubmittedStep::where('id', $this->attributes['step_id'])
                ->first();  
    }
}
