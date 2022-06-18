@extends('master')
@section('content')

<!-- Main Content -->
<div class="hk-pg-wrapper">
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
   <ol class="breadcrumb breadcrumb-light bg-transparent">
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      <li class="breadcrumb-item " aria-current="page">Roles</li>
      
   </ol>
</nav>
<!-- /Breadcrumb -->
<!-- Container -->
<div class="container">
   <!-- Title -->
   <div class="hk-pg-header">
      <h4 class="hk-pg-title offset-md-2"><span class="pg-title-icon"><span class="feather-icon"><i data-feather=""></i></span></span>Add Role</h4>
     
   </div>
   <!-- /Title -->
</div>
<form id="roleForm" >
   <div class="row ">
      <div class="col-sm-8 offset-md-2">
         <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"  id="inputGroup-sizing-default">Role</span>
               </div>
               <input type="text" id="role" class="form-control" required name="role" aria-label="no default" aria-describedby="inputGroup-sizing-default">
            </div>
         </div>
        <input type="submit"  class="btn btn-dark pull-right" name="submit" id="submit" value="Save" >
      </div>
   </div>
</form>
<script>
$(document).ready(function(){
    $('#roleForm').parsley();
    $('#roleForm').on('submit', function(event){
    event.preventDefault();
    if($('#roleForm').parsley().isValid())
    {
         let role=$('#role').val();
        //  var fd = new FormData();
        //  let banner = $('#banner')[0].files[0];
        //  let icon = $('#icon')[0].files[0];
        //  fd.append('name',nameVal);
        //  fd.append("banner", banner);
        //  fd.append("icon", icon);
        // fd.append("_token","{{ csrf_token()}}");

         $.ajax({
            type: 'POST',
            url: "{{ url('api/roles') }}",
            data: {
                "role":role
            } ,
           
            dataType:'JSON',
            headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
            beforeSend:function()
               {
                  $('#submit').attr('disabled', 'disabled');
                  $('#submit').val('Saving...');
               },
            success:function(response){
               $('#roleForm')[0].reset();
               console.log(response['message']);
               $('#roleForm').parsley().reset();
               $('#submit').attr('disabled', false);
               $('#submit').val('save');
               Toaster(response['message'],'success');
               window.location = "{{ url('roles/show') }}";
               //toastr.info(response['message'],response['result']);
               // alert(response['message']);
            },
            error:function(response){
               Toaster('Something went wrong!','danger');
               $('#roleForm').parsley().reset();
               $('#submit').attr('disabled', false);
               $('#submit').val('save');
               console.log("error",response);;
            }, 
         });
      }
   });
});
    
</script>
@endsection
