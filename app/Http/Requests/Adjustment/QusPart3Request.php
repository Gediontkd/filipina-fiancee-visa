<?php

namespace App\Http\Requests\Adjustment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class QusPart3Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [                       
            'substantial' => ['required'],                                   
            'harm' => ['required'],                                   
            'organization' => ['required'],                                   
            'paramilitary' => ['required'],                                   
            'engage' => ['required'],                                   
            'incited' => ['required'],                                   
            'weapon' => ['required'],                                   
            'hijacking' => ['required'],                                   
            'threatened' => ['required'],                                   
            'sabotage' => ['required'],                                   
            'explosive' => ['required'],                                   
            'transporting' => ['required'],                                   
            'volunteered' => ['required'],                                   
            'kind' => ['required'],                                   
            'guerrilla' => ['required'],                                   
            'affiliated' => ['required'],                                   
            'period' => ['required'],                                   
            'genocide' => ['required'],                                   
            'killing' => ['required'],                                   
            'intentionally' => ['required'],                                   
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
