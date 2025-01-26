@extends('layouts.app') 
@section('title', 'Photo - Keubitbit Aceh Ethnic Music - Official Website')
@section('content')
<section class="bg-center bg-cover bg-[url('https://res.cloudinary.com/domqavi1p/image/upload/v1699408853/IMG_2542_h32fv9.webp')]">
  <div class="p-5 md:p-10 py-6 md:py-[7em] justify-center items-center" style="background: rgba(59, 38, 6, 0.5)">
    <h1 class="text-white text-center text-3xl md:text-4xl font-bold tracking-wider">{{$gallery->name}}</h1>
  </div>
</section>
<section class="container py-4 mb-8 mt-4">
  <!-- <h2 class="text-lg md:text-2xl font-semibold md:font-bold mb-4">{{$gallery->name}}</h2> -->
  <div class="grid grid-cols-2 md:grid-cols-2 gap-10">
    @foreach ($photos as $photo)
    @php
      $img = json_decode($photo->image);
    @endphp
      <div class="w-100">
        <a href="{{$img->realImage}}" data-toggle="lightbox" data-gallery="example-gallery">
          <img src="{{$img->realImage}}" alt="{{$gallery->name}}" style="height: 20em;" class="rounded-md w-full object-cover" class="img-fluid">
        </a>
        <!-- <a href="#" target="_blank">
          <div class="">
            <img style="height: 20em;" class="rounded-md w-full object-cover" width="400" height="400" src="{{$img->realImage}}" alt="{{$gallery->name}}" />
          </div>
          <h2 class="card-title text-xl md:text-2xl font-philosopher pt-2">{{$gallery->name}}</h2>
        </a> -->
        <!-- <div class="mt-1 md:mt-4 mb-4 md:mb-0 text-base md:text-lg">{!!$gallery->detail !!}</div> -->
      </div>
    @endforeach
  </div>
</section>
@endsection

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
@endsection