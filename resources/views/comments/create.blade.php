<x-app-layout>
    <h1>コメント作成</h1>
    <!--コメント対象の投稿-->
    {{--<h2>{{ $post->title }}</h2>
    <p>{{ $post->body }}</p>
    <!--コメント対象の返信-->
    <p>{{ $reply->body }}</p>--}}
    <form action="/replies/show/{{ $reply->id }}" method="POST">
        @csrf
        <!--コメント本文-->
        <div class="body">
            <h2>本文</h2>
            <textarea name="comment[body]" placeholder="コメントを入力してください。">{{ old('comment.body') }}</textarea>
            <p class="comment_error" style="color:red">{{ $errors->first('comment.body') }}</p>
        </div>
        <input type="submit" value="コメントする"/>
    </form>
    <div class="footer">
        <a href="/posts/">戻る</a>
    </div>
</x-app-layout>