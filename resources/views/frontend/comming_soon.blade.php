<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/frontend/bootstrap/css/bootstrap.min.css') }}">
    <title>Coming soon | Sneakly</title>
    <link rel="icon" href="{{ asset('assets/frontend/images/favicon.png') }}" type="image/gif" sizes="16x16">
    <style>
        .row {
            margin: 0;
            padding: 0;
        }

        header.header-area {
            text-align: center;
            padding: 30px 0;
        }

        .header-area img {
            width: 25rem;
            margin-left: 9%;
        }

        .main-area {
            min-height: 63vh;
        }

        .content-single {
            margin-top: 50px;
        }

        .content-single img {
            width: 80px;
        }

        .input-group {
            border: 2px solid #000;
            border-radius: 6px;
        }

        .invite-form>input {
            height: 50px !important;
            border: none !important;
            outline: none !important;
        }

        .btn:focus,
        .btn:active {
            outline: none !important;
            box-shadow: none;
        }

        .content-single p {
            font-weight: bold;
            text-align: center;
            padding: 9px 6px 0 0;
        }

        button {
            background: #981DD1 !important;
            border: none !important;
            border-left: 2px solid #000 !important;
        }

        .code-form>input {
            height: 53px !important;
            outline: none !important;
            margin: 0 9px;
            border-radius: 10px;
            border: 2px solid #000000 !important;
            padding: 22px;
            text-align: center;
        }

        .code-form>button {
            background: #000000 !important;
            border-radius: 10px;
        }

        .footer-content p {
            padding: 0px 25%;
            font-size: 14px;
        }

        .footer-content {
            margin-left: 21%;
        }

        @media only screen and (max-width: 600px) {
            .header-area img {
                width: 15rem;
                margin-left: 0;
            }

            .content-single {
                margin-top: 25px;
                text-align: center;
            }

            .code-form>input {
                margin: 0px 1px;
            }

            .footer-content {
                margin-left: 0;
                margin-top: 30px;
            }

            .footer-content p {
                padding: 0;
                font-size: 13px;
            }

            .content-single p {
                font-weight: 500;
                text-align: center;
                padding: 0;
                font-size: 11px;
            }
        }
    </style>
</head>

<body>
    <header class="header-area">
        <div class="logo">
            <img src="{{ asset('assets/frontend/images/logo/vertigo.png') }}" alt="logo">
        </div>
    </header>
    <div class="main-area">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="content-area">
                    <div class="content-single">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{ asset('assets/frontend/images/other/Group 297.png') }}" alt="">
                            </div>
                            <div class="col-md-9">
                                <p>In order to enter the site you must invite
                                    5 friends with your custom link below: </p>
                                <form action="#">
                                    <div class="input-group mb-3 invite-form">
                                        <input type="text" class="form-control" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">retrieve</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="content-single">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{ asset('assets/frontend/images/other/Group 298.png') }}" alt="">
                            </div>
                            <div class="col-md-9">
                                <p>After you’ve invited your 5 friends, enter the 4-digit code after the forward slash
                                    in your custom link</p>
                                <form action="#">
                                    <div class="code-form d-flex justify-content-between">
                                        <input type="text" class="form-control">
                                        <input type="text" class="form-control">
                                        <input type="text" class="form-control">
                                        <input type="text" class="form-control">
                                        <button class="btn btn-primary" type="button">&nbsp;&nbsp; enter
                                            &nbsp;&nbsp;&nbsp;</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer-area">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <div class="footer-content">
                    <p>Confused about what we do?
                        Check out our Instagram and find out!</p>
                    <img src="assets/frontend/images/other/87390 1.png" alt="">
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
