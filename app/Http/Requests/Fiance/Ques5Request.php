<?php

namespace App\Http\Requests\Fiance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Ques5Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'avoiding_taxation' => ['required'],                                        
            'former_exchange_visitor' => ['required'],                                        
            'secretary_of_labor' => ['required'],                                        
            'foreign_medical_school' => ['required'],                                        
            'credentialing_org' => ['required'],                                        
            'permanently_ineligible' => ['required'],                                        
            'departed_us' => ['required'],                                        
            'practice_polygamy' => ['required'],                                        
            'frivolous_application' => ['required'],                                        
            'misrepresentation' => ['required'],                                        
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
