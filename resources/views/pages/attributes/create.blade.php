@extends('master')
@section('content')
<!-- Main Content -->
<div class="hk-pg-wrapper">
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
   <ol class="breadcrumb breadcrumb-light bg-transparent">
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      <li class="breadcrumb-item " aria-current="page">Attribute</li>
   </ol>
</nav>
<!-- /Breadcrumb -->
<!-- Container -->
<div class="container">
   <!-- Title -->
   <div class="hk-pg-header">
      <h4 class="hk-pg-title offset-md-2"><span class="pg-title-icon"><span class="feather-icon"><i data-feather=""></i></span></span>Add Attribute</h4>
   </div>
   <!-- /Title -->
</div>
<form id="attributeForm" enctype="multipart/form-data">
   <div class="row ">
      <div class="col-sm-8 offset-md-2">
         <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"  id="inputGroup-sizing-default">Name</span>
               </div>
               <input type="text" id="name" class="form-control" required name="name" aria-label="no default" aria-describedby="inputGroup-sizing-default">
            </div>
         </div>
      
         <div class="row mt-3">
         </div>
         <input type="submit"  class="btn btn-dark pull-right" name="submit" id="submit" value="Save" >
      </div>
   </div>
</form>
<script>

$(document).ready(function(){
    $('#attributeForm').parsley();
    $('#attributeForm').on('submit', function(event){
    event.preventDefault();
    if($('#attributeForm').parsley().isValid())
    {
         let name=$('#name').val();
         var fd = new FormData();
         fd.append('name',name);
         fd.append("_token","{{ csrf_token()}}");
            $.ajax({
               type: 'POST',
               url: "{{ url('api/attribute') }}",
               data: fd ,
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
                      $('#attributeForm')[0].reset();
                      console.log(response['message']);
                      $('#attributeForm').parsley().reset();
                      $('#submit').attr('disabled', false);
                      $('#submit').val('save');
                      Toaster(response['message'],'success');
                      window.location = "{{ url('attributes/show') }}";
                     //toastr.info(response['message'],response['result']);
                    // alert(response['message']);
               },
               error:function(response){
                  Toaster('Something went wrong!','danger');
                  $('#attributeForm').parsley().reset();
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