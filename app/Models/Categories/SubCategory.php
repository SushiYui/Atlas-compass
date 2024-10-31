<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category_id',
        'sub_category',
    ];

    // 1対多のリレーション。複数のサブカテゴリーは特定のメインカテゴリーに属する
    public function mainCategory(){
        // リレーションの定義
        return $this->belongTo(MainCategory::Class, 'sub_category_id', 'main_category_id');
    }

    // 複数のサブカテゴリーが複数のユーザーに関連付けできる
    public function posts(){
        // リレーションの定義
        return $this->belongsToMany(Post::Class, 'post_sub_categories', 'sub_category_id', 'post_id');
    }
}
