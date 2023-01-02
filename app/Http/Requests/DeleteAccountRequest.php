<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteAccountRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'delete_account' => 'bail|required|array|min:1',
            'delete_account.*' => 'bail|required|integer'
        ];
    }

    public function attributes() {
        return [
            'delete_account.*' => 'Tài khoản',
            'delete_account' => 'Tài khoản'
        ];
    }

    public function messages() {
        return [
            'required' => 'Phải chọn ít nhất một tài khoản',
        ];
    }

}
