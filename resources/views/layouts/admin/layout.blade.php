<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Welcome to Sneakly Admin panel</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/iconfonts/font-awesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/css/vendor.bundle.addons.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/lightgallery/css/lightgallery.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">

    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">
    <link rel="icon" href="{{ asset('assets/frontend/images/logo/logo.png') }}" type="image/gif" sizes="16x16">
    <style>
        .logout-button {
            position: absolute;
            right: 10px;
            top: 17px;
            color: #000;
        }

        .active {
            font-weight: bold !important;
            color: #000;
        }

        .bonus-switch {
            margin-top: 200px;
        }

    </style>
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 100px;
            height: 29px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #EDEDED;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 23px;
            width: 24px;
            left: 0;
            bottom: 3px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
            margin-left: 4px;
            margin-right: 4px;
        }

        input:checked+.slider {
            background-color: #C34DFB;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #C34DFB;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(68px);
            -ms-transform: translateX(68px);
            transform: translateX(68px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

    </style>

    <!-- endinject -->
    @yield('head')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="{{ route('chatroom.create') }}">
                    <img src="{{ asset('assets/frontend/images/logo/logo.png') }}" alt="logo" style="width:auto">
                    <a class="navbar-brand brand-logo-mini" href="{{ route('chatroom.create') }}">
                        <img src="{{ asset('assets/frontend/images/logo/logo.png') }}" alt="logo" style="width:auto">
                    </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="fas fa-bars"></span>
                </button>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="fas fa-bars"></span>
                </button>
                <a class="nav-link logout-button"
                    onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                    href="javascript:void(0)">
                    <span class="menu-title">Logout</span>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>

                </a>
            </div>

        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == 'admin/chatroom/create' ? 'active': '' }}"
                            href="{{route('chatroom.create')}}">
                            <span class="menu-title">Upload</span>
                        </a>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == 'admin/chatroom' ? 'active' : '' }}"
                            href="{{route('chatroom.index')}}">
                            <span class="menu-title">Chat Rooms</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == 'admin/winners' ? 'active' : '' }}"
                            href="{{route('winners')}}">
                            <span class="menu-title">Winners</span>
                        </a>
                    </li>
                </ul>


                <div class="bonus-switch d-flex justify-content-start"
                    style="padding:0.75rem 1.875rem 0.75rem 1.875rem">
                    <label style="font-size: 20px;font-weight: bold;margin-right: 10px;">Bonus</label>
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                </div>
            </nav>
            <!-- partial -->

            <div class="main-panel">

                @yield('content')

                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                            Having Issues? Please contact <a
                                href="mailto:Lesan@tridedesigns.com">Lesan@tridedesigns.com</a> </span>

                    </div>
                </footer>
            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{asset('assets/admin/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('assets/admin/vendors/js/vendor.bundle.addons.js')}}"></script>
    <script src="{{asset('assets/admin/js/off-canvas.js')}}"></script>
    <script src="{{asset('assets/admin/js/settings.js')}}"></script>
    <script src="{{asset('assets/admin/js/dashboard.js')}}"></script>
    <script src="{{asset('assets/admin/js/dropify.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

    <script src="{{asset('assets/admin/vendors/lightgallery/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/light-gallery.js')}}"></script>

    <script src="{{asset('assets/admin/vendors/summernote/dist/summernote-bs4.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/summernote/dist/summernote-bs4.css')}}">
    <script>
        $(document).ready(function () {
        $('select.select2').select2();
        $('table.dataTable').DataTable({
            "order": [[0, "desc"]]
        });
    });
    </script>
    @yield('script')
</body>

</html>