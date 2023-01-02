<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAuthorRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'author_name' => 'bail|required|string|max:255|min:3',
            'data_of_birth' => 'bail|nullable|date',
            'address' => 'bail|nullable|string|max:255|min:3',
        ];
    }
    public function attributes()
    {
        return [
            'author_name' => 'Tên tác giả',
            'data_of_birth' => 'Ngày sinh',
            'address' => 'Địa chỉ',
        ];
    }

    public function messages() {
        return [
            'required' => ':attribute không được để trống',
            'string' => ':attribute phải là chuỗi',
            'min' => ':attribute phải lớn hơn :min ký tự',
            'max' => ':attribute phải bé hơn :max ký tự',
            'date' => ':attribute phải là ngày'
        ];
    }
}
