<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
  <div class='bg-gradient-to-r from-purple-800 via-blue-800 to-indigo-700 min-h-full'>
    <div class='mx-auto py-2 container'>
      <!--カテゴリー-->
      <!--本文-->
      <div class="rounded border bg-white p-3">
        <div class="content_post">
          <p>{{ $post->title }}</p>
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
      <div class="rounded border bg-white p-3">
        <div class="content_post">
          <p>{{ $reply->body }}</p>
        </div>
      </div>
      <!--コメント一覧表示-->
      @foreach($comments as $comment)
      <div class="rounded border bg-white p-3">
        <div class="content">
          <div class="content_contents">
            <p>{{ $comment->body }}</p>
          </div>
        </div>
      </div>
      @endforeach
      <div class='flex justify-end p-4'>
        <div class='rounded bg-blue-500 hover:bg-blue-700 text-white w-fit'>
          <a href='/comments/create/{{ $reply->id }}'>コメントする</a>
        </div>
      </div>
      <div class="rounded bg-blue-500 hover:bg-blue-700 text-white w-fit">
        <a href="/posts/{{ $post->id }}">戻る</a>
      </div>
    </div>
  </div>
</x-app-layout>