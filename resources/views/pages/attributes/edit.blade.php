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



<script type="text/javascript"> 
    $(document).ready(function () {
        var id = "{!! $id !!}";
     $('#attributeForm').parsley();
    $('form#attributeForm').on('submit', function(event){
    event.preventDefault();
    if($('#attributeForm').parsley().isValid())
    {
         let formData = new FormData($(this)[0]);
          formData.append("_token","{{ csrf_token()}}");
         $.ajax({
            type: 'POST',
            url: '{{ url("/api/attribute", "id") }}'.replace('id', id),
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
               $('#attributeForm')[0].reset();
               $('#attributeForm').parsley().reset();
               $('#submit').attr('disabled', false);
               $('#submit').val('save');
               Toaster(response['message'],'success');
               window.location = "{{ url('attributes/show') }}";
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
    
      $.ajax({
               url: '{{ url("/api/attribute", "id") }}'.replace('id', id),
               type:  'GET',
               dataType: 'JSON',
               headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
               dataSrc: function (json) {
                        return json.data;
               },
               success:function(response){
                  let temp=response.data;
                  document.getElementById("name").value=temp.name;
               },
               error:function(response){

                  console.log(" the error here is:",response);
               }, 
      });
      
   });

    
</script>
@endsection
