<?php

namespace App\Http\Requests\Spouse;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => ['required'],
            'country_code' => ['required'],           
            'telephone_number' => ['required'],           
            'mob_no_country' => ['required'],           
            'mob_telephone_number' => ['required'],           
            // 'reg_no' => ['required'],           
            // 'tax_id' => ['required'],           
            // 'social_sec_no' => ['required'],           
            // 'uscis_no' => ['required'],           
            'diffrent_mailing_address' => ['required'],           
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
