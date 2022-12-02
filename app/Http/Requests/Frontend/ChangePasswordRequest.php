<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\BaseRequest;

class ChangePasswordRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'bail|required|string|min:8|max:20',
            'new_password' => 'bail|required|string|min:8|max:20|different:old_password|confirmed',
        ];
    }
}
