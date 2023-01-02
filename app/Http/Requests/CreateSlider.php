<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSlider extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'link' => 'bail|required|string',
            'image'=> 'bail|required|mimes:jpeg,jpg,png|max:10000',
        ];
    }
    public function attributes()
    {
        return [
            'link' => 'Link',
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
