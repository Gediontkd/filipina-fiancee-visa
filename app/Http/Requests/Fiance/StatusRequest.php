<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StatusRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_status' => ['required'],
            'height_feet' => ['required'],           
            'height_inches' => ['required'],           
            'weight' => ['required'],           
            'ethnicity' => ['required'],           
            'race' => ['required'],           
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
