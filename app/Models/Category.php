<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // カテゴリ別に取得
    // public function getByCategory(int $limit_count = 5)
    // {
    //      return $this->posts()->with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    // }
    //Categoriesテーブルからnameとidを抽出
    public function getLists()
    {
        $categories = $this->pluck('name', 'id');
        return $categories;
    }
    // postsテーブルとのリレーション
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
