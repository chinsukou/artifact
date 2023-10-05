<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  <style>
    .link {
      color: #3B82F6;
    }

    .link:hover {
      color: #1D4ED8;
    }

    .rep {
      display: block;
    }
  </style>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
  <div class='bg-white h-full'>
    <div class='mx-auto px-5 py-2 container'>
      <div class="border-2 rounded-lg border-gray-200 p-3 mb-2">
        <!--タイトル-->
        <h1 class="text-xl title-font font-medium mb-2">{{ $post->title }}</h1>
        <div class='flex text-sm text-gray-500 mb-4'>
          <!--投稿したユーザ-->
          <h2 class='ml-2'>{{ $post->user->name }}</h2>
          <!--カテゴリー-->
          <h2 class='ml-2'>カテゴリー：{{ $post->category->name }}</h2>
          <!--難易度-->
          <h2 class='ml-2'>難易度：{{ $post->difficulty->name }}</h2>
        </div>
        <!--本文-->
        <!--リンク改行を有効にして$post->bodyを表示する-->
        <p class=''>{!! nl2br($post->makeLink(e($post->body))) !!}</p>
        <img class='w-full object-cover object-center my-2' src='https://dummyimage.com/720x400' alt='画像'>
        <div class='flex justify-between'>
          <div class='text-sm text-gray-400'>
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
      <!--返信-->
      <div class='flex justify-end p-4'>
        <div class="rounded bg-blue-500 hover:bg-blue-700 text-white w-fit">
          <a href='/replies/create/{{ $post->id }}'>返信する</a>
        </div>
      </div>
      <!--返信一覧表示-->
      <h3 class='font-semibold p-4'>返信一覧</h3>
      @foreach($replies as $reply)
      <div class="border-2 rounded-lg border-gray-200 p-3 mb-2">
        <div class='text-gray-400 mb-2'>
          {{ $reply->user->name }}
        </div>
        <!--リンク改行を有効にして$post->bodyを表示する-->
        <p class='mb-2'>{!! nl2br($post->makeLink(e($reply->body))) !!}</p>
        <a href='/replies/{{ $reply->id }}' class='text-indigo-500'>返信スレッドを見る</a>
        <div class='text-sm text-gray-400'>
          {{ $reply->created_at }}
        </div>
      </div>
      @endforeach
      <div class="rounded bg-blue-500 hover:bg-blue-700 text-white w-fit mt-2">
        <a href="/">戻る</a>
      </div>
    </div>
  </div>
</x-app-layout>