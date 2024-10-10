<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

use App\Models\Users\User;

class Subjects extends Model
{
    const UPDATED_AT = null;


    protected $fillable = [
        'subject'
    ];

    // 科目が複数の特定ユーザーに所属する
    public function users(){
        return $this->belongsToMany(User::class, 'subject_users', 'subject_id', 'user_id');// リレーションの定義
    }
}
