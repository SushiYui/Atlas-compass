<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'main_category_name' => ['required', 'string', 'unique:main_categories,main_category', 'max:10'],
            'sub_category_name' =>  ['required', 'string', 'unique:sub_categories,sub_category', 'max:10'],
        ];
    }

    public function messages(){
        return[
            'main_category_name.required' => 'メインカテゴリーは必ず入力してください。',
            'main_category_name.max' => '最大文字数は100文字です。',
            'main_category_name.string' => 'メインカテゴリーは文字列である必要があります。',
            'main_category_name.unique' => '同じ名前のメインカテゴリーは登録できません。',
            'sub_category_nam.required' => 'サブカテゴリーは必ず入力してください。',
            'sub_category_nam.max' => '最大文字数は100文字です。',
            'sub_category_nam.string' => 'サブカテゴリーは文字列である必要があります。',
            'sub_category_nam.unique' => '同じ名前のサブカテゴリーは登録できません。',
        ];
    }
}
