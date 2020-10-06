<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class lang_request extends FormRequest
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
            'name' => 'required|string|max:100',
            'abbr' => 'required|string|max:10',
            'direction' => 'required|in:ltr,rtl',
           // 'active' => 'required|in:1',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'in' => 'القيم المدخله غير صحيحه',
            'name.string' => 'اسم اللغه لابد ان يكون احرف',
            'abbr.string' => 'هذا الحقل لابد ان يكون احرف',
            'abbr.max' => 'هذا الحقل لابد ان لايزيد عن 10 احرف',
            'name.max' => 'اسم اللغة لابد ان لا يزيد عن 100 حرف',
        ];   
    }

}
