@extends('layouts.frontend.layout')
@section('header')
<title>Sneakly</title>
@endsection
@section('menu-item')
<li class="nav-item">
    <a class="nav-link" href="#"><i class="fas fa-chevron-left"></i> Back</a>
</li>
@endsection
@section('content')
<div class="container">
    <div class="result-area">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="result-image">
                    <img src="https://via.placeholder.com/450" alt="image">
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 pt-5">
                <div class="result-form">
                    <h1 class="font-weight-bold text-center">You Won!!!</h1>
                    <form action="">
                        <label class="text-left">Pick a Size</label>

                        <div class="row">
                            <div class="col-3">
                                <div class="size">
                                    5
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="size">
                                    6
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="size">
                                    7
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="size">
                                    8
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="size">
                                    9
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="size">
                                    9.5
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="size">
                                    10
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="size">
                                    10.5
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="size">
                                    11
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="size">
                                    11.5
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="size">
                                    12
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="size">
                                    13
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary btn-block rounded-0 pt-4 pb-4"
                                style="background: #7B27A3;"><b>ACCEPT</b></button>
                            <p class="text-center p-4"><b>Please choose a size and press
                                    ACCEPT to win your Bonus </b></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@php
  $winer_val = isWinner(auth()->user()->id,false);
@endphp
<input type="hidden" value="{{ $winer_val->id }}" id="winner_user_id">
@endsection


@section('script')
    <script>
         $(document).ready(function(){
            $(document).on('click', '.size', function(){
                var value = parseInt($(this).text());
                var id = $('#winner_user_id').val();
                $.post('{{ route('winner.value_udpate') }}', {_token:'{{ csrf_token() }}', value:value,id:id}, function(data){
                
                  if(data == 'yes'){
                      alert('Your size picked successfull')
                  }else {
                      alert('Failed to pick size, please try again');
                  }
            });
            });
        });
    </script>
@endsection