<?php

namespace App\Http\Requests;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;

class CreatePublisherRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'publisher_name' => ['bail', 'required', 'string', 'min:3'],
            'email' => ['bail', 'required', 'email', 'unique:publishers,email'],
            'phone' => ['bail', 'required', new Phone(),'min:10','max:12', 'unique:publishers,phone'],
            'address' => ['bail', 'nullable', 'string'],
            'info' => ['bail','nullable','string'],
        ];
    }
}
