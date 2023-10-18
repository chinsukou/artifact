<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
  <div class='bg-white h-full'>
    <div class="container px-5 mx-auto">
      <!--投稿を表示する-->
      <div class='font-semibold'>{{ $category->name }}カテゴリ</div>
      {{--<p class=''>全{{ $posts->count() }}件</p>--}}
      <div class='flex flex-wrap -m-4'>
        @foreach ($posts as $post)
          <div class='p-4 md:w-1/3'>
            <div class='h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden hover:tansform hover:duration-1000 hover:scale-110'>
              @if(isset($post->main_img))
              <img class='lg:h-48 md:h-36 w-full object-cover object-center' src='{{ $post->main_img }}' alt='画像'>
              @else
              <img class='w-full object-cover object-center my-2'
                src='https://placehold.jp/ffffff/1e1515/720x400.png?text=stepBystep' alt='画像'>
              @endif
              <div class='p-6'>
                <h1 class='h-8 overflow-hidden text-lg title-font font-medium text-gray-900 mb-3'>{{ $post->title }}</h1>
                <a href='/categories/{{ $post->category->id }}'>
                  <h2 class='text-xs title-font font-medium text-gray-400 hover:text-black mb-1'>カテゴリー：{{ $post->category->name }}</h2>
                </a>
                <h2 class='text-xs title-font font-medium text-gray-400 mb-1'>難易度：{{ $post->difficulty->name }}</h2>
                <div class='flex justify-between items-center'>
                  <a href='/posts/{{ $post->id }}' class='text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0'>
                    投稿を見る
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-2">
                      <path stroke-linecap="round" stroke-linejoin="round"  d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                  </a>
                  <!--いいね-->
                  @auth
                  @if (!$post->isLikedBy(Auth::user()))
                  <span class="likes text-gray-400">
                    <i class="fas fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
                    <span class="like-counter">{{$post->likes_count}}</span>
                  </span>
                  @else
                  <span class="likes">
                    <i class="fas fa-heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
                    <span class="like-counter">{{$post->likes_count}}</span>
                  </span>
                  @endif
                  @endauth
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</x-app-layout>