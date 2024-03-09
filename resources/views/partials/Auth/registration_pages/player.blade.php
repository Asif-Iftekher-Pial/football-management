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
            <h4 class="text-center">Player Registration</h4>
            <form action="{{ route('player.login.submit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name" class="form-control-label">Name</label>
                            <input type="text" name="name" placeholder="Enter name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-control-label">Email</label>
                            <input type="email" name="email" placeholder="Enter Email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="age" class="form-control-label">Age</label>
                            <input type="number" name="age" placeholder="Enter age" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-control-label">Phone</label>
                            <input type="number" name="phone" placeholder="Enter phpne number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="address" class="form-control-label">Address</label>
                            <input type="text" name="address" placeholder="Enter address" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="dob" class="form-control-label">Date of Birth</label>
                            <input type="date" name="dob" placeholder="Enter date of birth" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="video" class="form-control-label">Video</label>
                            <input type="text" id="file-input" name="video" placeholder="https://" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="height" class="form-control-label">Height</label>
                            <input type="number" name="height" placeholder="Enter height" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="weight" class="form-control-label">Weight</label>
                            <input type="number" name="weight" placeholder="Enter weight" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="foot" class="form-control-label">Favourite Foot</label>
                            <select class="form-control" name="favourite_foot" id="foot">
                              <option value="left">Left</option>
                              <option value="right">Right</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="position" class="form-control-label">Position</label>
                            <select class="form-control" name="position" id="position">
                              <option value="">--Select Position--</option>
                              <option value="goalkeeper">Goalkeeper</option>
                              <option value="central_defender">Central Defender</option>
                              <option value="defender_right">Defender Right</option>
                              <option value="defender_left">Defender Left</option>
                              <option value="midfielder">Midfielder</option>
                              <option value="left_wing">Left Wing</option>
                              <option value="right_wing">Right Wing</option>
                              <option value="forward">Forward</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nationality" class="form-control-label">Nationality</label>
                            <input type="text" name="nationality" placeholder="Enter nationality" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="passport_type" class="form-control-label">Passport Type</label>
                            <select class="form-control" name="passport_type" id="passport_type">
                              <option value="">--Select Types--</option>
                              <option value="ordinary">Ordinary </option>
                              <option value="official">Official</option>
                              <option value="diplomatic">Diplomatic</option>
                              <option value="special">Special </option>
                            </select>
                        </div>
                        
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="allergies" class="form-control-label">Allergies</label>
                            <select class="form-control" name="allergies" id="allergies">
                              <option value="">---Select---</option>
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                             
                            </select>
                        </div>

                       <div class="form-group">
                            <label for="gender" class="form-control-label">Gender</label>
                            <br>
                            {{-- radio --}}
                            <div class="form-check-inline form-check">
                                <label for="inline-radio1" class="form-check-label mr-3 ">
                                    <input type="radio" id="inline-radio1" name="gender"  value="male" class="form-check-input">Male
                                </label>
                                <label for="inline-radio2" class="form-check-label ">
                                    <input type="radio" id="inline-radio2" name="gender" value="female" class="form-check-input">Female
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_passport_more_then_one" class="form-control-label">Multiple Passports</label>
                            <select class="form-control" name="is_passport_more_then_one" id="is_passport_more_then_one">
                              <option value="">---Select---</option>
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="current_club" class="form-control-label">Current Club</label>
                            <input type="text" name="current_club" placeholder="Enter current club" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="international_appearance" class="form-control-label">International Appearance</label>
                            <select class="form-control" name="international_appearance" id="international_appearance">
                                <option value="">--Select---</option>
                                <option value="full_cup">Full Cap</option>
                                <option value="under_21">Under 21's</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contract_length" class="form-control-label">Contract Length</label>
                            <input type="text" name="contract_length" placeholder="Enter contract length" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="football_group_player" class="form-control-label">Football Group Player</label>
                            <input type="text" name="football_group_player" placeholder="Enter football group player" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="blood_type" class="form-control-label">Blood Type</label>
                            <select class="form-control" name="blood_type" id="blood_type">
                              <option value="">--Select---</option>
                              <option value="a+">A+</option>
                              <option value="a-">A-</option>
                              <option value="b+">B+</option>
                              <option value="b-">B-</option>
                              <option value="ab+">AB+</option>
                              <option value="ab-">AB-</option>
                              <option value="o+">O+</option>
                              <option value="o-">O-</option>
                              
                            </select>
                        </div>
                       
                        <div class="form-group">
                            <label for="previous_injuries" class="form-control-label">Previous Injuries</label>
                            <input type="text" name="previous_injuries" placeholder="Enter previous injuries" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="about_player" class="form-control-label">About Player</label>
                            <textarea name="about_player" cols="10" rows="1"  class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="other_info" class="form-control-label">Other Information</label>
                            <textarea name="other_info" cols="10" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-control-label">Password</label>
                            <input type="password" name="password"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="photo" class="form-control-label">Photo</label>
                            <input type="file" id="file-input" name="photo" required class="form-control">
                        </div>
                       
                    </div>
                </div>
                <div class="col-md-12">
                        <button type="submit" class="btn btn-block btn-primary text-center">Register</button>
                        <a href="{{ route('login') }}" class="btn btn-block btn-success">Login</a>
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