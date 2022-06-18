<!DOCTYPE html>
<!-- 
Template Name: Pangong - Responsive Bootstrap 4 Admin Dashboard Template
Author: Hencework
Contact: https://hencework.ticksy.com/
License: You must have a valid license purchased only from themeforest to legally use the template for your project.
-->
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>BrotherCart Login</title>
    <meta name="description" content="BrotherCart" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('admin_assets/favicon.ico')}}">
    <link rel="icon" href="{{asset('admin_assets/favicon.ico')}}" type="image/x-icon">

    <!-- Custom CSS -->
    <link href="{{asset('admin_assets/dist/css/style.css')}}" rel="stylesheet" type="text/css">

    <style>
 .box
 {
  width:100%;
  max-width:600px;
  background-color:#f9f9f9;
  border:1px solid #ccc;
  border-radius:5px;
  padding:16px;
  margin:0 auto;
 }
 input.parsley-success,
 select.parsley-success,
 textarea.parsley-success {
   color: #468847;
   background-color: #DFF0D8;
   border: 1px solid #D6E9C6;
 }

 input.parsley-error,
 select.parsley-error,
 textarea.parsley-error {
   color: #B94A48;
   background-color: #F2DEDE;
   border: 1px solid #EED3D7;
 }


 .parsley-errors-list {
   margin: 2px 0 3px;
   padding: 0;
   list-style-type: none;
   font-size: 0.9em;
   line-height: 0.9em;
   opacity: 0;


   transition: all .3s ease-in;
   -o-transition: all .3s ease-in;
   -moz-transition: all .3s ease-in;
   -webkit-transition: all .3s ease-in;
 }


 .parsley-errors-list.filled {
   opacity: 1;
   color:#ff0000;
 }
 
 .parsley-type, .parsley-required, .parsley-equalto, .parsley-pattern, .parsley-length{
  color:#ff0000;
 }
 
 </style>

</head>

<body>



    <!-- Preloader -->
    <!-- <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div> -->
    <!-- /Preloader -->

    <!-- HK Wrapper -->
    <div class="hk-wrapper">

        <!-- Main Content -->
        <div class="hk-pg-wrapper hk-auth-wrapper">
            <header class="d-flex justify-content-between align-items-center">
                <a class="d-flex auth-brand" href="#">
                    <img class="brand-img" src="{{asset('admin_assets/dist/img/logo-light.png')}}" alt="brand" />
                </a>
                <!-- <div class="btn-group btn-group-sm">
                    <a href="#" class="btn btn-outline-secondary">Help</a>
                    <a href="#" class="btn btn-outline-secondary">About Us</a>
                </div> -->
            </header>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-5 pa-0">
                        <div id="owl_demo_1" class="owl-carousel dots-on-item owl-theme">
                            <div class="fadeOut item auth-cover-img overlay-wrap"
                                style="background-image:url('images/brother2.jpg');">
                                <div class="auth-cover-info py-xl-0 pt-100 pb-50">
                                    <div class="auth-cover-content text-center w-xxl-75 w-sm-90 w-xs-100">
                                        <h1 class="display-3 text-white mb-20">Understand and look deep into nature.
                                        </h1>
                                        <!-- <p class="text-white">The purpose of lorem ipsum is to create a natural looking
                                            block of text (sentence, paragraph, page, etc.) that doesn't distract from
                                            the layout. Again during the 90s as desktop publishers bundled the text with
                                            their software.</p> -->
                                    </div>
                                </div>
                                <div class="bg-overlay bg-trans-dark-50"></div>
                            </div>
                            <div class="fadeOut item auth-cover-img overlay-wrap"
                            style="background-image:url('{{asset('images/brother1.png')}}')">
                                <div class="auth-cover-info py-xl-0 pt-100 pb-50">
                                    <div class="auth-cover-content text-center w-xxl-75 w-sm-90 w-xs-100">
                                        <h1 class="display-3 text-white mb-20">Experience matters for good applications.
                                        </h1>
                                        <!-- <p class="text-white">The passage experienced a surge in popularity during the
                                            1960s when Letraset used it on their dry-transfer sheets, and again during
                                            the 90s as desktop publishers bundled the text with their software.</p> -->
                                    </div>
                                </div>
                                <div class="bg-overlay bg-trans-dark-50"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 pa-0">
                        <div class="auth-form-wrap py-xl-0 py-50">
                            <div class="auth-form w-xxl-55 w-xl-75 w-sm-90 w-xs-100">
                                <form id="emailform">
                                    <h6 class="display-4 mb-10 "id="message">Email</h6>
                                    <!-- <p class="mb-30">Sign in to your account and enjoy unlimited perks.</p> -->
                                    <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your E-mail"  data-parsley-type="email" data-parsley-error-message="Email is required and should be valid" data-parsley-errors-container="emailError" required="required" data-parsley-trigger="keyup" />
                                   <p id="emailError" style="color:red"></p>
                                    </div>
                                    
                                   
                                    
                                    <input type="submit" name="submit" id="submit" value="submit" class="btn btn-dark ">
  
                                    </div>
                                    <!-- <p class="font-14 text-center mt-15">Having trouble logging in?</p> -->
                                    <!-- <div class="option-sep">or</div> -->
                                    <!-- <div class="form-row">
                                        <div class="col-sm-6 mb-20">
                                            <button class="btn btn-indigo btn-block btn-wth-icon"> <span
                                                    class="icon-label"><i class="fa fa-facebook"></i> </span><span
                                                    class="btn-text">Login with facebook</span></button>
                                        </div>
                                        <div class="col-sm-6 mb-20">
                                            <button class="btn btn-primary btn-block btn-wth-icon"> <span
                                                    class="icon-label"><i class="fa fa-twitter"></i> </span><span
                                                    class="btn-text">Login with Twitter</span></button>
                                        </div>
                                    </div> -->
                                    <!-- <p class="text-center">Do have an account yet? <a href="#">Sign Up</a></p> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->

    <!-- jQuery -->
    <script src="{{asset('admin_assets/vendors/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('admin_assets/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- Slimscroll JavaScript -->
    <script src="{{asset('admin_assets/dist/js/jquery.slimscroll.js')}}"></script>

    <!-- Fancy Dropdown JS -->
    <script src="{{asset('admin_assets/dist/js/dropdown-bootstrap-extended.js')}}"></script>

    <!-- Owl JavaScript -->
    <script src="{{asset('admin_assets/vendors/owl.carousel/dist/owl.carousel.min.js')}}"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="{{asset('admin_assets/dist/js/feather.min.js')}}"></script>

    <!-- Init JavaScript -->
    <script src="{{asset('admin_assets/dist/js/init.js')}}"></script>
    <script src="{{asset('admin_assets/dist/js/login-data.js')}}"></script>
    <script src="{{asset('admin_assets/dist/ejs/parsley.js')}}"></script>
    <!-- <script src="http://parsleyjs.org/dist/parsley.js"></script> -->
    <script>

$(document).ready(function () {
$('#emailform').parsley();
$('#emailform').on('submit', function (event) {
        event.preventDefault();
        if ($('#emailform').parsley().isValid()) {
            let email = $('#email').val();
            $.ajax({
                type: 'POST',
                url: '{{ url("/api/auth/forgot_password")}}',
                dataType: 'JSON',
                data: {
                    "email": email
                },
                token: '{{ csrf_token()}}',
                headers: {
                    "Authorization": 'Bearer ' + localStorage.getItem('token')
                },
                beforeSend: function () {
                    $('#submit').attr('disabled', 'disabled');
                    $('#submit').val('submitting...');
                },
                success: function (response) {
                    $('#emailform')[0].reset();
                     $('#emailform').parsley().reset();
                    $('#submit').attr('disabled', false);
                    $('#submit').hide();
                    $('#email').hide();
                    document.getElementById("message").innerHTML = response['message'];
                    
                },
                error: function (response) {
                  
                    document.getElementById("message").innerHTML = "something went wrong";
                }
            });
        }
    });
});

    </script>
</body>

</html>