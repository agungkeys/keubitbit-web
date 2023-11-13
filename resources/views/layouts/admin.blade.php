<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin CMS Keubitbit.com</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }} " />
  <meta name="description" content="Everything about gigs, albums of Keubitbit Aceh Ethnic Music" />
  <meta name="keywords" content="Keubitbit, Ethnic Music, Keubitbit Indonesia" />
  <meta name="author" content="Agung Kurniawan" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta property="og:title" content="@hasSection('title')
@yield('title')
@else
Default Page
@endif" />
  <meta property="og:image" content="https://res.cloudinary.com/domqavi1p/image/upload/c_fill,w_300,h_300/v1690546337/ab67616d0000b273adaa917ccb54739ec80f2684_vgms6p.jpg" />
  <meta property="og:description" content="Everything about gigs, albums of Keubitbit Aceh Ethnic Music" />
  <meta property="og:url" content="https://keubitbit.com" />
  <meta property="og:image:width" content="300" />
  <meta property="og:image:height" content="300" />
  <meta property="og:image:alt" content="keubitbit" />
  <meta property="og:image:type" content="image/jpg" />

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link rel="dns-prefetch" href="//fonts.bunny.net" />
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" />

  <!-- Scripts -->
  @vite('resources/css/app.css')
</head>

<body data-theme="light">
  <div id="root">
    <div class="drawer lg:drawer-open drawer-mobile">
      <input id="left-sidebar-drawer" type="checkbox" class="drawer-toggle" />
      <div class="drawer-content flex flex-col">
        <div class="navbar flex justify-between bg-base-100 z-10 shadow-md">
          <div class="">
            <label for="left-sidebar-drawer" class="btn btn-primary drawer-button lg:hidden">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-5 inline-block w-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
              </svg>
            </label>
            <h1 class="text-2xl font-semibold ml-2">
              @hasSection('title')
                @yield('title')
              @else
                Default Page
              @endif
            </h1>
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
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.3/dist/cdn.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script> -->
  <script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
  <script>
    const datasidebar = [{
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
      }, {
        id: 2,
        name: "users",
        label: "User",
        link: "/admin/users?sortDirection=desc&sortColumn=id",
        isLabel: false,
      }, {
        id: 3,
        name: "members",
        label: "Member",
        link: "/admin/members",
        isLabel: false,
      }, {
        id: 4,
        name: "milestones",
        label: "Milestone",
        link: "/admin/milestones?sortDirection=desc&sortColumn=id",
        isLabel: false,
      }, {
        id: 5,
        name: "musics",
        label: "Music",
        link: "/admin/musics?sortDirection=desc&sortColumn=id",
        isLabel: false,
      }, {
        id: 6,
        name: "tours",
        label: "Tour Schedule",
        link: "/admin/tours?sortDirection=desc&sortColumn=id",
        isLabel: false,
      }, {
        id: 8,
        name: "articles",
        label: "Article & News",
        link: "/admin/articles?sortDirection=desc&sortColumn=id",
        isLabel: false,
      }, {
        id: 9,
        name: "galleries",
        label: "Gallery",
        link: "/admin/galleries",
        isLabel: false,
      }, {
        id: 10,
        name: "videos",
        label: "Video",
        link: "/admin/videos?sortDirection=desc&sortColumn=id",
        isLabel: false,
      }, {
        id: 11,
        name: "banners",
        label: "Banner",
        link: "/admin/banners?sortDirection=desc&sortColumn=id",
        isLabel: false,
      }, {
        id: 12,
        name: "newsletter",
        label: "Newsletter",
        link: "/admin/newsletter?sortDirection=desc&sortColumn=id",
        isLabel: false,
      }, {
        id: 13,
        name: "contacts",
        label: "Contacts",
        link: "/admin/contacts?sortDirection=desc&sortColumn=id",
        isLabel: false,
      }
    ];
  </script>
  @if (Session::has('success'))
    <script>
      toastr.options = {
        "closeButton": true,
        "progressBar": true
      }
      toastr.success("{{ session('success') }}");
    </script>
  @endif

  @if (Session::has('error'))
    <script>
      toastr.options = {
        "closeButton": true,
        "progressBar": true
      }
      toastr.error("{{ session('error') }}");
    </script>
  @endif

  @if (Session::has('info'))
    <script>
      toastr.options = {
        "closeButton": true,
        "progressBar": true
      }
      toastr.info("{{ session('info') }}");
    </script>
  @endif

  @if (Session::has('warning'))
    <script>
      toastr.options = {
        "closeButton": true,
        "progressBar": true
      }
      toastr.warning("{{ session('warning') }}");
    </script>
  @endif
  @yield('js')
</body>

</html>
