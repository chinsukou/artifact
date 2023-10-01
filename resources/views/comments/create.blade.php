<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
  <div class='bg-white h-full'>
    <div class='mx-auto py-2 container'>
      <h1 class='font-semibold'>コメント作成</h1>
      <div class='border rounded bg-white p-3'>
        <!--コメント対象の投稿-->
        <div class='flex text-sm'>
          <div class=''>
            {{ $reply->post->user->name }}
          </div>
        </div>
        <h2>{{ $reply->post->title }}</h2>
        <p>{{ $reply->post->body }}</p>
        <div class='flex justify-between'>
          <div class='text-sm'>
              {{ $reply->post->created_at }}
          </div>
          <div class=''>
          @auth
          <!-- Post.phpに作ったisLikedByメソッドをここで使用 -->
          @if (!$post->isLikedBy(Auth::user()))
          <span class="likes">
            <i class="fas fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
            <span class="like-counter">{{$post->likes_count}}</span>
          </span><!-- /.likes -->
          @else
          <span class="likes">
            <i class="fas fa-heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
            <span class="like-counter">{{$post->likes_count}}</span>
          </span><!-- /.likes -->
          @endif
          @endauth
          </div>
        </div>
      </div>
      <div class='border rounded bg-white p-3'>
        <!--コメント対象の返信-->
        <div class='flex text-sm'>
          <div class=''>
            {{ $reply->user->name }}
          </div>
        </div>
        <p>{{ $reply->body }}</p>
        <div class='text-sm'>
          {{ $reply->created_at }}
        </div>
      </div>
      <!--コメント一覧表示-->
      @foreach($comments as $comment)
      <div class="border rounded bg-white p-3">
        <div class='flex text-sm'>
          <div class=''>
            {{ $comment->user->name }}
          </div>
        </div>
        <p>{{ $comment->body }}</p>
        <div class='text-sm'>
          {{ $comment->created_at }}
        </div>
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