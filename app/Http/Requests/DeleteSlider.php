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
}
