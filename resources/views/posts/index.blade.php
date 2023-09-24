<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
  <div class='bg-gradient-to-r from-purple-800 via-blue-800 to-indigo-700 min-h-full'>
    <div class="mx-auto py-2 container">
      <!--検索フォーム-->
      <form class="md:flex justify-center p-5" method="GET" action="{{ route('searchpost')}}">
        <!--タイトル検索-->
        <div>
          <label class="text-white p-5">タイトル検索</label>
          <input type="text" class="" name="searchWord" value="{{ $searchWord }}">
        </div>
        <!--プルダウンカテゴリ選択-->
        <div>
          <label class="text-white p-5">カテゴリ</label>
          <select name="categoryId" class="" value="{{ $categoryId }}">
            <option value="">未選択</option>

            @foreach($categories as $id => $category_name)
            <option value="{{ $id }}">
              {{ $category_name }}
            </option>
            @endforeach
          </select>
        </div>
        <!--プルダウン難易度選択-->
        <div>
          <label class="text-white p-5">難易度</label>
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
        <p class='hover:text-red-500 w-fit'><a href="/categories/{{ $post->category->id }}">カテゴリー：{{
            $post->category->name }}</a></p>
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
      <div class='flex justify-end p-4'>
        <div class="rounded bg-blue-500 hover:bg-blue-700 text-white w-fit">
          <a href='/posts/create'>投稿する</a>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>