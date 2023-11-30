<?php

namespace App\Http\Requests\frontend\member;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email'=>'required|email',
            'password'=>'required',
        ];
    }
    public function messages(): array
    {
        return[
            'required'=>':attribute bắt buộc phải nhập',
            'email'=>':attribute yêu cầu phải đúng định dạng',
        ];
    }
    public function attributes(): array
    {
        return[
            'email'=>'Email',
            'password'=>'Mật khẩu'
        ];
    }
}
