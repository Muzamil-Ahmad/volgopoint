@extends('master')
@section('content')
<!-- Main Content -->
<div class="hk-pg-wrapper">
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
   <ol class="breadcrumb breadcrumb-light bg-transparent">
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      <li class="breadcrumb-item " aria-current="page">Brand</li>
      
   </ol>
</nav>
<!-- /Breadcrumb -->
<!-- Container -->
<div class="container">
   <!-- Title -->
   <div class="hk-pg-header">
      <h4 class="hk-pg-title offset-md-2"><span class="pg-title-icon"><span class="feather-icon"><i data-feather=""></i></span></span>Edit Brand</h4>
   </div>
   <!-- /Title -->
</div>
<form id="brandForm" enctype="multipart/form-data">
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

         <div class="row">
                  <div class="col-sm-6 mt-3">
                        <div class="text-right">
                              <span class="input-group-text" onclick="changeLogo()">Choose Logo</span>
                              <input  id="logo"  type="file" name="logo" class="d-none">
                        </div>
                        <div class="input-group mt-3">
                           <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">Alt_tag</span>
                           </div>
                           <input type="text" required id="alt_tag" class="form-control" name="alt_tag" aria-label="no default" aria-describedby="inputGroup-sizing-default">
                        </div>
                  </div>
                  <div class="col-sm-6 chooseLogoClass ">
                     <div class="text-right">
                           <img src="https://image.shutterstock.com/image-vector/c-letter-logo-vector-260nw-1219328149.jpg" id="logoimg" width="50%" class="rounded" alt="...">
                     </div>
                  </div>
                
                 
         </div>
         

         <div class="row mt-3">
            
            
         </div>
         <input type="submit"  class="btn btn-dark pull-right" name="submit" id="submit" value="Save" >
      </div>
   </div>
</form>



<script type="text/javascript"> 
   var id = "{!! $id !!}";
   var logochanged=0;
   const changeLogo = () => {
      $("#logo").click();
   }
   $(document).ready(function () {
      $('#logo').change( function(event) {
               logochanged=1;
               $("#logoimg").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
         });
     $('#brandForm').parsley();
    $('form#brandForm').on('submit', function(event){
    event.preventDefault();
    if($('#brandForm').parsley().isValid())
    {
         let formData = new FormData($(this)[0]);
         formData.append("logochanged",logochanged);
         formData.append("_token","{{ csrf_token()}}");
         $.ajax({
            type: 'POST',
            url: '{{ url("/api/brand", "id") }}'.replace('id', id),
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
               $('#brandForm')[0].reset();
               $('#brandForm').parsley().reset();
               $('#submit').attr('disabled', false);
               $('#submit').val('save');
               Toaster(response['message'],'success');
               window.location = "{{ url('brand/show') }}";
            },
            error:function(response){
               Toaster('Something went wrong!','danger');
               $('#brandForm').parsley().reset();
               $('#submit').attr('disabled', false);
               $('#submit').val('save');
               console.log("error",response);
            }, 
         });
      }
   });

      $.ajax({
               url: '{{ url("/api/brand", "id") }}'.replace('id', id),
               type:  'GET',
               dataType: 'JSON',
               headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
               dataSrc: function (json) {
                        return json.data;
               },
               success:function(response){
                  let temp=response.data;
                  document.getElementById("name").value=temp.name;
                  document.getElementById("alt_tag").value=temp.alt_tag;
                  let logo="{{asset('/img/logo')}}".replace('logo',temp.logo)
                  $("#logoimg").attr("src",logo)
               },
               error:function(response){

                  console.log(" the error here is:",response);
               }, 
      });
      
   });

    
</script>
@endsection
