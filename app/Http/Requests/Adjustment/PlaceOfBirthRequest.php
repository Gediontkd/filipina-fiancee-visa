<?php

namespace App\Http\Requests\Adjustment;

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
            'city_of_birth' => ['required'],
            'state_province' => ['required'],
            'country_of_birth' => ['required'],
            'country_of_citizen' => ['required'],
            'feet' => ['required'],
            'inches' => ['required'],
            'pounds' => ['required'],
            'ethnicity' => ['required'],
            'hair_color' => ['required'],
            'eye_color' => ['required'],
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
