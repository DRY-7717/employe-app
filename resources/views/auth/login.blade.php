@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-12 mt-5">
                <div class="card  shadow-sm  " style="border-top: 3.5px solid #0d6efd;">
                    <div class="card-body">
                        <h3 class="fw-bold ">Login</h3>
                        <p class="p-0 mt-0 mx-0 mb-2 text-secondary" style="font-size: 16px">Selamat datang di aplikasi
                            Employee App. Silahkan login!</p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="email" class="col-md-12 col-form-label ">{{ __('Email Address') }}</label>

                                <div class="col-md-12">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>

                                <div class="col-md-12">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-12 text-cetner">
                                    <button type="submit" class="w-100 d-block btn btn-primary mb-3">
                                        {{ __('Login') }}
                                    </button>
                                    {{-- <p class="text-center text-secondary m-0 p-0"> Sudah Punya akun? <a href="/register" class=" text-center text-decoration-none">register</a></p> --}}


                                    {{-- @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
