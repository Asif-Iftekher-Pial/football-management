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
                {{-- <div class="login-wrap"> --}}
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
                            <form action="{{ route('job.login.submit') }}" method="post" enctype="multipart/form-data">
                                <h3 class="text-center mb-2">Football Job Registration</h3>
                                @csrf
                                <div class="row">
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">Name</label>
                                            <input type="text" name="name" placeholder="Enter name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="form-control-label">Email</label>
                                            <input type="email" name="email" placeholder="Enter email" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="form-control-label">Phone</label>
                                            <input type="number" name="phone" placeholder="Enter phone number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address" class="form-control-label">Address</label>
                                            <input type="text" name="address" placeholder="Enter address" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="dob" class="form-control-label">Date of Birth</label>
                                            <input type="date" name="dob" placeholder="Enter date of birth" class="form-control" >
                                        </div>
                
                                        <div class="form-group">
                                            <label for="position" class="form-control-label">Position</label>
                                            <select class="form-control" name="position" id="exampleFormControlSelect1">
                                              <option value="" >---->Select Position<----</option>
                                              <option value="chairperson" >Chairperson</option>
                                              <option value="director" >Director</option>
                                              <option value="secretarial">Secretarial</option>
                                              <option value="public_relations" >Public Relations</option>
                                              <option value="communication" >Communication</option>
                                              <option value="marking" >Marking</option>
                                              <option value="web_team" >Web Team</option>
                                              <option value="social_media">Social Media</option>
                                              <option value="grounds_person" >Grounds Person</option>
                                              <option value="foundation_charity">Foundation/Charity</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-block btn-primary">Register</button>
                                        <a href="{{ route('login') }}" class="btn btn-block btn-success">Login</a>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="experience" class="form-control-label">Experience</label>
                                            <textarea cols="10" rows="3"  name="experience" placeholder="Enter your experience" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="about_you" class="form-control-label">About You</label>
                                            <textarea cols="10" rows="3"  name="about_you" placeholder="Enter about you" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="form-control-label">Password</label>
                                            <input type="password" name="password" placeholder="Enter password" class="form-control">
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="photo" class="form-control-label">Photo</label>
                                            <input type="file" name="photo" class="form-control">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </form>
                            {{-- <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="#">Sign Up Here</a>
                                </p>
                            </div> --}}
                        </div>
                    </div>
                {{-- </div> --}}
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