<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends CreateSlider
{
    public function rules()
    {
        return [
            'link_update' => 'bail|required|string',
            'image' => ['bail', 'nullable', 'mimes:jpeg,jpg,png|max:10000']
        ];
    }

    public function attributes()
    {
        return [
            'link_update' => 'Link',
            'image'=> 'Hình ảnh',
        ];
    }

    public function messages() {
        return [
            'required' => ':attribute không được để trống',
            'string' => ':attribute phải là chuỗi',
            'image.max' => 'Dung lượng :attribute phải bé hơn :max',
            'mimes' => ':attribute là một tệp loại: :values',
        ];
    }
}
