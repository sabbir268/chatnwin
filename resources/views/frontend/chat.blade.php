@extends('layouts.frontend.layout')
@section('header')
<title>Chat | Sneklay</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<style>
    .owl-item.active,
    .owl-item {
        width: auto !important;
    }

    .owl-theme .owl-nav {
        margin-top: 10px;
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
        <h1 class="font-weight-bold m-0 p-0">{{$chatRoom->name}}</h1>
        <h1 class="" style="visibility: hidden;"></h1>
    </div>
    <hr class="m-0 p-0">
    <div class="chatroom-inbox-area">

        <div class="room-member text-left d-flex justify-content-left">
            <Members :members="members"></Members>
            {{-- <div class="owl-carousel owl-theme">
                <div v-for="(member,i) in members" :key="i" class="item">
                    <h1 class="chatroom-member-single" style="background: blue">
                        A
                        <i class="fa fa-circle" aria-hidden="true"></i>
                    </h1>
                </div>
            </div> --}}

        </div>
        <hr class="m-0 p-0">
        <div class="message-rad" id="message-rad">

            <div v-for="(message, i) in messages" :key="i">
                <div :class="`${message.user_id == userId ? 'message-read-single-sender' : 'message-read-single'}`">
                    <div class="message-info d-flex justify-content-between">
                        <h6 class="m-0 p-0">@{{message.username}}</h6>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" style="background: #fff !important;padding:0;">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <button class="dropdown-item" type="button">Report Message</button>
                            </div>
                        </div>
                    </div>
                    <div class="message-text message-text-left">
                        <p class="m-0 p-0">@{{message.message}}</p>
                    </div>
                    <div class="chat-like-option d-flex justify-content-lg-start">
                        <a href="#" class="chat-like-active">
                            <i class="fas fa-thumbs-up"></i> @{{message.total_likes}}
                        </a>
                        <a href="#">
                            <i class="fas fa-thumbs-down"></i> @{{message.deslikes}}
                        </a>
                    </div>
                </div>
            </div>

            {{-- <div class="message-read-single-sender">
                <div class="message-info d-flex justify-content-between">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" style="background: #fff !important;padding:0;">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-left">
                            <button class="dropdown-item" type="button">Report Message</button>
                        </div>
                    </div>
                    <h6 class="m-0 p-0">Username</h6>
                </div>
                <div class="message-text message-text-right">
                    <p class="m-0 p-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis provident unde
                        dicta. Vel rem odio minima nemo adipisci, officiis cupiditate!</p>
                </div>
                <div class="message-image">
                    <div class="w-100">
                        <img src="{{ asset('assets/frontend/images/chat/thumb-v-v-1.jpg') }}" class="w-100" alt="img">
        </div>
    </div>
    <div class="chat-like-option d-flex justify-content-lg-start">
        <a href="#" class="chat-like-active">
            <i class="fas fa-thumbs-up"></i> 10
        </a>
        <a href="#">
            <i class="fas fa-thumbs-down"></i> 20
        </a>
    </div>
</div> --}}


</div>
<!-- Sender area -->
<div class="message-send-area">
    <div class="row">
        <div class="col-12 d-flex justify-content-start">
            <div id="imoje">
                <i class="far fa-smile"></i>
            </div>
            <div id="link-libery">
                <i class="fas fa-paperclip"></i>
            </div>
            <input type="text" v-model="chatText" class="form-control rounded-0" placeholder="Text" autofocus>
            <button type="button" @click="sendMessage()"
                class="btn btn-primary message-btn pl-4 pr-4 ml-1">Send</button>
        </div>
    </div>
</div>
</div>
</div>
@endsection


@section('script')
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    const app = new Vue({
        el: '#chat',

     

        data:{
            messages: [],
            chatRoomId: '{{$chatRoom->id}}',
            userId: '{{auth()->user()->id}}',
            chatText: '',
            members: [],
            checkmm: [],

            hooperSettings: {
                itemsToShow: 2,
                centerMode: true
            },
            api_token: '{{auth()->user()->api_token}}'
        },

        created(){
            window.Echo.private('chat-channel.'+ this.chatRoomId)
                .listen('ChatEvent', (e) => {
                    this.messages.push(e.chat);
                   this.scrollToEnd();
                });

             window.Echo.join('chat-channel.'+ this.chatRoomId)
                    // .joining((user) => {
                    //     axios.get(`/online/${this.chatRoomId}`);
                    // })
                    // .leaving((user) => {
                    //     axios.get(`/offline/${this.chatRoomId}`);
                    // })
                    .listen('UserOnline', (e) => {
                        console.log(e)
                    })
                    .listen('UserOffline', (e) => {
                        console.log(e)
                    });


            this.getAllMessage();
            this.getAllMember();
            this.scrollToEnd();
        },

        mounted() {
            this.scrollToEnd();
        },

        methods:{
            sendMessage(){
                axios.post('/chat',{
                    chat_room_id: this.chatRoomId,
                    message: this.chatText,
                }).then(res => {
                    console.log(res)
                }).catch(err => {
                    console.log(err)
                })
            },

            getAllMessage(){
                axios.get(`/chat/${this.chatRoomId}`)
                    .then(res => {
                        this.messages = res.data.data
                    }).catch(err => {
                        console.log(err)
                    })
            },

            getAllMember(){
                axios.get(`/all-members/${this.chatRoomId}`)
                    .then(res => {
                        this.members = res.data
                    })
            },

            listen() {
                window.Echo.join('chat-channel.'+ this.chatRoomId)
                    // .joining((user) => {
                    //     axios.get(`/online/${this.chatRoomId}`);
                    // })
                    // .leaving((user) => {
                    //     axios.get(`/offline/${this.chatRoomId}`);
                    // })
                    .listen('UserOnline', (e) => {
                        console.log(e)
                    })
                    .listen('UserOffline', (e) => {
                        console.log(e)
                    });
                },

            scrollToEnd() {
                var container = this.$el.querySelector(".message-rad");
                container.scrollTop = container.scrollHeight+20;
            },

        },
    });



</script>


<script>
    var objDiv = document.getElementById("#message-rad");
    objDiv.scrollTop = objDiv.scrollHeight;
</script>
@endsection