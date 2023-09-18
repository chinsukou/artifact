<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
  <div class="mx-auto container">
    <!--検索フォーム-->
    <form class="md:flex justify-center" method="GET" action="{{ route('searchpost')}}">
      <!--タイトル検索-->
      <div>
        <label class="p-5">タイトル検索</label>
        <input type="text" class="" name="searchWord" value="{{ $searchWord }}">
      </div>
      <!--プルダウンカテゴリ選択-->
      <div>
        <label class="p-5">カテゴリ</label>
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
      <div class='flex items-center justify-center'>
        <button type="submit" class='border rounded bg-blue-500 h-full w-full'>検索</button>
      </div>
    </form>

    <!--検索結果テーブル 検索された時のみ表示する-->
    @if (!empty($posts))
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
      {{ $posts->appends(request()->input())->links() }}
    @endif
    </div>
    <div class="text-center rounded border bg-blue-500 w-20">
        <a href='/posts/create'>投稿する</a>
    </div>
</x-app-layout>
