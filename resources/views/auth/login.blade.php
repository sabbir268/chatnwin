@extends('layouts.frontend.layout')
@section('header')
<title>Login | Sneakly</title>
@endsection
@section('menu-item')
<li class="nav-item">
    <a class="nav-link" href="{{ url('/') }}">Home</a>
</li>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4 bg-white shadow login-area-card">
                <h5 class="font-weight-bold">Sign in</h5>
                <p class="font-weight-bold mt-3">Welcome to Sneakly</p>
                <div class="card-body text-left">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">{{ __('Email address') }}</label>

                            <input id="email" type="email" class="form-control rounded-0 @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>

                            <input id="password" type="password"
                                class="form-control rounded-0 @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        @if (Route::has('password.request'))
                        <a class="btn secondary rounded-0 p-0" href="{{ route('password.request') }}"
                            style="color: #9B9A9A;border-bottom:2px solid #9B9A9A;">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif

                        <div class="form-group row mb-0 mt-3">
                            <button type="submit" class="btn btn-primary  rounded-0 btn-block bg-snw">
                                Sign In
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection