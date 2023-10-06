<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<x-app-layout>
    <div class='bg-white h-full'>
        <div class='container px-5 mx-auto'>
            <div class='text-2xl'>プロフィール</div>
            <h2 class='text-lg'>名前：{{ Auth::user()->name }}</h2>
            <h3>登録日：{{ Auth::user()->created_at }}</h3>
            <h2>自己紹介</h2>
            <div class='h-fit'>大学生です</div>{{--
            <div>{{ Auth::user()->profile }}</div>--}}
        </div>
    </div>
</x-app-layout>