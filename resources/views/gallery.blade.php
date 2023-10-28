@extends('layouts.app') 
@section('title', 'Gallery - Keubitbit Aceh Ethnic Music - Official Website')
@section('content')
<section class="bg-bottom bg-cover bg-[url('https://res.cloudinary.com/domqavi1p/image/upload/c_crop,h_340,w_1200/v1690537335/IMG20230623185903_y1nptl.webp')]">
  <div class="p-5 md:p-10 py-6 md:py-[7em] justify-center items-center" style="background: rgba(59, 38, 6, 0.5)">
    <h1 class="text-white text-center text-3xl md:text-5xl font-bold tracking-wider">Gallery of Keubitbit</h1>
  </div>
</section>
<section class="container">
  <div class="py-2 md:py-[3em] flex justify-center gap-8 md:gap-6">
    <a href="/gallery/photo" class="btn btn-secondary btn-md md:btn-lg capitalize">More Photo</a>
    <a href="/gallery/video" class="btn btn-secondary btn-md md:btn-lg capitalize">More Video</a>
  </div>
</section>
@endsection