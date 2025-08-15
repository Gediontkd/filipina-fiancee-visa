<?php

namespace App\Http\Requests\Fiance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ParentsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'father_last_name' => ['required'],
            'father_first_name' => ['required'],
            // 'father_middle_name' => ['required'],
            // 'father_dob' => ['required'],
            // 'father_city_town' => ['required'],
            // 'father_city_or_province_of_birth' => ['required'],
            // 'father_birth_country' => ['required'],
            'he_deceased' => ['required'],
            'mother_maiden_last_name' => ['required'],
            'mother_first_name' => ['required'],
            // 'mother_middle_name' => ['required'],
            // 'mother_dob' => ['required'],
            // 'mother_city_town' => ['required'],
            // 'mother_city_or_province_of_birth' => ['required'],
            // 'mother_birth_country' => ['required'],
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
