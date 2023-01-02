<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteVoucherRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'delete_voucher' => ['bail', 'required', 'array', 'min:1'],
            'delete_voucher.*' => 'bail|required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'delete_voucher.*' => 'Mã giảm giá',
            'delete_voucher' => 'Mã giảm giá'
        ];
    }

    public function messages() {
        return [
            'required' => 'Phải chọn ít nhất một mã giảm giá',
            'exists' => 'Mã giảm giá không tồn tại'
        ];
    }
}
