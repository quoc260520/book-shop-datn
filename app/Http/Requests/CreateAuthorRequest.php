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
}
