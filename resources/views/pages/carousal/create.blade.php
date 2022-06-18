@extends('master')
@section('content')

<!-- Main Content -->
<div class="hk-pg-wrapper">
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
   <ol class="breadcrumb breadcrumb-light bg-transparent">
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      <li class="breadcrumb-item " aria-current="page">Carousal</li>
      
   </ol>
</nav>
<!-- /Breadcrumb -->
<!-- Container -->
<div class="container">
   <!-- Title -->
   <div class="hk-pg-header">
      <h4 class="hk-pg-title offset-md-2"><span class="pg-title-icon"><span class="feather-icon"><i data-feather=""></i></span></span>Add Carousal</h4>
   </div>
   <!-- /Title -->
</div>

<form id="carousalForm" enctype="multipart/form-data">
<div class="row">
      <div class="col-sm-8 offset-md-2">
         <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Text</span>
               </div>
               <input type="text" id="text"required class="form-control" name="text" aria-label="no default" aria-describedby="inputGroup-sizing-default" placeholder="enter carousal text">
            </div>
         </div>
         
            <div class="row">
                  <div class="col-sm-6 mt-3">
                        <div class="text-right">
                              <span class="input-group-text" onclick="chooseBanner()">Choose Image</span><small>Image size must be (1110*480)</small>
                              <input  id="alt_image" required class="d-none" type="file" name="alt_image" >
                        </div>
                        <div class="input-group mt-3">
                           <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">Alt_tag</span>
                           </div>
                           <input type="text" required id="alt_tag" class="form-control" name="alt_tag" aria-label="no default" aria-describedby="inputGroup-sizing-default">
                        </div>
                  </div>
                  <div class="col-sm-6 chooseBannerClass d-none">
                     <div class="text-right">
                           <img src="https://image.shutterstock.com/image-vector/c-letter-logo-vector-260nw-1219328149.jpg" id="carousalimg" width="50%" class="rounded" alt="...">
                     </div>
                  </div>
                
                 
         </div>
         

         <div class="row mt-3">
            
            
         </div>
         <input type="submit"  class="btn btn-dark pull-right" name="submit" id="submit" value="Save" >
      </div>
   </div>
</form>
<script>
 const chooseBanner = () => {
         $("#alt_image").click();
   }
$(document).ready(function(){
   $('#alt_image').change( function(event) {
               $('.chooseBannerClass').removeClass('d-none');
               $("#carousalimg").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
    });
    $('#carousalForm').parsley();
    $('form#carousalForm').on('submit', function(event){
    event.preventDefault();
    if($('#carousalForm').parsley().isValid())
    {
         let formData = new FormData($(this)[0]);
         formData.append("_token","{{ csrf_token()}}");
         $.ajax({
            type: 'POST',
            url: "{{ url('api/carousals') }}",
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
               $('#carousalForm')[0].reset();
               $('#carousalForm').parsley().reset();
               $('#submit').attr('disabled', false);
               $('#submit').val('save');
               Toaster(response['message'],'success');
               window.location = "{{ url('carousal/show') }}";
               //toastr.info(response['message'],response['result']);
               // alert(response['message']);
            },
            error:function(response){
               Toaster('Something went wrong!','danger');
               $('#carousalForm').parsley().reset();
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
