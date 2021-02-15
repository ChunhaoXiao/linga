<?php
/*
 * @Description: 
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2021-01-10 22:21:37
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
            'file' => 'required|mimes:jpg,bmp,png,jpeg|max:5000',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => '文件不能为空',
            'file.mimes' => '文件格式不允许',
            'file.max' => '文件大小不能超过5M',
        ];
    }
}
