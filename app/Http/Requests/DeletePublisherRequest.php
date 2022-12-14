<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeletePublisherRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'delete_publisher' => 'required|array|min:1',
            'delete_publisher.*' => 'required|integer|exists:publishers,id,deleted_at,NULL',
        ];
    }

    public function attributes()
    {
        return [
            'delete_publisher.*' => 'Nhà xuất bản',
            'delete_publisher' => 'Nhà xuất bản',
        ];
    }

    public function messages() {
        return [
            'required' => 'Phải chọn ít nhất một nhà xuất bản',
            'exists' => 'Nhà xuất bản không tồn tại'
        ];
    }
}
