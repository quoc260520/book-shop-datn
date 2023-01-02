<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\BaseRequest;

class ChangePasswordRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'bail|required|string|min:8|max:20',
            'new_password' => 'bail|required|string|min:8|max:20|different:old_password|confirmed',
        ];
    }
    public function attributes()
    {
        return [
            'old_password' => 'Mật khẩu cũ',
            'new_password' => 'Mật khẩu mới',
        ];
    }

    public function messages() {
        return [
            'required' => ':attribute không được để trống',
            'string' => ':attribute phải là chuỗi',
            'min' => ':attribute phải lớn hơn :min ký tự',
            'max' => ':attribute phải bé hơn :max ký tự',
            'new_password.different' => 'Mật khẩu mới phải khác mật khẩu cũ',
            'new_password.confirmed' => 'Mật khẩu mới không trùng khớp'
        ];
    }
}
