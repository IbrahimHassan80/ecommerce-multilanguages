<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class vendor_request extends FormRequest
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
            'logo' => 'required_without:id|mimes:jpg:jpeg:,png',
            'password' => 'required_without:id',
            'name' => 'required|string|max:100',
            'mobile' => 'required|numeric|unique:vendors,mobile,'.$this->id,
            'email' => 'required|email|unique:vendors,email,'.$this->id,
            'category_id' => 'required|exists:main_categories,id',
            'address' => 'required|max:300'           
        ];
    }

    public function messages(){
        return[
        'required' => 'هذا الحقل مطلوب',
        'logo.required_without' => 'يجب ادخال اللوجو الخاص بالمتجر',
        'string' => 'هذا الحقل يجب ان يحتوى على احرف',
        'max' => 'القيمه المدخله طويله للغايه',
        'category_id.exists' => 'القسم غير موجود',
        'email.email' => 'صيغة البريد الالكترونى غير صحيحه',
        ];
    }

}
