<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Admin CMS Keubitbit.com</title>

        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.3/dist/cdn.min.js"></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=Nunito"
            rel="stylesheet"
        />

        <!-- Scripts -->
        @vite('resources/css/app.css')
    </head>
    <body data-theme="corporate">
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
                                <img src="https://res.cloudinary.com/domqavi1p/image/upload/v1690634584/favicon_ablvyf.webp" alt="profile" />
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
        <script>
          const datasidebar = [
            {
              id: 0,
              name: "dashboard",
              label: "Dashboard",
              link: "/dashboard",
              isLabel: false,
            },
            {
              id: 1,
              name: "data master",
              label: "Data Master",
              link: "",
              isLabel: true,
            },{
              id: 2,
              name: "user",
              label: "User",
              link: "/admin/users",
              isLabel: false,
            },{
              id: 3,
              name: "member",
              label: "Member",
              link: "/admin/members",
              isLabel: false,
            },{
              id: 4,
              name: "music",
              label: "Music",
              link: "/admin/musics",
              isLabel: false,
            },{
              id: 5,
              name: "tour",
              label: "Tour",
              link: "/admin/tours",
              isLabel: false,
            },{
              id: 6,
              name: "store",
              label: "Store",
              link: "/admin/stores",
              isLabel: false,
            },{
              id: 7,
              name: "article",
              label: "Article & News",
              link: "/admin/articles",
              isLabel: false,
            },{
              id: 8,
              name: "gallery",
              label: "Gallery",
              link: "/admin/galleries",
              isLabel: false,
            },{
              id: 9,
              name: "video",
              label: "Video",
              link: "/admin/videos",
              isLabel: false,
            },{
              id: 10,
              name: "banner",
              label: "Banner",
              link: "/admin/banners",
              isLabel: false,
            },{
              id: 11,
              name: "newsletter",
              label: "Newsletter",
              link: "/admin/newsletter",
              isLabel: false,
            }
          ]
        </script>
        @yield('js')
    </body>
</html>
