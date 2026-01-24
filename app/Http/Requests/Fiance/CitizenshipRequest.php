<?php

namespace App\Http\Requests\Fiance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CitizenshipRequest extends FormRequest
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
            // 'province_of_birth' => ['required'],                 
            // 'country_of_birth' => ['required'],                 
            // 'national_identi_no' => ['required'],                 
            // 'country_of_citizenship' => ['required'],                 
            'passport_number' => ['required'],                 
            // 'passport_book_number' => ['required'],                 
            // 'city_passport_issue' => ['required'],                 
            // 'province_state_passport_issued' => ['required'],                 
            // 'country_passport_issue' => ['required'],                 
            'date_passport_issue' => ['required'],                 
            'date_passport_expire' => ['required'],                 
            'nationality' => ['required'],                 
            // 'other_country_region' => ['required'],                 
            'passport_lost_or_stolen' => ['required'],                 
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
