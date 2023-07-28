@extends('layouts.app') @section('content')
<div class="bg-base-200">
  <div 
    x-data="{ data: datalatestrelease}"
    class="relative bg-cover bg-center bg-[url(https://res.cloudinary.com/domqavi1p/image/upload/v1690546337/ab67616d0000b273adaa917ccb54739ec80f2684_vgms6p.webp)]">
    <div class="py-2 md:py-6" style="background: rgba(0, 0, 0, 0.8)">
      <h1 class="text-center py-2 md:py-4 text-3xl md:text-5xl font-great">Latest Release</h1>
      <div class="container pt-2 md:pt-6">
        <span class="text-sm md:text-base">Album:</span>
        <h1 class="text-white text-2xl md:text-5xl font-semibold" x-text="data.album"></h1>
      </div>
      <div class="container grid grid-cols-3 gap-4 pt-1 md:pt-3">
        <div class="col-span-3 md:col-span-1">
          <img class="rounded-md" src="https://res.cloudinary.com/domqavi1p/image/upload/v1690546337/ab67616d0000b273adaa917ccb54739ec80f2684_vgms6p.webp" alt="album #1" />
        </div>
        <div class="col-span-3 md:col-span-2">
          <div class="flex gap-3">
            <button class="btn btn-sm md:btn-md btn-success btn-outline">Spotify</button>
            <button class="btn btn-sm md:btn-md btn-primary btn-outline">Apple Music</button>
            <button class="btn btn-sm md:btn-md btn-error btn-outline">Youtube</button>
          </div>
          <ul class="mt-3 menu w-full rounded-box text-white">
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
          </ul>
        </div>
      </div>
    </div>
  </div>
  

  <div class="hero pt-2 md:pt-10 pb-4 md:pb-8">
    <div class="hero-content gap-6 flex-col-reverse lg:flex-row">
      <div>
        <h1 class="text-3xl md:text-5xlfont-bold font-great">Keubitbit</h1>
        <p class="py-6 text-sm md:text-base">
          Keubitbit merupakan grup yang mengangkat musik etnik asal Aceh dan dipadukan dengan unsur modern, dibentuk pada 2014 dengan membawa instrumen khas seperti rapai’, gendrang, seurunee kalee...
        </p>
        <button class="btn btn-primary btn-sm md:btn-md capitalize">Read More</button>
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
</div>
@endsection
