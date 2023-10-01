<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this::withCount('likes')->with('category')->orderBy('updated_at','DESC')->paginate($limit_count);
    }
    protected $fillable = [
        'title',
        'body',
        'category_id',
        'difficulty_id',
        'user_id',
        'tag_id'
    ];
    
    
    // Viewで使う、いいねされているかを判定するメソッド。
    public function isLikedBy($user): bool {
        return Like::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    // categoriesテーブルとのリレーション
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // usersテーブルとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // difficultiesテーブルとのリレーション
    public function difficulty()
    {
        return $this->belongsTo(Difficulty::class);
    }
    //repliesテーブルとのリレーション
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
