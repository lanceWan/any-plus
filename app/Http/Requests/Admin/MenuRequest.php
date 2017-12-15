<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
        $rule =  [
            'name' => 'required',
            'pid' => 'required',
            'slug' => 'required',
        ];

        if ($this->pid) {
            $rule['url'] = 'required';
        }
        return $rule;
    }

    public function messages()
    {
        return [
            'required'  => ':attribute 不能为空。',
        ];
    }

    public function attributes()
    {
        return [
            'name'  => '名称',
            'pid'  => '层级',
            'slug'  => '权限',
            'url'  => '连接地址',
        ];
    }
}
