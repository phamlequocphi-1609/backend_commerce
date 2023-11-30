<?php

namespace App\Http\Requests\admin\blog;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title'=>'required',
            'image'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description'=>'required',
            'content'=>'required',
        ];
    }
    public function messages(): array
    {
        return[
            'required'=>':attribute bắt buộc phải nhập',
            'image'=>':attribute yêu cầu phải là hình ảnh',
            'mimes'=>':attribute yêu cầu hình ảnh phải có đuôi :values',
            'max'=>':attribute không được lớn hơn :max MB',
        ];
    }
    public function attributes():array
    {
        return[
            'title'=>'Tiêu đề',
            'image'=>'File tải lên',
            'description'=>'Chi tiết',
            'content'=>'Nội dung'
        ];
    }
}
