<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class PermissionRequest extends FormRequest
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
        // 添加权限
        if (request()->isMethod('POST')) {
            $rules['slug'] = 'required|unique:permissions,slug';
        }else{
            // 修改时 request()->method() 方法返回的是 PUT或PATCH
            $rules['slug'] = [
                'required',
                Rule::unique('permissions')->ignore(decodeId(request()->route('permission'))),
            ];
        }
        return $rules;
    }

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
            'slug'  => '权限',
        ];
    }
}
