<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class FianceVisaStep extends Model
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
                    ->where('step', 'citizenship')
                    ->first();
                $form['next'] = 'citizenship'; 
                return $form;
            break;
            case 'citizenship':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'embassy')
                    ->first();
                $form['next'] = 'embassy'; 
                return $form;
            break;
            case 'embassy':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'contact')
                    ->first();
                $form['next'] = 'contact'; 
                return $form;
            break;
            case 'contact':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'marital-status')
                    ->first();
                $form['next'] = 'marital-status'; 
                return $form;
            break;
            case 'marital-status':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'parents')
                    ->first();
                $form['next'] = 'parents'; 
                return $form;
            break;
            case 'parents':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'visited-us')
                    ->first();
                $form['next'] = 'visited-us'; 
                return $form;
            break;
            case 'visited-us':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'address')
                    ->first();
                $form['next'] = 'address'; 
                return $form;
            break;
            case 'address':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'employment')
                    ->first();
                $form['next'] = 'employment'; 
                return $form;
            break;
            case 'employment':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'travel')
                    ->first();
                $form['next'] = 'travel'; 
                return $form;
            break;
            // case 'schools':
            //     $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
            //         ->where('step', 'travel')
            //         ->first();
            //     $form['next'] = 'travel'; 
            //     return $form;
            // break;
            case 'travel':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'military')
                    ->first();
                $form['next'] = 'military'; 
                return $form;
            break;
            case 'military':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'activity')
                    ->first();
                $form['next'] = 'activity'; 
                return $form;
            break;
            case 'activity':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'immigration')
                    ->first();
                $form['next'] = 'immigration'; 
                return $form;
            break;
            case 'immigration':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'languages')
                    ->first();
                $form['next'] = 'languages'; 
                return $form;
            break;
            case 'languages':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'relatives')
                    ->first();
                $form['next'] = 'relatives'; 
                return $form;
            break;
            case 'relatives':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'question1')
                    ->first();
                $form['next'] = 'question1'; 
                return $form;
            break;
            case 'question1':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'question2')
                    ->first();
                $form['next'] = 'question2'; 
                return $form;
            break;
            case 'question2':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'question3')
                    ->first();
                $form['next'] = 'question3'; 
                return $form;
            break;
            case 'question3':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'question4')
                    ->first();
                $form['next'] = 'question4'; 
                return $form;
            break;
            case 'question4':
                $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'question5')
                    ->first();
                $form['next'] = 'question5'; 
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
