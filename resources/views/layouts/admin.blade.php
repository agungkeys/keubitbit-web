<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config("app.name", "Laravel") }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=Nunito"
            rel="stylesheet"
        />

        <!-- Scripts -->
        @vite('resources/css/app.css')
    </head>
    <body>
        <div id="root">
            <div class="drawer lg:drawer-open drawer-mobile">
                <input
                    id="left-sidebar-drawer"
                    type="checkbox"
                    class="drawer-toggle"
                />
                <div class="drawer-content flex flex-col">
                  <div class="navbar flex justify-between bg-base-100 z-10 shadow-md">
                    <div class="">
                        <label for="left-sidebar-drawer" class="btn btn-primary drawer-button lg:hidden">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-5 inline-block w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path></svg>
                        </label>
                        <h1 class="text-2xl font-semibold ml-2">Judul Halaman</h1>
                    </div>

                    <div class="order-last">
                        <div class="dropdown dropdown-end ml-4">
                            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                                <div class="w-10 rounded-full">
                                <img src="https://placehold.co/80x80" alt="profile" />
                                </div>
                            </label>
                            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                                <li class="justify-between">
                                  <a href="#">
                                      Profile
                                  </a>
                                </li>
                                <li>
                                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                  </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                  </div>
                  <main class="flex-1 overflow-y-auto pt-8 px-6 bg-base-200">@yield('content')</main>
                </div>
                @include('layouts.admin-sidebar') 
            </div>

            <!-- Right drawer - containing secondary content like notifications list etc.. -->
            <!-- <RightSidebar /> -->

            <!-- Notification layout container -->
            <!-- <NotificationContainer /> -->

            <!-- Modal layout container -->
            <!-- <ModalLayout /> -->
            
        </div>
    </body>
</html>
