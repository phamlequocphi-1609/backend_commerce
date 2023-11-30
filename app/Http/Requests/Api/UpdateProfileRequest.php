<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\api\FormRequest;



class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return[
            'name'=>'required',
            'email'=>'required|email',
            'address'=>'required',
            'phone'=>'required',
            'avatar'=>'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
    public function messages()
    {
        return[
            'required'=>':attribute bắt buột',
            'avatar'=>':attribute phải là hình ảnh',
            'mimes'=>':attribute phải đỊnh dạng như :values',
            'avatar.max'=>':attribute maximum file size to upload :max'
        ];
    }
}
