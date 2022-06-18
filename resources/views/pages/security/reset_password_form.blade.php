
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Reset password form</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">
<!-- Toastr CSS -->
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
 <!-- Font -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
<style>
.parsley-type, .parsley-required, .parsley-equalto, .parsley-pattern, .parsley-length{
  color:#ff0000;
 }
body {
            background: white; 
}
        .card {
            border: 1px solid #28a745;
            margin-left:30%
        }
        .card-login {
            margin-top: 130px;
            padding: 18px;
            max-width: 30rem;
        }

        .card-header {
            color: #fff;
            /*background: #ff0000;*/
            font-family: sans-serif;
            font-size: 20px;
            font-weight: 600 !important;
            margin-top: 10px;
            border-bottom: 0;
        }

 .form-control {
            display: block;
            width: 100%;
            height: calc(2.25rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 1.2rem;
            line-height: 1.6;
            color: #28a745;
            background-color: transparent;
            background-clip: padding-box;
            border: 1px solid #28a745;
            border-radius: 0;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .login_btn{
            width: 10rem;
            line-height: 200%;
        }

        .login_btn:hover{
            color: #fff;
            background-color: blue;
        }

        .btn-outline-danger {
            color: #fff;
            font-size: 15px;
            background-color: #28a745;
            background-image: none;
            border-color: #28a745;
        }

</style>
</head>

<body>


<!-- <div class="container"> -->
    <div class="card card-login mx-auto text-center bg-dark">
        <div class="card-header mx-auto bg-dark">
            <span> <img src="{{asset('admin_assets/dist/img/logo-light.png')}}"  class="w-75" alt="Logo"> </span><br/>
         </div>
        <div class="card-body">
            <form id="reset_password_form">
            Password:<br>
            <input type="password" class="form-control" id="password" name="password" required data-parsley-length="[8,16]" data-parsley-trigger="keyup" >
            <br><br>
            Confirm Password:<br>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required data-parsley-length="[8,16]" data-parsley-trigger="keyup"  data-parsley-equalto="#password">
            <br><br>
            <input  type="submit" class=" btn-outline-danger float-right login_btn" name="submit" id="submit" value="change password" >
            </form>
         </div>
    </div>
<!-- </div> -->

<!-- jQuery -->
<script src="{{asset('admin_assets/vendors/jquery/dist/jquery.min.js')}}"></script>
<!-- parsley -->
<script src="{{asset('admin_assets/dist/ejs/parsley.js')}}"></script>

<script>
  $(document).ready(function () {
			console.log("reached in ready function");
			$('#reset_password_form').parsley();
			$('#reset_password_form').on('submit', function (event) {
					console.log("reached in on submit");
					event.preventDefault();
					if ($('#reset_password_form').parsley().isValid()) {
						console.log("reached in parsley is valid");
						let pageURL = window.location.href;
						let lastURLSegment = pageURL.substr(pageURL.lastIndexOf('/') + 1);
						console.log(lastURLSegment);
						let password = $('#password').val();
						let confirm_password = $('#confirm_password').val();
						if (password === confirm_password) {
							$.ajax({
								type: 'POST',
								url: "{{ url('api/auth/password_reset') }}",
								dataType: 'JSON',
								data: {
									"email": lastURLSegment,
									"password": password,
									// "remember_me":true
								},


								success: function (response) {
                                    toastr.success(response['message']);
							
									window.location = "{{ url('admin') }}";
								},
								error: function (response) {
									$('#login_form')[0].reset();
									$('#login_form').parsley().reset();
									$('#submit').attr('disabled', false);
									$('#submit').val('Login');
									console.log("error", response);
								}

							});

                        }
                       
                    }

					});
            }); 
            </script>
            </body>
            </html>