@extends('master')
@section('content')
<div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">General Settings</li>
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

   
    
<h4 class="mb-5 h4 text-center ">General Settings</h4><br>

<!-- Default horizontal form -->
<form id="setting_form">

<!-- Grid row -->
<div class="form-group row">
    <!-- Default input -->
    <label for="sitename" class="col-sm-3 col-form-label">Site-name</label>
    <div class="col-sm-9">
      <input type="text" class="form-control"  required data-parsley-required-message="Your site name was missing." id="sitename" placeholder="site-name" value="">
    </div>
  </div>
  <!-- Grid row -->

  <!-- Grid row -->
  <div class="form-group row">
    <!-- Default input -->
    <label for="address" class="col-sm-3 col-form-label">Address</label>
    <div class="col-sm-9">
      <input type="text" required data-parsley-required-message="Your address was missing."class="form-control" id="address" placeholder="address">
    </div>
  </div>
  <!-- Grid row -->

<!-- Grid row -->
<div class="form-group row">
    <!-- Default input -->
    <label for="footertext" class="col-sm-3 col-form-label">Footer text</label>
    <div class="col-sm-9">
      <input type="text-area" required data-parsley-required-message="Your footer text was missing." class="form-control" id="footertext" placeholder="footer text">
    </div>
  </div>
  <!-- Grid row -->


  <!-- Grid row -->
  <div class="form-group row">
    <!-- Default input -->
    <label for="email" class="col-sm-3 col-form-label">E-mail</label>
    <div class="col-sm-9">
      <input type="email" required data-parsley-required-message="Your email was missing." class="form-control" id="email" placeholder="Email">
    </div>
      </div>
<!-- Grid row -->
<div class="form-group row">
    <!-- Default input -->
    <label for="phone" class="col-sm-3 col-form-label">Phone Number</label>
    <div class="col-sm-9">
      <input type="text" class="form-control"required data-parsley-required-message="Your phone number was missing." id="phone" placeholder="phone number">
    </div>
  </div>
  <!-- Grid row -->

      <!-- Grid row -->
      <div class="form-group row ">
      <label for="logo" class="col-sm-3 col-form-label">logo</label>
      <div class="col-sm-9">
            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
              
               <div class="form-control text-truncate" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
               <span class="input-group-append">
               <span class=" btn btn-primary btn-file"><span class="fileinput-new">Choose file</span><span class="fileinput-exists">Change</span>
              <input  id="logo" required data-parsley-required-message="insert logo here"type="file" name="logo">
               </span>
               <a href="#" class="btn btn-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
               </span>
            </div>
         </div>
         </div>



  


  <!-- Grid row -->
  <div class="form-group row">
    <div class="col">
      <button id="save" type="submit" class="btn btn-primary btn-md pull-right">Save</button>
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
                     FetchSettings();
                     $('#setting_form').parsley();
                     $('#setting_form').on('submit', function(event){
                      event.preventDefault();
                      updateSettings();
                     });
                     
                });
function FetchSettings(){
  console.log("reached here!");
  $.ajax({
                type: 'GET',
                url: "{{ url('api/settings') }}",
                dataType:'JSON',
                headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
                data:  {
                    // "email":username,
                    // "password":password,
                    // // "remember_me":true
                },
                beforeSend:function()
                {
                   
                },
                success:function(response){
                     console.log(response);
                    
                    document.getElementById("sitename").value=response.data[0].sitename;
                    document.getElementById("address").value=response.data[0].address;
                    document.getElementById("footertext").value=response.data[0].footertext;
                    document.getElementById("email").value=response.data[0].email;
                    document.getElementById("phone").value=response.data[0].phone;
                     
                    
                    },
                error:function(response){
                  
                console.log(" some error",response);
                }
                    
            });

}


function updateSettings()
{
  // event.preventDefault();
  
   console.log($('#sitename').val());
   console.log("reached in update category");
    if($('#setting_form').parsley().isValid())
    {
      console.log("reached in parsley is valid");  
         let sitename=$('#sitename').val();
         let address=$('#address').val();
         let footertext=$('#footertext').val();
         let email=$('#email').val();
         let phone=$('#phone').val();
         var fdd = new FormData();
         let logo = $('#logo')[0].files[0];
        
         fdd.append('sitename',sitename);
         fdd.append("address", address);
         fdd.append("footertext", footertext);
         fdd.append("email", email);
         fdd.append("phone", phone);
         fdd.append("logo",logo);
         fdd.append("_token","{{ csrf_token()}}");
        
   $.ajax({
                type:  'POST',
                url:"{{ url('api/settings') }}",
                dataType:'JSON',
                 data: fdd,
                 headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
               processData: false,
               contentType: false,
              
               beforeSend:function()
                {
                    $('#save').attr('disabled', 'disabled');
                    $('#save').val('saving...');
                },
               success:function(response){
                    
                     
                      console.log(response['message']);
                      $('#setting_form').parsley().reset();
                      $('#save').attr('disabled', false);
                      $('#save').val('save');
                     //  $("#banner").val(" ");
                      Toaster(response['message'],'success');
                      //window.location = "{{ url('category/show') }}";
               },
               error:function(response){
                  Toaster('Something went wrong!','danger');
                  $('#save').attr('disabled', false);
                  $('#save').val('save');
                      console.log("error",response);
               }, 
             });
}
}
</script>
@endsection