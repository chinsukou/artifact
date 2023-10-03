<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
    <div class='mx-auto py-2 container'>
      <div class='font-semibold'>返信作成</div>
      <div class='border rounded bg-white p-3'>
        <!--返信対象の投稿-->
       <div class='flex text-sm'>
          <div class=''>
            {{ $post->user->name }}
          </div>
        </div>
        <!--カテゴリー-->
        <a fref="">{{ $post->category->name }}</a>
        <br>
        <!--難易度-->
        <a fref="">{{ $post->difficulty->name }}</a>
        <!--タイトル-->
        <h1 class="title">
          {{ $post->title }}
        </h1>
        <!--本文-->
        <div class="content_post">
          <!--リンク改行を有効にして$post->bodyを表示する-->
          <p>{!! nl2br($post->makeLink(e($post->body))) !!}</p>
          <div class='flex justify-between'>
          <div class='text-sm'>
              {{ $post->created_at }}
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
      </div>
      <form action="/posts/show/{{ $post->id }}" method="POST">
        @csrf
        <!--返信本文-->
        <div class="body">
          <textarea class='resize-none h-1/5 w-full border-gray-300' name="reply[body]"
            placeholder="返信を入力ください。">{{ old('reply.body') }}</textarea>
          <p class="reply_error" style="color:red">{{ $errors->first('reply.body') }}</p>
        </div>
        <div class='flex justify-end p-4'>
            <input class='rounded bg-blue-500 hover:bg-blue-700 text-white w-fit' type="submit" value="返信する" />
        </div>
      </form>
        <div class="rounded bg-blue-500 hover:bg-blue-700 text-white w-fit">
          <a href="/posts/">戻る</a>
        </div>
    </div>
  </div>
</x-app-layout>