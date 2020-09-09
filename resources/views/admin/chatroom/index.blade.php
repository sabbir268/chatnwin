@extends('layouts.admin.layout')
<style>
    .card.card-statistics {
        background: linear-gradient(85deg, #06b76b, #f5a623);
        color: #ffffff;
    }

    .admin-char_room-single {
        position: relative;
        margin-bottom: 35px;
    }

    .admin-char_room-single a {
        text-decoration: none;
        color: #000000;
    }

    .admin-char_room-single a:hover {
        text-decoration: none;
        color: #000000;
    }

    .chat_cross_btn {
        position: absolute;
        top: -9px;
        right: -11px;
        background: #c34dfb;
        height: 30px;
        width: 30px;
        text-align: center;
        line-height: 30px;
        border-radius: 50%;
        padding-top: 7px;
        color: #fff;
        cursor: pointer;
    }

    .admin-chat-image {
        position: relative;
    }

    .chatroom-edit-area {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        background: #004eff7a;
        height: 100%;
        opacity: 0;
        transition: .25s;
        text-align: center
    }

    .chatroom-edit-area i {
        position: relative;
        top: 43%;
        background: #a33cd4;
        padding: 10px;
        color: #fff;
        height: 40px;
        width: 40px;
        text-align: center;
        border-radius: 50%;
    }

    .admin-chat-image:hover>.chatroom-edit-area {
        opacity: 1;
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
                <div class="row">
                    @foreach ($chatrooms as $chatroom)
                    <div class="col-md-4">
                        <div class="admin-char_room-single" style="width: 100%">
                            {{-- <a href="#"> --}}
                            <div class="admin-chat-image">
                                <img src="{{ asset('storage/'.$chatroom->photo) }}" alt="image" style="width: 100%">
                                <div class="chatroom-edit-area">
                                    <a href="{{ route('chatroom.edit',$chatroom->id) }}"><i class="fas fa-edit"></i></a>
                                </div>
                            </div>
                            <h4 class="text-center mt-3">{{ $chatroom->name }}</h4>
                            {{-- </a> --}}
                            <i class="fas fa-minus chat_cross_btn" id="delete_chatroom"
                                data-id="{{ $chatroom->id }}"></i>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
            $(document).on('click', '#delete_chatroom', function(){
                var id = $(this).data('id');
                if(confirm('Are you sure want to delte this data ? ')){
                    $.post('{{ route('admin.chatroom.delete') }}', {_token:'{{ csrf_token() }}', id:id}, function(data){
                if(data == 1){
                    alert('Chatroom deleted successfully');
                    location.reload();
                }
                else{
                    alert('Soemting went wrong !');
                }
            });
                }
                

            });
        });
</script>
@endsection