<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'category_name' => 'required|string|max: 255',
            'category_parent' => 'required|integer',
        ];
    }
    public function attributes()
    {
        return [
            'category_name' => 'Tên danh mục', 
            'category_parent' => 'Danh mục cha',
        ];
    }

    public function messages() {
        return [
            'required' => ':attribute không được để trống',
            'string' => ':attribute phải là chuỗi',
            'max' => ':attribute phải lớn hơn :max ký tự',
        ];
    }
}
