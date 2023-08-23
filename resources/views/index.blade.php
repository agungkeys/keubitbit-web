@extends('layouts.app') 
@section('title', 'Keubitbit Aceh Ethnic Music - Official Website')
@section('content')
<div class="">
  <div 
    x-data="{ data: datalatestrelease}"
    class="relative bg-cover bg-center bg-[url(https://res.cloudinary.com/domqavi1p/image/upload/v1690546337/ab67616d0000b273adaa917ccb54739ec80f2684_vgms6p.webp)]">
    <div class="py-2 md:py-6" style="background: rgba(0, 0, 0, 0.8)">
      <h1 class="text-center py-2 md:py-4 text-3xl md:text-5xl font-bold">Latest Release</h1>
      <div class="container pt-2 md:pt-4">
        <span class="text-base md:text-lg">Album:</span>
        <h1 class="text-white pt-1 text-2xl md:text-5xl" x-text="data.album"></h1>
      </div>
      <div class="container grid grid-cols-3 gap-6 pt-1 md:pt-3">
        <div class="col-span-3 md:col-span-1">
          <img class="rounded-md w-full" width="400" height="400" src="https://res.cloudinary.com/domqavi1p/image/upload/v1690546337/ab67616d0000b273adaa917ccb54739ec80f2684_vgms6p.webp" alt="album #1" />
        </div>
        <div class="col-span-3 md:col-span-2">
          <!-- <div class="flex gap-3">
            <button class="btn btn-sm md:btn-md btn-success btn-outline">Spotify</button>
            <button class="btn btn-sm md:btn-md btn-primary btn-outline">Apple Music</button>
            <button class="btn btn-sm md:btn-md btn-error btn-outline">Youtube</button>
          </div> -->
          <iframe style="border-radius:12px" src="https://open.spotify.com/embed/album/2WItxRtYnXr3rZPsSEq8S0?utm_source=generator&theme=0" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
          <!-- <ul class="mt-3 menu w-full rounded-box text-white">
            <template x-for="item in data.songs">
              <li class="w-full">
                <div class="flex justify-between items-center">
                  <div class="flex gap-2 items-center">
                    <div>
                      <div class="avatar placeholder">
                        <div class="border-[1px] border-white rounded-full w-8">
                          <span class="text-xs md:text-base" x-text="item.id+1"></span>
                        </div>
                      </div>
                    </div>
                    <div class="">
                      <h2 class="text-sm md:text-base" x-text="item.name"></h2>
                      <p class="text-xs md:text-sm font-light text-gray-400" x-text="item.description"></p>
                    </div>
                  </div>
                  <div>
                    <span>Play</span>
                  </div>
                </div>
              </li>
            </template>
          </ul> -->
        </div>
      </div>
    </div>
  </div>
  

  <div class="hero container pt-2 md:pt-4 pb-3 md:pb-6">
    <div class="hero-content gap-6 flex-col-reverse lg:flex-row">
      <div class="text-center md:text-left">
        <!-- <h1 class="text-3xl text-black md:text-5xl font-bold font-great">Keubitbit</h1>
        <span class="text-xs md:text-sm">Aceh Ethnic Music</span> -->
        <img class="w-56 mx-auto md:mx-0" src="https://res.cloudinary.com/domqavi1p/image/upload/v1690634689/logo-long_yewhbj.webp" />
        <p class="text-black py-b md:pb-6 text-base md:text-lg">
          Keubibitt departs from anxiety about culture which has begun to fade slowly with time. The feeling of love because the cause is no longer a reference, to foster longing for the process of cultural events.
        </p>
        <p class="mt-2 text-black py-b md:pb-6 text-base md:text-lg">
          Keubibit exists as an adhesive for modern culture and traditional culture side by side to present to the world.
        </p>
        <a href="/about" class="btn btn-secondary btn-md md:btn-md capitalize">Read More</a>
      </div>
      <div id="gallery" class="relative w-full" data-carousel="slide">
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
          <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img
              src="https://res.cloudinary.com/domqavi1p/image/upload/v1690457739/keubitbit_p9zx93.webp"
              class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 rounded-lg"
              alt="Photo Slider 1" />
          </div>
          <div
            class="hidden duration-700 ease-in-out"
            data-carousel-item="active">
            <img
              src="https://res.cloudinary.com/domqavi1p/image/upload/v1690536179/Indra_121_teelfi.webp"
              class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 rounded-lg"
              alt="Photo Slider 2" />
          </div>
          <div
            class="hidden duration-700 ease-in-out"
            data-carousel-item="active">
            <img
              src="https://res.cloudinary.com/domqavi1p/image/upload/v1690536801/Indra_88_bnhtd1.webp"
              class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 rounded-lg"
              alt="Photo Slider 3" />
          </div>
        </div>
        <button
          type="button"
          class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
          data-carousel-prev>
          <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg
              class="w-4 h-4 text-white dark:text-gray-800"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 6 10">
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M5 1 1 5l4 4" />
            </svg>
            <span class="sr-only">Previous</span>
          </span>
        </button>
        <button
          type="button"
          class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
          data-carousel-next>
          <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg
              class="w-4 h-4 text-white dark:text-gray-800"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 6 10">
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m1 9 4-4-4-4" />
            </svg>
            <span class="sr-only">Next</span>
          </span>
        </button>
      </div>
    </div>
  </div>

  <div class="divider"></div> 

  <section class="container py-6">
    <div class="flex justify-between items-center">
      <h1 class="text-black text-3xl md:text-5xl font-bold">Latest Videos</h1>
      <a href="https://www.youtube.com/@KeubitbitAtjehEthnicMusic" class="btn btn-secondary btn-md md:btn-md capitalize">More Videos</a>
    </div>
    <div class="py-2 md:py-4 grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-6">
      <div class="card shadow-xl bg-contain bg-[url('https://res.cloudinary.com/domqavi1p/image/upload/c_fill,h_200,w_500/v1690519461/ART_WORK_KEUBITBIT_emiyy9.webp')]">
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/RcPB6GtYTYQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        <div class="card-body">
          <span class="text-xl text-primary">Keubitbit - Hembala (Tribute For Endatu) Live Moscow Jazz Festival 2023</span>
          <p class="mt-2 text-lg">By: Keubitbit</p>
        </div>
      </div>

      <div class="card shadow-xl bg-contain bg-[url('https://res.cloudinary.com/domqavi1p/image/upload/c_fill,h_200,w_500/v1690519461/ART_WORK_KEUBITBIT_emiyy9.webp')]">
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/_1KiJRbX-J0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        <div class="card-body">
          <span class="text-xl text-primary">Keubitbit - Sep Sep Hansep Live Moscow Jazz Festival 2023</span>
          <p class="mt-2 text-lg">By: Keubitbit</p>
        </div>
      </div>

      <div class="card shadow-xl bg-contain bg-[url('https://res.cloudinary.com/domqavi1p/image/upload/c_fill,h_200,w_500/v1690519461/ART_WORK_KEUBITBIT_emiyy9.webp')]">
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/GvM4L0hK2Kc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        <div class="card-body">
          <span class="text-xl text-primary">Keubitbit - Bak Tajak Live Moscow Jazz Festival 2023</span>
          <p class="mt-2 text-lg">By: Keubitbit</p>
        </div>
      </div>
      
    </div>
  </section>

</div>
@endsection
@section('js')
<script type="text/javascript" src="https://instaembedcode.com/in.js"></script>
@endsection


