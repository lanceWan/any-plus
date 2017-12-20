<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
        $rules = [
            'category_id' => 'required',
            'title' => 'required',
            'content_mark' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required'  => ':attribute 不能为空。',
        ];
    }
    /**
     * 字段名称
     * @author 晚黎
     * @date   2016-11-02T10:28:52+0800
     * @return [type]                   [description]
     */
    public function attributes()
    {
        return [
            'category_id'           => '分类',
            'title'         => '标题',
            'content_mark'  => '文章内容',
        ];
    }
}
