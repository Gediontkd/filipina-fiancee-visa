<?php

namespace App\Http\Requests\Adjustment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class visaInfoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [                       
            'visa_no' => ['required'],
            'visa_issued' => ['required'],
            'city_town' => ['required'],
            'us_states' => ['required'],
            'entered_us' => ['required'],
            'i_94_no' => ['required'],
            'authorized_exp_date' => ['required'],
            'current_immig_status' => ['required'],
            'last_name' => ['required'],
            'first_name' => ['required'],
            'middle_name' => ['required'],
            'reg_no' => ['required'],
            'travel_doc_no' => ['required'],
            'passport_listed' => ['required'],
            'issued_travel_doc' => ['required'],
            'receipt_no' => ['required'],
            'priority_date' => ['required'],
            'embassy_country' => ['required'],
            // 'embassy_city' => ['required'],
            'previously_applied' => ['required'],
            'uscis_city_town' => ['required'],
            'uscis_states' => ['required'],
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
