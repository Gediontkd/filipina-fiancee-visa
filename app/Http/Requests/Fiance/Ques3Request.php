<?php

namespace App\Http\Requests\Fiance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Ques3Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'acts_of_violence' => ['required'],                    
            'child_soldier' => ['required'],                    
            'religious_freedom' => ['required'],                    
            'member_of_affiliated' => ['required'],                    
            'colombia_group' => ['required'],                    
            'governmental_abuse' => ['required'],                    
            'expropriated_property' => ['required'],                    
            'chemical_weapon' => ['required'],                    
            'trafficked_confidential' => ['required'],                    
            'establishment' => ['required'],                    
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
