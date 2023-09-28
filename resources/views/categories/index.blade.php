<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
  <div class='bg-white h-full'>
    <div class='mx-auto py-2 container'>
      <!--投稿を表示する-->
      <div class='font-semibold'>{{ $category->name }}カテゴリ</div>
      @foreach ($posts as $post)
      <div class='rounded border bg-white hover:bg-gray-100 p-3'>
        <p><a href="/categories/{{ $post->category->id }}">カテゴリー：{{ $post->category->name }}</a></p>
        <p><a href="/difficulties/{{ $post->difficulty->id }}">難易度：{{ $post->difficulty->name }}</a></p>
        <a href="/posts/{{ $post->id }}">
          <h2 class='title'>{{ $post->title }}</h2>
          <p class='body'>{{ $post->body }}</p>
        </a>
        @auth
        <!-- Post.phpに作ったisLikedByメソッドをここで使用 -->
        @if (!$post->isLikedBy(Auth::user()))
        <span class="likes">
          <i class="fas fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
          <span class="like-counter">{{$post->likes_count}}</span>
        </span><!-- /.likes -->
        @else
        <span class="likes">
          <i class="fas fa-heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
          <span class="like-counter">{{$post->likes_count}}</span>
        </span><!-- /.likes -->
        @endif
        @endauth
      </div>
      @endforeach
      <!--ページネイション-->
      <div class='flex'>
        {{ $posts->links() }}
      </div>
      <div class='flex justify-end p-4'>
      <div class="rounded bg-blue-500 hover:bg-blue-700 text-white w-fit">
        <a href="/">戻る</a>
      </div>
    </div>
  </div>
</x-app-layout>