<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
    <div class"mx-auto container">
        <h1>コメント作成</h1>
        <!--コメント対象の投稿-->
        <h2>{{ $reply->post->title }}</h2>
        <p>{{ $reply->post->body }}</p>
        @auth
        <!-- Post.phpに作ったisLikedByメソッドをここで使用 -->
        @if (!$reply->post->isLikedBy(Auth::user()))
            <span class="likes">
                <i class="fas fa-heart like-toggle" data-post-id="{{ $reply->post->id }}"></i>
            <span class="like-counter">{{$reply->post->likes_count}}</span>
            </span><!-- /.likes -->
        @else
            <span class="likes">
                <i class="fas fa-heart heart like-toggle liked" data-post-id="{{ $reply->post->id }}"></i>
            <span class="like-counter">{{$reply->post->likes_count}}</span>
            </span><!-- /.likes -->
        @endif
        @endauth
        <!--コメント対象の返信-->
        <p>{{ $reply->body }}</p>
        <!--コメント一覧表示-->
        <div class="content_reply">
            @foreach($comments as $comment)
                <div class="content">
                    <div class="content_contents">
                        <br>
                        <p>{{ $comment->body }}</p>
                    </div>
                </div>
                <br>
            @endforeach
        </div>
        <form action="/replies/show/{{ $reply->id }}" method="POST">
            @csrf
            <!--コメント本文-->
            <div class="body">
                <h2>本文</h2>
                <textarea name="comment[body]" placeholder="コメントを入力してください。">{{ old('comment.body') }}</textarea>
                <p class="comment_error" style="color:red">{{ $errors->first('comment.body') }}</p>
            </div>
            <input type="submit" value="コメントする"/>
        </form>
    </div>
    <div class="footer">
        <a href="/replies/{{ $reply->id }}">戻る</a>
    </div>
</x-app-layout>