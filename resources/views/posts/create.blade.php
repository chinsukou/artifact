<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
  <div class='bg-white h-full'>
    <div class='mx-auto py-2 container'>
      <h1 class='font-semibold'>投稿作成</h1>
      <form action="/posts" method="POST">
        @csrf
        <div class=''>
          <!--カテゴリーの選択-->
          <div>
            <select class='border-gray-300 rounded w-full' name="post[category_id]">
              @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>
          <!--難易度の選択-->
          <div class=''>
            <select class='border-gray-300 rounded w-full' name="post[difficulty_id]">
              @foreach($difficulties as $difficulty)
              <option value="{{ $difficulty->id }}">{{ $difficulty->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <!--タイトル-->
        <div class="border rounded bg-white">
          <input class='w-full border-none' type="text" name="post[title]" placeholder="タイトル"
            value="{{ old('post.title') }}" />
          <p class="title_error" style="color:red">{{ $errors->first('post.title') }}</p>
        </div>
        <!--本文-->
        <div class="border rounded bg-white">
          <textarea class='resize-none h-1/3 w-full border-gray-300' name="post[body]"
            placeholder="投稿を入力してください。">{{ old('post.body') }}</textarea>
          <p class="body_error" style="color:red">{{ $errors->first('post.body') }}</p>
        </div>
        <div class='flex justify-end p-4'>
          <input class='rounded bg-blue-500 hover:bg-blue-700 text-white w-fit' type="submit" value="投稿する" />
        </div>
      </form>
      <div class="rounded bg-blue-500 hover:bg-blue-700 text-white w-fit">
        <a href="/">戻る</a>
      </div>
    </div>
  </div>
</x-app-layout>