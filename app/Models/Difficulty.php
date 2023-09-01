<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Difficulty extends Model
{
    use HasFactory;
    // カテゴリ＋難易度別に取得
    public function getByDifficulty(int $limit_count = 5, Category $category)
    {
        return $this->$category->posts()->with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    //Difficultiesテーブルからnameとidを抽出
    public function getLists()
    {
        $difficulties = $this->pluck('name', 'id');
        return $difficulties;
    }
    // postsテーブルとのリレーション
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
