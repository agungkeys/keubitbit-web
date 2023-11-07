@extends('layouts.app') 
@section('title', 'Gallery - Keubitbit Aceh Ethnic Music - Official Website')
@section('content')
<section class="bg-bottom bg-cover bg-[url('https://res.cloudinary.com/domqavi1p/image/upload/c_crop,h_340,w_1200/v1690537335/IMG20230623185903_y1nptl.webp')]">
  <div class="p-5 md:p-10 py-6 md:py-[7em] justify-center items-center" style="background: rgba(59, 38, 6, 0.5)">
    <h1 class="text-white text-center text-3xl md:text-5xl font-bold tracking-wider">Gallery</h1>
  </div>
</section>
<section class="container">
  <div class="py-[4em] md:py-[6em] flex justify-center gap-8 md:gap-6">
    <div class="card card-compact w-96 bg-base-100 shadow-xl">
      <figure><img class="max-h-32 md:max-h-52 p-2" src="https://res.cloudinary.com/domqavi1p/image/upload/v1699333932/icons/photos-icon_btrary.png" alt="More Photo" /></figure>
      <div class="card-body">
        <h2 class="card-title">Gallery Photos</h2>
        <div class="card-actions justify-end">
          <a href="/gallery/photo" class="btn btn-md md:btn-lg btn-secondary w-full">More Photo</a>
        </div>
      </div>
    </div>
    <div class="card card-compact w-96 bg-base-100 shadow-xl">
      <figure><img class="max-h-32 md:max-h-52 p-2" src="https://res.cloudinary.com/domqavi1p/image/upload/v1699333897/icons/video_tnqf1l.png" alt="More Photo" /></figure>
      <div class="card-body">
        <h2 class="card-title">Gallery Videos</h2>
        <div class="card-actions justify-end">
          <a href="/gallery/video" class="btn btn-md md:btn-lg btn-secondary w-full">More Video</a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection