<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/frontend/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    <meta name="csrf-token" content="{{csrf_token()}}">
    @yield('header')
    <link rel="icon" href="{{ asset('assets/frontend/images/favicon.png') }}" type="image/gif" sizes="16x16">
    <style>
     

        .select2-container--default .select2-selection--single {
            border: 1px solid #CED4DA;
            height: 38px !important;
            border-radius: .5rem !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 33px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 33px !important;
        }

        .preloader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('assets/frontend/images/loader/beginning_animation.gif') 50% 50% no-repeat rgb(255, 255, 255);
            opacity: 1;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #CED4DA;
            height: 38px !important;
            border-radius: .5rem !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 33px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 33px !important;

            position: fixed;
            width: 100%;
            height: 100vh;
            z-index: 1;
            overflow: visible;
            background: #FBFBFB url('assets/frontend/images/loader/beginning_animation.gif') no-repeat center center;
        }

        li.nav-item {
            margin-left: 17px;
        }

    </style>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body style="@if(Request::path() == 'privacy-policy' || Request::path() == 'terms-services') background: #E5E5E5 @endif">
   
    <header class="hedar-area">
        <div class="container-fluid">
            <nav
                class="navbar navbar-expand-lg navbar-light d-flex justify-content-between @if(Request::path() == 'privacy-policy' || Request::path() == 'terms-services') @else bg-white  @endif fixed-top">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('assets/frontend/images/logo/logo______.png') }}" alt="logo" style="width:80%;">
                </a>
                <div class="menu-item">
                    <ul class="navbar-nav ml-auto">
                        @yield('menu-item')
                        @if(Auth::check())
                        <li class="nav-item">
                            <a class="nav-link logout-button"
                                onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                                href="javascript:void(0)">
                                <span class="menu-title">Logout</span>
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>

                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    @if(auth()->check())
    @if (!request()->is('account/*'))
    <div class="modal fadeIn" id="welcomModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-body">
                    <div class="welcome-message p-3 text-center">
                        <h5>Welcome to Sneakly {{request()->is('/account/nasim')}}</h5>
                        <p class="font-weight-bolder">We are glad you’ve become a member,
                            However there’s one last step before we can begin. In order for you to win the bonus you
                            must
                            enter your
                            address in My Account.</p>
                        <a href="{{ url('account/'.Auth::user()->username) }}"
                            class="btn btn-primary rounded-0 border-sn bg-snw pl-5 pr-5 pt-2 pb-2">Ok</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @endif

    <div class="main-area text-center" style="margin-top: 100px;">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="{{ asset('assets/frontend/bootstrap/js/bootstrap.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> --}}
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>




<script>
    
    window.onload = function () { 
        setTimeout(function(){ 
            $(".preloader").fadeOut();
            // alert('yes');
            }, 3000);
        // $("#preloaders").fadeOut(1000);
}
</script>



    @if (auth()->check())
    @if (!auth()->user()->address)
    <script>
        $(document).ready(function(){
            $('#welcomModal').modal('show');
          })
    </script>
    @endif
    @endif

    <script>
        $(document).ready(function(){
                let token = '{{auth()->check() ? auth()->user()->api_token : ""}}';
                if(token != ""){
                    localStorage.setItem("token", token);
                }
                
            });
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')

</body>

</html>