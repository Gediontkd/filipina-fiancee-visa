<?php

namespace App\Http\Requests\Fiance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Ques4Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'transplantation' => ['required'],                  
            'civil_penalty' => ['required'],                  
            'ordered_removed' => ['required'],                  
            'ordered_removed_2' => ['required'],                  
            'unlawfully_present' => ['required'],                  
            'convicted_aggravated' => ['required'],                  
            'voluntarily_departed' => ['required'],                  
            'aggregate_at_any_time' => ['required'],                  
            'withheld_custody' => ['required'],                  
            'removed_deported' => ['required'],                  
            'deportation_hearing' => ['required'],                  
            'inadmissibilty' => ['required'],                  
            'admitted_u_s' => ['required'],                  
            'immigration_official' => ['required'],                  
        ];    
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => $validator->errors()->all(),         
        ], 200));
    }
}
