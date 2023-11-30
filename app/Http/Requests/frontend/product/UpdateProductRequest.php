<?php

namespace App\Http\Requests\frontend\product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required',
            'price'=>'required',
            'company'=>'required',
            'image[]'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
            'detail'=>'required',
        ];
    }

    public function messages():array
    {
        return[
            'required'=>':attribute không được bỏ trống',
            'image'=>':attribute yêu cầu phải là hình ảnh',
            'mimes'=>':attribute phải có đuôi :values',
            'max'=>':attribute phải nhỏ hơn :max MB',
        ];
    }

    public function attributes():array
    {
        return[
            'name'=>'Tên sản phẩm',
            'price'=>'Giá sản phẩm',
            'company'=>'Công ty sản phẩm',
            'image[]'=>'Hình ảnh',
            'detail'=>'Chi tiết',
        ];
    }
}
