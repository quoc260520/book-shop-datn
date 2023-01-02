<?php

namespace App\Http\Requests;

use App\Rules\Phone;

class ApplyPaymentRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'full_name' => 'required|string',
            'email' => ['bail', 'required', 'email', 'max:50'],
            'phone' => ['bail', 'required', new Phone(), 'min:10', 'max:12'],
            'address' => ['bail', 'required', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'full_name' => 'Họ tên',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
        ];
    }

    public function messages() {
        return [
            'required' => ':attribute không được để trống',
            'string' => ':attribute phải là chuỗi',
            'email' => 'Phải là định dạng email',
            'min' => ':attribute phải lớn hơn :min ký tự',
            'max' => ':attribute phải bé hơn :max ký tự',
        ];
    }
}
