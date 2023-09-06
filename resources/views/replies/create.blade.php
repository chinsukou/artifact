<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
    <div class"mx-auto container">
        <h1>返信</h1>
        <!--返信対象の投稿-->
        <h1>{{ $post->title }}</h1>
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
    
        <form action="/posts/show/{{ $post->id }}" method="POST">
            @csrf
            <!--返信本文-->
            <div class="body">
                <h2>本文</h2>
                <textarea name="reply[body]" placeholder="返信を入力ください。">{{ old('reply.body') }}</textarea>
                <p class="reply_error" style="color:red">{{ $errors->first('reply.body') }}</p>
            </div>
            <input type="submit" value="返信する"/>
        </form>
    </div>
    <div class="footer">
        <a href="/posts/">戻る</a>
    </div>
</x-app-layout>