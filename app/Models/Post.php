<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this::with('category')->orderBy('updated_at','DESC')->paginate($limit_count);
    }
    
    protected $fillable = [
        'title',
        'body',
        'category_id',
        'difficulty_id',
        'user_id'
    ];
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
    public function difficult()
    {
        return $this->belongsTo(Difficulty::class);
    }
    //repliesテーブルとのリレーション
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
