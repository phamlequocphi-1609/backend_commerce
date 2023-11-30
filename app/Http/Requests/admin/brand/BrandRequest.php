<?php

namespace App\Http\Requests\admin\brand;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class BrandRequest extends FormRequest
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
            'brand'=>'required',
        ];
    }
    public function messages(): array
    {
        return[
            'required'=>':attribute không được bỏ trống',
        ];
    }
    public function attributes():array
    {
        return[
            'brand'=>'Thương hiệu',
        ];
    }
}
