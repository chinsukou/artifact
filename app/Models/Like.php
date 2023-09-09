<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id'
    ];
    
    public function getByLike()
    {
        return $this->post()->where('user_id', Auth::id())->orderBy('created_at','DESC')->get();
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}