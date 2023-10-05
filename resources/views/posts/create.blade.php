<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <img class='lg:h-48 md:h-36 w-full object-cover object-center' src='https://dummyimage.com/720x400' alt='画像'>
      <form action="/posts" method="POST">
        @csrf
        <!--タイトル-->
        <div class="">
          <input class='border-none w-full' type="text" name="post[title]" placeholder="タイトル"
            value="{{ old('post.title') }}" />
          <p class="title_error" style="color:red">{{ $errors->first('post.title') }}</p>
        </div>
        <div class=''>
          <!--カテゴリーの選択-->
          <div>
            <select class='border-none w-full' name="post[category_id]">
              @foreach($categories as $category)
              <option value="{{ $category->id }}">カテゴリー：{{ $category->name }}</option>
              @endforeach
            </select>
          </div>
          <!--難易度の選択-->
          <div class=''>
            <select class='border-none w-full' name="post[difficulty_id]">
              @foreach($difficulties as $difficulty)
              <option value="{{ $difficulty->id }}">難易度：{{ $difficulty->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <!--本文-->
        <div class="">
          <textarea class='border-none resize-none h-1/3 w-full' name="post[body]"
            placeholder="おすすめしたい教材.当時の自分のレベルなどを投稿してください.">{{ old('post.body') }}</textarea>
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