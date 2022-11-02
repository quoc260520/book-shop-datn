<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            [
                'email_register' => ['bail', 'required', 'email', 'max:50','unique:true'],
                'password_register' => ['bail', 'required', 'max:20'],
            ],
        ];
    }

    public function attributes()
    {
        return [
            'email_register' => 'Email',
            'password_register' => 'Password',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'không được để trống',
            'email_register.email' => 'Cần nhập đúng định dạng email',
            'max' => 'không được nhập quá :max ký tự',
        ];
    }
}
