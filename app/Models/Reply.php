<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    
    // public function getPaginateByLimit(int $limit_count = 5)
    // {
    //     return $this::orderBy('updated_at', 'ASC')->paginate($limit_count);
    // }
    public function getReplies()
    {
        return $this::orderBy('updated_at', 'DESC')->get();
    }
    
    // postsテーブルとのリレーション
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    // // commentsテーブルとのリレーション
    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }
    
     protected $fillable = [
        'body',
        'category_id',
        'difficulty_id',
        'user_id',
        'post_id',
    ];
}
