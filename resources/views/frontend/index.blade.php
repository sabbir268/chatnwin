@extends('layouts.frontend.layout')
@section('header')
<title>Sneakly</title>
<style>
  @media only screen and (max-width: 600px) {
    h1 {
      font-size: 18px !important;
    }
    .chatroom-single h3 {
    font-size: 12px;
}
  }
</style>
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


  <div class="col-md-10 col-lg-10 offset-md-1 offset-lg-1">
    <h1 class="mb-5 font-weight-bold">Choose a chat room about an item you have or want to have </h1>
    <div class="chatroom-area">
      <div class="row">


        {{-- @foreach ($chatrooms as $chatroom)
        <div class="col-md-4 col-lg-4 col-sm-6 col-6">
          <div class="chatroom-single">
            <a href="{{ route('chatroom', $chatroom->slug) }}">
        <img src="{{ asset('storage/'.$chatroom->photo) }}" alt="chatroom-image" style="width: 100%">
        <h3>{{ $chatroom->name }}</h3>
        </a>
      </div>
    </div>
    @endforeach --}}
    

    @foreach ($chatrooms as $chatroom)
    <div class="col-md-4 col-lg-4 col-sm-6 col-6">
      <div class="chatroom-single">
        @if (auth()->check())
          @if (checkJoined($chatroom->id, auth()->user()->id))
              <a href="{{route('chatroom', $chatroom->slug)}}">
          @else 
            <a href="javascript::void(0)" data-url="{{route('chatroom', $chatroom->slug)}}" class="enter-chatroom">
          @endif
        @else 
          <a href="{{route('chatroom', $chatroom->slug)}}">
        @endif
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

<!-- modal -->

<div class="modal fadeIn" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-0">
      <div class="modal-body">
        <div class="welcome-message p-3 text-center">
          <p class="font-weight-bolder">Do you want to pay $1 to access this Chat Room?</p>
          <a href="javascript::void(0)" data-dismiss="modal"
            class="btn btn-primary rounded-0 border-sn bg-snw pl-5 pr-5 pt-2 pb-2">No</a>
          <a href="#" id="goChatroom" class="btn btn-primary rounded-0 border-sn bg-snw pl-5 pr-5 pt-2 pb-2">Ok</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection


@section('script')

<script>
  $(document).ready(function() {
      $('.enter-chatroom').click(function() {
          $url = $(this).data('url');
          $('#goChatroom').attr("href", $url);
          $('#confirmModal').modal('show');
      });
  });
</script>

@endsection