<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class FianceSponsor extends Model
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
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'contact')
                    ->where('type', 'sponsor')
                    ->first();
                $form['next'] = 'contact'; 
                return $form;           
            break;
            case 'contact':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'place-of-birth')
                    ->where('type', 'sponsor')
                    ->first();
                $form['next'] = 'place-of-birth'; 
                return $form;           
            break;
            case 'place-of-birth':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'status')
                    ->where('type', 'sponsor')
                    ->first();
                $form['next'] = 'status'; 
                return $form;           
            break;
            case 'status':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'marital-status')
                    ->where('type', 'sponsor')
                    ->first();
                $form['next'] = 'marital-status'; 
                return $form;           
            break;
            case 'marital-status':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'other-filings')
                    ->where('type', 'sponsor')
                    ->first();
                $form['next'] = 'other-filings'; 
                return $form;           
            break;
            case 'other-filings':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'military-and-convictions')
                    ->where('type', 'sponsor')
                    ->first();
                $form['next'] = 'military-and-convictions'; 
                return $form;           
            break;
            case 'military-and-convictions':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'address')
                    ->where('type', 'sponsor')
                    ->first();
                $form['next'] = 'address'; 
                return $form;           
            break;
            case 'address':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'relationship')
                    ->where('type', 'sponsor')
                    ->first();
                $form['next'] = 'relationship'; 
                return $form;           
            break;
            case 'relationship':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'employment')
                    ->where('type', 'sponsor')
                    ->first();
                $form['next'] = 'employment'; 
                return $form;    
            case 'employment':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'employment')
                    ->where('type', 'sponsor')
                    ->first();
                $form['next'] = 'employment'; 
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
