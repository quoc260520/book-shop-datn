<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteAuthorRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'delete_author' => ['bail','required','array','min:1'],
            'delete_author.*' => 'bail|required|integer'
        ];
    }

    public function attributes() {
        return [
            'delete_author.*' => 'Tác giả',
            'delete_author' => 'Tác giả'
        ];
    }

    public function messages() {
        return [
            'required' => 'Phải chọn ít nhất một tác giả',
        ];
    }
}
