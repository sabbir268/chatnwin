@extends('layouts.frontend.layout')
@section('header')
<title>Sneakly</title>
@endsection
@section('menu-item')
<li class="nav-item">
    <a class="nav-link" href="{{ url('/') }}"><i class="fas fa-chevron-left"></i> Back</a>
  </li>
@endsection
@section('content')
<div class="container">
    <div class="registration-header text-center">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1 class="font-weight-bold">$1</h1>
                 <h6>Pay $1 to access the chat room and at the end of the week one lucky person will win the exclusive item that the room was about  </h6>
            </div>
        </div>
    </div>
    
    <div class="registration-form mt-3 text-left">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control rounded-0" name="username">
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control rounded-0" name="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control rounded-0" name="password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
               <div class="col-md-12">
                <div class="form-group text-right">
                    <input type="submit" class="btn btn-primary rounded-0 pl-5 pr-5 pt-2 pb-2" value="Continue" style="background: #7B27A3;">
                </div>
               </div>

            </div>
        </form>
    </div>
       
</div>
@endsection


@section('script')
    
@endsection