@extends('layouts.admin.layout')
 <style>
        .card.card-statistics {
            background: linear-gradient(85deg, #06b76b, #f5a623);
            color: #ffffff;
        }
        .winners-single {
            margin-bottom: 45px; 
        }
        .winners-single h5 {
            font-size: 23px;
            font-weight: normal;
            margin-top: 20px; 
        }
    </style>
    @section('content')
    <div class="main-panel" style="width: 100% !important;">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    
                </h3>
            </div>
            <div class="row grid-margin">
                <div class="col-12">
                    <div class="winners-single">
                        <h4>Username</h4>
                        <h5>Chatroom name, Item size, Address listed</h5>
                    </div>
                    <div class="winners-single">
                        <h4>Username</h4>
                        <h5>Chatroom name, Item size, Address listed</h5>
                    </div>
                    <div class="winners-single">
                        <h4>Username</h4>
                        <h5>Chatroom name, Item size, Address listed</h5>
                    </div>
                    <div class="winners-single">
                        <h4>Username</h4>
                        <h5>Chatroom name, Item size, Address listed</h5>
                    </div>
                </div>
            </div>
        </div>
      
    </div>
@endsection
