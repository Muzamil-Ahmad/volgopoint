@extends('master')
@section('content')

<!-- Main Content -->
<div class="hk-pg-wrapper">
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
   <ol class="breadcrumb breadcrumb-light bg-transparent">
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      <li class="breadcrumb-item " aria-current="page">Product Offers</li>
      
   </ol>
</nav>
<!-- /Breadcrumb -->
<!-- Container -->
<div class="container">
   <!-- Title -->
   <div class="hk-pg-header">
      <h4 class="hk-pg-title offset-md-2"><span class="pg-title-icon"><span class="feather-icon"><i data-feather=""></i></span></span>Add Offer</h4>
   </div>
   <!-- /Title -->
</div>

<form id="tagForm" enctype="multipart/form-data">
<section class="hk-sec-wrapper" style="margin-left: 8%; margin-right: 8%">
 
   <div class="row ">
      <div class="col-sm-8 offset-md-2">
         <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"  id="inputGroup-sizing-default">Offer Name</span>
               </div>
               <input type="text" id="tag_name" name="tag_name" placeholder="Enter offer name..." class="form-control" required aria-label="no default" aria-describedby="inputGroup-sizing-default">
            </div>
         </div>
         <input type="submit"  class="btn btn-dark pull-right" name="submit" id="submit" value="Save" >
      </div>
   </div>
   </section>
</form>

<script>
$(document).ready(function(){
    $('#tagForm').parsley();
    $('form#tagForm').on('submit', function(event){
    event.preventDefault();
    if($('#tagForm').parsley().isValid())
    {
         let formData = new FormData($(this)[0]);
         formData.append("_token","{{ csrf_token()}}");
         $.ajax({
            type: 'POST',
            url: "{{ url('api/tags') }}",
            data: formData ,
            processData: false,
            contentType: false,
            dataType:'JSON',
            headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
            beforeSend:function()
               {
                  $('#submit').attr('disabled', 'disabled');
                  $('#submit').val('Saving...');
               },
            success:function(response){
               $('#tagForm')[0].reset();
               $('#tagForm').parsley().reset();
               $('#submit').attr('disabled', false);
               $('#submit').val('save');
               Toaster(response['message'],'success');
               window.location = "{{ url('tags/show') }}";
               //toastr.info(response['message'],response['result']);
               // alert(response['message']);
            },
            error:function(response){
               Toaster('Something went wrong!','danger');
               $('#tagForm').parsley().reset();
               $('#submit').attr('disabled', false);
               $('#submit').val('save');
               console.log("error",response);
            }, 
         });
      }
   });
});
    
</script>
@endsection
