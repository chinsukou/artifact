<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Home</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
    <body>
        <h1>HOME</h1>
        <br>
        <!--投稿を表示する-->
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='posts'>
                    <p><a href="">カテゴリー：{{ $post->category->name }}</a></p>
                    <p><a href="">難易度：{{ $post->difficulty_id }}</a></p>
                    <a href="/posts/{{ $post->id }}">
                        <h2 class='title'>
                            {{ $post->title }}
                            <br>
                        </h2>
                        <p class='body'>{{ $post->body }}</p>
                    </a>
                </div>
                <br>
            @endforeach
        </div>
        <!--ページネイション-->
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
        <!--投稿ページへ-->
        <div>
            <a href='/posts/create'>投稿する</a>
        </div>
        <br>
        <!--現在ログインしているユーザー-->
        <p>ログインユーザー:{{ Auth::user()->name }}</p>
    </body>
    </x-app-layout>
</html>