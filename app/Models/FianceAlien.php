<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class FianceAlien extends Model
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
        $nextSteps = [
            'name' => 'citizenship',
            'citizenship' => 'embassy',
            'embassy' => 'contact',
            'contact' => 'marital-status',
            'marital-status' => 'parents',
            'parents' => 'visited-us',
            'visited-us' => 'address',
            'address' => 'employment',
            'employment' => 'schools',
            'schools' => 'travel',
            'travel' => 'military',
            'military' => 'activity',
            'activity' => 'immigration',
            'immigration' => 'languages',
            'languages' => 'relatives',
            'relatives' => 'question1',
            'question1' => 'question2',
            'question2' => 'question3',
            'question3' => 'question4',
            'question4' => 'question5',
            'question5' => 'question5',
        ];

        $currentStep = $this->attributes['name'] ?? null;
        
        if ($currentStep && isset($nextSteps[$currentStep])) {
            $nextStep = $nextSteps[$currentStep];
            
            $form = FianceVisaSubmittedStep::where('user_id', Auth::id())
                ->where('step', $nextStep)
                ->where('type', 'alien')
                ->first();
                
            if (!$form) {
                $form = new FianceVisaSubmittedStep();
            }
            
            $form['next'] = $nextStep;
            return $form;
        }
        
        return null;
    }

    public function previous()
    {
        return FianceVisaSubmittedStep::where('id', $this->attributes['step_id'])
                ->first();  
    }
}
