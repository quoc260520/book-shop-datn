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
            // 'book_name' => ['bail', 'required', 'string', 'min:3', 'max:500'],
            // 'category' => ['bail', 'required', 'integer'],
            // 'author' => ['bail', 'required', 'integer'],
            // 'publisher' => ['bail', 'required', 'integer'],
            // 'year_publish' => ['bail','nullable','date_format:Y'],
            // 'price' => ['bail','required', 'integer'],
            // 'sale' => ['bail','integer', 'between:1,100'],
            // 'amount' => ['bail', 'nullable', 'string', 'min:3', 'max:500'],
            // 'image' => ['bail', 'nullable','array','max:5'],
            // 'image.*' => ['bail','nullable','mimes:jpeg,jpg,png,gif','max:10000'],
            // 'status' => ['bail','integer', 'between:1,2'],
            // 'describe_book' => ['bail', 'nullable','string'],
        ];
    }
}
