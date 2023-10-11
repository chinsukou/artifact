<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
  <div class='bg-white h-full'>
    <div class='container px-5 mx-auto'>
        <div class='flex border-b border-gray-500 mb-5'>
            <div class='text-gray-500 py-5'>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-24 h-24">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div class='py-8 ml-4'>
      <h2 class='text-lg mb-3'>名前：{{ $user->name }}</h2>
      <h3>登録日：{{ $user->created_at }}</h3>
            </div>
        </div>
        <!--投稿の表示-->
        @if (isset($posts))
        <div class='flex justify-center items-center h-80'>
            <div class='items-center'>
            <h3 class='text-gray-400 text-lg text-center'>投稿がありません</h3>
            </div>
        </div>
        @else
      <div class='flex flex-wrap -m-4'>
        @foreach($posts as $post)
        <div class='p-4 md:w-1/3'>
          <div
            class='h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden hover:tansform hover:duration-1000 hover:scale-110'>
            <img class='lg:h-48 md:h-36 w-full object-cover object-center'
              src='https://placehold.jp/ffffff/1e1515/720x400.png?text=stepBystep' alt='画像'>
            <div class='p-6'>
              <h1 class='h-8 overflow-hidden text-lg title-font font-medium text-gray-900 mb-3'>{{ $post->title }}</h1>
              <a href='/categories/{{ $post->category->id }}'>
                <h2 class='text-xs title-font font-medium text-gray-400 hover:text-black mb-1'>カテゴリー：{{
                  $post->category->name }}</h2>
              </a>
              <h2 class='text-xs title-font font-medium text-gray-400 mb-1'>難易度：{{ $post->difficulty->name }}</h2>
              <div class='flex justify-between items-center'>
                <a href='/posts/{{ $post->id }}' class='text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0'>
                  投稿を見る
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4 ml-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </a>
                <!--ゴミ箱-->
                <div class='h-5'>
                  @auth
                  @if($post->user_id == Auth::user()->id)
                  <form action='/posts/{{ $post->id }}' id='form_{{ $post->id }}' method='post'>
                    @csrf
                    @method('DELETE')
                    <button type='button' onclick='deletePost({{ $post->id }})'>
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                      </svg>
                    </button>
                  </form>
                  @endif
                  @endauth
                </div>
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
        </div>
        @endforeach
        @endif
      </div>
    </div>
  </div>
  <script>
    function deletePost(id) {
      'use strict'

      if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
        document.getElementById(`form_${id}`).submit();
      }
    }
  </script>
</x-app-layout>