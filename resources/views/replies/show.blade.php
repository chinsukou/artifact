<x-app-layout>
    <!--カテゴリー-->
    <!--本文-->
    <div class="content">
       <div class="content_post">
           <p>{{ $post->body }}</p>
       </div>
    </div>
    <!--返信-->
    <div class="content">
       <div class="content_post">
           <p>{{ $reply->body }}</p>
       </div>
    </div>
    <br>
    <!--コメント一覧表示-->
    <div class="content_reply">
        @foreach($comments as $comment)
            <div class="content">
                <div class="content_contents">
                    <br>
                    <p>{{ $comment->body }}</p>
                </div>
            </div>
            <br>
        @endforeach
        <a href='/comments/create/{{ $reply->id }}'>コメントする</a>
    </div>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
</x-app-layout>