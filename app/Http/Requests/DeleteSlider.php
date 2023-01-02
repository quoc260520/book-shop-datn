<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteSlider extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'delete_slider' => 'bail|required|array|min:1',
            'delete_slider.*' => 'bail|required|string'
        ];
    }

    public function attributes()
    {
        return [
            'delete_slider.*' => 'Slider',
            'delete_slider' => 'Slider',
        ];
    }

    public function messages() {
        return [
            'required' => 'Phải chọn ít nhất một slider',
            'exists' => 'Slider không tồn tại'
        ];
    }
}
