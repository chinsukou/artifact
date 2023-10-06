<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DifficultyController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;

// 投稿用コントローラー
Route::controller(PostController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/posts/create', 'create')->name('post.create');
    Route::post('/posts', 'store')->name('post.store');
    Route::delete('/posts/{post}', 'delete')->name('post.delete');
});

Route::controller(PostController::class)->group(function(){
    Route::get('/', 'welcome')->name('welcome');
    Route::get('/posts', 'index')->name('post.index');
    //検索用
    Route::get('/searchpost', 'search')->name('searchpost');
    Route::get('/posts/{post}', 'show')->name('post.show');
    // 投稿へのいいね用
    Route::post('/posts/like', 'like')->name('posts.like');
});

// 返信用コントローラー
Route::controller(ReplyController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/replies/create/{post}', 'create')->name('reply.create');
    Route::post('/posts/show/{post}', 'store')->name('reply.store');
});

Route::controller(ReplyController::class)->group(function(){
    Route::get('/replies/{reply}', 'show')->name('reply.show');
});
// 個別返信用コントローラー
Route::controller(CommentController::class)->middleware(['auth', 'verified'])->group(function(){
    Route::get('/comments/create/{reply}', 'create')->name('comment.create');
    Route::post('/replies/show/{reply}', 'store')->name('comment.store');
});

// カテゴリ用コントローラー
Route::get('/categories/{category}', [CategoryController::class,'index'])->name('category.index');

// いいね用コントローラー
Route::get('/likes', [LikeController::class,'index'])->middleware(['auth', 'verified'])->name('like.index');

// ユーザーのプロフィール用コントローラー
Route::controller(UserController::class)->group(function(){
   Route::get('/user-prof/prof', 'index')->name('user.profile'); 
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
