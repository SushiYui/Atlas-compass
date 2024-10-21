<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category'
    ];

    // 1対多のリレーション。特定のメインカテゴリーは府狂うのサブカテゴリーを持つ
    public function subCategories(){
        // リレーションの定義
        return $this->hasMany(SubCategory::Class, 'main_category_id', 'sub_category_id');
    }

}
