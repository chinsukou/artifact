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
    //正規表現でURLの条件を取得する
    public function makeLink($value) {
        return mb_ereg_replace("(https?)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)" , '<a href="\1\2" class="link">\1\2</a>' , $value);
    }
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
