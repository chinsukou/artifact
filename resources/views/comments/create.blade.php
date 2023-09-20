<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
    <div class='bg-gradient-to-r from-purple-800 via-blue-800 to-indigo-700 min-h-full'>
        <div class='mx-auto container'>
            <h1 class='text-white'>コメント作成</h1>
            <div class='border rounded bg-white p-3'>
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
            </div>
            <div class='border rounded bg-white p-3'>
                    <!--コメント対象の返信-->
                    <p>{{ $reply->body }}</p>
            </div>
            <!--コメント一覧表示-->
            @foreach($comments as $comment)
                <div class="border rounded bg-white p-3">
                    <p>{{ $comment->body }}</p>
                </div>
                @endforeach
            <form action="/replies/show/{{ $reply->id }}" method="POST">
                @csrf
                <!--コメント本文-->
                <div class="body">
                    <textarea class='resize-none h-1/5 w-full border-none' name="comment[body]" placeholder="コメントを入力してください。">{{ old('comment.body') }}</textarea>
                    <p class="comment_error" style="color:red">{{ $errors->first('comment.body') }}</p>
                </div>
                <input class='rounded bg-blue-500 hover:bg-blue-700 text-white w-fit' type="submit" value="コメントする"/>
            </form>
        </div>
        <div class="rounded bg-blue-500 hover:bg-blue-700 text-white w-fit">
            <a href="/replies/{{ $reply->id }}">戻る</a>
        </div>
    </div>
</x-app-layout>