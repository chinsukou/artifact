<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>stepBystep 返信スレッド</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  <style>
    .link {
      color: #3B82F6;
    }

    .link:hover {
      color: #1D4ED8;
    }
  </style>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
  <div class='bg-white h-full'>
    <div class='mx-auto px-5 py-2 container'>
      <!--投稿-->
      <div class="border-2 rounded-lg border-gray-200 p-3 mb-2">
        <h1 class='text-xl title-font font-medium mb-2'>{{ $post->title }}</h1>
        <div class='text-sm text-gray-500 mb-4'>
          <h2 class='ml-2'>{{ $post->user->name }}</h2>
          <h2 class='ml-2'>カテゴリー：{{ $post->category->name }}</h2>
          <h2 class='ml-2'>難易度：{{ $post->difficulty->name }}</h2>
        </div>
        <!--リンク改行を有効にして$post->bodyを表示する-->
        <p class=''>{!! nl2br($post->makeLink(e($post->body))) !!}</p>
        <img class='w-full object-cover object-center my-2' src='https://placehold.jp/ffffff/1e1515/720x400.png?text=stepBystep' alt='画像'>
        <div class='flex justify-between'>
          <div class='text-sm text-gray-400'>{{ $post->created_at }}</div>
          <div class=''>
            <!--いいね-->
            <!--ログイン用-->
            @auth
            @if (!$post->isLikedBy(Auth::user()))
            <span class="likes text-gray-400">
              <i class="fas fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
              <span class="like-counter">{{ $post->likes_count }}</span>
            </span>
            @else
            <span class="likes">
              <i class="fas fa-heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
              <span class="like-counter">{{ $post->likes_count }}</span>
            </span>
            @endif
            @endauth
            <!--ゲスト用-->
            @if(!Auth::user())
            <a href="{{ route('login') }}">
              <span class="likes text-gray-400">
                <i class="fas fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
                <span class="like-counter">{{ $post->likes_count }}</span>
              </span>
            </a>
            @endif
          </div>
        </div>
      </div>
      <!--返信-->
      <div class="border-2 rounded-lg border-gray-200 p-3 mb-2">
        <div class='text-gray-400 mb-2'>{{ $reply->user->name }}</div>
        <!--リンク改行を有効にして$post->bodyを表示する-->
        <p class='mb-2'>{!! nl2br($post->makeLink(e($reply->body))) !!}</p>
        <div class='text-sm text-gray-400'>{{ $reply->created_at }}</div>
      </div>
      <!--コメント一覧表示-->
      @foreach($comments as $comment)
      <div class="border-2 rounded-lg border-gray-200 p-3 mb-2">
        <div class='text-gray-400 mb-2'>{{ $comment->user->name }}</div>
        <!--リンク改行を有効にして$post->bodyを表示する-->
        <p class='mb-2'>{!! nl2br($post->makeLink(e($comment->body))) !!}</p>
        <div class='text-sm text-gray-400'>{{ $comment->created_at }}</div>
      </div>
      @endforeach
      <div class='flex justify-end p-4'>
        <div class='rounded bg-blue-500 hover:bg-blue-700 text-white w-fit'>
          <a href='/comments/create/{{ $reply->id }}'>コメントする</a>
        </div>
      </div>
      <div class="rounded bg-blue-500 hover:bg-blue-700 text-white w-fit mt-2">
        <a href="/posts/{{ $post->id }}">戻る</a>
      </div>
    </div>
  </div>
</x-app-layout>