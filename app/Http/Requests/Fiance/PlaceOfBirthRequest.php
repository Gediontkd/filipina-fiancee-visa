<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PlaceOfBirthRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'dob' => ['required'],
            'birth_city' => ['required'],           
            'birth_state' => ['required'],           
            'birth_country' => ['required'],           
            'father_first_name' => ['required'],           
            'father_middle_name' => ['required'],           
            'father_last_name' => ['required'],           
            'father_dob' => ['required'],           
            'father_birth_country' => ['required'],           
            'father_city_or_province_of_birth' => ['required'],           
            'he_deceased' => ['required'],           
            'mother_first_name' => ['required'],           
            'mother_middle_name' => ['required'],           
            'mother_last_name' => ['required'],           
            'mother_dob' => ['required'],           
            'mother_birth_country' => ['required'],           
            'mother_birth_city' => ['required'],           
            'she_deceased' => ['required'],           
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
