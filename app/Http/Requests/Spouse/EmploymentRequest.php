<?php

namespace App\Http\Requests\Spouse;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmploymentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'employer_name' => ['required'],                
            'occupation' => ['required'],                
            'number_street' => ['required'],                
            'apartment_suite_or_floor' => ['required'],                
            'apartment' => ['required'],                
            'town_city' => ['required'],                
            'country' => ['required'],                
            'state' => ['required'],                
            'province' => ['required'],                
            'postal_code' => ['required'],                
            'job_category' => ['required'],                
            'date' => ['required'],                
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
