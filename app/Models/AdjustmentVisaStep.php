<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class AdjustmentVisaStep extends Model
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
                $form = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'place-of-birth')
                    ->first();
                $form['next'] = 'place-of-birth'; 
                return $form;
            break;
            case 'place-of-birth':
                $form = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'visa-info')
                    ->first();
                $form['next'] = 'visa-info'; 
                return $form;
            break;
            case 'visa-info':
                $form = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'address')
                    ->first();
                $form['next'] = 'address'; 
                return $form;
            break;
            case 'address':
                $form = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'civil-status')
                    ->first();
                $form['next'] = 'civil-status'; 
                return $form;
            break;
            case 'civil-status':
                $form = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'sponsor-part-1')
                    ->first();
                $form['next'] = 'sponsor-part-1'; 
                return $form;
            break;
            case 'sponsor-part-1':
                $form = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'sponsor-part-2')
                    ->first();
                $form['next'] = 'sponsor-part-2'; 
                return $form;
            break;
            case 'sponsor-part-2':
                $form = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'questions-part-1')
                    ->first();
                $form['next'] = 'questions-part-1'; 
                return $form;
            break;
            case 'questions-part-1':
                $form = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'questions-part-2')
                    ->first();
                $form['next'] = 'questions-part-2'; 
                return $form;
            break;
            case 'questions-part-2':
                $form = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'questions-part-3')
                    ->first();
                $form['next'] = 'questions-part-3'; 
                return $form;
            break;
            case 'questions-part-3':
                $form = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'questions-part-4')
                    ->first();
                $form['next'] = 'questions-part-4'; 
                return $form;
            break;
            case 'questions-part-4':
                $form = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'questions-part-5')
                    ->first();
                $form['next'] = 'questions-part-5'; 
                return $form;
            break;
            case 'questions-part-5':
                $form = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'ead')
                    ->first();
                $form['next'] = 'ead'; 
                return $form;
            break;
            case 'ead':
                $form = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'accommodations')
                    ->first();
                $form['next'] = 'accommodations'; 
                return $form;
            break;
            case 'accommodations':
                $form = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'interpreter')
                    ->first();
                $form['next'] = 'interpreter'; 
                return $form;
            break;
            case 'interpreter':
                $form = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'children')
                    ->first();
                $form['next'] = 'children'; 
                return $form;
            break;
            case 'children':
                $form = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'affiliations')
                    ->first();
                $form['next'] = 'affiliations'; 
                return $form;
            break;
            case 'affiliations':
                $form = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'alien-parents')
                    ->first();
                $form['next'] = 'alien-parents'; 
                return $form;
            break;
            case 'alien-parents':
                $form = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'employment')
                    ->first();
                $form['next'] = 'employment'; 
                return $form;
            break;
            case 'employment':
                $form = AdjustmentVisaSubmittedStep::where('user_id', Auth::id())
                    ->where('step', 'name')
                    ->first();
                $form['next'] = 'name'; 
                return $form;
            break;           
        }
    }

    public function previous()
    {
        return AdjustmentVisaSubmittedStep::where('id', $this->attributes['step_id'])
                ->first();  
    }
}
