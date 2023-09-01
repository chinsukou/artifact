<x-app-layout>
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
            <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
            <p class="title_error" style="color:red">{{ $errors->first('post.title') }}</p>
        </div>
        <!--本文-->
        <div class="body">
            <h2>本文</h2>
            <textarea name="post[body]" placeholder="投稿を入力してください。">{{ old('post.body') }}</textarea>
            <p class="body_error" style="color:red">{{ $errors->first('post.body') }}</p>
        </div>
        <input type="submit" value="投稿する"/>
    </form>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
</x-app-layout>