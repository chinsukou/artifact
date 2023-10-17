<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>stepBystep 投稿作成</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
  <div class='bg-white h-full'>
    <div class='mx-auto px-5 py-2 container'>
      <h1 class='font-semibold mb-2'>投稿作成</h1>
      <div>※画像投稿は現在開発中です.ご迷惑をおかけします.</div>
      <div class='border-2 border-gray-200 rounded-lg'>
        @if(isset($post->public_id))
        <img class='lg:h-48 md:h-36 w-full object-cover object-center' src='{{ $post->public_id }}' alt='画像'>
        @else
        <img class='w-full object-cover object-center my-2'
          src='https://placehold.jp/ffffff/1e1515/720x400.png?text=stepBystep' alt='画像'>
        @endif
        <form action="/posts" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="file" name="image">
          <!--タイトル-->
          <div class="my-2">
            <input class='border-none w-full' type="text" name="post[title]" placeholder="タイトル(目的)"
              value="{{ old('post.title') }}" />
            <p class="title_error" style="color:red">{{ $errors->first('post.title') }}</p>
          </div>
          <div class='my-2'>
            <!--カテゴリーの選択-->
            <div>
              <select class='font-bold border-none w-full' name="post[category_id]">
                @foreach($categories as $category)
                <option value="{{ $category->id }}">カテゴリー：{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
            <!--難易度の選択-->
            <div class=''>
              <select class='font-bold border-none w-full' name="post[difficulty_id]">
                @foreach($difficulties as $difficulty)
                <option value="{{ $difficulty->id }}">教材の難易度：{{ $difficulty->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <!--本文-->
          <div class="">
            <textarea class='border-none border-top resize-none h-1/3 w-full' name="post[body]"
              placeholder="おすすめしたい教材.当時の自分のレベルなどを投稿してください.">#ハッシュタグをつけよう！&#13;&#10;&#13;&#10;・取り組み当時の自分のレベル&#13;&#10;&#13;&#10;・おすすめできるところ&#13;&#10;&#13;&#10;・おすすめできないところ&#13;&#10;&#13;&#10;・その他（リンクなど）{{ old('post.body') }}</textarea>
            <p class="body_error" style="color:red">{{ $errors->first('post.body') }}</p>
          </div>
      </div>
      <div class='flex justify-end p-4'>
        <input class='rounded bg-blue-500 hover:bg-blue-700 text-white w-fit' type="submit" value="投稿する" />
      </div>
      </form>
      <div class="rounded bg-blue-500 hover:bg-blue-700 text-white w-fit">
        <a href="/posts">戻る</a>
      </div>
    </div>
  </div>
</x-app-layout>