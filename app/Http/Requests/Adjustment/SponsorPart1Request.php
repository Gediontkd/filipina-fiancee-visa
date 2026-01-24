<?php

namespace App\Http\Requests\Adjustment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SponsorPart1Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [                       
            'f_name' => ['required'],                    
            'm_name' => ['required'],                    
            'l_name' => ['required'],                    
            'dob' => ['required'],                    
            'city_of_birth' => ['required'],                    
            'state_province' => ['required'],                    
            'country_of_birth' => ['required'],                    
            'm_no_country' => ['required'],                    
            'p_number' => ['required'],                    
            'ss_number' => ['required'],                    
            'sponsor_a' => ['required'],                    
            'gender' => ['required'],                    
            'feet' => ['required'],                    
            'inches' => ['required'],                    
            'pounds' => ['required'],                    
            'ethnicity' => ['required'],                    
            'hair_color' => ['required'],                    
            'eye_color' => ['required'],                    
            'member_of_us' => ['required'],                    
            'beneficiary' => ['required'],                    
            'citizenship' => ['required'],                    
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
