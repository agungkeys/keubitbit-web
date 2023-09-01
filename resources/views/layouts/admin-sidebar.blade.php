<div class="drawer-side min" x-data="{ menus: datasidebar, pathname: window.location.pathname.split('/') }">
  <label html-for="left-sidebar-drawer" class="drawer-overlay"></label> 
  <ul class="menu pt-2 w-80 min-h-screen bg-base-100 text-base">
    <button class="btn btn-ghost bg-base-300  btn-circle z-50 top-0 right-0 mt-4 mr-2 absolute lg:hidden" onClick={(e) =>close(e))}>
      <span class="h-5 inline-block w-5">XXX</span>
    </button>
    <li class="mb-2 font-semibold text-xl">
      <span>
        <img class="w-28" src="https://res.cloudinary.com/domqavi1p/image/upload/v1690634689/logo-long_yewhbj.webp" alt="Keubitbi Logo"/>
      </span> 
    </li>
    <template x-for="item in menus">
      <div>
        <template x-if="!item.isLabel">
          <li class="">
            <a 
              class="font-bold my-[3px]" 
              x-bind:class="pathname[1] === 'dashboard' && item.name === 'dashboard' && 'active' ||  pathname[2] === item.name ? 'active' : ''"
              x-bind:href="item.link"
            >
              <span x-text="item.label">-</span>
            </a>
          </li>
        </template>
        <template x-if="!!item.isLabel">
          <div class="mt-3" x-show="item.isLabel">
            <span class="text-yellow-800 text-sm" x-text="item.label">
            </span>
          </div>
        </template>
      </div>
    </template>
  </ul>
</div>

@section('js')
<script>
  function close(e) {
    document.getElementById('left-sidebar-drawer').click();
  }
</script>
@endsection