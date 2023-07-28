<div
  class="top-0 sticky z-10 bg-base-100 border-base-content w-full drop-shadow-md bg-[url('https://res.cloudinary.com/domqavi1p/image/upload/c_fill,h_200,w_500/v1690519461/ART_WORK_KEUBITBIT_emiyy9.webp')]">
  <div class="w-full" style="background: rgba(0, 0, 0, 0.2);">
    <div class="container grid md:flex navbar justify-center">
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
        class="flex-none"
        x-data="{ data: datamenu}"
      >
        <ul class="menu menu-horizontal md:gap-1 md:my-1">
          <template x-for="item in data">
            <li>
              <a
                x-text="item.label" 
                x-bind:href="item.link"
                class="hover:text-white text-xs md:text-base font-normal md:font-light px-2 py-1 md:py-2"
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
