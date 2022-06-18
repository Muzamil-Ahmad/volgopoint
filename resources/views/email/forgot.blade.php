
<h1> Hello <?php echo $user->name; ?> </h1>
<p>
Please click the password reset button to reset your password
<!-- <a href=url('reset_password/'.$user->email.'/'.$code) ?>>Reset password</a> -->
<a href="{{url('reset_password')}}/{{ $user->email }}">Reset password</a>