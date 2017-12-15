<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagRequest extends FormRequest
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
        // 添加权限
        if (request()->isMethod('POST')) {
            $rules['name'] = 'required|unique:tags,name';
        }else{
            // 修改时 request()->method() 方法返回的是 PUT或PATCH
            $rules['name'] = [
                'required',
                Rule::unique('tags')->ignore(decodeId(request()->route('tag'))),
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
            'name'  => '标签名称',
        ];
    }
}
