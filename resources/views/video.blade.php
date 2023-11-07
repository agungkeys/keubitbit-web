@extends('layouts.app') 
@section('title', 'Video - Keubitbit Aceh Ethnic Music - Official Website')
@section('content')
<section class="bg-bottom bg-cover bg-[url('https://res.cloudinary.com/domqavi1p/image/upload/c_crop,h_340,w_1200/v1690537335/IMG20230623185903_y1nptl.webp')]">
  <div class="p-5 md:p-10 py-6 md:py-[7em] justify-center items-center" style="background: rgba(59, 38, 6, 0.5)">
    <h1 class="text-white text-center text-3xl md:text-5xl font-bold tracking-wider">Video</h1>
  </div>
</section>
<section class="container py-8">
  <div 
    class="flex gap-4 mb-8"
    x-data="{ data: datacategoryvideos }"
  >
    <template x-for="item in data">
      <a
        x-text="item.label" 
        x-bind:href="item.link"
        x-bind:class="!pathname && item.name === 'home' && styleselected || pathname === item.name ? styleselected : ''"
        class="btn btn-sm md:btn-lg btn-secondary hover:text-white"
      >
          -
      </a>
    </template>
  </div>
  @if(request()->input('filter'))
  <h2 class="text-lg md:text-2xl font-semibold md:font-bold mb-4">Filtered by <span>{{request()->input('filter')}}</span> videos</h2>
  @else
  <h2 class="text-lg md:text-2xl font-semibold md:font-bold mb-4">All videos</h2>
  @endif
  <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
    @foreach ($videos as $video)
        @php
          $img = json_decode($video->image);
        @endphp
        <div class="w-100">
          <div class="">
            {!!$video->iframe_youtube!!}
          </div>
          <a href="{{$video->link}}" target="_blank">
            <h2 class="card-title text-2xl md:text-3xl font-philosopher pt-4">{{$video->name}}</h2>
          </a>
          <div class="mt-4 text-sm md:text-lg">{!!$video->detail !!}</div>
        </div>
    @endforeach
  </div>
</section>
@endsection