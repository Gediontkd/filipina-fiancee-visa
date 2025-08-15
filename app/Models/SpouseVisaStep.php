<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class SpouseVisaStep extends Model
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
            case 'name':
                $form = SpouseVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'contact')
                    ->first();
                $form['next'] = 'contact'; 
                return $form;
            break;
            case 'contact':
                $form = SpouseVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'place-of-birth')
                    ->first();
                $form['next'] = 'place-of-birth'; 
                return $form;
            break;
            case 'place-of-birth':
                $form = SpouseVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'status')
                    ->first();
                $form['next'] = 'status'; 
                return $form;
            break;
            case 'status':
                $form = SpouseVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'marital-status')
                    ->first();
                $form['next'] = 'marital-status'; 
                return $form;
            break;
            case 'marital-status':
                $form = SpouseVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'other-filings')
                    ->first();
                $form['next'] = 'other-filings'; 
                return $form;
            break;
            case 'other-filings':
                $form = SpouseVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'military-convictions')
                    ->first();
                $form['next'] = 'military-convictions'; 
                return $form;
            break;
            case 'military-convictions':
                $form = SpouseVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'address')
                    ->first();
                $form['next'] = 'address'; 
                return $form;
            break;
            case 'address':
                $form = SpouseVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'relationship')
                    ->first();
                $form['next'] = 'relationship'; 
                return $form;
            break;
            case 'relationship':
                $form = SpouseVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'employment')
                    ->first();
                $form['next'] = 'employment'; 
                return $form;
            break;          
        }
    }

    public function previous()
    {
        return SpouseVisaSubmittedStep::where('id', $this->attributes['step_id'])
                ->first();  
    }
}
