<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => ['required', 'min:5', 'max:100'],
            'parent_id' => ['required', 'numeric'],
            'depth' => ['required', 'numeric']
        ];
    }

    public function attributes(){
        return[
            'name' => 'Tên danh mục',
            'parent_id' => 'ID cha của danh mục',
            'depth' => 'Độ sâu của danh mục'
        ];
    }

    public function messages(){
        return[
            'required' => ':attribute Không được bỏ trống',
            'min' => ':attribute Phải lớn hơn :min',
            'max' => ':attribute Phải nhỏ hơn :max',
            'numeric' => ':attribute Phải là kiểu số'
        ];
    }
}
