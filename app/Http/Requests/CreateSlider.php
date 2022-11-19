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
}
