<x-app-layout>
    <h1>カテゴリ別</h1>
    <br>
    <!--投稿を表示する-->
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
    <div>
        <a href='/posts/create'>投稿する</a>
    </div>
    <br>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
    <!--現在ログインしているユーザー-->
    <p>ログインユーザー:{{ Auth::user()->name }}</p>
</x-app-layout>
