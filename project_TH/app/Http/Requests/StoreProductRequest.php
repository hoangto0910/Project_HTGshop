<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => ['required', 'min:6', 'max:100'],
            'origin_price' => ['required', 'numeric'],
            'sale_price' => ['required', 'numeric'],
            'content' => ['required'],
            'status' => ['required'],
            'guarantee' => ['required'],
            'policy' => ['required'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:10000'],
        ];
    }

    public function attributes(){
        return
        [
            'name' => 'Tên sản phẩm',
            'origin_price' => 'Giá gốc',
            'sale_price' => 'Giá bán',
            'content' => 'mô tả sản phẩm',
            'status' => 'Trạng thái sản phẩm',
            'guarantee' => 'Thời gian bảo hành',
            'policy' => 'Chính sách',
            'image' => 'Ảnh',
        ];
    }

    public function messages(){
        return
        [
            'required' => ':attribute Không được để trống',
            'min' => ':attribute Phải lớn hơn :min',
            'max' => ':attribute Phải ít hơn :max',
            'numeric' => ':attribute Phải là dạng số',
            'image' => 'Phải upload File có dạng là ảnh',
            'mimes' => ':attribute Phải có đuôi là : jpeg, png, jpg',
        ];
    }
}
