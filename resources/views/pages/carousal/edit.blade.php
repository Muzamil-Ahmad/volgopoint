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
      <h4 class="hk-pg-title offset-md-2"><span class="pg-title-icon"><span class="feather-icon"><i data-feather=""></i></span></span>Edit Carousal</h4>
   </div>
   <!-- /Title -->
</div>

<form id="carousalForm" enctype="multipart/form-data">
<section class="hk-sec-wrapper" style="margin-left: 8%; margin-right: 8%">
 
   <div class="row ">
      <div class="col-sm-8 offset-md-2">
         <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"  id="inputGroup-sizing-default">Text</span>
               </div>
               <input type="text" id="text" name="text" placeholder="Enter carousal text..." class="form-control" required name="text" aria-label="no default" aria-describedby="inputGroup-sizing-default">
            </div>
         </div>
         <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"  id="inputGroup-sizing-default">Alt Tag</span>
               </div>
               <input type="text" id="alt_tag" placeholder="Enter text..." class="form-control" required name="alt_tag" aria-label="no default" aria-describedby="inputGroup-sizing-default">
            </div>
         </div>
         <div class="row">
            <div class="col-sm-6">
               <div class="text-right">
                      <span class="input-group-text"onclick="changeLogo()" >Change Image</span>
                      <input  id="img"  class="d-none" type="file" name="img" >
               </div>
            </div>
            <div class="col-sm-6">
               <div class="text-right">
                     <img src="" id="alt_image" width="50%" class="rounded" alt="...">
               </div>
            </div>
         </div>
         <input type="submit"  class="btn btn-dark pull-right" name="submit" id="submit" value="Update" >
      </div>
   </div>
   </section>
</form>
<script>
 var id = "{!! $id !!}"
 var logochanged=0;
   const changeLogo = () => {
      $("#img").click();
   }
$(document).ready(function(){
   $('#img').change( function(event) {
               logochanged=1;
               $("#alt_image").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
         });
    $('#carousalForm').parsley();
    $('form#carousalForm').on('submit', function(event){
    event.preventDefault();
    if($('#carousalForm').parsley().isValid())
    {
            
      // let text=$('#text').val();
      // let alt_tag=$('#alt_tag').val();
         // var fdd = new FormData();
         // let img = $('#img')[0].files[0];
         // fdd.append('text',text);
         // fdd.append("alt_tag", alt_tag);
         // fdd.append("img", img);
         // fdd.append("id",id);
         // fdd.append("_token","{{ csrf_token()}}");


         let formData = new FormData($(this)[0]);
         formData.append("logochanged",logochanged);
      //    formData.append("_token","{{ csrf_token()}}");
         $.ajax({
            type: 'POST',
            url: '{{ url("/api/carousals", "id") }}'.replace('id', id),
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


   //Edit the carousal here
       $.ajax({
            url: '{{ url("/api/carousals", "id") }}'.replace('id', id),
            type:  'GET',
            dataType: 'JSON',
            headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
            success:function(response){
               let data=response.data;
               $('#text').val(data.text);
                  $('#alt_tag').val(data.alt_tag);
                  // $('#alt_image').val(data.image);
                  let logo="{{asset('/img/logo')}}".replace('logo',data.image)
                  $("#alt_image").attr("src",logo)
            },
            error:function(response){
               console.log(response);
            }, 
         });

         //Delete the carousal here!

             
});



    
</script>
@endsection
