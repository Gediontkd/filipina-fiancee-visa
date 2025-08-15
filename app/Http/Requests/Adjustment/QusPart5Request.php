<?php

namespace App\Http\Requests\Adjustment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class QusPart5Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [                       
            'polygamy' => ['required'],                         
            'accompanying' => ['required'],                         
            'custody' => ['required'],                         
            'federal' => ['required'],                         
            'renounced' => ['required'],                         
            'discharge' => ['required'],                         
            'discharged' => ['required'],                         
            'convicted' => ['required'],                         
            'war' => ['required'],                         
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
