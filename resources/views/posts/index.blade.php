<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">

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
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-6 h-6">
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
      <div class="rounded border bg-white hover:bg-gray-100 p-3">
        <div class='flex text-sm'>
          <div class=''>
            {{ $post->user->name }}
          </div>
          <div class='px-3'>
            {{ $post->created_at }}
          </div>
        </div>
        <a href="/categories/{{ $post->category->id }}">
          <p class='hover:text-red-500'>カテゴリー：{{ $post->category->name }}</p>
        </a>
        <a href="/posts/{{ $post->id }}">
          <p>難易度：{{ $post->difficulty->name }}</p>
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
          <i class="fas fa-heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
          <span class="like-counter">{{$post->likes_count}}</span>
        </span><!-- /.likes -->
        @endif
        @endauth
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
  <script src="{{ asset('js/app.js') }}"></script>
</x-app-layout>