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
      <div class='border rounded bg-white p-3'>
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
      </div>
      <form action="/posts/show/{{ $post->id }}" method="POST">
        @csrf
        <!--返信本文-->
        <div class="body">
          <textarea class='resize-none h-1/5 w-full border-none' name="reply[body]"
            placeholder="返信を入力ください。">{{ old('reply.body') }}</textarea>
          <p class="reply_error" style="color:red">{{ $errors->first('reply.body') }}</p>
        </div>
        <div class='flex justify-end p-4'>
            <input class='rounded bg-blue-500 hover:bg-blue-700 text-white w-fit' type="submit" value="返信する" />
        </div>
      </form>
        <div class="rounded bg-blue-500 hover:bg-blue-700 text-white w-fit">
          <a href="/posts/">戻る</a>
        </div>
    </div>
  </div>
</x-app-layout>