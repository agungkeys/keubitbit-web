@extends('layouts.app') 
@section('title', 'Keubitbit Aceh Ethnic Music - Official Website')
@section('content')
<div>
  @if($musicFeatured)
  @php
    $img = json_decode($musicFeatured->image);
  @endphp
  <div style='background: url("{{$img->realImage}}"); background-size: contain; background-position: top center;' class="relative bg-cover bg-center">
    <div class="py-2 md:py-6 h-auto md:h-[48rem]" style="background: rgba(0, 0, 0, 0.8)">
      <h1 class="text-center py-2 md:py-4 text-3xl md:text-5xl font-bold">Latest Release</h1>
      <div class="container pt-2 md:pt-4">
        <span class="text-secondary text-base md:text-xl">Album:</span>
        <h1 class="text-white pt-1 text-2xl md:text-5xl font-philosopher">{{$musicFeatured->name}}</h1>
      </div>
      <div class="container grid grid-cols-3 gap-6 pt-1 md:pt-3">
        <div class="col-span-3 md:col-span-1">
          <img class="rounded-md w-full" width="400" height="400" src="{{$img->realImage}}" alt="album #1" />
        </div>
        <div class="col-span-3 md:col-span-2">
          <div class="flex gap-2 mb-4">
            @if($musicFeatured->link_spotify)
            <a href="{{$musicFeatured->link_spotify}}" target="_blank" class="btn glass">
              <img src="https://res.cloudinary.com/domqavi1p/image/upload/v1694177096/icons/3669986_lu9urg.webp" width="25" height="25" />
              Spotify
            </a>
            @endif
            @if($musicFeatured->link_youtube)
            <a href="{{$musicFeatured->link_youtube}}" target="_blank" class="btn glass">
              <img src="https://res.cloudinary.com/domqavi1p/image/upload/v1694177235/icons/10091411_llil1j.webp" width="25" height="25" />
              Music
            </a>
            @endif
            @if($musicFeatured->link_apple)
            <a href="{{$musicFeatured->link_apple}}" target="_blank" class="btn glass">
              <img src="https://res.cloudinary.com/domqavi1p/image/upload/v1694177281/icons/7566380_iqnpmb.webp" width="25" height="25" />
              Apple
            </a>
            @endif
          </div>
          {!!$musicFeatured->iframe!!}
        </div>
      </div>
    </div>
  </div>
  @endif
  
  <section class="hero container mt-10 md:mt-14 pb-3 md:pb-6">
    <div class="flex md:flex-row flex-col-reverse gap-2 items-center">
      <div class="basis-1/1 md:basis-1/2 text-center md:text-left">
        <img class="w-56 mx-auto md:mx-0" src="https://res.cloudinary.com/domqavi1p/image/upload/v1690634689/logo-long_yewhbj.webp" />
        <p class="text-black py-b md:pb-6 text-base md:text-lg">
          Keubibitt departs from anxiety about culture which has begun to fade slowly with time. The feeling of love because the cause is no longer a reference, to foster longing for the process of cultural events.
        </p>
        <p class="mt-2 text-black py-b md:pb-6 text-base md:text-lg">
          Keubibit exists as an adhesive for modern culture and traditional culture side by side to present to the world.
        </p>
        <a href="/about" class="mt-4 md:mt-4 btn btn-secondary btn-md md:btn-lg capitalize">Read More</a>
      </div>
      <div class="basis-1/1 md:basis-1/2">
        <div class="slider grid">
          @foreach ($banners as $banner)
            @php
              $img = json_decode($banner->image);
            @endphp
            <div class="item">
              <img
                src="{{$img->realImage}}"
                class="object-cover rounded-lg"
                alt="{{$banner->name}}" 
              />
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <div class="divider"></div> 

  <section class="container py-6">
    <div class="flex justify-between items-center">
      <h1 class="text-black text-3xl md:text-5xl font-bold">Latest Videos</h1>
    </div>
    <div class="py-2 md:py-4 grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-6">
      @foreach ($videos as $video)
        @php
          $img = json_decode($video->image);
        @endphp
        <div class="card shadow-xl bg-contain bg-[url('https://res.cloudinary.com/domqavi1p/image/upload/c_fill,h_200,w_500/v1690519461/ART_WORK_KEUBITBIT_emiyy9.webp')]">
          {!!$video->iframe_youtube!!}
          <div class="card-body p-4 md:p-6">
            <span class="text-xl md:text-2xl text-primary font-philosopher">{{$video->name}}</span>
            <div class="mt-1 text-sm md:text-base text-white">{!!$video->detail!!}</div>
          </div>
        </div>
      @endforeach 
    </div>
    <div class="text-center py-4 md:py-8">
      <a href="/gallery/video" class="btn btn-secondary btn-md md:btn-lg capitalize">More Videos</a>
    </div>
  </section>

</div>
@endsection
@section('js')
<!-- <script type="text/javascript" src="https://instaembedcode.com/in.js"></script> -->
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
  $('.slider').slick({
    draggable: true,
    autoplay: true,
    autoplaySpeed: 2000,
    dots: true,
    infinite: true,
    speed: 300
  });
</script>
@endsection


