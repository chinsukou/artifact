<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function auth(User $user)
    {
        $user = \Auth::user();
        $user->loadCount(['follows', 'followers']);
        return view('user-prof.prof')->with([
            'posts' => $user->posts,
            'followsCount' => $user->follows_count,
            'followersCount' => $user->followers_count
        ]);
    }
    
    public function index(User $user)
    {
        $user->loadCount(['follows', 'followers']);
        return view('user-prof.prof-other')->with([
            'posts' => $user->posts,
            'user' => $user,
            'followsCount' => $user->follows_count,
            'followersCount' => $user->followers_count
        ]);
    }
    public function follow(User $user)
    {
        $auth_user = \Auth::user();
        $already_followed = $user->followers()->where('follower_id', $auth_user->id)->exists();
        if(!$already_followed) {
            $auth_user = \Auth::user();
            auth()->user()->follows()->attach( $user->id );
            auth()->user()->followers()->attach( $auth_user->id );
        }
        $user->loadCount(['follows', 'followers']);
        return view('user-prof.prof-other')->with([
            'posts' => $user->posts,
            'user' => $user,
            'followsCount' => $user->follows_count,
            'followersCount' => $user->followers_count
            ]);
    }
    public function unfollow(User $user)
    {
        $auth_user = \Auth::user();
        $already_followed = $user->followers()->where('follower_id', $auth_user->id)->exists();
        if($already_followed) {
            auth()->user()->follows()->detach( $user->id );
            auth()->user()->followers()->detach( $auth_user->id );
        }
        $user->loadCount(['follows', 'followers']);
        return view('user-prof.prof-other')->with([
            'posts' => $user->posts,
            'user' => $user,
            'followsCount' => $user->follows_count,
            'followersCount' => $user->followers_count
            ]);
    }
}
