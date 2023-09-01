<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;
use App\Models\Reply;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    // 返信へのコメント
    public function create(Reply $reply, Post $post)
    {
        return view('comments.create')->with([
            'post' => $post,
            'reply' => $reply,
        ]);
    }
    // コメントの保存
    public function store(CommentRequest $request, Comment $comment,Post $post, Reply $reply)
    {
        $input = $request['comment'];
        $comment->user_id = Auth::id();
        $comment->reply_id = $reply->id;
        $comment->fill($input)->save();
        return redirect('/replies/' . $reply->id)->with([
            'comments' => $comment,
        ]);
    }
}
