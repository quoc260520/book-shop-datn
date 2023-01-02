<?php

namespace App\Http\Requests;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends CreateAccountRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'bail|nullable|string',
            'last_name' => 'bail|nullable|string',
            'email' => ['bail', 'required', 'email', 'max:50','unique:users,email,' . $this->id],
            'phone' => ['bail', 'nullable', new Phone(),'min:10','max:12', 'unique:users,phone,' . $this->id],
            'password' => ['bail', 'nullable', 'max:20'],
            'address' => ['bail', 'nullable','string'],
            'date_of_birth' => ['bail', 'nullable','date']
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => 'Họ',
            'last_name' => 'Tên',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'password' => 'Mật khẩu',
            'address' => 'Địa chỉ',
            'date_of_birth' => 'Ngày sinh'
        ];
    }

    public function messages() {
        return [
            'required' => ':attribute không được để trống',
            'string' => ':attribute phải là chuỗi',
            'email' => 'Phải là định dạng email',
            'min' => ':attribute phải lớn hơn :min ký tự',
            'max' => ':attribute phải bé hơn :max ký tự',
            'unique' => ':attribute đã tồn tại',
            'date' => ':attribute phải là ngày'
        ];
    }
}
