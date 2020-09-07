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
    <link rel="icon" href="{{ asset('assets/frontend/images/logo/logo.png') }}" type="image/gif" sizes="16x16">
    <style>
        #loader {
            position: fixed;
            width: 100%;
            height: 100vh;
            z-index: 1;
            overflow: visible;
            background: #FBFBFB url('assets/frontend/images/loader/beginning_animation.gif') no-repeat center center;
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
        }

        .loader {
            position: fixed;
            width: 100%;
            height: 100vh;
            z-index: 1;
            overflow: visible;
            background: #FBFBFB url('assets/frontend/images/loader/beginning_animation.gif') no-repeat center center;
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

    </style>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body
    style="@if(Request::path() == 'privacy-policy' || Request::path() == 'terms-services') background: #E5E5E5 @endif">
    {{-- <div id="loader"></div> --}}
    <header class="hedar-area">
        <div class="container-fluid">
            <nav
                class="navbar navbar-expand-lg navbar-light @if(Request::path() == 'privacy-policy' || Request::path() == 'terms-services') @else bg-white  @endif fixed-top">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('assets/frontend/images/logo/logo.png') }}" alt="logo" style="width:80%;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        @yield('menu-item')
                        @if(Auth::check())
                        <a class="nav-link logout-button"
                            onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                            href="javascript:void(0)">
                            <span class="menu-title">Logout</span>
                            <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                        </a>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <div class="main-area text-center" style="margin-top: 100px;">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="{{ asset('assets/frontend/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>






    {{-- document.addEventListener("DOMContentLoaded", function() {
    loader = document.getElementById('loader');
    loadNow(2.3);
    });
     --}}
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
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