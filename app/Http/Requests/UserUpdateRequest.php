<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'name' => ['required', Rule::unique('users')->ignore($this->user()->id), "min:3", "max:12"],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '用户名不能为空',
            'name.min' => '用户名最少3个字符',
            'name.max' => '用户名最大12个字符',
            'name.unique' => '用户名已存在',
        ];
    }
   
}
