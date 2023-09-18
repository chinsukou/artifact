<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
    <div class='mx-auto container'>
        <h1>投稿作成</h1>
        <form action="/posts" method="POST">
            @csrf
            <!--カテゴリーの選択-->
            <div class="category">
                <h2>Category</h2>
                <select name="post[category_id]">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <!--難易度の選択-->
            <div>    
                <h2>Difficulty</h2>
                <select name="post[difficulty_id]">
                    @foreach($difficulties as $difficulty)
                        <option value="{{ $difficulty->id }}">{{ $difficulty->name }}</option>
                    @endforeach
                </select>
            </div>
            <!--タイトル-->
            <div class="title">
                <h2>タイトル</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
                <p class="title_error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <!--タグ-->
            <div class="tag">
                <h2>タグ</h2>
                <input type="text" name="tags" placeholder="#タグを付けましょう" value"{{ old('tags') }}"/>
                <p class="tag_error">{{ $errors->first('tags') }}</p>
            </div>
            <!--本文-->
            <div class="body">
                <h2>本文</h2>
                <textarea name="post[body]" placeholder="投稿を入力してください。">{{ old('post.body') }}</textarea>
                <p class="body_error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <input type="submit" value="投稿する"/>
        </form>
    </div>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
</x-app-layout>