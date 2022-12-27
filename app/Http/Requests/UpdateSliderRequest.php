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
}
