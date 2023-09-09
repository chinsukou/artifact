<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function index(Like $like)
    {
        $user = \Auth::user();
        
        return view('likes.index')->with([
            'posts' => $user->likes,
        ]);
    }
}
