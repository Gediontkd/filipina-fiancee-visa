<?php

namespace App\Http\Requests\Adjustment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AlienParentsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [                       
            'father_last_name' => ['required'],                           
            'father_last_name' => ['required'],                           
            'father_first_name' => ['required'],                           
            'father_middle_name' => ['required'],                             
            'father_dob' => ['required'],                           
            'father_city_town' => ['required'],                           
            'father_birth_country' => ['required'],                           
            'father_current_city' => ['required'],                           
            'mother_last_name' => ['required'],                           
            'mother_first_name' => ['required'],                           
            'mother_middle_name' => ['required'],                                                
            'mother_dob' => ['required'],                           
            'mother_city_town' => ['required'],                           
            'mother_birth_country' => ['required'],                           
            'mother_current_city' => ['required'],                           
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
