<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVoucherRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'bail|required|string|min:5|max:50|unique:vouchers,code',
            'amount' => 'bail|nullable|integer',
            'percent' => 'bail|required|string|digits_between: 1,100',
            'time_start' => 'bail|required|date_format:"Y-m-d H:i:s"',
            'time_end' => 'bail|required|date_format:"Y-m-d H:i:s"|after:time_start'
        ];
    }
}
