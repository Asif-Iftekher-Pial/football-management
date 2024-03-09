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

<body>
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
                <h4 class="text-center">Manager Registration</h4>
                    <form action="{{ route('manager.login.submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Name</label>
                                    <input type="text" name="name" placeholder="Enter name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-control-label">Email</label>
                                    <input type="email" name="email" placeholder="Enter Email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="form-control-label">Phone</label>
                                    <input type="number" name="phone" placeholder="Enter phone number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="address" class="form-control-label">Address</label>
                                    <input type="text" name="address" placeholder="Enter address" class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <label for="nationality" class="form-control-label">Nationality</label>
                                    <input type="text" name="nationality" placeholder="Enter nationality" class="form-control">
                                </div>
                                
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="age" class="form-control-label">Age</label>
                                    <input type="number" name="age" placeholder="Enter age" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-control-label">Password</label>
                                    <input type="password" name="password" placeholder="Enter password" class="form-control">
                                </div>
                               
                                <div class="form-group">
                                    <label for="dob" class="form-control-label">Date of Birth</label>
                                    <input type="date" name="dob" placeholder="Enter date of birth" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="football_club_manage" class="form-control-label">Football Club Managed</label>
                                    <input type="text" name="football_club_manage" placeholder="Enter football club managed" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="coaching_badges" class="form-control-label">Coaching Badges</label>
                                    <input type="text" name="coaching_badges" placeholder="Enter coaching badges" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Register</button>
                                <a href="{{ route('login') }}" class="btn btn-block btn-success">Login</a>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qualification" class="form-control-label">Qualification</label>
                                    <input type="text" name="qualification" placeholder="Enter qualification" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="honours" class="form-control-label">International Honours</label>
                                    <input type="text" name="honours" placeholder="Enter any international honours" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="international_team_managed" class="form-control-label">International Team Managed</label>
                                    <input type="text" name="international_team_managed" placeholder="Enter international team managed" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="video" class="form-control-label">Video</label>
                                    <input type="text" name="video" placeholder="https://" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="photo" class="form-control-label">Photo</label>
                                    <input type="file" name="photo" class="form-control">
                                </div>
                            </div>
                        </div>
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