<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
            'title' => 'required|max:60',
            'category_id' => 'required|exists:categories,id',
            'file' => 'required',
            //'is_vip' => [Rule::in([0, 1])],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '标题不能为空',
            'title.max' => '标题长度不能超过60个字符',
            'category_id.required' => '请选择分类',
            'category_id.exists' => '分类不存在',
            'file.required' => '图片文件不能为空', 
        ];
    }
}
