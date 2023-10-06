<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>stepBystep コメント作成</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  <style>
    .link {
      color: #3B82F6;
    }
    .link:hover {
      color: #1D4ED8;
    }
  </style>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
  <div class='bg-white h-full'>
    <div class='mx-auto px-5 py-2 container'>
      <h1 class='font-semibold'>コメント作成</h1>
      <div class="border-2 rounded-lg border-gray-200 p-3 mb-3">
        <h1 class='text-xl title-font font-medium mb-2'>{{ $reply->post->title }}</h1>
        <div class='text-sm text-gray-500 mb-4'>
          <h2 class='ml-2'>{{ $reply->post->user->name }}</h2>
          <h2 class='ml-2'>カテゴリー：{{ $reply->post->category->name }}</h2>
          <h2 class='ml-2'>難易度：{{ $reply->post->difficulty->name }}</h2>
        </div>
        <!--リンク改行を有効にして$post->bodyを表示する-->
        <p class=''>{!! nl2br($post->makeLink(e($reply->post->body))) !!}</p>
        <img class='w-full object-cover object-center my-2' src='https://placehold.jp/ffffff/1e1515/720x400.png?text=stepBystep' alt='画像'>
        <div class='flex justify-between'>
          <div class='text-sm text-gray-400'>{{ $reply->post->created_at }}</div>
          <div class=''>
            @auth
            <!-- Post.phpに作ったisLikedByメソッドをここで使用 -->
            @if (!$post->isLikedBy(Auth::user()))
            <span class="likes text-gray-400">
              <i class="fas fa-heart like-toggle" data-post-id="{{ $reply->post->id }}"></i>
              <span class="like-counter">{{$reply->post->likes_count}}</span>
            </span><!-- /.likes -->
            @else
            <span class="likes">
              <i class="fas fa-heart like-toggle liked" data-post-id="{{ $reply->post->id }}"></i>
              <span class="like-counter">{{$reply->post->likes_count}}</span>
            </span><!-- /.likes -->
            @endif
            @endauth
          </div>
        </div>
      </div>
      <!--コメント対象の返信-->
      <div class="border-2 rounded-lg border-gray-200 p-3 mb-2">
        <div class='text-gray-400 mb-2'>{{ $reply->user->name }}</div>
        <!--リンク改行を有効にして$post->bodyを表示する-->
        <p class='mb-2'>{!! nl2br($post->makeLink(e($reply->body))) !!}</p>
        <div class='text-sm text-gray-400'>{{ $reply->created_at }}</div>
      </div>
      <!--コメント一覧表示-->
      @foreach($comments as $comment)
      <div class="border-2 rounded-lg border-gray-200 p-3 mb-2">
        <div class='text-gray-400 mb-2'>{{ $comment->user->name }}</div>
        <!--リンク改行を有効にして$post->bodyを表示する-->
        <p class='mb-2'>{!! nl2br($post->makeLink(e($comment->body))) !!}</p>
        <div class='text-sm text-gray-400'>{{ $comment->created_at }}</div>
      </div>
      @endforeach
      <form action="/replies/show/{{ $reply->id }}" method="POST">
        @csrf
        <!--コメント本文-->
        <div class="body">
          <textarea class='resize-none h-1/5 w-full border-gray-300' name="comment[body]"
            placeholder="コメントを入力してください。">{{ old('comment.body') }}</textarea>
          <p class="comment_error" style="color:red">{{ $errors->first('comment.body') }}</p>
        </div>
        <div class='flex justify-end p-4'>
          <input class='rounded bg-blue-500 hover:bg-blue-700 text-white w-fit' type="submit" value="コメントする" />

        </div>
      </form>
      <div class="rounded bg-blue-500 hover:bg-blue-700 text-white w-fit">
        <a href="/replies/{{ $reply->id }}">戻る</a>
      </div>
    </div>
  </div>
</x-app-layout>