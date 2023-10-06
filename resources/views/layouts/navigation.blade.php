<nav x-data="{ open: false }" class="bg-white border-b border-black">
  <!-- Primary Navigation Menu -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <div class="flex">
        <!--アプリ名-->
        <div class="shrink-0 flex items-center">
          <div class="text-2xl font-serif font-semibold">
            <a href="/posts" class="">
              stepBystep
            </a>
          </div>
        </div>
      </div>
      <!-- Navigation Links -->
      <div class="hidden sm:flex sm:items-center sm:ml-6">
        <div class="space-x-5 -my-px ml-10 flex">
          <!--投稿一覧-->
          <x-nav-link :href="route('post.index')" :active="request()->routeIs('post.index')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-8 h-8">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
          </x-nav-link>
          <!--いいね一覧-->
          <x-nav-link :href="route('like.index')" :active="request()->routeIs('like.index')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-8 h-8">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
            </svg>
          </x-nav-link>{{--
          <!--投稿作成-->
          <x-nav-link :href="route('post.create')" :active="request()->routeIs('post.create')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-8 h-8">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </x-nav-link>--}}
          <!--ヒント-->{{--
          <x-nav-link :href="route('like.index')" :active="request()->routeIs('like.index')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
            </svg>
          </x-nav-link>--}}
        </div>
        <!-- Settings Dropdown -->
        <x-dropdown align="right" width="48">
          <x-slot name="trigger">
            <button
              class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
              @auth<div>{{ Auth::user()->name }}</div>@endauth

              <div class="ml-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              </div>
            </button>
          </x-slot>

          <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')">
              {{ __('プロフィール') }}
            </x-dropdown-link>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                              this.closest('form').submit();">
                {{ __('ログアウト') }}
              </x-dropdown-link>
            </form>
          </x-slot>
        </x-dropdown>
      </div>

      <!-- Hamburger -->
      <div class="-mr-2 flex items-center sm:hidden">
        <button @click="open = ! open"
          class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>
  <!-- Responsive Navigation Menu -->
  <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <!--Responsive Settings Options-->
    <div class="pt-4 pb-1 border-t border-gray-200">
      <div class="px-4">
        @auth
        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
        @endauth
      </div>

      <div class="mt-3 space-y-1">
        <x-responsive-nav-link :href="route('profile.edit')">
          {{ __('プロフィール') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('post.index')">
          {{ __('ホーム') }}
        </x-responsive-nav-link>{{--
        <x-responsive-nav-link :href="route('post.create')">
          {{ __('投稿作成') }}
        </x-responsive-nav-link>--}}
        <x-responsive-nav-link :href="route('like.index')">
          {{ __('いいね') }}
        </x-responsive-nav-link>{{--
        <x-responsive-nav-link :href="route('profile.edit')">
          {{ __('チュートリアル') }}
        </x-responsive-nav-link>--}}
        <!--Authentication-->
        <form method="POST" action="{{ route('logout') }}">
          @csrf

          <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                      this.closest('form').submit();">
            {{ __('ログアウト') }}
          </x-responsive-nav-link>
        </form>
      </div>
    </div>
  </div>
</nav>