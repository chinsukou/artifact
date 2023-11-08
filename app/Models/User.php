<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // likesテーブルとのリレーション
    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id');
    }
    // postsテーブルとのリレーション
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    // repliesテーブルとのリレーション
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    // commentsテーブルとのリレーション
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follower_users', 'follower_id', 'user_id');
    }
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follower_users', 'user_id', 'follower_id');
    }
}
