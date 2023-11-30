<?php

namespace App\Http\Requests\admin\user;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'password'=>'required|min:8',
            'phone'=>'required',
            'avatar'=>'image|mimes:jpeg, png, jpg,gif|max:2048',
            'address'=>'required',
        ];
    }
    public function messages(): array
    {
        return[
            'required'=>':attribute không được để trống',
            'string'=>':attribute phải là chuỗi',
            'max'=>':attribute không được lớn hơn :max MB',
            'min'=>':attribute không được nhỏ hơn :min ký tự',
            'email'=>':attribute yêu cầu phải đúng định đạng email',
            'image'=>':attribute yêu cầu phải là hình ảnh',
            'mimes'=>':attribute yêu cầu hình ảnh phải có đuôi :values',
        ];
    }
    public function attributes():array
    {
        return[
            'name'=>'Tên',
            'email'=>'Email',
            'password'=>'Mật khẩu',
            'phone'=>'Số điện thoại',
            'avatar'=>'File tải lên',
            'address'=>'Địa chỉ',
        ];
    }
}
