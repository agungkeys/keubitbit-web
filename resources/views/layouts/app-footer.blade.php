<div class="relative bg-bottom bg-cover bg-[url('https://res.cloudinary.com/domqavi1p/image/upload/c_crop,h_450,w_1200/v1690537335/IMG20230623185903_y1nptl.webp')]">
  <div class="py-10" style="background: rgba(21, 39, 70, 0.5)" x-data="{ data: datasocialfooter }">
    <div class="h-full w-full container">
      <div class="grid grid-cols-3 md:grid-cols-6 gap-2 md:gap-3 items-center">
        <template x-for="item in data">
          <a x-bind:href="item.link" target="_blank">
            <img x-bind:src="item.image" x-bind:alt="item.name" />
          </a>
        </template>
      </div>
    </div>
    <div class="w-full text-centerblock">
      <div class="form-control mt-8">
        <div class="join mx-auto">
          <form method="POST" action="{{ route('mailists.store') }}">
            @csrf
            <input type="email" name="email" class="input input-bordered join-item w-64" placeholder="Email for subscribe newsletter" required />
            <button type="submit" class="btn join-item rounded-r-full">Subscribe</button>
            @if ($errors->has('email'))
              <label class="label">
                <span class="label-text-alt text-error">{{ $errors->first('email') }}</span>
              </label>
            @endif
          </form>
        </div>
      </div>

    </div>

  </div>
</div>
<footer class="bg-secondary text-neutral-content">
  <div class="container mx-auto footer gap-2 items-center p-4">
    <div class="mx-auto md:mx-0 items-center grid-flow-col">
      <p>Copyright © 2023 - Keubitbit with ❤️</p>
    </div>
    <div class="mx-auto md:mx-0 grid-flow-col gap-4 md:place-self-center md:justify-self-end">
      <a href="https://www.tiktok.com/@keubitbit_am" target="_blank">
        <svg width="24" height="24" viewBox="0 0 32 32" class="fill-current">
          <path
            d="M16.656 1.029c1.637-0.025 3.262-0.012 4.886-0.025 0.054 2.031 0.878 3.859 2.189 5.213l-0.002-0.002c1.411 1.271 3.247 2.095 5.271 2.235l0.028 0.002v5.036c-1.912-0.048-3.71-0.489-5.331-1.247l0.082 0.034c-0.784-0.377-1.447-0.764-2.077-1.196l0.052 0.034c-0.012 3.649 0.012 7.298-0.025 10.934-0.103 1.853-0.719 3.543-1.707 4.954l0.020-0.031c-1.652 2.366-4.328 3.919-7.371 4.011l-0.014 0c-0.123 0.006-0.268 0.009-0.414 0.009-1.73 0-3.347-0.482-4.725-1.319l0.040 0.023c-2.508-1.509-4.238-4.091-4.558-7.094l-0.004-0.041c-0.025-0.625-0.037-1.25-0.012-1.862 0.49-4.779 4.494-8.476 9.361-8.476 0.547 0 1.083 0.047 1.604 0.136l-0.056-0.008c0.025 1.849-0.050 3.699-0.050 5.548-0.423-0.153-0.911-0.242-1.42-0.242-1.868 0-3.457 1.194-4.045 2.861l-0.009 0.030c-0.133 0.427-0.21 0.918-0.21 1.426 0 0.206 0.013 0.41 0.037 0.61l-0.002-0.024c0.332 2.046 2.086 3.59 4.201 3.59 0.061 0 0.121-0.001 0.181-0.004l-0.009 0c1.463-0.044 2.733-0.831 3.451-1.994l0.010-0.018c0.267-0.372 0.45-0.822 0.511-1.311l0.001-0.014c0.125-2.237 0.075-4.461 0.087-6.698 0.012-5.036-0.012-10.060 0.025-15.083z">
          </path>
        </svg>
      </a>
      <a href="https://twitter.com/keubitbit_am" target="_blank">
        <svg width="24" height="24" viewBox="0 0 24 24" class="fill-current">
          <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
        </svg>
      </a>
      <a href="https://www.youtube.com/@KeubitbitAtjehEthnicMusic" target="_blank">
        <svg width="24" height="24" viewBox="0 0 24 24" class="fill-current">
          <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
        </svg>
      </a>
      <a href="https://www.facebook.com/keubitbit" target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
          <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
        </svg>
      </a>
      <a href="https://www.instagram.com/keubitbit_am/" target="_blank">
        <svg width="24" height="24" viewBox="0 0 169.063 169.063" class="fill-current">
          <g>
            <path d="M122.406,0H46.654C20.929,0,0,20.93,0,46.655v75.752c0,25.726,20.929,46.655,46.654,46.655h75.752
c25.727,0,46.656-20.93,46.656-46.655V46.655C169.063,20.93,148.133,0,122.406,0z M154.063,122.407
c0,17.455-14.201,31.655-31.656,31.655H46.654C29.2,154.063,15,139.862,15,122.407V46.655C15,29.201,29.2,15,46.654,15h75.752
c17.455,0,31.656,14.201,31.656,31.655V122.407z" />
            <path d="M84.531,40.97c-24.021,0-43.563,19.542-43.563,43.563c0,24.02,19.542,43.561,43.563,43.561s43.563-19.541,43.563-43.561
C128.094,60.512,108.552,40.97,84.531,40.97z M84.531,113.093c-15.749,0-28.563-12.812-28.563-28.561
c0-15.75,12.813-28.563,28.563-28.563s28.563,12.813,28.563,28.563C113.094,100.281,100.28,113.093,84.531,113.093z" />
            <path d="M129.921,28.251c-2.89,0-5.729,1.17-7.77,3.22c-2.051,2.04-3.23,4.88-3.23,7.78c0,2.891,1.18,5.73,3.23,7.78
c2.04,2.04,4.88,3.22,7.77,3.22c2.9,0,5.73-1.18,7.78-3.22c2.05-2.05,3.22-4.89,3.22-7.78c0-2.9-1.17-5.74-3.22-7.78
C135.661,29.421,132.821,28.251,129.921,28.251z" />
          </g>
        </svg>
      </a>
    </div>
  </div>
</footer>
