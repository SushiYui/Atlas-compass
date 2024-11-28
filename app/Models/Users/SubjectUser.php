<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Users\User;
use App\Models\Users\Subject;


class SubjectUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'subject_id',
    ];

    public function subjectUser($subject_id){
        return Subject::where('id', $subject_id)->first();
    }

    public $timestamps = false; // タイムスタンプを無効化

}
