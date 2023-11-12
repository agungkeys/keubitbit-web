@extends('layouts.app') 
@section('title', 'Tour - Keubitbit Aceh Ethnic Music - Official Website')
@section('content')
<section class="bg-center bg-contain bg-[url('https://res.cloudinary.com/domqavi1p/image/upload/v1699408853/IMG_2542_h32fv9.webp')]">
  <div class="p-5 md:p-10 py-6 md:py-[7em] justify-center items-center" style="background: rgba(59, 38, 6, 0.5)">
    <h1 class="text-white text-center text-3xl md:text-5xl font-bold tracking-wider">Tour</h1>
  </div>
</section>
<section class="container py-4 md:py-8">
  <div 
    class="flex gap-2 md:gap-4 mb-4 md:mb-8"
    x-data="{ data: datatourfilter }"
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
  @if(count($tours) > 0)
    @foreach ($tours as $data)
      @php
        $img = json_decode($data->image);
      @endphp
      <a href="{{$data->link}}" target="_blank">
        <div class="card shadow-xl my-4 border-[1px] border-gray-100 hover:text-white hover:bg-secondary hover:border-secondary">
          <div class="card-body p-4">
            <div class="flex">
              <h1 class="flex-1 text-xl font-semibold line-clamp-1">{{$data->name}}</h1>
              <div>
                <span class="text-base text-gray-400">{{$data->location}}</span>
              </div>
            </div>
          </div>
        </div>
      </a>
    @endforeach
  @else
    <div class="card shadow-xl my-4 border-[1px] border-gray-100">
      <div class="card-body p-2 md:p-4">
        <div class="flex text-center">
          <h1 class="flex-1 text-xl line-clamp-1 text-gray-800">Don't have any tours schedule</h1>
        </div>
      </div>
    </div>
  @endif
</section>
@endsection