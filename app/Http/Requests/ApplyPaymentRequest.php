<?php

namespace App\Http\Requests;

use App\Rules\Phone;

class ApplyPaymentRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'full_name' => 'required|string',
            'email' => ['bail', 'required', 'email', 'max:50'],
            'phone' => ['bail', 'required', new Phone(),'min:10','max:12'],
            'address' => ['bail', 'required','string'],
        ];
    }
}
