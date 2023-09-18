<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
    <div class='mx-auto container'>
        <div class="border rounded bg-white p-3">
            <!--カテゴリー-->
            <a fref="">{{ $post->category->name }}</a>
            <br>
            <!--難易度-->
            <a fref="">{{ $post->difficulty->name }}</a>
            <!--タイトル-->
            <h1 class="title">
                {{ $post->title }}
            </h1>
            <!--本文-->
            <div class="content_post">
                <p>{{ $post->body }}</p>
                 @auth
                <!-- Post.phpに作ったisLikedByメソッドをここで使用 -->
                @if (!$post->isLikedBy(Auth::user()))
                    <span class="likes">
                        <i class="fas fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
                    <span class="like-counter">{{$post->likes_count}}</span>
                    </span><!-- /.likes -->
                @else
                    <span class="likes">
                        <i class="fas fa-heart heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
                    <span class="like-counter">{{$post->likes_count}}</span>
                    </span><!-- /.likes -->
                @endif
                @endauth
            </div>
        </div>
        <!--返信-->
        <div class="content">
            <div class="">
                <a href='/replies/create/{{ $post->id }}'>返信する</a>
            </div>
        </div>
        <br>
        <!--返信一覧表示-->
        <h3>返信一覧</h3>
        <br>
            @foreach($post->replies as $reply)
                <div class="rounded border bg-white p-3">
                    <div class="content">
                        <div class="content_contents">
                            <a href='/replies/{{ $reply->id }}'><p>{{ $reply->body }}</p></a>
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
    <div class="flex-end">
        <a href="/">戻る</a>
    </div>
</x-app-layout>
