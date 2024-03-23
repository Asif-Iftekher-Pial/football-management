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

<body >
    <div class="container">
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
                <h4 class="text-center">Partner Registration</h4>
                    <form action="{{ route('partner.login.submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class=" form-control-label">Name</label>
                                    <input type="text" name="name" placeholder="Enter your name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="email" class=" form-control-label">Email</label>
                                    <input type="email" name="email" placeholder="abc@gmail.com" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="contact" class=" form-control-label">Contact</label>
                                    <input type="number" name="contact" placeholder="Enter contact number with country code" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="address" class=" form-control-label">Address</label>
                                    <textarea name="address" id="" cols="10" rows="2" class="form-control"></textarea>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="website" class=" form-control-label">Website</label>
                                    <input name="website"  placeholder="https://www.yourwebsite.com"  class="form-control">
                                </div> --}}
                            </div>
                            <div class="col-md-6">
                                {{-- <div class="form-group">
                                    <label for="telephone" class=" form-control-label">Telephone</label>
                                    <input type="text" name="telephone" placeholder="Enter your telephone" class="form-control">
                                </div> --}}
                                <div class="form-group">
                                    <label for="country" class=" form-control-label">Country</label>
                                    <input type="text" name="country" placeholder="USA" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password" class=" form-control-label">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <label for="photo" class="form-control-label">Photo</label>
                                    <input type="file" id="file-input" name="photo" class="form-control-file">
                                </div>
                                
                            </div>
                        </div>
                       
                        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Register</button>
                        {{-- <a href="{{ route('login') }}" class="au-btn au-btn--block  btn-success">Login</a> --}}
                        <a href="{{ route('login') }}" class="btn btn-block btn-primary">Login</a>
                        
                    </form>
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