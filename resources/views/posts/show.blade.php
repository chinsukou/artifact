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
      <div class="border rounded bg-white p-3">
        <div class='flex text-sm'>
          <div class=''>
            {{ $post->user->name }}
          </div>
        </div>
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
        <div class='flex justify-between'>
          <div class='text-sm'>
              {{ $post->created_at }}
          </div>
          <div class=''>
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
        </div>
        </div>
      </div>
      <!--返信-->
      <div class='flex justify-end p-4'>
        <div class="rounded bg-blue-500 hover:bg-blue-700 text-white w-fit">
          <a href='/replies/create/{{ $post->id }}'>返信する</a>
        </div>
      </div>
      <!--返信一覧表示-->
      <h3 class='font-semibold p-4'>返信一覧</h3>
      @foreach($replies as $reply)
      <div class="rounded border bg-white hover:bg-gray-100 p-3">
        <div class='flex text-sm'>
          <div class=''>
            {{ $reply->user->name }}
          </div>
        </div>
        <a href='/replies/{{ $reply->id }}'>
          <p>{{ $reply->body }}</p>
        </a>
        <div class='text-sm'>
          {{ $reply->created_at }}
        </div>
      </div>
      @endforeach
      <div class="rounded bg-blue-500 hover:bg-blue-700 text-white w-fit">
        <a href="/">戻る</a>
      </div>
    </div>
  </div>
</x-app-layout>