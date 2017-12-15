<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $rules =  [
            'pid' => 'required',
        ];

        if (request()->isMethod('POST')) {
            $rules['name'] = 'required|unique:categories,name';
        }else{
            // 修改时 request()->method() 方法返回的是 PUT或PATCH
            $rules['name'] = [
                'required',
                Rule::unique('categories')->ignore(decodeId(request()->route('category'))),
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
            'pid'  => '层级',
        ];
    }
}
