<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class RoleRequest extends FormRequest
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
        $rules['name'] = 'required';
        // 添加角色
        if (request()->isMethod('POST')) {
            $rules['slug'] = 'required|unique:roles,slug';
        }else{
            // 修改时 request()->method() 方法返回的是 PUT或PATCH
            $rules['slug'] = [
                'required',
                Rule::unique('roles')->ignore(decodeId(request()->route('role'))),
            ];
        }
        return $rules;
    }

    /**
     * 验证信息
     * @Author   晚黎
     * @DateTime 2017-07-26T22:24:11+0800
     * @return   [type]                   [description]
     */
    public function messages()
    {
        return [
            'required'  => ':attribute 不能为空。',
            'unique'    => ':attribute 已经存在。',
        ];
    }
    
    public function attributes()
    {
        return [
            'name'  => '名称',
            'slug'  => '角色',
        ];
    }
}
