@extends('layouts.app') 
@section('title', 'News - Keubitbit Aceh Ethnic Music - Official Website')
@section('content')
<section class="bg-bottom bg-cover bg-[url('https://res.cloudinary.com/domqavi1p/image/upload/c_crop,h_340,w_1200/v1690537335/IMG20230623185903_y1nptl.webp')]">
  <div class="p-5 md:p-10 py-6 md:py-[7em] justify-center items-center" style="background: rgba(59, 38, 6, 0.5)">
    <h1 class="text-white text-center text-3xl md:text-5xl font-bold tracking-wider">News</h1>
  </div>
</section>
<section class="container py-4 md:py-8">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
    @foreach ($news as $data)
      @php
        $img = json_decode($data->image);
      @endphp
      <div class="card card-compact bg-base-100 shadow-xl">
        <a href="{{$data->reference}}" target="_blank">
          <figure class="w-full h-[245px] min-h-[245px] rounded-t-2xl">
            <img class="object-cover w-full h-full" src="{{$img->realImage}}" alt="{{$data->name}}" />
          </figure>
        </a>
        <div class="card-body block">
          <a href="{{$data->reference}}" target="_blank">
            <h2 class="card-title line-clamp-2 font-philosopher text-base md:text-xl">{{$data->name}}</h2>
          </a>
          <div id="wysiwyg" class="mt-2 md:mt-4 text-base md:text-lg">{!!$data->detail !!}</div>
        </div>
      </div>
    @endforeach
  </div>  
</section>
@endsection