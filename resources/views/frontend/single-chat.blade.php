@extends('layouts.frontend.layout')
@section('header')
<title>Chat | Sneklay</title>

<style>
    .emoji-area {
        position: absolute;
        z-index: 99;
        top: -406px;
        left: 0;
    }

    .em-show {
        display: none;
    }
</style>

@endsection
@section('menu-item')
<li class="nav-item">
    <a class="nav-link" href="{{ url('account/'.Auth::user()->username) }}">My Account</a>
</li>
@endsection
@section('content')
<div class="container-fluid" id="chat">
    <div class="chatroom-inbox-header d-flex justify-content-between">
        <a href="{{ url('/') }}" class="btn"> <i class="fas fa-chevron-left"></i> back </a>
        <h1 class="font-weight-bold m-0 p-0">Private Messages</h1>
        <div class="btn-group">
            <button type="button" class="btn btn-default active " aria-haspopup="true"
                aria-expanded="false" style="background: #fff !important;padding:0;">
                <i class="fas fa-ellipsis-h"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <button class="dropdown-item" type="button">Report Message</button>
            </div>
        </div>
    </div>
    <hr class="m-0 p-0">
    <div class="chatroom-inbox-area">
        <hr class="m-0 p-0">
        <div class="message-rad" id="message-rad">

            <div>
                <div class="message-read-single">
                    <div class="message-info d-flex justify-content-between">
                        <h6 class="m-0 p-0">username</h6>
                    </div>
                    <div class="message-text message-text-left">
                        <p class="m-0 p-0">Lorem ipsum dolor sit amet.</p>
                    </div>
                    <div class="chat-like-option d-flex justify-content-lg-start">
                        <span :class="like chat-like-active">
                            <i class="fas fa-thumbs-up"></i></span>

                        <span class="dislike chat-like-active">
                            <i class="fas fa-thumbs-down"></i>12
                        </span>

                    </div>
                </div>
                <div class="message-read-single-sender message-read-single">
                    <div class="message-info d-flex justify-content-between">
                        <h6 class="m-0 p-0">username</h6>
                    </div>
                    <div class="message-text message-text-left">
                        <p class="m-0 p-0">Lorem ipsum dolor sit amet.</p>
                    </div>
                    <div class="chat-like-option d-flex justify-content-lg-start">
                        <span :class="like chat-like-active">
                            <i class="fas fa-thumbs-up"></i></span>

                        <span class="dislike chat-like-active">
                            <i class="fas fa-thumbs-down"></i>12
                        </span>

                    </div>
                </div>
            </div>

        </div>
        <!-- Sender area -->
        <div class="message-send-area">
            <div class="row">
                <div class="col-12 pb-1" style="padding-left:5.4%">
                    <div class="show-image" v-if="chatImage" style="height: 50px;width:50px;float:left;">
                        <img :src="chatImage" class="w-100">
                        <i v-if="chatImage" class="fa fa-times" style="border:1px;cursor:pointer;position: absolute;"
                            @click="clearImage"></i> </div>
                </div>
                <div class="col-12 d-flex justify-content-start">
                    <div id="imoje">
                        <i class="far fa-smile"></i>
                    </div>
                    <label for="chat-image" id="link-libery"> <i class="fas fa-paperclip"></i></label>
                    <input type="file" v-model="chatAsset" class="d-none" @change="onFileChange" id="chat-image">
                    <div class="emoji-area em-show">
                        <emoji-picker></emoji-picker>
                    </div>
                    {{-- <input type="text" id="sn-msg-box" v-model="chatText" class="form-control rounded-0"
                        placeholder="Text" autofocus>
                     --}}
                    <textarea id="sn-msg-box" v-model="chatText" class="form-control rounded-0" rows="1"
                        placeholder="Text" style="height: 38px !important;" autofocus></textarea>

                    <button type="button" @click="sendMessage()" class="btn btn-primary message-btn  ml-1"
                        style="height: 38px !important;">Send</button>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
{{-- <script src="https://js.pusher.com/7.0/pusher.min.js"></script> --}}
