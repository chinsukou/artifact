<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    public function getComments()
    {
        return $this::orderBy('updated_at', 'DESC')->get();
    }
    // replyテーブルとのリレーション
    public function reply()
    {
        return $this->belongsTo(Reply::class);
    }
    protected $fillable = [
        'body',
        'user_id',
        'reply_id',
    ];
}
