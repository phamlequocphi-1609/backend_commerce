<?php

namespace App\Http\Requests\frontend\member;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
            'name'=>'required|string',
            'email'=>'required|email',
            'avatar'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function messages(): array
    {
        return[
            'required'=>':attribute bắt buộc nhập',
            'string'=>':attribute phải là chuổi',
            'email'=>':attribute bắt buộc nhập đúng định dạng',
            'image'=>':attribute yêu cầu phải là hình ảnh',
            'mimes'=>':attribute phải có đuôi :values',
            'max'=>':attribute phải nhỏ hơn :max MB',
        ];
    }
    public function attributes():array
    {
        return[
            'name'=>'Tên',
            'email'=>'Email',
            'avatar'=>'File tải lên',
        ];
    }
}
