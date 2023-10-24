<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>stepBystep 投稿詳細</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
  <div class='bg-white h-full'>
    <div class='mx-auto px-5 py-2 container'>
      <div class="break-all container border-2 rounded-lg border-gray-200 p-3 mb-2">
        <div class='flex justify-between'>
          <!--投稿したユーザ-->
          <a href='/user-prof/prof-other/{{ $post->user->id }}'>
            <div class='flex text-gray-500'>
              <div class='py-2'>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              </div>
              <h2 class='py-2 ml-2'>
                {{ $post->user->name }}
              </h2>
            </div>
          </a>
          <a href="/posts/{{ $post->id }}/edit">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
          </a>
        </div>
        <!--タイトル-->
        <h1 class="text-xl title-font font-medium mb-2">{{ $post->title }}</h1>
        <div class='text-sm text-gray-500 mb-4'>
          <!--カテゴリー-->
          <h2 class='ml-2'>カテゴリー：{{ $post->category->name }}</h2>
          <!--難易度-->
          <h2 class='ml-2'>難易度：{{ $post->difficulty->name }}</h2>
        </div>
        <!--本文-->
        <!--リンク改行を有効にして$post->bodyを表示する-->
        <p class=''>{!! nl2br($post->makeLink(e($post->body))) !!}</p>
        @if(isset($post->public_id))
        <img class='h-full w-full object-cover object-center' src='{{ $post->public_id }}' alt='画像'>
        @else
        <img class='w-full object-cover object-center my-2'
          src='https://placehold.jp/ffffff/1e1515/720x400.png?text=stepBystep' alt='画像'>
        @endif
        <div class='flex justify-between'>
          <div class='text-sm text-gray-400'>
            {{ $post->created_at }}
          </div>
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
      <div class='flex justify-end p-4'>
        <div class="rounded bg-blue-500 hover:bg-blue-700 text-white w-fit">
          <a href='/replies/create/{{ $post->id }}'>返信する</a>
        </div>
      </div>
      <!--返信一覧表示-->
      <h3 class='font-semibold p-4'>返信一覧</h3>
      @foreach($replies as $reply)
      <div class="break-all border-2 rounded-lg border-gray-200 p-3 mb-2">
        <div class='text-gray-400 mb-2'>
          <!--投稿したユーザ-->
          <a href='/user-prof/prof-other/{{ $reply->user->id }}'>
            <div class='flex text-gray-500'>

              <div class='py-2'>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              </div>
              <h2 class='py-2 ml-2'>
                {{ $reply->user->name }}
              </h2>
            </div>
          </a>
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
        <a href="/posts">戻る</a>
      </div>
    </div>
  </div>
</x-app-layout>