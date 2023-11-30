<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'id_blog'=>'required',
            'id_user'=>'required',
            'name_user'=>'required',
            'level'=>'required',
            'comment'=>'required',
            'avatar_user'=>'required'
        ];
    }
    public function messages()
    {
        return[
            'id_blog.required'=>':attribute yêu cầu bắt buột',
            'id_user.required'=>':attribute yêu cầu bắt buột',
            'name_user.required'=>':attribute yêu cầu bắt buột',
            'level.required'=>':attribute yêu cầu bắt buột',
            'comment.required'=>':attribute yêu cầu bắt buột',
            'avatar_user.required'=>':attribute yêu cầu bắt buột',
        ];
    }
}
