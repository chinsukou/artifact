<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function auth(User $user)
    {
        $user = \Auth::user();
        
        return view('user-prof.prof')->with([
            'posts' => $user->posts,
        ]);
    }
    
    public function index(User $user)
    {
        return view('user-prof.prof-other')->with([
            'posts' => $user->posts,
            'user' => $user
        ]);
    }
}
