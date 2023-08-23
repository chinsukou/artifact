<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Difficulty;
use App\Models\User;

class PostController extends Controller
{
    //投稿一覧
    public function index(Post $post)
    {
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]);
    }
    //投稿詳細
    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
    }
    //新規投稿作成画面
    public function create(Category $category,  Difficulty $difficulty, User $user)
    {
        return view('posts.create')->with([
            'categories' => $category->get(),
            'difficulties' => $difficulty->get(),
            //'users' => $user->get()
            ]);
    }
    //投稿をDBに保存して投稿一覧へリダイレクト
    public function store(Request $request, Post $post)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
}
