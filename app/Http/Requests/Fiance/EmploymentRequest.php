<?php

namespace App\Http\Requests\Fiance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmploymentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'company_school_name' => ['required'],
            'street' => ['required'],
            'apartment_suite_or_floor' => ['required'],
            'apartment_suite_or_floor_no' => ['required'],            
            'city' => ['required'],            
            // 'state_or_province' => ['required'],            
            // 'postal_code' => ['required'],            
            'country' => ['required'],            
            'phone' => ['required'],            
            // 'supervisor_fname' => ['required'],            
            // 'supervisor_lname' => ['required'],           
            // 'monthly_income' => ['required'],            
            'briefly_explain' => ['required'],            
            'occupation_or_job' => ['required'],            
            'job_category' => ['required'],            
            'began_date' => ['required'],            
            'work_type' => ['required'],            
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
