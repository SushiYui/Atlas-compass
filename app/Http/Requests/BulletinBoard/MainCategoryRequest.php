<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
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
        ];
    }

    public function messages(){
        return[
            'main_category_name.required' => 'メインカテゴリーは必ず入力してください。',
            'main_category_name.max' => '最大文字数は100文字です。',
            'main_category_name.string' => 'メインカテゴリーは文字列である必要があります。',
            'main_category_name.unique' => '同じ名前のメインカテゴリーは登録できません。',
        ];
    }
}
