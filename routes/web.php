<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DifficultyController;
use App\Http\Controllers\LikeController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// 投稿用コントローラー
Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('post.index');
    Route::get('/posts', 'index')->name('post.index');
    Route::get('/posts/create', 'create')->name('post.create');
    //検索用
    Route::get('/searchpost', 'search')->name('searchpost');
    Route::get('/posts/{post}', 'show')->name('post.show');
    Route::post('/posts', 'store')->name('post.store');
    // いいね用
    Route::post('/posts/like', 'like')->name('posts.like');
});

// 返信用コントローラー
Route::controller(ReplyController::class)->middleware(['auth'])->group(function(){
    Route::get('/replies/create/{post}', 'create')->name('reply.create');
    Route::get('/replies/{reply}', 'show')->name('reply.show');
    Route::post('/posts/show/{post}', 'store')->name('reply.store');
 
});

// 個別返信用コントローラー
Route::controller(CommentController::class)->middleware(['auth'])->group(function(){
    Route::get('/comments/create/{reply}', 'create')->name('comment.create');
    Route::post('/replies/show/{reply}', 'store')->name('comment.store');
});

// カテゴリ用コントローラー
Route::get('/categories/{category}', [CategoryController::class,'index'])->name('category.index');

// 難易度用コントローラー
Route::get('/difficulties/{difficulty}', [DifficultyController::class,'index'])->name('diffidulty.index');

// いいね用コントローラー
Route::get('/likes', [LikeController::class,'index'])->name('like.index');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
