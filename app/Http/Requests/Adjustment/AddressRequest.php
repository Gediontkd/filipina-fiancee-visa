<?php

namespace App\Http\Requests\Adjustment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddressRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [                       
            'in_care_name' => ['required'],                      
            'number_and_street' => ['required'],                      
            'apartment_suite_or_floor' => ['required'],                      
            'apartment_suite_or_floor_no' => ['required'],                      
            'city' => ['required'],                      
            'state' => ['required'],                      
            'zip_code' => ['required'],                      
            'country' => ['required'],                      
            'date_from' => ['required'],                      
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
