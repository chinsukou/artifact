<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  <style>
    .link {
      color: #3B82F6;
      position: relative;
      z-index: 0;
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
    <div class="mx-auto py-2 container">
      <div class='flex justify-between'>
        <div class='font-semibold'>HOME</div>
        <!--検索アイコン-->
        <div>
          <button class="textcenter text-gray-600 hover:text-black" id='searchIcon'>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
          </button>
        </div>
      </div>
      <!--検索フォーム-->
      <form class="bg-gray-100 py-4" id='searchForm' style='display:none;' method="GET"
        action="{{ route('searchpost')}}">
        <!--ハッシュタグ検索-->
        <div class='py-2'>
          <label class='p-5'>ハッシュタグ検索</label>
          <input type'text' name='tag' value='{{ $tag }}' placeholder='#初心者'>
        </div>
        <!--タイトル検索-->
        <div class='py-2'>
          <label class="p-5">タイトル検索</label>
          <input type="text" name="searchWord" value="{{ $searchWord }}" placeholder='タイトル'>
        </div>
        <!--プルダウンカテゴリ選択-->
        <div class='py-2'>
          <label class="p-5">カテゴリ</label>
          <select name="categoryId" value="{{ $categoryId }}">
            <option value="">未選択</option>

            @foreach($categories as $id => $category_name)
            <option value="{{ $id }}">
              {{ $category_name }}
            </option>
            @endforeach
          </select>
        </div>
        <!--プルダウン難易度選択-->
        <div class='py-2'>
          <label class="p-5">難易度</label>
          <select name="difficultyId" class="form-control" value="{{ $difficultyId }}">
            <option value="">未選択</option>

            @foreach($difficulties as $id => $difficulty_name)
            <option value="{{ $id }}">
              {{ $difficulty_name }}
            </option>
            @endforeach
          </select>
        </div>
        <div class='flex items-center justify-center px-4'>
          <button type="submit" class='rounded bg-blue-500 text-white hover:bg-blue-700 h-fit w-full'>検索</button>
        </div>
      </form>
      <!--検索結果テーブル 検索された時のみ表示する-->
      @if (!empty($posts))
      <p class='text-white'>全{{ $posts->count() }}件</p>
      @foreach($posts as $post)
      <div class="rounded border bg-white hover:bg-gray-100">
        <div class='flex justify-between h-fit'>
          <div class='text-sm h-fit'>
            {{ $post->user->name }}
          </div>
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
        </div>
        <a href="/categories/{{ $post->category->id }}" class='relative z-20'>
          <p class='hover:text-red-500'>カテゴリー：{{ $post->category->name }}</p>
        </a>
          <p>難易度：{{ $post->difficulty->name }}</p>
        <a href="/posts/{{ $post->id }}" class='relative z-10'>
          <h2 class='title font-bold'>{{ $post->title }}</h2>
        </a>
          <!--リンク改行を有効にして$post->bodyを表示する-->
          <p>{!! nl2br($post->makeLink($post->body)) !!}</p>
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
      @endforeach
      <!--テーブルここまで-->
      <!--ページネーション-->
      {{-- appendsでカテゴリを選択したまま遷移 --}}
      <div class='flex flex-col text-white'>
        {{ $posts->appends(request()->input())->links() }}
      </div>
      @endif
    </div>
  </div>
  <!--検索フォームの表示・非表示-->
  <script src="{{ asset('js/app.js') }}"></script>
  <!--削除確認-->
  <script>
    function deletePost(id) {
      'use strict'

      if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
        document.getElementById(`form_${id}`).submit();
      }
    }
  </script>
</x-app-layout>