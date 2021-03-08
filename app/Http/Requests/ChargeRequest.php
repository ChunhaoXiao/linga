<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChargeRequest extends FormRequest
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
            'card_number' => ['required', Rule::exists('cards')->where(function ($query) {
                return $query->whereNull('used_at');
            })],
        ];
    }

    public function messages()
    {
        return [
            //'name.required' => '用户名不能为空',
            //'name.exists' => '用户名不存在',
            'card_number.required' => '卡号不能为空',
            'card_number.exists' => '卡号不存在',
        ];
    }
}
