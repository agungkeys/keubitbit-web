<div
  class="top-0 font-philosopher sticky z-10 bg-base-100 border-base-content w-full drop-shadow-md bg-[url('https://res.cloudinary.com/domqavi1p/image/upload/c_fill,h_200,w_500/v1690519461/ART_WORK_KEUBITBIT_emiyy9.webp')]">
  <div style="background: rgba(0, 0, 0, 0.2);">
    <div class="container">
      <div class="block md:flex navbar justify-center">
        <div class="block md:flex-1 text-center md:text-left pt-2 md:pt-0">
          <img
            class="w-36 mx-auto md:mx-0"
            src="https://res.cloudinary.com/domqavi1p/image/upload/v1690468533/keubitbit-long_hidyuv.svg" 
            alt="Logo Keubitbit"
            width="144"
            height="40"
            />
        </div>
        <div 
          class="w-full md:w-auto"
          x-data="{ data: datamenu, pathname: window.location.pathname.split('/')[1], styleselected: 'text-white font-[100px] text-base md:text-xl'}"
        >
          <ul class="mx-auto menu menu-horizontal items-center justify-center md:my-1">
            <template x-for="item in data">
              <li>
                <a
                  x-text="item.label" 
                  x-bind:href="item.link"
                  x-bind:class="!pathname && item.name === 'home' && styleselected || pathname === item.name ? styleselected : ''"
                  class="hover:text-white text-[12px] md:text-lg font-light md:font-light px-1 md:px-2 py-1 md:py-2"
                >
                  -
              </a>
              </li>
            </template>
          </ul>
        </div>
      </div>
    </div>
  </div>
  
</div>
