<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteCategoryRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'delete_category' => 'required|array|min:1',
            'delete_category.*' => 'required|integer|exists:categorys,id,deleted_at,NULL',
        ];
    }

    public function attributes()
    {
        return [
            'delete_category.*' => 'Danh mục',
            'delete_category' => 'Danh mục',
        ];
    }
    public function messages() {
        return [
            'required' => 'Phải chọn ít nhất một danh mục',
            'exists' => 'Danh mục không tồn tại'
        ];
    }
}
