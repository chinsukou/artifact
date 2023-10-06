<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <meta name="csrf-token" content="{{ csrf_token() }}">
          <link rel="stylesheet" href="{{ asset('css/style.css') }}">
          <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
          @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>Welcome</title>
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- Styles -->
    </head>
    <body class='welcome-bg'>
        <div class='container h-full mx-auto p-10'>
            <h1 class='text-4xl font-semibold font-serif text-center mb-5'>stepBystep</h1>
            <div class='tracking-wider bg-white h-2/3 overflow-y-scroll p-10 mb-5'>
                <p class='py-2'>stepBystepをご覧下さりありがとうございます！</p>
                <p class='py-2'>こちらのWebアプリは、現在情報系の学部に通っている大学生が作成した自分のおすすめの教材などを共有できる掲示板です。</p>
                <p class='text-lg font-bold py-2'>「本でもネットでも教材が多すぎてどれを選べばいいのかわからない！」</p>
                <p class='py-2'>そんな悩みをなくすためのアプリです。</p>
                <p class='py-2'>今後もアップデートしていきますのでぜひご利用ください!</p>
                <p class='py-2'>※メールアドレスによっては認証メールが届かない場合があります。</p>
                <p class='py-2'>※迷惑メールに届いてないかも確認してください。</p>
            </div>
                <div class=''>
                <div class='flex justify-center mb-4'>
            @if (Route::has('login'))
                @auth
                <div class='bg-white rounded-lg text-center p-2'>
                    <a href="{{ url('/posts') }}" class="text-sm text-white bg-black">Homeへ</a>
                </div>
                @else
                    
                <div class='bg-black rounded-lg text-center p-2'>
                    <a href="{{ route('login') }}" class="text-lg text-white">ログイン</a>
                </div>
                    @if (Route::has('register'))
                    <div class='bg-black rounded-lg text-center p-2 ml-4'>
                        <a href="{{ route('register') }}" class="text-lg text-white">新規登録</a>
                    </div>
                    @endif
                @endauth
            @endif
                </div>
                    <div class='flex justify-center'>
                    <div class='bg-white rounded-lg text-center w-fit p-2'>
                    <a href="{{ url('/posts') }}" class="text-sm text-gray-400">ログインせずに見る</a>
                    </div>
                    </div>
                </div>
        </div>
    </body>
</html>
