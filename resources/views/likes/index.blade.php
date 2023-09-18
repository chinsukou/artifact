<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
 <div class="mx-auto container">
      <p>全{{ $posts->count() }}件</p>
      @foreach($posts as $post)
        <div class="rounded border bg-white p-3">
          <p><a href="/categories/{{ $post->category->id }}">カテゴリー：{{ $post->category->name }}</a></p>
          <p>難易度：{{ $post->difficulty->name }}</p>
          <a href="/posts/{{ $post->id }}">
            <h2 class='title font-bold'>{{ $post->title }}</h2>
            <p class='body'>{{ $post->body }}</p>&nbsp;
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
              <i class="fas fa-heart heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
              <span class="like-counter">{{$post->likes_count}}</span>
            </span><!-- /.likes -->
          @endif
          @endauth
        </div>
      @endforeach   
    </div>
</x-app-layout>