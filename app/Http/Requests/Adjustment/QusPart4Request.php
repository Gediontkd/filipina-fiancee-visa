<?php

namespace App\Http\Requests\Adjustment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class QusPart4Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [                       
            'sexual' => ['required'],                                  
            'denying' => ['required'],                                  
            'armed' => ['required'],                                  
            'hostilities' => ['required'],                                  
            'municipality' => ['required'],                                  
            'assistance' => ['required'],                                  
            'proceeding' => ['required'],                                  
            'reasonable' => ['required'],                                  
            'counterfeit' => ['required'],                                  
            'misrepresented' => ['required'],                                  
            'claimed' => ['required'],                                  
            'stowaway' => ['required'],                                  
            'smuggling' => ['required'],                                  
            'fraudulent' => ['required'],                                  
            'excluded' => ['required'],                                  
            'paroled' => ['required'],                                  
            'unlawfully' => ['required'],                                  
            'departed_us' => ['required'],                                  
            'reentered' => ['required'],                                  
            'inspected' => ['required'],                                  
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
