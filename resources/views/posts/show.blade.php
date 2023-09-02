<x-app-layout>
    <!--カテゴリー-->
    <a fref="">{{ $post->category->name }}</a>
    <!--タイトル-->
    <h1 class="title">
        {{ $post->title }}
    </h1>
    <!--本文-->
    <div class="content">
        <div class="content_post">
            <p>{{ $post->body }}</p>
        </div>
    </div>
    <!--返信-->
    <div class="content">
        <div class="content_reply">
            {{--<p>{{ $reply->body }}</p>--}}
            <a href='/replies/create/{{ $post->id }}'>返信する</a>
        </div>
    </div>
    <br>
    <!--返信一覧表示-->
    <h3>返信一覧</h3>
    <br>
    <div class="content_reply">
            @foreach($post->replies as $reply)
                <div class="content">
                    <div class="content_contents">
                        <a href='/replies/{{ $reply->id }}'><p>{{ $reply->body }}</p></a>
                    </div>
                </div>
                <br>
            @endforeach
    </div>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
</x-app-layout>
