<?php

namespace App\Http\Requests\Spouse;

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
            // 'first_name' => ['required'],
            // 'middle_name' => ['required'],           
            // 'last_name' => ['required'],           
            'gender' => ['required'],           
            'related_to_you' => ['required'],           
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
