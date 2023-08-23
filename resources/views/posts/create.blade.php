<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>新規投稿作成</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
    <body>
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
            <br>
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
                <input type="text" name="post[title]" placeholder="タイトル">
            </div>
            <!--本文-->
            <div class="body">
                <h2>本文</h2>
                <textarea name="post[body]" placeholder="ご自由におかきください。"></textarea>
            </div>
            <!--投稿するユーザー-->
            <select name="post[user_id]">
                <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
            </select>
            <input type="submit" value="投稿する"/>
        </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
    </x-app-layout>
</html>