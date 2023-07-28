<div class="drawer-side ">
  <label html-for="left-sidebar-drawer" class="drawer-overlay"></label> 
  <ul class="menu pt-2 w-80 bg-base-100 text-base">
    <button class="btn btn-ghost bg-base-300  btn-circle z-50 top-0 right-0 mt-4 mr-2 absolute lg:hidden" onClick={(e) =>close(e))}>
      <span class="h-5 inline-block w-5">XXX</span>
    </button>
    <li class="mb-2 font-semibold text-xl">
      <span>
        <img class="w-28" src="https://res.cloudinary.com/domqavi1p/image/upload/v1690468533/keubitbit-long_hidyuv.webp" alt="Keubitbi Logo"/>
      </span> 
    </li>
    <li class="">
      <a class="font-bold">
        Dashboard
        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-md rounded-br-md bg-primary" aria-hidden="true"></span>
      </a>
    </li>
    <div class="mt-3">
      <span class="text-yellow-800 text-sm">
        Data Master
      </span>
    </div>
    <li class="">
      <a class="font-normal">
        Member
      </a>
    </li>
    <li class="">
      <a class="font-normal">
        Banner
      </a>
    </li>
    <li class="">
      <a class="font-normal">
        Video
      </a>
    </li>
    <li class="">
      <a class="font-normal">
        Music
      </a>
    </li>
    <li class="">
      <a class="font-normal">
        Gigs
      </a>
    </li>
    <li class="">
      <a class="font-normal">
        Article & News
      </a>
    </li>
    <li class="">
      <a class="font-normal">
        Store
      </a>
    </li>
  </ul>
</div>

@section('js')
<script>
  function close(e) {
    document.getElementById('left-sidebar-drawer').click();
  }
</script>
@endsection
