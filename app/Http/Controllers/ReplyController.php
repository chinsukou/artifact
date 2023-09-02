<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReplyRequest;
use App\Models\Post;
use App\Models\Reply;
use App\Models\Comment;



class ReplyController extends Controller
{
    public function show(Post $post, Reply $reply, Comment $comment)
    {
        return view('replies.show')->with([
            'post' => $post,
            'reply' => $reply,
            'comments' => $comment->where('reply_id', $reply->id)->get(),
        ]);
    }
    // 投稿への返信
    public function create(Post $post)
    {
        return view('replies.create')->with([
            'post' => $post,
        ]);
    }
    // 返信の保存
    public function store(ReplyRequest $request, Reply $reply, Post $post)
    {
        $input = $request['reply'];
        $reply->user_id = Auth::id();
        $reply->post_id = $post->id;
        $reply->fill($input)->save();
        return redirect('/posts/'. $post->id)->with([
            'replies' => $reply,    
        ]);
    }
}
