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
                            <button type="button" class="btn btn-default active " aria-haspopup="true"
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
                        <span :class="`${message.is_reacted == 'like' ? 'chat-like-active' : ''}`"
                            @click="chatLike(message)">
                            <i class="fas fa-thumbs-up"></i> @{{message.total_likes}}
                        </span>

                        <span :class="`${message.is_reacted == 'dislike' ? 'chat-like-active' : ''}`"
                            @click="chatDislike(message)">
                            <i class="fas fa-thumbs-down"></i> @{{message.total_deslikes}}
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
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    const app = new Vue({
        el: '#chat',
        data:{
            messages: [],
            chatRoomId: '{{$chatRoom->id}}',
            userId: '{{auth()->user()->id}}',
            chatText: '',
            chatImage: '',
            chatAsset: '',
            members: [],
            checkmm: [],

            hooperSettings: {
                itemsToShow: 2,
                centerMode: true
            },
            api_token: '{{auth()->user()->api_token}}'
        },

       watch: {
            messages: function () {
                setTimeout(function () {
                  //$(".message-rad").stop().animate({ scrollTop: $(".message-rad")[0].scrollHeight}, 1000);
                   $('.message-rad').scrollTop(999999999);
                }, 100)
            }
        },

        created(){
            window.Echo.private('chat-channel.'+ this.chatRoomId)
                .listen('ChatEvent', (e) => {
                    this.messages.push(e.chat);
                   this.scrollToEnd();
                });

             window.Echo.join('chat-channel.'+ this.chatRoomId)
                    .listen('UserOnline', (e) => {
                        console.log(e)
                    })
                    .listen('UserOffline', (e) => {
                        console.log(e)
                    });


            this.getAllMessage();
            this.getAllMember();
            // this.scrollToEnd();
        },

        // mounted() {
        //     this.scrollToEnd();
        // },

        methods:{
            sendMessage(){
            if(this.chatImage != ""){
                this.sendMessageWithImage();
            }else{
                axios.post('/chat',{
                    chat_room_id: this.chatRoomId,
                    message: this.chatText,
                }).then(res => {
                    console.log(res)
                    this.chatText = ''
                }).catch(err => {
                    console.log(err)
                })
             }   
            },

            sendMessageWithImage() {
                let vm = this;
                let formData = new FormData();
                formData.append("chat_room_id", this.chatRoomId);
                formData.append("message", this.chatText);
                formData.append("file", this.chatAsset);
                axios.post("/chat", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                    })
                    .then(function (res) {
                        console.log(res)
                    })
                    .catch(function (err) {
                        console.log(err);
                    });
                },

            getAllMessage(){
                axios.get(`/chat/${this.chatRoomId}`)
                    .then(res => {
                        this.messages = res.data.data
                    }).catch(err => {
                        console.log(err)
                    })
            },

            chatLike(chat){
                axios.get(`/chat/like/${chat.id}`)
                    .then(res => {
                        console.log(res)
                    }).catch(err => {
                        console.log(err)
                    });
                    if(chat.is_reacted != "like"){
                        if(chat.is_reacted == "dislike"){
                            chat.total_deslikes--
                        }
                        chat.total_likes++
                        chat.is_reacted = 'like'
                    }
            },

            chatDislike(chat){
                axios.get(`/chat/dislike/${chat.id}`)
                    .then(res => {
                        console.log(res)
                    }).catch(err => {
                        console.log(err)
                    });
                    if(chat.is_reacted != "dislike"){
                        if(chat.is_reacted == "like"){
                            chat.total_likes--
                        }
                        chat.total_deslikes++
                        chat.is_reacted = 'dislike'
                    }
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

            onFileChange(e) {
                const file = e.target.files[0];
                this.chatImage = URL.createObjectURL(file);
            },
            clearImage(){
                this.chatImage = "";

                $('#chat-image').val('');
            },
            scrollToEnd() {
                $(".message-rad").stop().animate({ scrollTop: $(".message-rad")[0].scrollHeight}, 1000);
            },

        },
    });



</script>


<script>
    $(document).ready(function() {
        $(".dropdown-toggle").dropdown();
        // $(".message-rad").stop().animate({ scrollTop: $(".message-rad")[0].scrollHeight}, 100000);
        $('#imoje').click(function(){
            $('.emoji-area').toggleClass("em-show");

            // $(document).mouseup(function(e)
            // {
            // var container = $(".emoji-area");
            // if (!container.is(e.target) && container.has(e.target).length === 0)
            // {
            // container.addClass();
            // }
            // });
        })
    });
    document.querySelector('emoji-picker').addEventListener('emoji-click', event => app.chatText += event.detail.unicode);

</script>



@endsection