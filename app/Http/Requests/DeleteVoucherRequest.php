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
            'delete_voucher.*' => 'delete voucher',
        ];
    }
}
