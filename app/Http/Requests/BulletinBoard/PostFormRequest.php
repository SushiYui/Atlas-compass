<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
            'post_title' => 'required|string|max:100',
            'post_body' => 'required|string|max:5000',
            'main_category_name' => 'required|string|max:100',
            'sub_category_name' => 'required|string|max:1',
        ];
    }

    public function messages(){
        return [
            'post_title.required' => 'タイトルは必ず入力してください。',
            'post_title.string' => 'タイトルは文字列である必要があります。',
            'post_title.max' => 'タイトルは100文字以内で入力してください。',
            'post_body.required' => '内容は必ず入力してください。',
            'post_body.string' => '内容は文字列である必要があります。',
            'post_body.max' => '最大文字数は2000文字です。',
            'main_category_name.required' => 'メインカテゴリーは必ず入力してください。',
            'main_category_name.string' => 'タイトルは文字列である必要があります。',
            'main_category_name.max' => 'メインカテゴリーは100文字以内で入力してください。',
        ];
    }
}
