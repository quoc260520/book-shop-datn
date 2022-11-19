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
}
