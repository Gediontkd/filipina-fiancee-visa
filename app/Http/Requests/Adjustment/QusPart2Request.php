<?php

namespace App\Http\Requests\Adjustment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class QusPart2Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [                       
            'foreign_nat' => ['required'],                        
            'prostitution' => ['required'],                        
            'prostitutes' => ['required'],                        
            'proceeds' => ['required'],                        
            'bootlegging' => ['required'],                        
            'exercised' => ['required'],                        
            'carried' => ['required'],                        
            'coercion' => ['required'],                        
            'slavery' => ['required'],                        
            'conspired' => ['required'],                        
            'financial' => ['required'],                        
            'laundering' => ['required'],                        
            'evades' => ['required'],                        
            'violates' => ['required'],                        
            'unlawful' => ['required'],                        
            'welfare' => ['required'],                        
            'intend' => ['required'],                        
            'consequences' => ['required'],                        
            'threatened' => ['required'],                        
            'kidnapping' => ['required'],                        
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
