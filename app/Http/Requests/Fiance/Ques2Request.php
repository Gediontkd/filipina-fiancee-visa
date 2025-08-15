<?php

namespace App\Http\Requests\Fiance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Ques2Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'trafficking_offense' => ['required'],           
            'trafficking_activitie' => ['required'],           
            'significant_role' => ['required'],           
            'violated_controlled' => ['required'],           
            'illegal_activity' => ['required'],           
            'terrorist_activities' => ['required'],           
            'terrorist_orga' => ['required'],           
            'member_terr_orga' => ['required'],           
            'participated_genocide' => ['required'],           
            'participated_torture' => ['required'],           
            'withholding_custody' => ['required'],           
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
