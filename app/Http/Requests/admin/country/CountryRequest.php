<?php

namespace App\Http\Requests\admin\country;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
            'name'=> 'required',
        ];
    }
    public function messages(): array
    {
        return[
            'required'=>":attribute không được bỏ trống",
        ];
    }
    public function attributes(): array
    {
        return[
            'name'=>'Tên nước',
        ];
    }
}
