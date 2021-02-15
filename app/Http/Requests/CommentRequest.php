<?php
/*
 * @Description: 
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2021-01-01 22:24:23
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'body' => 'required|max:200',
        ];
    }

    public function messages()
    {
        return [
            'body.required' => "评论内容不能为空",
            'body.max' => '评论内容最多200个字',
        ];
    }
}
