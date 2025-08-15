<?php

namespace App\Http\Requests\Adjustment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class NameRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [                       
            'first_name' => ['required'],           
            'middle_name' => ['required'],           
            'last_name' => ['required'],           
            'email' => ['required'],           
            'country_no' => ['required'],           
            'phone_no' => ['required'],           
            'mob_no_country' => ['required'],           
            'mob_no' => ['required'],           
            'uscis_no' => ['required'],           
            'ssa' => ['required'],           
            'ssc' => ['required'],           
            'gender' => ['required'],           
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
