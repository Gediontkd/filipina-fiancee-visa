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
        'section', // ADD THIS - to track sponsor/beneficiary/shared
    ];

    protected $appends = ['step'];    

    public function getStepAttribute()
    {
        $section = $this->attributes['section'] ?? 'sponsor';
        
        // Define step flow for each section
        $sponsorFlow = [
            'name' => 'contact',
            'contact' => 'address',
            'address' => 'place-of-birth',
            'place-of-birth' => 'status',
            'status' => 'marital-status',
            'marital-status' => 'other-filings',
            'other-filings' => 'military-convictions',
            'military-convictions' => 'employment',
            'employment' => null, // End of sponsor section
        ];

        $beneficiaryFlow = [
            'name' => 'contact',
            'contact' => 'address',
            'address' => 'place-of-birth',
            'place-of-birth' => 'status',
            'status' => 'marital-status',
            'marital-status' => 'employment',
            'employment' => null, // End of beneficiary section
        ];

        $flow = $section === 'sponsor' ? $sponsorFlow : $beneficiaryFlow;
        $currentStep = $this->attributes['name'];
        $nextStep = $flow[$currentStep] ?? null;

        if ($nextStep) {
            $form = SpouseVisaSubmittedStep::where('user_id', Auth::id())
                ->where('section', $section)
                ->where('step', $nextStep)
                ->first();
            
            if ($form) {
                $form['next'] = $nextStep;
                return $form;
            }
        }

        return null;
    }

    public function previous()
    {
        return SpouseVisaSubmittedStep::where('id', $this->attributes['step_id'])
            ->first();  
    }

    public function submittedStep()
    {
        return $this->belongsTo(SpouseVisaSubmittedStep::class, 'step_id');
    }
}