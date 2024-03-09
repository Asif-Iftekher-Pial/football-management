<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin_essentials/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_essentials/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_essentials/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_essentials/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin_essentials/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('admin_essentials/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_essentials/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_essentials/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_essentials/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_essentials/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_essentials/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_essentials/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin_essentials/css/theme.css') }}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="{{ asset('logo/pdf_header.png') }}" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert"
                                id="alert">
                                {{ session()->get('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        {{-- error message --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <form action="{{ route('submit.login') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email"  @if (Cookie::has('backendcookieNameEmail')) value="{{ Cookie::get('backendcookieNameEmail') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password" @if (Cookie::has('backendcookieNamePassword')) value="{{ Cookie::get('backendcookieNamePassword') }}" @endif>
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox"  name="rememberMe" >Remember Me
                                    </label>
                                    {{-- <label>
                                        <a href="#">Forgotten Password?</a>
                                    </label> --}}
                                </div>
                                <button class="au-btn au-btn--block au-btn--green" type="submit">sign in</button>
                                {{-- <div class="social-login-content">
                                    <div class="social-button">
                                        <button class="au-btn au-btn--block au-btn--blue m-b-20">sign in with facebook</button>
                                        <button class="au-btn au-btn--block au-btn--blue2">sign in with twitter</button>
                                    </div>
                                </div> --}}
                            </form>
                            <div class="row mt-0">
                                <div class="col-md-12 mt-0">
                                    <p class="text-center">Registration</p>
                                </div>
                                <div class="col-md-6">
                                    <p>Manager<a class="ml-1" href="{{ route('manager.login') }}">Click Here</a></p>
                                    <p>Player<a class="ml-1" href="{{ route('player.login') }}">Click Here</a></p>
                                    <p>Football Club<a class="ml-1" href="{{ route('club.login') }}">Click Here</a></p>
                                </div>
                                <div class="col-md-6">
                                    <p>Football Partner<a class="ml-1" href="{{ route('partner.login') }}">Click Here</a></p>
                                    <p>Football Staff<a class="ml-1" href="{{ route('staff.login') }}">Click Here</a></p>
                                    <p>Football Job<a class="ml-1" href="{{ route('job.login') }}">Click Here</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('admin_essentials/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('admin_essentials/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin_essentials/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('admin_essentials/vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ asset('admin_essentials/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin_essentials/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('admin_essentials/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ asset('admin_essentials/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin_essentials/vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{ asset('admin_essentials/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('admin_essentials/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin_essentials/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_essentials/vendor/select2/select2.min.js') }}">
    </script>

    <!-- Main JS-->
    <script src="{{ asset('admin_essentials/js/main.js') }}"></script>
    <script>
        setTimeout(function() {
            $('#alert').slideUp();
        }, 4000);
    </script>

</body>

</html>
<!-- end document-->