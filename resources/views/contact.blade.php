@extends('layouts.app') 
@section('title', 'Tour - Keubitbit Aceh Ethnic Music - Official Website')
@section('content')
<section class="bg-bottom bg-cover bg-[url('https://res.cloudinary.com/domqavi1p/image/upload/c_crop,h_340,w_1200/v1690537335/IMG20230623185903_y1nptl.webp')]">
  <div class="p-5 md:p-10 py-6 md:py-[7em] justify-center items-center" style="background: rgba(59, 38, 6, 0.5)">
    <h1 class="text-white text-center text-3xl md:text-5xl font-bold tracking-wider">Contact</h1>
  </div>
</section>
<section class="py-8">
  <div class="container">
    <h4 class="text-lg">Send Message To</h4>
    <h1 class="text-5xl font-semibold font-philosopher text-black">General Inquiries</h1>
    
    <div class="grid grid-cols-5">
      <div class="col-span-2">
        <div class="card mt-5 bg-white border-gray-50 border-2 shadow-lg">
          <form class="card-body" onsubmit="disableButton()" action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-control w-full">
              <label class="label">
                <span class="label-text text-xl undefined">Name</span>
              </label>
              <input name="name" type="text" placeholder="What's your name?" class="input input-lg input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
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
              <input name="email" type="text" placeholder="What's your email?" class="input input-lg input-bordered w-full {{ $errors->has('email') ? ' input-error' : '' }}" />
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
              <textarea placeholder="What's up?" class="textarea textarea-lg textarea-bordered h-34 w-full {{ $errors->has('email') ? ' textarea-error' : '' }}" name="message"></textarea>
              <!-- <input name="message" type="text" placeholder="What's your email?" class="input input-lg input-bordered w-full {{ $errors->has('email') ? ' input-error' : '' }}" /> -->
              @if ($errors->has('message'))
                <label class="label">
                  <span class="label-text-alt text-error">{{ $errors->first('message') }}</span>
                </label>
              @endif
            </div>
            <button class="mt-5 btn btn-secondary btn-md md:btn-lg">Send</button>
          </form>
        </div>
      </div>
      <div class="col-span-3"></div>
    </div>
  </div>

</section>
@endsection