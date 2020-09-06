@extends('layouts.frontend.layout')
@section('header')
<title>Sneakly</title>
@endsection
@section('menu-item')
<li class="nav-item">
  <a class="nav-link" href="{{ url('about') }}">About</a>
</li>
@if (!Auth::check())
<li class="nav-item">
  <a class="nav-link" href="{{ url('login') }}">Login</a>
</li>
@endif
@endsection
@section('content')
<div class="row m-0 p-0">
  @if(auth()->check())
  <div class="modal fadeIn" id="welcomModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-0">
        <div class="modal-body">
          <div class="welcome-message p-3">
            <h5>Welcome to Sneakly</h5>
            <p class="font-weight-bolder">We are glad you’ve become a member,
              However there’s one last step before we can begin. In order for you to win the bonus you must enter your
              address in My Account.</p>
            <a href="{{ url('account/'.Auth::user()->username) }}"
              class="btn btn-primary rounded-0 border-sn bg-snw pl-5 pr-5 pt-2 pb-2">Ok</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
  {{-- {{ Session::get('message') }} --}}
  <div class="col-md-10 col-lg-10 offset-md-1 offset-lg-1">
    <h1 class="mb-5 font-weight-bold">Choose a chat room about an item you have or want to have </h1>
    <div class="chatroom-area">
      <div class="row">
        @foreach ($chatrooms as $chatroom)
        <div class="col-md-4 col-lg-4 col-sm-6 col-6">
          <div class="chatroom-single">
            <a href="{{ route('chatroom', $chatroom->slug) }}">
              <img src="{{ asset('storage/'.$chatroom->photo) }}" alt="chatroom-image" style="width: 100%">
              <h3>{{ $chatroom->name }}</h3>
            </a>
          </div>
        </div>
        @endforeach



      </div>
    </div>
  </div>
</div>
@endsection


@section('script')
@if (auth()->check())
@if (!auth()->user()->address)
<script>
  $(document).ready(function(){
        $('#welcomModal').modal('show');
      })
</script>
@endif
@endif
@endsection