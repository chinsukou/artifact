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
      <div class='border-b border-gray-500 mb-5'>
      <div class='flex'>
        <div class='text-gray-500 py-5'>
          <a href='/user-prof/prof-other/{{ $user->id }}'>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-24 h-24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          </a>
        </div>
        <div class='py-8 ml-4'>
          <h2 class='text-lg mb-3'>名前：{{ $user->name }}</h2>
          <h3>登録日：{{ $user->created_at }}</h3>
        </div>
      </div>
        <div class='flex mb-5'>
          <a href='/follow-list/{{ $user->id }}'><div class='ml-4'>フォロー：{{ $followsCount }}</div></a>
          <a href='/followed-list/{{ $user->id }}'><div class='ml-4'>フォロワー：{{ $followersCount }}</div></a>
        </div>
      </div>
      <div class=''>
        @foreach($user->follows as $follow)
        <div class='flex text-center text-md border border-gray-500'>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 h-6 m-2">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          <div class='flex items-center'>
            {{ $follow->name }}
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</x-app-layout>