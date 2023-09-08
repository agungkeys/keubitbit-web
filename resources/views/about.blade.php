@extends('layouts.app') 
@section('title', 'About - Keubitbit Aceh Ethnic Music - Official Website')
@section('content')
<div>
  <div class="bg-gradient-to-r from-[#d9d9d9] to-[#8b8b8b]">
    <div class="flex h-full md:h-[580px] w-[100%] md:w-[80%] mx-auto">
      <img class="w-full object-cover" src="https://res.cloudinary.com/domqavi1p/image/upload/v1692713285/keubitbit-group_q4p9ac.webp" />
    </div>
  </div>
  <div class="container">
    <!-- <h1 class="text-center text-black py-2 md:py-4 text-3xl md:text-5xl font-bold">About</h1> -->
    <div class="text-center pt-6 md:scroll-pt-10 md:py-6">
      <img
        class="w-52 mx-auto"
        src="https://res.cloudinary.com/domqavi1p/image/upload/v1690634689/logo-long_yewhbj.webp" 
        alt="Logo Keubitbit"
        width="144"
        height="40"
      />
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-14 my-3 md:my-3 pb-3 md:pb-10">
      <div class="col-span-3 md:col-span-2">
        <div class="text-base text-black md:text-lg tracking-wider text-justify">
          <p>
            Keubitbit departs from anxiety about culture which has begun to fade slowly with time. The feeling of love because the cause is no longer a reference, to foster longing for the process of cultural events.
          </p>
          <p class="mt-2">
            Keubibit exists as an adhesive for modern culture and traditional culture side by side to present to the world.
          </p>
        </div>
        <div class="text-base text-black md:text-lg tracking-wider text-justify">
          <p class="first-line:uppercase first-line:tracking-widest first-letter:text-7xl first-letter:font-bold first-letter:mr-2 first-letter:float-left">
            Keubtibit Ethnic Music is a music group that based on the
            spirit and nuance of the coastal music of Sumatra originating
            from Aceh, tried to explore further about the tradition of
            Aceh music, which is packaged in a modern and
            contemporary form. Keubitbit&apos;s works contains a lot social,
            culture and problems from various aspects, the uniqueness of
            keubitbit itself is the percussion and blowing from seurune
            kalee, also the melody has the color of middle eastern music,
            then complemented by unique rhythm from rapa&apos;i. Special
            touch of the fast singing technique using rhythmic music that
            makes Keubitbit music has a strong character.
          </p>
          <p class="mt-4">
            Rapa&apos;i (Aceh&apos;s instrument) and Serune Kalee (Aceh&apos;s flute)
            are the musical instruments that being used to strengthen
            the character of Keubitbit&apos;s songs, combined with the
            modern instruments will produce a perfect harmony.
          </p>
          <p class="mt-4">
            Keubitbit Hailed from Jakarta, and was formed early of June
            2014. The name of keubitbit itself also taken from aceh's
            language that means &quot;Heartily&quot;.
          </p>
          <p class="mt-4">
            Currently Keubitbit already released three albums in 2017,
            2021, 2023 and three singles in 2018 & 2019. One of the
            single that is called &quot;Pemulia Jamee&quot; was the results of a
            collaboration between the urban dance from Aceh that
            known as &quot;Ratoeh Jaroe&quot;.
            In 2020, Keubitbit won the Ami Awards as the best world
            music production work through a song called
            &quot;Saban Sabee&quot;
          </p>
        </div>
      </div>
      <div class="col-span-3 md:col-span-1">
        <div class="card shadow-lg border-[1px]">
          <div class="card-body">
            <h1 class="text-black text-center text-2xl font-light">Est. 2014 | <span class="font-bold">Jakarta, ID</span></h1>
          </div>
        </div>
        <section class="mt-6 md:mt-10">
          <div 
            x-data="{ data: datamilestone.reverse(), ismore: false, classes: `grid grid-rows-${Math.ceil(datamilestone.length/2)} grid-flow-col gap-4 mt-4`}"
          >
            <h1 class="text-black text-xl md:text-2xl font-bold">Milestone</h1>
            <ul x-show="!ismore" class="list-disc mx-4">
              <template x-for="item in data.slice(0, 5)">
                <li class="text-blue-900 text-base tracking-wider" x-text="item.name"></li>
              </template>
            </ul>
            <ul x-show="ismore" class="list-disc mx-4">
              <template x-for="item in data">
                <li class="text-blue-900 text-base tracking-wider" x-text="item.name"></li>
              </template>
            </ul>
            <button x-on:click="ismore = !ismore" x-text="ismore ? 'Hide' : 'More Milestone'" class="mt-2 btn btn-md btn-secondary w-full capitalize"></button>
          </div>
        </section>
      </div> 
    </div>
    <div class="text-center pb-8">
      <h1 class="text-center text-black py-2 mb-4 md:py-4 text-3xl md:text-5xl font-bold pb-4 md:pb-6">Award</h1>
      <div class="grid grid-cols-2 gap-4 justify-center items-center">
        <img width="200" height="200" src="https://res.cloudinary.com/domqavi1p/image/upload/v1694183195/icons/LOGO-AMI-Linkedin_oh1jts.webp" />
        <img width="350" height="200"  src="https://res.cloudinary.com/domqavi1p/image/upload/v1694183680/icons/94184754882-logo-api-2_jzkz7l.webp" />
      </div>
    </div>
  </div>

  <section class="bg-[url('https://res.cloudinary.com/domqavi1p/image/upload/c_fill,h_200,w_500/v1690519461/ART_WORK_KEUBITBIT_emiyy9.webp')]">
    <div class="container py-6">
      <h1 class="text-center py-2 md:py-4 text-3xl md:text-5xl font-bold">Discography</h1>
      <div x-data="{ data: datadiscography}" class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4 mb-4">
        <template x-for="item in data">
          <a target="_blank" x-bind:href="item.link" class="bg-secondary duration-500 hover:bg-black hover:text-white group card w-full">
            <div class="card-body p-5">
              <div class="flex justify-between items-center">
                <h2 class="capitalize font-bold text-sm md:text-base" x-text="item.name"></h2>
                <div class="group-hover:translate-x-2 duration-500">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                  </svg> 
                </div>         
              </div>
            </div>
          </a>
        </template>
      </div>
    </div>
  </section>

  <div>
    <section class="container">
      <div 
        class="py-6"
      >
        <h1 class="text-center text-black py-2 mb-4 md:py-4 text-3xl md:text-5xl font-bold pb-4 md:pb-6">The Band</h1>
        @foreach ($members as $member)
          @php
            $img = json_decode($member->image);
          @endphp
          <div class="grid grid-cols-1 md:grid-cols-3 gap-0 md:gap-12 pb-10 md:pb-20">
            <div class="col-span-1">
              <img class="rounded-lg md:rounded-2xl w-full" src="{{ $img->realImage }}" alt="{{ $member->name }}">
            </div>
            <div class="col-span-2 pt-4 md:pt-0">
              <h2 class="text-black text-3xl md:text-4xl font-medium tracking-wider">{{$member->name}}</h2>
              <span class="text-lg font-medium tracking-wider">{{$member->position}}</span>
              <div class="flex items-center gap-2 my-3">
                @if ($member->social_facebook)
                <a href="{{$member->social_facebook}}" target="_blank">
                  <img class="w-10 h-10" src="https://res.cloudinary.com/domqavi1p/image/upload/v1692882266/icons/img.icons8.com_wvhfgi.webp" />
                </a>
                @endif
                @if ($member->social_instagram)
                <a href="{{$member->social_instagram}}" target="_blank">
                  <img class="w-10 h-10" src="https://res.cloudinary.com/domqavi1p/image/upload/v1692882217/icons/img.icons8.com_ooftuv.webp" />
                </a>
                @endif
                @if ($member->social_twitter)
                <a href="{{$member->social_twitter}}" target="_blank">
                  <img class="w-10 h-10" src="https://res.cloudinary.com/domqavi1p/image/upload/v1692882190/icons/img.icons8.com_blvbtt.webp" />
                </a>
                @endif
                @if ($member->social_tiktok)
                <a href="{{$member->social_tiktok}}" target="_blank">
                  <img class="w-10 h-10" src="https://res.cloudinary.com/domqavi1p/image/upload/v1692882239/icons/img.icons8.com_dqksbg.webp" />
                </a>
                @endif
                @if ($member->social_youtube)
                <a href="{{$member->social_youtube}}" target="_blank">
                  <img class="w-10 h-10" src="https://res.cloudinary.com/domqavi1p/image/upload/v1692882166/icons/img.icons8.com_ekvdqu.webp" />
                </a>
                @endif
                @if ($member->social_linktree)
                <a href="{{$member->social_linktree}}" target="_blank">
                  <img class="w-10 h-10" src="https://res.cloudinary.com/domqavi1p/image/upload/v1692882134/icons/img.icons8.com_ypsjli.webp" />
                </a>
                @endif
              </div>
              <div id="wysiwyg" class="text-black text-lg tracking-wider my-4">
                {!!$member->detail!!}
              </div>
            </div>
          </div>
        @endforeach
        
      </div>
    </section>
  </div>
</div>
@endsection
@section('js')
<script>
  const datadiscography = [
    {
      id: 0,
      name: "DEBUT ALBUM 'STORY OF ACEH' - 2017",
      label: "DEBUT ALBUM 'STORY OF ACEH' - 2017",
      link: "https://open.spotify.com/album/6GzEVqYalUbOANdbl5hgqQ"
    },{
      id: 1,
      name: "SINGLE 'PEUMEULIA JAMEE' - 2018",
      label: "SINGLE 'PEUMEULIA JAMEE' - 2018",
      link: "https://open.spotify.com/album/04WTrkFDVyviUX8MTmRBWz"
    },{
      id: 2,
      name: "SINGLE '3 MINUTES ABOUT US' 2019",
      label: "SINGLE '3 MINUTES ABOUT US' 2019",
      link: "https://open.spotify.com/album/27lynzEQWDAbN7ZU787s3E"
    },{
      id: 3,
      name: "SINGLE 'SABAN SABEE' - 2019",
      label: "SINGLE 'SABAN SABEE' - 2019",
      link: "https://open.spotify.com/album/5fXrECNglaZfT7KUP2OZhe"
    },{
      id: 4,
      name: "ALBUM 'LIVE SESSION ft. FAHMIL ARABI' - 2021",
      label: "ALBUM 'LIVE SESSION ft. FAHMIL ARABI' - 2021",
      link: "https://open.spotify.com/album/4F5nkKr6G75gv8WoaEBKcu"
    },{
      id: 5,
      name: "EP 'SEMUA RINDU BALI' - 2021",
      label: "EP 'SEMUA RINDU BALI' - 2021",
      link: "https://open.spotify.com/album/0j22YWyq4aGJRWENGNbQy0"
    },{
      id: 6,
      name: "ALBUM 'PEUNEURAH BUMOE' 2023",
      label: "ALBUM 'PEUNEURAH BUMOE' 2023",
      link: "https://open.spotify.com/album/2WItxRtYnXr3rZPsSEq8S0"
    }
  ];

  const datamilestone = [
    {
      id: 0,
      name: "2015 : JAVA JAZZ FESTIVAL",
      label: "2015 : JAVA JAZZ FESTIVAL",
      link: "#"
    },{
      id: 1,
      name: "2015 : JAZZ KOTA TUA",
      label: "2015 : JAZZ KOTA TUA",
      link: "#"
    },{
      id: 2,
      name: "2016 : JAVA JAZZ FESTIVAL",
      label: "2016 : JAVA JAZZ FESTIVAL",
      link: "#"
    },{
      id: 3,
      name: "2016 : SABANG JAZZ FESTIVAL",
      label: "2016 : SABANG JAZZ FESTIVAL",
      link: "#"
    },{
      id: 4,
      name: "2016 : SABANG MARINE FESTIVAL",
      label: "2016 : SABANG MARINE FESTIVAL",
      link: "#"
    },{
      id: 5,
      name: "2016 : RAPA'I INTERNATIONAL FESTIVAL",
      label: "2016 : RAPA'I INTERNATIONAL FESTIVAL",
      link: "#"
    },{
      id: 6,
      name: "2017 : JAVA JAZZ FESTIVAL",
      label: "2017 : JAVA JAZZ FESTIVAL",
      link: "#"
    },{
      id: 7,
      name: "2017 : HOLLAND PARADISO FESTIVAL",
      label: "2017 : HOLLAND PARADISO FESTIVAL",
      link: "#"
    },{
      id: 8,
      name: "2018 : ACEH CULLINARY FESTIVAL",
      label: "2018 : ACEH CULLINARY FESTIVAL",
      link: "#"
    },{
      id: 9,
      name: "2019 : ACEH SUMATERA EXPO",
      label: "2019 : ACEH SUMATERA EXPO",
      link: "#"
    },{
      id: 10,
      name: "2019 : CALENDAR OF EVENT",
      label: "2019 : CALENDAR OF EVENT",
      link: "#"
    },{
      id: 11,
      name: "2020 : WINNER OF 'BEST WORLD MUSIC PRODUCTION' AMI AWARDS",
      label: "2020 : WINNER OF 'BEST WORLD MUSIC PRODUCTION' AMI AWARDS",
      link: "#"
    },{
      id: 12,
      name: "2021 : SEMUA RINDU BALI",
      label: "2021 : SEMUA RINDU BALI",
      link: "#"
    },{
      id: 13,
      name: "2022 : ANUGERAH PESONA INDONESIA (API AWARD)",
      label: "2022 : ANUGERAH PESONA INDONESIA (API AWARD)",
      link: "#"
    },{
      id: 14,
      name: "2023 : SIRIUS JAZZ DAYS (SOCHI, RUSSIA)",
      label: "2023 : SIRIUS JAZZ DAYS (SOCHI, RUSSIA)",
      link: "#"
    },{
      id: 15,
      name: "2023 : FESTIVAL THE TRIUMPH OF JAZZ (MOSCOW, RUSSIA)",
      label: "2023 : FESTIVAL THE TRIUMPH OF JAZZ (MOSCOW, RUSSIA)",
      link: "#"
    }
  ];
  </script>
@endsection