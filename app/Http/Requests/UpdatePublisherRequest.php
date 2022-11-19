<?php

namespace App\Http\Requests;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePublisherRequest extends CreatePublisherRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'publisher_id' => ['required', 'integer'],
            'email' => ['bail', 'required', 'email', 'unique:publishers,email,' . $this->publisher_id ],
            'phone' => ['bail', 'required', new Phone(),'min:10','max:12', 'unique:publishers,phone,' . $this->publisher_id],
        ];
    }
}
