<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromocodeRequest extends FormRequest
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
            'code'=>'required', //|unique:promo_code
            'limit_date'=>'required',
            'value' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required'=>"هذا الحقل مطلوب",
            'string'  =>"يجب ان يكون احرف",
            'max'     =>"الاسم طويل",
            'in'      =>"القيمه غير صحيحه",
        ];
    }
}