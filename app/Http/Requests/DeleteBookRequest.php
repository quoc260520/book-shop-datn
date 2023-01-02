<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteBookRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'delete_book' => ['bail','required','array','min:1','distinct'],
            'delete_book.*' => ['bail','required','integer']
        ];
    }

    public function attributes() {
        return [
            'delete_book' => 'Sách ',
            'delete_book.*' => 'Sách',
        ];
    }

    public function messages() {
        return [
            'required' => 'Phải chọn ít nhất một sách',
        ];
    }
}
