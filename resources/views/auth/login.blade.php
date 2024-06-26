@extends('layouts.app')

@section('content')
    <section class="w-100"
        style="background: url('../img/4.jpeg'); background-size: cover; background-position: center; height: 100vh;">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-md-5 col-12 border-0" style="margin-top: 120px; margin-right: -50px" >
                    <div class="card  shadow-sm" style="background-color: rgba(255, 255, 255, .7)">
                        <div class="card-body">
                            <div class="box-logo mb-4" style="width: 230px;">
                                <img src="/img/logo.png" style="object-fit: cover; width: 100%;" alt="">
                            </div>
                            <h3 class="fw-bold ">Login</h3>
                            <p class="p-0 mt-0 mx-0 mb-2 text-secondary" style="font-size: 16px">Selamat datang di aplikasi
                                Employee App. Silahkan login!</p>
                            @if (session('message'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="email"
                                        class="col-md-12 col-form-label ">{{ __('Email Address') }}</label>

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
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
