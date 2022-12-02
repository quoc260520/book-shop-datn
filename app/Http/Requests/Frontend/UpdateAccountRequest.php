<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\BaseRequest;
use App\Rules\Phone;

class UpdateAccountRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'bail|nullable|string',
            'last_name' => 'bail|nullable|string',
            'email' => ['bail', 'required', 'email', 'max:50','unique:users,email,' . $this->id],
            'phone' => ['bail', 'nullable', new Phone(),'min:10','max:12', 'unique:users,phone,' . $this->id],
            'password' => ['bail', 'nullable', 'max:20'],
            'address' => ['bail', 'nullable','string'],
            'birthday' => ['bail', 'nullable','date']
        ];
    }
}
