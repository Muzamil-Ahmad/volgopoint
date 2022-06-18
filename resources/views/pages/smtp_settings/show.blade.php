@extends('master')
@section('content')
<div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">SMTP Settings</li>
                </ol>
            </nav>

            <div class="container">

<!-- Title -->

<div class="row">
    
   <div class="col-sm-2">
   </div>
   <div class="col-sm-8">
   <section class="hk-sec-wrapper">
   <div class="container my-4 ">

   
    
<h4 class="mb-5 h4 text-center ">SMTP Settings</h4><br>

<!-- Default horizontal form -->
<form action="{{ route('env_key_update.update') }}" method="POST">
@csrf
<!-- Grid row -->

  <div class="form-group row">
              <label for="mail_deriver" class="col-sm-3 col-form-label">MAIL DERIVER</label>
              <input type="hidden" name="types[]" value="MAIL_DRIVER">
              <div class="col-sm-9">
                  <select class="custom-select" name="MAIL_DRIVER" onchange="checkMailDriver()">
                      <option value="sendmail" @if (env('MAIL_DRIVER') == "sendmail") selected @endif>Sendmail</option>
                      <option value="smtp" @if (env('MAIL_DRIVER') == "smtp") selected @endif>SMTP</option>
                      <option value="mailgun" @if (env('MAIL_DRIVER') == "mailgun") selected @endif>Mailgun</option>
                  </select>
               </div>
            </div>
  <!-- Grid row -->

  <!-- Grid row -->
  <div class="form-group row">
    <!-- Default input -->
    <input type="hidden" name="types[]" value="MAIL_HOST">
    <label for="mail_host" class="col-sm-3 col-form-label">MAIL HOST</label>
    <div class="col-sm-9">
    <input type="text" class="form-control" name="MAIL_HOST" value="{{  env('MAIL_HOST') }}" placeholder="MAIL HOST">
     </div>
  </div>
  <!-- Grid row -->

<!-- Grid row -->
<div class="form-group row">
    <!-- Default input -->
    <input type="hidden" name="types[]" value="MAIL_PORT">
    <label for="mail_port" class="col-sm-3 col-form-label">MAIL PORT</label>
    <div class="col-sm-9">
      <input type="text" value="{{  env('MAIL_PORT') }}" required data-parsley-required-message="Your footer text was missing." class="form-control" name="MAIL_PORT" id="mail_port" placeholder="Mail Port...">
    </div>
  </div>
  <!-- Grid row -->


  <!-- Grid row -->
<div class="form-group row">
    <!-- Default input -->
    <input type="hidden" name="types[]" value="MAIL_USERNAME">
    <label for="mail_username" class="col-sm-3 col-form-label">MAIL USERNAME</label>
    <div class="col-sm-9">
      <input type="text" value="{{  env('MAIL_USERNAME') }}" required data-parsley-required-message="Your mail username was missing." class="form-control" name="MAIL_USERNAME" id="mail_username" placeholder="Email">
    </div>
</div>
<!-- Grid row -->
<div class="form-group row">
    <!-- Default input -->
    <input type="hidden" name="types[]" value="MAIL_PASSWORD">
    <label for="mail_password" class="col-sm-3 col-form-label">MAIL PASSWORD</label>
    <div class="col-sm-9">
      <input type="text" value="{{ env('MAIL_PASSWORD') }}" class="form-control" required data-parsley-required-message="Your password was missing." name="MAIL_PASSWORD" id="mail_password">
    </div>
  </div>
  <!-- Grid row -->
  <div class="form-group row">
    <!-- Default input -->
    <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
    <label for="mail_encryption" class="col-sm-3 col-form-label">MAIL ENCRYPTION</label>
    <div class="col-sm-9">
      <input type="text" value="{{ env('MAIL_ENCRYPTION') }}" class="form-control" required data-parsley-required-message="Your mail encryption was missing." name="MAIL_ENCRYPTION" id="mail_encryption" placeholder="Mail Encryption...">
    </div>
  </div>
  <div class="form-group row">
    <!-- Default input -->
    <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
    <label for="mail_from_address" class="col-sm-3 col-form-label">MAIL FROM ADDRESS</label>
    <div class="col-sm-9">
      <input type="text" value="{{  env('MAIL_FROM_ADDRESS') }}" class="form-control" required data-parsley-required-message="Your mail from address was missing." name="MAIL_FROM_ADDRESS" id="mail_from_address" placeholder="Mail from address">
    </div>
  </div>
  <!-- <div class="form-group row">
      <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
    <label for="mail_from_name" class="col-sm-3 col-form-label">MAIL FROM NAME</label>
    <div class="col-sm-9">
      <input type="text" value="{{  env('MAIL_FROM_NAME') }}" class="form-control" required data-parsley-required-message="Your mail from name was missing." name="MAIL_FROM_NAME" id="mail_from_name" placeholder="Mail from name...">
    </div>
  </div> -->

      <!-- Grid row -->
      



  


  <!-- Grid row -->
  <div class="form-group row">
    <div class="col">
      <button id="smtp_submit_button" type="submit" class="btn btn-primary btn-md pull-right">Save</button>
    </div>
  </div>
  <!-- Grid row -->
</form>
</div>  
</section> 
   </div>
   <div class="col-sm-2">
   </div>
</div>
</div>
<script type="text/javascript"> 
                $(document).ready(function () {
                     $('#smtp_setting_form').parsley();
                     $('#smtp_setting_form').on('submit', function(event){
                        event.preventDefault();
                        
                    if($('form#smtp_setting_form').parsley().isValid())
                    { 
                        var formData = new FormData($(this)[0]);
                        $.ajax({
                                type:  'POST',
                                url:"{{ url('api/smtp') }}",
                                dataType:'JSON',
                                data: formData,
                                processData: false,
                                contentType: false,
                                headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
                                beforeSend:function()
                                {
                                    $('#save').attr('disabled', 'disabled');
                                    $('#save').val('saving...');
                                },
                                success:function(response){
                                      $('#smtp_setting_form').parsley().reset();
                                      $('#save').attr('disabled', false);
                                      Toaster(response['message'],'success');
                                      window.location = "{{ url('smtp_settings/show') }}";
                                },
                                error:function(response){
                                    Toaster('Something went wrong!','danger');
                                    $('#save').attr('disabled', false);
                                }, 
                            });
                       }
                     }); 
                });
</script>
@endsection



