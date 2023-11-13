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

  @if(request()->input('filter'))
  <h2 class="text-lg md:text-2xl font-semibold md:font-bold mb-4">Filtered by <span>{{request()->input('filter')}}</span> tour</h2>
  @else
  <h2 class="text-lg md:text-2xl font-semibold md:font-bold mb-4">All tour</h2>
  @endif
  
  @if(count($tours) > 0)
    @foreach ($tours as $data)
      @php
        $img = json_decode($data->image);
      @endphp
      <div>
        <div class="card shadow-xl my-4 border-[1px] border-gray-100 hover:text-white hover:bg-secondary hover:border-secondary">
          <div class="card-body p-4">
            <div class="grid md:grid-rows-none md:grid-cols-4 items-center">
              <div>
                <span class="text-base md:text-xl">{{\Carbon\Carbon::parse($data->date_gigs)->format('M j, Y')}}</span>
              </div>
              <div>
                <h1 class="text-xl font-semibold line-clamp-1">{{$data->name}}</h1>
              </div>
              <div>
                <span class="text-base md:text-xl">{{$data->location}}</span>
              </div>
              <div class="text-right">
                <a class="btn btn-sm md:btn-circle" href="{{$data->link}}">
                  <span class="md:hidden">More Info</span>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>                  
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
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