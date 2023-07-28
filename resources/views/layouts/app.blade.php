<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@hasSection('title') @yield('title') @else Default Page @endif</title>
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}} " />
    <meta name="description" content="Everything about gigs, albums of Keubitbit Aceh Ethnic Music" />
    <meta name="keywords" content="Keubitbit, Ethnic Music, Keubitbit Indonesia" />
    <meta name="author" content="Agung Kurniawan" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property=’og:title’ content="{{@hasSection('title') @yield('title') @else Default Page @endif}}" />
    <meta property=’og:image’ content="https://res.cloudinary.com/domqavi1p/image/upload/c_fill,w_300,h_300/v1690546337/ab67616d0000b273adaa917ccb54739ec80f2684_vgms6p.jpg" />
    <meta property=’og:description’ content="Everything about gigs, albums of Keubitbit Aceh Ethnic Music" />
    <meta property=’og:url’ content="https://keubitbit.com" />
    <meta property='og:image:width' content='300' />
    <meta property='og:image:height' content='300' />

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.3/dist/cdn.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <!-- {{asset('rockinger.png')}} -->

    <!-- Scripts -->
    @vite('resources/css/app.css')
  </head>
  <body class="font-hindi">
    @include('layouts.app-header') 
    <div id="root" class="bg-white">
      <main>@yield('content')</main>
    </div>
    @include('layouts.app-footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
    <script>
      const datamenu = [
        {
          id: 0,
          name: "home",
          label: "Home",
          link: "/"
        },{
          id: 1,
          name: "about",
          label: "About",
          link: "/about"
        },{
          id: 2,
          name: "video",
          label: "Video",
          link: "/video"
        },{
          id: 3,
          name: "music",
          label: "Music",
          link: "/music"
        },{
          id: 4,
          name: "tour",
          label: "Tour",
          link: "/tour"
        },{
          id: 5,
          name: "merchandise",
          label: "Merchandise",
          link: "/merchandise"
        },{
          id: 6,
          name: "contact",
          label: "Contact",
          link: "/contact"
        }
      ];

      const datasocialfooter = [
        {
          id: 0,
          name: "groundup",
          image: "https://res.cloudinary.com/domqavi1p/image/upload/v1690539710/groundup-white_sivrmn.webp",
          link: "/"
        },
        {
          id: 1,
          name: "apple-music",
          image: "https://res.cloudinary.com/domqavi1p/image/upload/v1690539805/applemusic-white_vhybzx.webp",
          link: "/"
        },{
          id: 2,
          name: "facebook",
          image: "https://res.cloudinary.com/domqavi1p/image/upload/v1690539844/facebook-white_ejzyil.webp",
          link: "/"
        },{
          id: 3,
          name: "twitter",
          image: "https://res.cloudinary.com/domqavi1p/image/upload/v1690539886/twitter-white_zj1p5f.webp",
          link: "/"
        },{
          id: 4,
          name: "instagram",
          image: "https://res.cloudinary.com/domqavi1p/image/upload/v1690539927/instagram-white_thzdpf.webp",
          link: "/"
        },{
          id: 5,
          name: "youtube",
          image: "https://res.cloudinary.com/domqavi1p/image/upload/v1690539951/youtube-white_ciu5ol.webp",
          link: "/"
        }
      ];

      const datalatestrelease = {
        album: "Peuneurah Bumoe",
        image: "https://res.cloudinary.com/domqavi1p/image/upload/v1690546337/ab67616d0000b273adaa917ccb54739ec80f2684_vgms6p.webp",
        year: "2023",
        songs: [
          {
            id: 0,
            name: "SiCupak Lada",
            description: "Keubitbit",
            file: ""
          },{
            id: 1,
            name: "Sep Sep Hansep",
            description: "Keubitbit, Fahmil Arabi",
            file: ""
          },{
            id: 2,
            name: "Bak Tajak",
            description: "Keubitbit, Fahmil Arabi",
            file: ""
          },{
            id: 3,
            name: "Eu mak Eu",
            description: "Keubitbit, Fahmil Arabi",
            file: ""
          },{
            id: 4,
            name: "ANGEN",
            description: "Keubitbit, Fahmil Arabi",
            file: ""
          },{
            id: 5,
            name: "Rhambule",
            description: "Keubitbit, Fahmil Arabi",
            file: ""
          }
        ]
      }
    </script>
    @yield('js')
  </body>
</html>
