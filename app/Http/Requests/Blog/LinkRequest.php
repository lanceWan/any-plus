<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
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
            'name' => 'required',
            'url' => 'required',
        ];
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
            'name'  => '网站名称',
            'url'  => '网站地址',
        ];
    }
}
