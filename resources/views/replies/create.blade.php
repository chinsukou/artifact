<x-app-layout>
    <h1>返信</h1>
    <!--返信対象の投稿-->
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>
    <form action="/posts/show/{{ $post->id }}" method="POST">
        @csrf
        <!--返信本文-->
        <div class="body">
            <h2>本文</h2>
            <textarea name="reply[body]" placeholder="返信を入力ください。">{{ old('reply.body') }}</textarea>
            <p class="reply_error" style="color:red">{{ $errors->first('reply.body') }}</p>
        </div>
        <input type="submit" value="返信する"/>
    </form>
    <div class="footer">
        <a href="/posts/">戻る</a>
    </div>
</x-app-layout>