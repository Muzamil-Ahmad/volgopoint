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
      <h4 class="hk-pg-title offset-md-2"><span class="pg-title-icon"><span class="feather-icon"><i data-feather=""></i></span></span>Edit Category</h4>
   </div>
   <!-- /Title -->
</div>
<form id="categoryForm" enctype="multipart/form-data">
   <div class="row ">
      <div class="col-sm-8 offset-md-2">
         <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"  id="inputGroup-sizing-default">Name</span>
               </div>
               <input type="text" id="name" required class="form-control"  name="name" aria-label="no default" aria-describedby="inputGroup-sizing-default">
            </div>
         </div>
         <div class="row">
         <div class="col-sm-6 mt-3">
                        <div class="text-right">
                              <span class="input-group-text" onclick="chooseBanner()">Choose Banner</span>
                              <input  id="banner"  class="d-none" type="file" name="banner" >
                        </div>
                        <div class="input-group mt-3">
                           <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">Alt_tag</span>
                           </div>
                           <input type="text" required id="banner_alt_tag" class="form-control" name="banner_alt_tag" aria-label="no default" aria-describedby="inputGroup-sizing-default">
                        </div>
                  </div>
                  <div class="col-sm-6 chooseBannerClass ">
                     <div class="text-right">
                           <img src="https://image.shutterstock.com/image-vector/c-letter-logo-vector-260nw-1219328149.jpg" id="bannerimg" width="50%" class="rounded" alt="...">
                     </div>
                  </div>
                  <div class="col-sm-6 mt-3">
                     <div class="text-right">
                           <span class="input-group-text" onclick="chooseIcon()">Choose Icon</span>
                           <input  id="icon"  class="d-none" type="file" name="icon" >
                     </div>
                  <div class="input-group mt-3">
                        <div class="input-group-prepend">
                           <span class="input-group-text" id="inputGroup-sizing-default">Alt_tag</span>
                        </div>
                        <input type="text" id="icon_alt_tag" class="form-control" name="icon_alt_tag" aria-label="no default" aria-describedby="inputGroup-sizing-default">
                  </div>
               </div>
               <div class="col-sm-6 chooseIconClass ">
                  <div class="text-right">
                        <img src="https://image.shutterstock.com/image-vector/c-letter-logo-vector-260nw-1219328149.jpg" id="iconimg" width="50%" class="rounded" alt="...">
                  </div>
               </div>
                 
         </div>
         <div class="row mt-3">
            
            
            </div>
         <input type="submit" onclick="updateCategory()" class="btn btn-dark pull-right" name="submit" id="submit" value="update" >
      </div>
   </div>
</form>



<script type="text/javascript"> 
var bannerchanged=0;
var iconchanged=0;
const chooseBanner = () => {
      $("#banner").click();
 }
 const chooseIcon = () => {
      $("#icon").click();
 }
   $(document).ready(function () {
      $('#banner').change( function(event) {
               bannerchanged=1;
               $("#bannerimg").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
         });
         $('#icon').change( function(event) {
               iconchanged=1;
               $("#iconimg").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
         });

         $('#categoryForm').parsley();
         $('form#categoryForm').on('submit', function(event){
               event.preventDefault();
               var id = "{!! $id !!}";
      let urlv = '{{ url("/api/categories", "id") }}';
      urlv = urlv.replace('id', id);
      if($('#categoryForm').parsley().isValid())
    {

           let alt_tags = [];
           console.log("reached here");
           let formData = new FormData($(this)[0]);
           alt_tags.push($('#banner_alt_tag').val());
           alt_tags.push($('#icon_alt_tag').val());
           console.log(JSON.stringify(alt_tags));
         formData.append("bannerchanged",bannerchanged);
         formData.append("iconchanged",iconchanged);
         formData.append("alt_tags", JSON.stringify(alt_tags));
        
   $.ajax({
                type:  'POST',
                url: urlv,
                dataType:'JSON',
                 data: formData,
                 headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
               processData: false,
               contentType: false,
              
               beforeSend:function()
                {
                    $('#submit').attr('disabled', 'disabled');
                    $('#submit').val('updating...');
                },
               success:function(response){
                      $('#categoryForm')[0].reset();
                     
                      console.log(response['message']);
                      $('#categoryForm').parsley().reset();
                      $('#submit').attr('disabled', false);
                      $('#submit').val('update');
                     //  $("#banner").val(" ");
                      Toaster(response['message'],'success');
                      window.location = "{{ url('category/show') }}";
               },
               error:function(response){
                  Toaster('Something went wrong!','danger');
                  $('#categoryForm').parsley().reset();
                      $('#submit').attr('disabled', false);
                      $('#submit').val('update');
                      console.log("error",response);
               }, 
             });
}
         });

      var id = "{!! $id !!}";
      let urlv = '{{ url("/api/categories", "id") }}';
      urlv = urlv.replace('id', id);
                            $.ajax({
                              url: urlv,
                              type:  'GET',
                              dataType: 'JSON',
                              headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
                              dataSrc: function (json) {
                                     return json.data;
                                 },
                              success:function(response){
                                 let temp=response.data;
                                 let tagVal=JSON.parse(temp.alt_tag);
                           document.getElementById("banner_alt_tag").value=tagVal[0];
                           document.getElementById("icon_alt_tag").value=tagVal[1];
                          
                                 document.getElementById("name").value=temp.name;
                                 let banner="{{asset('/img/banner')}}".replace('banner',temp.banner)
                                 $("#bannerimg").attr("src",banner);
                                 let icon="{{asset('/img/icon')}}".replace('icon',temp.icon)
                                 $("#iconimg").attr("src",icon);
                                  },
                             error:function(response){
              
                               console.log(" the error here is:",response);
                              }, 
             });
      
   // }

   });

    
</script>
@endsection
