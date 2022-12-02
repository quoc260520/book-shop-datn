<?php

namespace App\Http\Requests;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;

class CreateAccountRequest extends BaseRequest
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
            'email' => ['bail', 'required', 'email', 'max:50','unique:users,email'],
            'phone' => ['bail', 'nullable', new Phone(),'min:10','max:12', 'unique:users,phone'],
            'password' => ['bail', 'required', 'max:20'],
            'address' => ['bail', 'nullable','string'],
            'date_of_birth' => ['bail', 'nullable','date']
        ];
    }
}
