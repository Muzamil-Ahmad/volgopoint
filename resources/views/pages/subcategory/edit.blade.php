@extends('master')
@section('content')
<!-- Main Content -->
<div class="hk-pg-wrapper">
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
   <ol class="breadcrumb breadcrumb-light bg-transparent">
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      <li class="breadcrumb-item " aria-current="page">Subcategory</li>
      
   </ol>
</nav>
<!-- /Breadcrumb -->
<!-- Container -->
<div class="container">
   <!-- Title -->
   <div class="hk-pg-header">
      <h4 class="hk-pg-title offset-md-2"><span class="pg-title-icon"><span class="feather-icon"><i data-feather=""></i></span></span>Edit Subcategory</h4>
   </div>
   <!-- /Title -->
</div>
<form id="subCategoryForm" enctype="multipart/form-data">
<div class="row">
      <div class="col-sm-8 offset-md-2">
         <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
               </div>
               <input type="text" id="name" required class="form-control" name="name" aria-label="no default" aria-describedby="inputGroup-sizing-default">
            </div>
         </div>
         <div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Options</label>
  </div>
  <!-- <select class="custom-select categoryname categorySelectId" id="categorySelectId" name="select">
    <option disabled>Choose category...</option>
  </select> -->
  <select class="custom-select"   id="fetchCat" name="fetchCat">
  <option value="" disabled selected>Choose category...</option>
</select>
</div>
<div class="row">
         <div class="col-sm-6 mt-3">
                        <div class="text-right">
                              <span class="input-group-text" onclick="chooseBanner()">Choose Banner</span>
                              <input  id="banner" class="d-none" type="file" name="banner" >
                        </div>
                        <div class="input-group mt-3">
                           <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">Alt_tag</span>
                           </div>
                           <input type="text" id="banner_alt_tag" required class="form-control" name="banner_alt_tag" aria-label="no default" aria-describedby="inputGroup-sizing-default">
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
                        <input type="text" id="icon_alt_tag"  required class="form-control" name="icon_alt_tag" aria-label="no default" aria-describedby="inputGroup-sizing-default">
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
         
         <input type="submit"  class="btn btn-dark pull-right" name="submit" id="submit" value="Update" >
      </div>
   </div>
</form>



<script type="text/javascript"> 
var bannerchanged=0;
var iconchanged=0;
var id = "{!! $id !!}";
      const chooseBanner = () => {    
            $("#banner").click();
      }
      const chooseIcon = () => {
            $("#icon").click();
      }
   $(document).ready(function () {
         $('#subCategoryForm').parsley();
         $('form#subCategoryForm').on('submit', function(event){
               event.preventDefault();
               if($('#subCategoryForm').parsley().isValid())
    {
      let alt_tags = [];
       console.log("reached here");
      let formData = new FormData($(this)[0]);
      alt_tags.push($('#banner_alt_tag').val());
         alt_tags.push($('#icon_alt_tag').val());

         formData.append("bannerchanged",bannerchanged);
         formData.append("iconchanged",iconchanged);
         formData.append("alt_tags", JSON.stringify(alt_tags));
         $.ajax({
               url:  '{{ url("/api/subcategories", "id") }}'.replace('id', id),
               type:  'POST',
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
                      $('#subCategoryForm')[0].reset();
                      $('#subCategoryForm').parsley().reset();
                      $('#submit').attr('disabled', false);
                      $('#submit').val('save');
                      Toaster(response['message'],'success');
                      window.location = "{{ url('subcategory/show') }}";
               },
               error:function(response){
                  Toaster('Something went wrong!','danger');
                  $('#subCategoryForm').parsley().reset();
                      $('#submit').attr('disabled', false);
                      $('#submit').val('save');
                      console.log("error",response);
               }, 
             });
         }
         });
         fetchCategories();
        
         $('#banner').change( function(event) {
            bannerchanged=1;
            $("#bannerimg").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
         });
         $('#icon').change( function(event) {
                     iconchanged=1;
                     $("#iconimg").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
         });
      
       
   });
      let selectedCategoryId;
      const getSubCategoryData = () =>{
            $.ajax({
                        url: '{{ url("/api/subcategories", "id") }}'.replace('id', id),
                        type:  'GET',
                        dataType: 'JSON',
                        headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
                        dataSrc: function (json) {
                                 return json.data;
                           },
                        success:function(response){
                           let temp=response.data;
                           console.log("cat id is here",temp.category_id);
                           let tagVal=JSON.parse(temp.alt_tag);
                           document.getElementById("banner_alt_tag").value=tagVal[0];
                           document.getElementById("icon_alt_tag").value=tagVal[1];
                          
                           selectedCategoryId=temp.category_id;
                           console.log("selected =",selectedCategoryId);
                           document.getElementById("name").value=temp.name;
                           let banner="{{asset('/img/banner')}}".replace('banner',temp.banner)
                           $("#bannerimg").attr("src",banner);
                           let icon="{{asset('/img/icon')}}".replace('icon',temp.icon)
                           $("#iconimg").attr("src",icon);
                           $("#icon").closest("input[type=hidden]").val(temp.icon)
                           },
                        error:function(response){
                           console.log(" the error here is:",response);
                        }, 
                     });
      }
      getSubCategoryData();


      


function fetchCategories(){

$.ajax({
   type: 'GET',
   url: "{{ url('api/categories') }}",
   processData: false,
   contentType: false,
   dataType:'JSON',
   headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
   success:function(response){
      let html=""
      let categoryData=response.data
      categoryData.forEach(function(index){
         if(selectedCategoryId==index.id)
         html+="<option value="+index.id+" selected>"+index.name+"</option>"
         else
         html+="<option value="+index.id+">"+index.name+"</option>"
      })
      $("#fetchCat").append(html);
      console.log("response OF CATEGORY TABLE",response);
   },
   error:function(response){
      console.log("error",response);
   }, 
});
}

</script>
@endsection
