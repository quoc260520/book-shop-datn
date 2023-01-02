<?php

namespace App\Http\Requests;

class UpdateVoucherRequest extends CreateVoucherRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => ['bail', 'required', 'string', 'min:5', 'max:50', 'unique:vouchers,code,' . $this->id],
            'amount' => 'bail|nullable|integer',
            'percent' => 'bail|required|string|digits_between: 1,100',
            'time_start' => 'bail|required|date_format:"Y-m-d H:i:s"',
            'time_end' => 'bail|required|date_format:"Y-m-d H:i:s"|after:time_start',
        ];
    }

    public function attributes()
    {
        return [
            'code' => 'Code',
            'amount' => 'Số lượng',
            'percent' => 'Phần trăm giảm',
            'time_start' => 'Thời gian bắt đầu',
            'time_end' => 'Thời gian kết thúc'
        ];
    }

    public function messages() {
        return [
            'required' => ':attribute không được để trống',
            'string' => ':attribute phải là chuỗi',
            'min' => ':attribute phải lớn hơn :min ký tự',
            'max' => ':attribute phải bé hơn :max ký tự',
            'date' => ':attribute phải là ngày',
            'unique' => ':attribute đã tồn tại',
            'digits_between' => ':attribute phải nằm trong khoảng từ :min đến :max',
            'date_format' => ':attribute phải có định dạng :format',
            'time_end.after' => 'Thời gian kết thúc phải sau thời gian bắt đầu'
        ];
    }
}
