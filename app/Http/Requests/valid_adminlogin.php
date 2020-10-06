<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class valid_adminlogin extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'you must enter your email',
            'email.email' => 'email is wrong', 
            'password.required' => 'enter your password'
        ];
    }


}//--//
