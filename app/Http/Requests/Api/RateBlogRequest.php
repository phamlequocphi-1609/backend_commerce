<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\api\FormRequest;


class RateBlogRequest extends FormRequest
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
            'id_user' => 'required',
            'id_blog'=>'required',
            'rate' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required'=>':attribute Không được để trống'
        ];
    }
}
