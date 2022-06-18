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
 }
 
 .parsley-type, .parsley-required, .parsley-equalto, .parsley-pattern, .parsley-length{
  color:#ff0000;
 }
 
 </style>

</head>

<body>



    <!-- Preloader -->
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
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
                                        <h1 class="display-3 text-white mb-20">Deliver excellence in Service and Execution!
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
                                        <h1 class="display-3 text-white mb-20">Grow your business with us!
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
                                <form id="login_form">
                                    <h1 class="display-4 mb-10">Welcome to BrotherCart :)</h1>
                                    <p id="message" style="display:none; color:red" > Incorrect 'email' or 'password'</p>
                                    <!-- <p class="mb-30">Sign in to your account and enjoy unlimited perks.</p> -->
                                    <div class="form-group">
                                        <input type="text" onfocus="myFunction()" name="email" id="email" class="form-control" placeholder="Email" required data-parsley-type="email" data-parsley-trigger="keyup" />
                                    </div>
                                    <div class="form-group">
                                        <!-- <div class="input-group"> -->
                                            <input class="form-control" onfocus="myFunction()" required data-parsley-length="[8,16]" data-parsley-trigger="keyup" name="password" id="password" placeholder="Password" type="password">
                                            <!-- <div class="input-group-append">
                                                <span class="input-group-text"><span class="feather-icon"><i
                                                            data-feather="eye-off"></i></span></span>
                                            </div> -->
                                        <!-- </div> -->
                                    </div>
                                    <div class="custom-control custom-checkbox mb-25">
                                        <input class="custom-control-input" id="same-address" type="checkbox">
                                        <label class="custom-control-label font-14" for="same-address">Keep me logged
                                            in</label>
                                    </div>
                                    <div  class="form-group">
                                      <a href="{{url('/forgot_password')}}" >Forgot password?</a>
                                    </div>
                                    <div class="form-group">
                                    <input type="submit" name="submit" id="submit" value="Login" class="btn btn-primary btn-block mt-25" />
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

$(document).ready(function(){
    $('#login_form').parsley();
    $('#login_form').on('submit', function(event){
    event.preventDefault();
    if($('#login_form').parsley().isValid())
    {
            let username=$('#email').val();
            let password=$('#password').val();
            $.ajax({
                type: 'POST',
                url: "{{ url('api/auth/login') }}",
                dataType:'JSON',
                data:  {
                    "email":username,
                    "password":password,
                    // "remember_me":true
                },
                beforeSend:function()
                {
                    $('#submit').attr('disabled', 'disabled');
                    $('#submit').val('Login...');
                },
                success:function(response){
                    console.log("response:",response);
                    console.log("accesstoken",response['access_token']);
                    localStorage.setItem("token",response['access_token']);
                    localStorage.setItem("username",response['user']['name']);
                    localStorage.setItem("email",response['user']['email']);
                    localStorage.setItem("dp",response['user']['dp']);
                    console.log("dp=",response['user']['dp']);
                    $('#login_form')[0].reset();
                    $('#login_form').parsley().reset();
                    $('#submit').attr('disabled', false);
                    $('#submit').val('Login');
                     window.location = "{{ url('dashboard') }}";
                    },
                error:function(response){
                     if(response.status===401){
                        $('#message').show();
                      
                         
                     }
                    console.log(response);
                    $('#login_form')[0].reset();
                    $('#login_form').parsley().reset();
                    $('#submit').attr('disabled', false);
                    $('#submit').val('Login');
                console.log("error",response);
                }
                    
            });

    }

});

});
function myFunction(){
   
    $('#message').hide();
}
    </script>
</body>

</html>