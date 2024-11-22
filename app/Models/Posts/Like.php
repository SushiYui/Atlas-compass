<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Posts\Post;
use App\Models\Users\User;


class Like extends Model
{
    const UPDATED_AT = null;

    protected $fillable = [
        'like_user_id',
        'like_post_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function likeCounts($post_id){
        return $this->where('like_post_id', $post_id)->get()->count();
    }
}
