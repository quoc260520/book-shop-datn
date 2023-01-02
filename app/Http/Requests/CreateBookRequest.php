<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'book_name' => ['bail', 'required', 'string', 'min:3', 'max:500'],
            'category' => ['bail', 'required', 'integer'],
            'author' => ['bail', 'required', 'integer'],
            'publisher' => ['bail', 'required', 'integer'],
            'year_publish' => ['bail','nullable','date_format:Y'],
            'price' => ['bail','required', 'integer'],
            'sale' => ['bail','integer', 'between:1,100'],
            'amount' => ['bail', 'nullable', 'string', 'max:10000'],
            'image' => ['bail', 'nullable','array','max:5'],
            'image.*' => ['bail','nullable','mimes:jpeg,jpg,png,gif','max:10000'],
            'status' => ['bail','integer', 'between:1,2'],
            'describe_book' => ['bail', 'nullable','string'],
        ];
    }
    public function attributes()
    {
        return [
            'book_name' => 'Tên sách',
            'category' => 'Danh mục',
            'author' => 'Tác giả',
            'publisher' => 'Nhà xuất bản',
            'year_publish' => 'Năm xuất bản',
            'price' => 'Giá tiền',
            'sale' => 'Giảm giá',
            'amount' => 'Số lượng',
            'image' => 'Hình ảnh',
            'image.*' => 'Hình ảnh',
            'status' => 'Trang thái',
            'describe_book' => 'Mô tả'
        ];
    }

    public function messages() {
        return [
            'required' => ':attribute không được để trống',
            'string' => ':attribute phải là chuỗi',
            'min' => ':attribute phải lớn hơn :min ký tự',
            'max' => ':attribute phải bé hơn :max ký tự',
            'date' => ':attribute phải là ngày',
            'integer' => ':attribute phải là số',
            'date_format' => ':attribute phải là dạng :format',
            'between' => ':attribute phải nằm trong khoảng :min và :max',
            'array' => ':attribute phải là một mảng',
            'mimes' => ':attribute là một tệp loại: :values',
        ];
    }
}
