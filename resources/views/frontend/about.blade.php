@extends('layouts.frontend.layout')
@section('header')
<title>Sneakly</title>
@endsection
@section('menu-item')
<li class="nav-item">
    <a class="nav-link" href="{{ url('terms-services') }}">Terms</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('privacy-policy') }}">Privacy</a>
  </li>
  @if (!Auth::check())
  <li class="nav-item">
    <a class="nav-link" href="{{ url('login') }}">Login</a>
  </li>
  @endif
@endsection
@section('content')
<div class="container">
    <div class="about-us-header">
        <h1 class="font-weight-bold">ABOUT US</h1>
        <p>CHAT AND WIN COOL PRIZES WHILE YOU’RE AT IT </p>
    </div>
<div class="About-us-main">
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <div class="about-us-single">
                <img src="{{ asset('assets/frontend/images/about/focus-center-weak-photo-image.png') }}" alt="image">
                <p>PAY $1 TO GET ACCESS TO A CHAT ROOM ABOUT HYPED ITEMS</p>
            </div>
          </div>
          <div class="col-md-4 col-lg-4">
            <div class="about-us-single">
                <img src="{{ asset('assets/frontend/images/about/party-horn-event-celebrate-funny.png') }}" alt="image">
                <p>CHOP IT UP ABOUT ANYTHING IN THE CHAT ROOM</p>
            </div>
          </div>
          <div class="col-md-4 col-lg-4">
            <div class="about-us-single">
                <img src="{{ asset('assets/frontend/images/about/chat-bubble-message-speech-conversation-comomment-chating.png') }}" alt="image">
                <p>EACH WEEK ONE PERSON FROM EVERY CHAT ROOM WILL RECEIVE A FREE BONUS</p>
            </div>
          </div>
     </div>
</div>
</div>
@endsection


@section('script')
    
@endsection