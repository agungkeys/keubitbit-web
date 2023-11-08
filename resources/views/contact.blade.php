@extends('layouts.app')
@section('title', 'Tour - Keubitbit Aceh Ethnic Music - Official Website')
@section('content')
  <section class="bg-center bg-contain bg-[url('https://res.cloudinary.com/domqavi1p/image/upload/v1692863098/banners/ow0hvgneouja1qvwinru.webp')]">
    <div class="p-5 md:p-10 py-6 md:py-[7em] justify-center items-center" style="background: rgba(59, 38, 6, 0.5)">
      <h1 class="text-white text-center text-3xl md:text-5xl font-bold tracking-wider">Contact</h1>
    </div>
  </section>
  <section class="py-8">
    <div class="container">
      <h4 class="text-lg">Send Message To</h4>
      <h1 class="text-5xl font-semibold font-philosopher text-black">General Inquiries</h1>

      <div class="grid grid-cols-1 md:grid-cols-5 gap-4 md:gap-6">
        <div class="col-span-1 md:col-span-2">
          <div class="card mt-5 bg-white border-gray-50 border-2 shadow-lg">
            <form class="card-body" onsubmit="disableSend()" action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-control w-full">
                <label class="label">
                  <span class="label-text text-xl undefined">Name</span>
                </label>
                <input value="{{ old('name') }}" name="name" type="text" placeholder="What's your name?" class="input input-lg input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
                @if ($errors->has('name'))
                  <label class="label">
                    <span class="label-text-alt text-error">{{ $errors->first('name') }}</span>
                  </label>
                @endif
              </div>
              <div class="form-control w-full">
                <label class="label">
                  <span class="label-text text-xl undefined">Email</span>
                </label>
                <input value="{{ old('email') }}" name="email" type="text" placeholder="What's your email?" class="input input-lg input-bordered w-full {{ $errors->has('email') ? ' input-error' : '' }}" />
                @if ($errors->has('email'))
                  <label class="label">
                    <span class="label-text-alt text-error">{{ $errors->first('email') }}</span>
                  </label>
                @endif
              </div>
              <div class="form-control w-full">
                <label class="label">
                  <span class="label-text text-xl undefined">Message</span>
                </label>
                <textarea name="message" placeholder="What's up?" class="textarea textarea-lg textarea-bordered h-34 w-full {{ $errors->has('message') ? ' textarea-error' : '' }}">{{ old('message') }}</textarea>
                <!-- <input name="message" type="text" placeholder="What's your email?" class="input input-lg input-bordered w-full {{ $errors->has('email') ? ' input-error' : '' }}" /> -->
                @if ($errors->has('message'))
                  <label class="label">
                    <span class="label-text-alt text-error">{{ $errors->first('message') }}</span>
                  </label>
                @endif
              </div>
              <button id="send" class="mt-5 btn btn-secondary btn-md md:btn-lg">Send</button>
            </form>
          </div>
        </div>
        <div class="col-span-1 md:col-span-3">
          <div class="card mt-5 bg-white border-gray-50 border-2 shadow-lg h-[30em] md:h-full">
            <div class="card-body p-2">
              <iframe style="height:100%;width:100%;border:0;border-radius: .5em;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=Jakarta,+Indonesia&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
@endsection
@section('js')
  <script>
    function disableSend() {
      document.getElementById('send').disabled = true;
    }
  </script>
@endsection
