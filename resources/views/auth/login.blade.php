@extends('layouts.auth')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="min-h-screen bg-base-200 flex items-center bg-cover bg-[url('https://res.cloudinary.com/domqavi1p/image/upload/v1690519461/ART_WORK_KEUBITBIT_emiyy9.webp')]">
    <div class="card mx-auto w-full max-w-5xl  shadow-xl">
        <div class="grid md:grid-cols-2 grid-cols-1 bg-base-100 rounded-xl">
            <div class=''>
                <div class="hero min-h-full rounded-l-xl bg-base-300">
                    <div class="hero-content py-12">
						<div class="max-w-md text-white">
							<h1 class='text-3xl text-center font-bold '>
								<img
									class="inline-block w-36 mx-auto md:mx-0"
									src="https://res.cloudinary.com/domqavi1p/image/upload/v1690468533/keubitbit-long_hidyuv.svg"
								/>
								<!-- <img src="https://res.cloudinary.com/domqavi1p/image/upload/v1690518293/keubitbit-vector_tdb5tn.webp" class="w-12 inline-block mr-2 mask mask-circle" alt="dashwind-logo" /> -->
							</h1>
							<h1 class="text-2xl mt-8 font-bold">Admin CMS Keubitbit</h1>
							<p class="py-2 mt-4">✓ <span class="font-semibold">Please login with your email id and password</span></p>
							<p class="py-2">✓ <span class="font-semibold">If forget access please contact web administrator</span></p>
						</div>
                    </div>
                  </div>
            </div>
            <div class='py-24 px-10'>
                <h2 class='text-2xl font-semibold mb-2 text-center'>Login</h2>
                <form method="POST" action="{{ route('login') }}">
					@csrf
                    <div class="mb-4">
						<div class="form-control w-full mb-3">
							<label class="label">
								<span class="label-text text-base-content">Email Id</span>
							</label>
							<input 
								id="email"
								class="input input-bordered w-full form-control @error('email') input-error @enderror" 
								type="text" 
								placeholder="" 
								name="email"
								value="{{ old('email') }}" 
								required 
								autocomplete="email" 
								autofocus
							/>
							@error('email')
								<span class="label text-red-500" role="alert">
									<strong class="label-text-alt">{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="form-control w-full mb-3">
							<label class="label">
								<span class="label-text text-base-content">Password</span>
							</label>
							<input 
								id="password"
								class="input input-bordered w-full form-control @error('password') input-error @enderror" 
								type="password" 
								placeholder="" 
								name="password"
								required 
								autocomplete="current-password"
							/>
							@error('password')
								<span class="label text-red-500" role="alert">
									<strong class="label-text-alt">{{ $message }}</strong>
								</span>
							@enderror
						</div>
                    </div>
					<button type="submit" class="mt-2 w-full btn btn-primary">Login</button>
					@if (Route::has('password.request'))
						<div class="text-right text-primary mt-1">
							<a class="" href="{{ route('password.request') }}">
								<span class="text-sm inline-block hover:text-primary hover:underline hover:cursor-pointer transition duration-200">{{ __('Forgot Your Password?') }}</span>
							</a>
						</div>
					@endif
                    <div class='text-center mt-4'>Don't have an account yet? 
						<a href="{{ route('register') }}">
							<span class="inline-block hover:text-primary hover:underline hover:cursor-pointer transition duration-200">Register</span>
						</a>
					</div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
