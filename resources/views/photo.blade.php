@extends('layouts.app') 
@section('title', 'Photo - Keubitbit Aceh Ethnic Music - Official Website')
@section('content')
<section class="bg-center bg-contain bg-[url('https://res.cloudinary.com/domqavi1p/image/upload/w_1000,ar_16:9,c_fill,g_auto,e_sharpen/v1699408853/IMG_2542_h32fv9.webp')]">
  <div class="p-5 md:p-10 py-6 md:py-[7em] justify-center items-center" style="background: rgba(59, 38, 6, 0.5)">
    <h1 class="text-white text-center text-3xl md:text-5xl font-bold tracking-wider">Photo</h1>
  </div>
</section>
<section class="container py-4 mb-8">
  <h2 class="text-lg md:text-2xl font-semibold md:font-bold mb-4">All Photos</h2>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
    @foreach ($galleries as $gallery)
    @php
      $img = json_decode($gallery->image);
    @endphp
      <div class="w-100">
        <a href="/gallery/photo/{{$gallery->slug}}" target="_blank">
          <div class="">
            <img class="rounded-md w-full object-cover h-48" width="400" height="400" src="{{$img->realImage}}" alt="{{$gallery->name}}" />
          </div>
          <h2 class="card-title text-xl md:text-2xl font-philosopher pt-2">{{$gallery->name}}</h2>
        </a>
        <!-- <div class="mt-1 md:mt-4 mb-4 md:mb-0 text-base md:text-lg">{!!$gallery->detail !!}</div> -->
      </div>
    @endforeach
  </div>
</section>
@endsection