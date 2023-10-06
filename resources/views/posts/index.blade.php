<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>stepBystep HOME</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
  <div class='bg-white h-full'>
    <div class="container px-5 mx-auto">
      <div class='flex justify-between'>
        <div class='font-semibold'>HOME</div>
        <div>※画像投稿は現在開発中です.</div>
        <!--検索アイコン-->
        <div>
          <button class="textcenter text-gray-600 hover:text-black" id='searchIcon'>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-8 h-8">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
          </button>
        </div>
      </div>
      <!--検索フォーム-->
      <form class="bg-gray-100 py-4" id='searchForm' style='display:none;' method="GET" action="{{ route('searchpost')}}">
        <!--ハッシュタグ検索-->
        <div class='py-2'>
          <label class='p-5'>ハッシュタグ検索</label>
          <input type='text' name='tag' value='{{ $tag }}' placeholder='#初心者'>
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
              <option value="{{ $id }}">{{ $category_name }}</option>
            @endforeach
          </select>
        </div>
        <!--プルダウン難易度選択-->
        <div class='py-2'>
          <label class="p-5">難易度</label>
          <select name="difficultyId" class="form-control" value="{{ $difficultyId }}">
            <option value="">未選択</option>
            @foreach($difficulties as $id => $difficulty_name)
            <option value="{{ $id }}">{{ $difficulty_name }}</option>
            @endforeach
          </select>
        </div>
        <div class='flex items-center justify-center px-4'>
          <button type="submit" class='rounded bg-blue-500 text-white hover:bg-blue-700 h-fit w-full'>検索</button>
        </div>
      </form>
      <!--検索結果テーブル 検索された時のみ表示する-->
      @if (!empty($posts))
      <p class=''>全{{ $posts->count() }}件</p>
      <div class='flex flex-wrap -m-4'>
        <!--投稿の表示-->
        @foreach($posts as $post)
        <div class='p-4 md:w-1/3'>
          <div class='h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden hover:tansform hover:duration-1000 hover:scale-110'>
            <img class='lg:h-48 md:h-36 w-full object-cover object-center' src='https://placehold.jp/ffffff/1e1515/720x400.png?text=stepBystep' alt='画像'>
            <div class='p-6'>
              <h1 class='h-8 overflow-hidden text-lg title-font font-medium text-gray-900 mb-3'>{{ $post->title }}</h1>
              <a href='/categories/{{ $post->category->id }}'>
                <h2 class='text-xs title-font font-medium text-gray-400 hover:text-black mb-1'>カテゴリー：{{ $post->category->name }}</h2>
              </a>
              <h2 class='text-xs title-font font-medium text-gray-400 mb-1'>難易度：{{ $post->difficulty->name }}</h2>
              <div class='flex justify-between items-center'>
                <a href='/posts/{{ $post->id }}' class='text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0'>
                  投稿を見る
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-2">
                    <path stroke-linecap="round" stroke-linejoin="round"  d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </a>
                <!--いいね-->
                @auth
                @if (!$post->isLikedBy(Auth::user()))
                <span class="likes text-gray-400">
                  <i class="fas fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
                  <span class="like-counter">{{$post->likes_count}}</span>
                </span>
                @else
                <span class="likes">
                  <i class="fas fa-heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
                  <span class="like-counter">{{$post->likes_count}}</span>
                </span>
                @endif
                @endauth
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <!--テーブルここまで-->
      <!--ページネーション-->
      {{-- appendsでカテゴリを選択したまま遷移 --}}
      <div class='flex flex-col text-white'>
        {{ $posts->appends(request()->input())->links() }}
      </div>
      @endif
    </div>
  </div>
    <!--投稿作成-->
    <div class='fixed bottom-5 right-5'>
      <a href="{{ route('post.create') }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
          stroke="currentColor" class="w-20 h-20 text-green-600 opacity-70">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </a>
    </div>
  <!--検索フォームの表示・非表示-->
  <script src="{{ asset('js/app.js') }}"></script>
</x-app-layout>