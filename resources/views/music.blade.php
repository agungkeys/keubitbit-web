@extends('layouts.app') 
@section('title', 'Music - Keubitbit Aceh Ethnic Music - Official Website')
@section('content')
  <section class="bg-bottom bg-cover bg-[url('https://res.cloudinary.com/domqavi1p/image/upload/c_crop,h_340,w_1200/v1690537335/IMG20230623185903_y1nptl.webp')]">
    <div class="p-5 md:p-10 py-6 md:py-[7em] justify-center items-center" style="background: rgba(59, 38, 6, 0.5)">
      <h1 class="text-white text-center text-3xl md:text-5xl font-bold tracking-wider">Music</h1>
    </div>
  </section>
  <section class="container py-4 md:py-10">
    @foreach ($musics as $music)
      @php
        $img = json_decode($music->image);
      @endphp
      <div class="card card-side shadow-xl border-2 border-gray-50 mb-12" style='background: linear-gradient(rgba(255, 255, 255, 0.75), rgba(255, 255, 255, 1), rgba(255, 255, 255, 1)),url("{{$img->realImage}}"); background-size: contain; background-position: top center;'>
        <div class="grid grid-cols-1 md:grid-cols-3">
          <div class="col-span-1 min-h-[300px]">
            {!!$music->iframe!!}
          </div>
          <div class="card-body col-span-1 md:col-span-2">
            <div class="text-black">
              <div class="flex gap-4 md:gap-2 mb-2 md:mb-0">
                <a href="{{$music->link_spotify}}" target="_blank" class="btn glass btn-md">
                  <img src="https://res.cloudinary.com/domqavi1p/image/upload/v1694177096/icons/3669986_lu9urg.webp" width="25" height="25" />
                  <span class="hidden md:block">Spotify</span>
                </a>
                <a href="{{$music->link_youtube}}" target="_blank" class="btn glass btn-md">
                  <img src="https://res.cloudinary.com/domqavi1p/image/upload/v1694177235/icons/10091411_llil1j.webp" width="25" height="25" />
                  <span class="hidden md:block">Music</span>
                </a>
                <a href="{{$music->link_apple}}" target="_blank" class="btn glass btn-md">
                  <img src="https://res.cloudinary.com/domqavi1p/image/upload/v1694177281/icons/7566380_iqnpmb.webp" width="25" height="25" />
                  <span class="hidden md:block">Apple</span>
                </a>
              </div>
              <h2 class="card-title text-2xl md:text-3xl font-philosopher pt-2">{{$music->name}}</h2>
              <h2 class="mt-0 text-xl md:text-3xl text-yellow-600 font-philosopher">{{$music->date_release}}</h2>
              <div id="wysiwyg" class="text-black text-lg tracking-wider my-2">
                {!!$music->detail!!}
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </section>
  <section class="pb-4 md:pb-10">
    <h1 class="text-center text-3xl md:text-5xl font-bold mb-5">More album of Keubitbit</h1>
    <div class="container max-w-lg">
      <div class="grid gap-4 grid-cols-2">
        <a href="https://open.spotify.com/artist/6W34RUeAaZxU7giOCVfG25" target="_blank" class="btn btn-md btn-secondary text-white">
          <img src="https://res.cloudinary.com/domqavi1p/image/upload/v1694177096/icons/3669986_lu9urg.webp" width="25" height="25" />
          <span>Spotify</span>
        </a>
        <a href="https://music.apple.com/id/artist/keubitbit/1589699514" target="_blank" class="btn btn-md btn-secondary text-white">
          <img src="https://res.cloudinary.com/domqavi1p/image/upload/v1694177281/icons/7566380_iqnpmb.webp" width="25" height="25" />
          <span>Apple</span>
        </a>
      </div>
    </div>
  </section>

@endsection
