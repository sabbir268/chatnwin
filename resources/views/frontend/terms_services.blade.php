@extends('layouts.frontend.layout')
@section('header')
<title>Sneklay</title>
@endsection
@section('menu-item')
<li class="nav-item">
    <a class="nav-link" href="{{ url('/') }}">Back</a>
  </li>
@endsection
@section('content')
<div class="terms-services-area">
    <h1 class="text-center">Terms Of Service</h1>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="terms-condition-area">

            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
    
@endsection