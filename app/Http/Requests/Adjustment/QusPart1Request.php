<?php

namespace App\Http\Requests\Adjustment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class QusPart1Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [                       
            'admission' => ['required'],            
            'denied_us' => ['required'],            
            'worked_in_us' => ['required'],            
            'violated' => ['required'],            
            'presently' => ['required'],            
            'diplomats' => ['required'],            
            'crewmember' => ['required'],            
            'deportation' => ['required'],            
            'reinstated' => ['required'],            
            'rescinded' => ['required'],            
            'allotted' => ['required'],            
            'relief' => ['required'],            
            'nonimmigrant' => ['required'],            
            'complied' => ['required'],            
            'recommendation' => ['required'],            
            'arrested' => ['required'],            
            'lawfully' => ['required'],            
            'committed' => ['required'],            
            'subsequently' => ['required'],            
            'punished' => ['required'],            
            'defendant' => ['required'],            
            'regulation' => ['required'],            
            'offences' => ['required'],            
            'illicitly' => ['required'],            
            'knowingly' => ['required'],            
            'vama' => ['required'],            
            'victim' => ['required'],            
            'trafficking' => ['required'],            
            'i_485' => ['required'],            
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
