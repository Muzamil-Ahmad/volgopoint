@extends('master')
@section('content')

<!-- Main Content -->
<div class="hk-pg-wrapper">
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
   <ol class="breadcrumb breadcrumb-light bg-transparent">
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      <li class="breadcrumb-item " aria-current="page">Category</li>
      
   </ol>
</nav>
<!-- /Breadcrumb -->
<!-- Container -->
<div class="container">
   <!-- Title -->
   <div class="hk-pg-header">
      <h4 class="hk-pg-title offset-md-2"><span class="pg-title-icon"><span class="feather-icon"><i data-feather=""></i></span></span>Add Category</h4>
   </div>
   <!-- /Title -->
</div>
<form id="categoryForm" enctype="multipart/form-data">
<div class="row">
      <div class="col-sm-8 offset-md-2">
         <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
               </div>
               <input type="text" id="name" class="form-control" name="name" aria-label="no default" aria-describedby="inputGroup-sizing-default">
            </div>
         </div>
         
            <div class="row">
                  <div class="col-sm-6 mt-3">
                        <div class="text-right">
                              <span class="input-group-text" onclick="chooseBanner()">Choose Banner</span>
                              <input  id="banner" required class="d-none" type="file" name="banner" >
                        </div>
                        <div class="input-group mt-3">
                           <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">Alt_tag</span>
                           </div>
                           <input type="text" required id="banner_alt_tag" class="form-control" name="banner_alt_tag" aria-label="no default" aria-describedby="inputGroup-sizing-default">
                        </div>
                  </div>
                  <div class="col-sm-6 chooseBannerClass d-none">
                     <div class="text-right">
                           <img src="https://image.shutterstock.com/image-vector/c-letter-logo-vector-260nw-1219328149.jpg" id="bannerimg" width="50%" class="rounded" alt="...">
                     </div>
                  </div>
                  <div class="col-sm-6 mt-3">
                     <div class="text-right">
                           <span class="input-group-text" onclick="chooseIcon()">Choose Icon</span>
                           <input  id="icon" required class="d-none" type="file" name="icon" >
                     </div>
                  <div class="input-group mt-3">
                        <div class="input-group-prepend">
                           <span class="input-group-text" id="inputGroup-sizing-default">Alt_tag</span>
                        </div>
                        <input type="text" required id="icon_alt_tag" class="form-control" name="icon_alt_tag" aria-label="no default" aria-describedby="inputGroup-sizing-default">
                  </div>
               </div>
               <div class="col-sm-6 chooseIconClass d-none">
                  <div class="text-right">
                        <img src="https://image.shutterstock.com/image-vector/c-letter-logo-vector-260nw-1219328149.jpg" id="iconimg" width="50%" class="rounded" alt="...">
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
         $("#banner").click();
   }
   const chooseIcon = () => {
         $("#icon").click();
   }
$(document).ready(function(){
   $('#banner').change( function(event) {
               $('.chooseBannerClass').removeClass('d-none');
               $("#bannerimg").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
    });
    $('#icon').change( function(event) {
                $('.chooseIconClass').removeClass('d-none');
               $("#iconimg").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
    });

    $('#categoryForm').parsley();
      $('form#categoryForm').on('submit', function(event){
         event.preventDefault();
         let alt_tags = [];
         if($('#categoryForm').parsley().isValid())
         {
         let formData = new FormData($(this)[0]);
         alt_tags.push($('#banner_alt_tag').val());
         alt_tags.push($('#icon_alt_tag').val());
         formData.append("alt_tags", JSON.stringify(alt_tags));
                      $.ajax({
                        type: 'POST',
                        url: "{{ url('api/categories') }}",
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
                           $('#categoryForm')[0].reset();
                           // console.log(response['message']);
                           $('#categoryForm').parsley().reset();
                           $('#submit').attr('disabled', false);
                           $('#submit').val('save');
                           Toaster(response['message'],'success');
                           window.location = "{{ url('category/show') }}";
                           //toastr.info(response['message'],response['class_name']);
                           // alert(response['message']);
                        },
                  error:function(response){
                     Toaster('Something went wrong!','danger');
                     $('#categoryForm').parsley().reset();
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
