<?php

namespace App\Http\Requests\Fiance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Ques1Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'insurgent_orga' => ['required'],                     
            'human_service' => ['required'],                     
            'physical_disorder' => ['required'],                     
            'drug_abuser' => ['required'],                     
            'medical_examination' => ['required'],                     
            'arrested_or_convicted' => ['required'],                     
            'violated_or_engaged' => ['required'],                     
            'prostitution' => ['required'],                     
            'money_laundering' => ['required'],                     
            'trafficking_offense' => ['required'],                     
            'knowingly_aided' => ['required'],                     
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
