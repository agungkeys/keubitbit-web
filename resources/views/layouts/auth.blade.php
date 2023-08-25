<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>CMS Administrator for Keubitbit</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }} " />
    <meta name="description" content="Everything about gigs, albums of Keubitbit Aceh Ethnic Music" />
    <meta name="keywords" content="Keubitbit, Ethnic Music, Keubitbit Indonesia" />
    <meta name="author" content="Agung Kurniawan" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:title" content="CMS Administrator for Keubitbit" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" />

    <!-- Scripts -->
    @vite('resources/css/app.css')
  </head>
  <body>
    <main>@yield('content')</main>
  </body>
</html>
