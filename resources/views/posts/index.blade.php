
<x-app-layout>
    <h1>HOME</h1>
    <br>
    
    <div class="container">
    <div class="mx-auto">
      <br>
      <h2 class="text-center">検索</h2>
      <br>
      <!--検索フォーム-->
      <div class="row">
        <div class="col-sm">
          <form method="GET" action="{{ route('searchpost')}}">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">内容検索</label>
              <!--入力-->
              <div class="col-sm-5">
                <input type="text" class="form-control" name="searchWord" value="{{ $searchWord }}">
              </div>
              <div class="col-sm-auto">
                <button type="submit" class="btn btn-primary ">検索</button>
              </div>
            </div>     
            <!--プルダウンカテゴリ選択-->
            <div class="form-group row">
              <label class="col-sm-2">カテゴリ</label>
              <div class="col-sm-3">
                <select name="categoryId" class="form-control" value="{{ $categoryId }}">
                  <option value="">未選択</option>

                  @foreach($categories as $id => $category_name)
                  <option value="{{ $id }}">
                    {{ $category_name }}
                  </option>  
                  @endforeach
                </select>
              </div>
              <!--プルダウン難易度選択-->
              <label class="col-sm-2">難易度</label>
              <div class="col-sm-3">
                <select name="difficultyId" class="form-control" value="{{ $difficultyId }}">
                  <option value="">未選択</option>

                  @foreach($difficulties as $id => $difficulty_name)
                  <option value="{{ $id }}">
                    {{ $difficulty_name }}
                  </option>  
                  @endforeach
                </select>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    
    <!--検索結果テーブル 検索された時のみ表示する-->
    @if (!empty($posts))
    <div class="postsTable">
      <p>全{{ $posts->count() }}件</p>
        @foreach($posts as $post)
            <p><a href="/categories/{{ $post->category->id }}">カテゴリー：{{ $post->category->name }}</a></p>
            <p><a href="/difficulties/{{ $post->difficulty->id }}">難易度：{{ $post->difficulty->name }}</a></p>
            <a href="/posts/{{ $post->id }}">
            <h2 class='title'>{{ $post->title }}</h2>
                <p class='body'>{{ $post->body }}</p>&nbsp;
            </a>
        @endforeach   
    </div>
    <!--テーブルここまで-->
    <!--ページネーション-->
    <div class="d-flex justify-content-center">
      {{-- appendsでカテゴリを選択したまま遷移 --}}
      {{ $posts->appends(request()->input())->links() }}
    </div>
    <!--ページネーションここまで-->
    @endif
  </div>
    
{{--    <!--投稿を表示する-->
    <div class='posts'>
        @foreach ($posts as $post)
            <div class='posts'>
                <p><a href="/categories/{{ $post->category->id }}">カテゴリー：{{ $post->category->name }}</a></p>
                <p><a href="/difficulties/{{ $post->difficulty->id }}">難易度：{{ $post->difficulty->name }}</a></p>
                <a href="/posts/{{ $post->id }}">
                    <h2 class='title'>
                        {{ $post->title }}
                        <br>
                    </h2>
                    <p class='body'>{{ $post->body }}</p>
                </a>
            </div>
            <br>
        @endforeach
    </div>
    <!--ページネイション-->
    <div class='paginate'>
        {{ $posts->links() }}
    </div>
    <!--投稿ページへ-->
    <div>--}}
        <a href='/posts/create'>投稿する</a>
    </div>
    <br>
    <!--現在ログインしているユーザー-->
    <p>ログインユーザー:{{ Auth::user()->name }}</p>
</x-app-layout>
