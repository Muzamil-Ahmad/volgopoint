@extends('master')
@section('content')
<script src="{{ asset('admin_assets/dist/ejs/spartan-multi-image-picker-min.js') }}"></script>
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
   <!-- <div class="hk-pg-header"> -->
   <h5 class="hk-pg-title mb-2" style="color:#324148"><span class="pg-title-icon"><span class="feather-icon"><i data-feather=""></i></span></span>Add New Product</h5>
   <!-- </div> -->
   <!-- /Title -->
</div>
<div class="container">
<form id="add_new_product_form" enctype="multipart/form-data">
   <section class="hk-sec-wrapper">
      <div class="row ">
         <div class="col-sm-12 mb-2" style="border-bottom:1px solid #eaecec">
            <h5 class="panel-title" >Product Information</h5>
         </div>
         <div class="col-sm-8 offset-md-2">
            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"  id="inputGroup-sizing-default">Product Name</span>
                  </div>
                  <input type="text" id="name" class="form-control" required name="name" aria-label="no default" aria-describedby="inputGroup-sizing-default">
               </div>
            </div>
            <div class="form-group">
               <div class="input-group">
                  <select class="custom-select" required id="category" name="category">
                     <option value="" disabled selected>Select category</option>
                  </select>
               </div>
            </div>
            <div class="form-group">
               <div class="input-group">
                  <select class="custom-select" id="sub_category" name="sub_category">
                     <option value="" disabled selected>Select subcategory</option>
                  </select>
               </div>
            </div>
            <div class="form-group">
               <div class="input-group">
                  <select class="custom-select" id="carousals" name="carousals">
                     <option value="" disabled selected>Select carousals</option>
                  </select>
               </div>
            </div>
            <div class="form-group">
               <div class="input-group">
                  <select class="custom-select" id="Offers" name="Offers">
                     <option value="" disabled selected>Choose Offers</option>
                  </select>
               </div>
            </div>
            <div class="form-group">
               <div class="input-group">
                  <select class="custom-select" id="brand" name="brand">
                     <option disabled selected>Choose brand</option>
                  </select>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="hk-sec-wrapper">
      <div class="row ">
         <div class="col-lg-12" style="border-bottom:1px solid #eaecec">
            <h5 class="panel-title" >{{__('Product Images')}}</h5>
         </div>
         <div class="col-lg-8 offset-lg-2">
            <div class="panel">
               <div class="panel-body">
                  <div class="form-group">
                     <label class="col-lg-2 control-label">{{__('Gallery Images')}} </label>
                     <div class="col-lg-7">
                        <div class="row" id="photos">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-2 control-label">{{__('Thumbnail Image')}} <small>(290x300)</small></label>
                     <div class="col-lg-7">
                        <div id="thumbnail_img">
                        </div>
                     </div>
                  </div>
                  <!-- <div class="form-group">
                     <label class="col-lg-2 control-label">{{__('Featured')}} <small>(290x300)</small></label>
                     <div class="col-lg-7">
                        <div id="featured_img">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-2 control-label">{{__('Flash Deal')}} <small>(290x300)</small></label>
                     <div class="col-lg-7">
                        <div id="flash_deal_img">
                        </div>
                     </div>
                  </div> -->
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="hk-sec-wrapper">
      <div class="row ">
         <div class="col-sm-12 mb-2" style="border-bottom:1px solid #eaecec">
            <h5 class="panel-title" >Product price + stock</h5>
         </div>
         <div class="col-sm-8 offset-md-2">
            <div class="form-group">
               <div class="form-group">
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text"  id="inputGroup-sizing-default1">Original Price</span>
                     </div>
                     <input type="number" id="product_original_price" class="form-control" required name="product_original_price" aria-label="no default" aria-describedby="inputGroup-sizing-default">
                  </div>
               </div>
               <div class="form-group">
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text"  id="inputGroup-sizing-default2">Tax</span>
                     </div>
                     <input type="number" id="product_tax" class="form-control" required name="product_tax" aria-label="no default" aria-describedby="inputGroup-sizing-default">
                  </div>
               </div>
               <!-- <div class="form-group ">
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text"  id="inputGroup-sizing-default3">Discount</span>
                     </div>
                     <input type="number" id="product_discount" class="form-control" required name="product_discount" aria-label="no default" aria-describedby="inputGroup-sizing-default">
                  </div>
               </div> -->
               <div class="form-group">
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text"  id="inputGroup-sizing-default4">Discounted Price</span>
                     </div>
                     <input type="number" id="product_sale_price" class="form-control" required name="product_sale_price" aria-label="no default" aria-describedby="inputGroup-sizing-default">
                  </div>
               </div>
               <div class="form-group">
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text"  id="inputGroup-sizing-default5">Quantity</span>
                     </div>
                     <input type="number" id="product_quantity" class="form-control" required name="product_quantity" aria-label="no default" aria-describedby="inputGroup-sizing-default">
                  </div>
               </div>
            </div>
         </div>
   </section>
   <section class="hk-sec-wrapper">
      <div class="row ">
         <div class="col-sm-12 mb-2" style="border-bottom:1px solid #eaecec">
            <h5 class="panel-title" >Add Attributes</h5>
         </div>
         <div class="col-sm-8 offset-md-2">
         <div class="form-group">
               <div class="input-group">
                  <select class="custom-select mb-2"  onchange="addAttribute(this);"  id="attributes" name="attributes">
                     <option value="" disabled selected>Select attributes</option>
                  </select>
                  <div class=" input-group " id="newRow"></div>
               </div>
            </div>
         </div>
      </div>
   </section>




   <section class="hk-sec-wrapper">
   <div class="row ">
   <div class="col-sm-12 mb-2" style="border-bottom:1px solid #eaecec">
   <h5 class="panel-title" >Product Description</h5>
   </div>
   <div class="col-sm-8 offset-sm-2">
   <div class="form-group">
    <label for="product_description">Product Description</label>
    <input class="form-control" name="product_description" id="product_description" maxlength="20"></input>
   </div>
   <div class="tinymce-wrap">
   <span class="input-group-text"  id="inputGroup-sizing-default">Product Full Description</span>
   <textarea class="tinymce" name="product_cart_description" id="product_cart_description"></textarea>
   </div>
   </div>
   </div>
   </section>

   <section class="hk-sec-wrapper">
   <div class="row ">
   <div class="col-sm-12 mb-2" style="border-bottom:1px solid #eaecec">
   <h5 class="panel-title" >Product Specification</h5>
   </div>
   <div class="col-sm-8 offset-sm-2">
  
   <div class="tinymce-wrap">
   <span class="input-group-text"  id="inputGroup-sizing-default">Product Specification</span>
   <textarea class="tinymce" name="product_specification" id="product_specification"></textarea>
   </div>
   </div>
   </div>
   </section>






   <section class="hk-sec-wrapper">
   <div class="row ">
   <div class="col-sm-12 mb-2" style="border-bottom:1px solid #eaecec">
   <h5 class="panel-title" >SEO Meta Tags</h5>
   </div>
   <div class="col-sm-8 offset-sm-2">
   <div class="form-group">
         <div class="input-group">
               <div class="input-group-prepend">
               <span class="input-group-text"  id="inputGroup-sizing-default">Meta Title</span>
               </div>
               <input type="text" id="meta_title" class="form-control" required name="meta_title" aria-label="no default" aria-describedby="inputGroup-sizing-default">
         </div>
   </div>
   <!-- <div class="form-group">
         <div class="input-group">
               <div class="input-group-prepend">
               <span class="input-group-text"  id="inputGroup-sizing-default">Slug</span>
               </div>
               <input type="text" id="slug" class="form-control" required name="slug" aria-label="no default" aria-describedby="inputGroup-sizing-default">
         </div>
   </div> -->
   
   <div class="tinymce-wrap">
   <span class="input-group-text"  id="inputGroup-sizing-default">Meta Description</span>
   <textarea class="tinymce" name="meta_description" id="meta_description"></textarea>
   </div>
   <div class="tinymce-wrap" style="margin-top:10px">
   <span class="input-group-text"  id="inputGroup-sizing-default">Meta Keywords</span>
   <textarea class="tinymce" rows="2" name="meta_keywords" id="meta_keywords"></textarea>
   </div>
   </div>
   </div>
   </section>
   </div>
   <div class="row ">
      <div class="col-sm-12">
         <input type="submit"  class="btn btn-dark pull-right" name="add_new_product" id="add_new_product" style="margin-right:1%" value="Save" >
      </div>
   </div>
</form>
<script>
$(document).ready(function(){
   
   getCategories();
   getSubCategories();
   getCarousals();
   getBrand();
   getOffers();
   getAttributes();
   tinyMCE.init({
    height : "50"
});
var count=1;
const putInput = () => {
  let html= `<div class="form-group mt-2">
               <label for="alt_image_tag">Tag</label>
               <input type="text" class="form-control" name="alt_image_tag_photo[]" id="alt_image_tag_photo"  placeholder="Alt tag...">
            </div>`
      $(".input"+count).append(html);
      count++;
      $(".input"+count).addClass("input"+count)
      count--;
      $(".input"+count).removeClass("input"+count)
} 

	$("#photos").spartanMultiImagePicker({
			fieldName:       'photos[]',
			maxCount:        5,
			rowHeight:       '200px',
			groupClassName:  'col-md-4 col-sm-4 col-xs-6 input'+count,
			maxFileSize:     '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			},
         onAddRow: function() {
            putInput();
         },
		});
      var count2=1
		$("#thumbnail_img").spartanMultiImagePicker({
			fieldName:        'thumbnail_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6 input_thumbnail'+count2,
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			},
         onAddRow:function(){
                  let html= `<div class="form-group mt-2">
                     <label for="alt_image_tag">Tag</label>
                     <input type="text" class="form-control" name="alt_image_tag_thumbnail" id="alt_image_tag_thumbnail"  placeholder="Alt tag...">
                  </div>`
                  $(".input_thumbnail"+count2).append(html);
         }
		});
		// $("#featured_img").spartanMultiImagePicker({
		// 	fieldName:        'featured_img',
		// 	maxCount:         1,
		// 	rowHeight:        '200px',
		// 	groupClassName:   'col-md-4 col-sm-4 col-xs-6',
		// 	maxFileSize:      '',
		// 	dropFileLabel : "Drop Here",
		// 	onExtensionErr : function(index, file){
		// 		console.log(index, file,  'extension err');
		// 		alert('Please only input png or jpg type file')
		// 	},
		// 	onSizeErr : function(index, file){
		// 		console.log(index, file,  'file size too big');
		// 		alert('File size too big');
		// 	}
		// });
		// $("#flash_deal_img").spartanMultiImagePicker({
		// 	fieldName:        'flash_deal_img',
		// 	maxCount:         1,
		// 	rowHeight:        '200px',
		// 	groupClassName:   'col-md-4 col-sm-4 col-xs-6',
		// 	maxFileSize:      '',
		// 	dropFileLabel : "Drop Here",
		// 	onExtensionErr : function(index, file){
		// 		console.log(index, file,  'extension err');
		// 		alert('Please only input png or jpg type file')
		// 	},
		// 	onSizeErr : function(index, file){
		// 		console.log(index, file,  'file size too big');
		// 		alert('File size too big');
		// 	}
		// });

		// $("#meta_photo").spartanMultiImagePicker({
		// 	fieldName:        'meta_img',
		// 	maxCount:         1,
		// 	rowHeight:        '200px',
		// 	groupClassName:   'col-md-4 col-sm-4 col-xs-6',
		// 	maxFileSize:      '',
		// 	dropFileLabel : "Drop Here",
		// 	onExtensionErr : function(index, file){
		// 		console.log(index, file,  'extension err');
		// 		alert('Please only input png or jpg type file')
		// 	},
		// 	onSizeErr : function(index, file){
		// 		console.log(index, file,  'file size too big');
		// 		alert('File size too big');
		// 	}
      // });
   


   // This function is used to add new product
    $('form#add_new_product_form').on('submit', function(event){
         event.preventDefault();
         tinyMCE.triggerSave();
         console.log("form data we get: ",$(this)[0]);
         var formData = new FormData($(this)[0]);
         // formData.append(attributes);
        
         // let json = [];
         // $("#attributes option").each(function(i){
         //    // alert($(this).text() + " : " + $(this).val());
         //    var res = $(this).val().split(",");
         //    if($("#"+res[0]+res[1]).length) {
         //       // alert($('#'+res[0]+res[1]).val());
         //       item = {}
         //       item [res[1]] = $('#'+res[0]+res[1]).val();
         //       json.push(item);
         //    }
            
         // });
         // formData.append("attributes",JSON.stringify(json));
         let message = ($("input[name='photos[]']").val() == "")?"You are saving product without gallery images.Please add some gallery images before saving it!":
         ($("input[name='thumbnail_img']").val() == "")?"You are saving product without thumbnail images.Please add some thumbnail images before saving it!":
         ($("input[name='alt_image_tag_photo[]']").val() == "")?"Please add gallery alt image text":
         ($("input[name='alt_image_tag_thumbnail']").val() == "")?"Please add thumbnail alt image text":"";
         if($("input[name='photos[]']").val() == "" || $("input[name='thumbnail_img']").val() == "" || $("input[name='alt_image_tag_photo[]']").val() == "" || $("input[name='alt_image_tag_thumbnail']").val() == ""){
               swal({
                     title: message,
                     text: "Not a good practice of saving product!",
                     type: "warning",
                     showCancelButton: true,
                     confirmButtonClass: "btn-danger",
                     confirmButtonText: "Yes, save it!",
                     cancelButtonText: "Cancel!",
                  }).then(function(isConfirm) {
                     if(isConfirm.value==true){
                        console.log("yes")
                        addProductWithoutImages(formData);
                     }else{
                        console.log("cancelled");
                     }
                  });
         }else{
             addProductWithoutImages(formData);
         }
   });
});

 //Add Product without images
 const addProductWithoutImages = (formData) => {
     if($('#add_new_product_form').parsley().isValid())
     {
            $.ajax({
               type: 'POST',
               url: "{{ url('api/products') }}",
               data: formData,
               processData: false,
               contentType: false,
               dataType:'JSON',
               headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
               beforeSend:function()
               {
                  $('#add_new_product').attr('disabled', 'disabled');
                  $('#add_new_product').val('Saving...');
               },
               success:function(response){
                  if(response.result=="success"){
                      $('#add_new_product_form')[0].reset();
                      $('#add_new_product_form').parsley().reset();
                      $('#add_new_product').attr('disabled', false);
                      $('#add_new_product').val('Save');
                      Toaster(response['message'],'success');
                      window.location = "{{ url('/products/show') }}";
                  }else if(response.result=="fail"){
                     // $('#add_new_product_form')[0].reset();
                     //  $('#add_new_product_form').parsley().reset();
                      $('#add_new_product').attr('disabled', false);
                      $('#add_new_product').val('Save');
                      Toaster(response['message'],'danger');
                  }else if(response.result=="error"){
                     // $('#add_new_product_form')[0].reset();
                     //  $('#add_new_product_form').parsley().reset();
                      $('#add_new_product').attr('disabled', false);
                      $('#add_new_product').val('Save');
                      Toaster(response['message'],'danger');
                  }
               },
               error:function(response){
                  console.log(response.data)
                  // $('#add_new_product_form')[0].reset();
                  //  $('#add_new_product_form').parsley().reset();
                   $('#add_new_product').attr('disabled', false);
                   $('#add_new_product').val('Save');
                   Toaster('Something went wrong!','danger');
               }, 
             });
      }
 }  

   //This function is used to get categories
   const getCategories=()=>{
      $.ajax({
         type: 'GET',
         url: "{{ url('/api/tags/categories') }}",
         processData: false,
         contentType: false,
         dataType:'JSON',
         headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
         beforeSend:function()
         {
                  $("#category").attr('disabled', 'disabled');
         },
         success:function(response){
            let categories=response.data;
            let html="";
               if(response.result=="success"){
               for(i=0;i<categories.length;i++){
                     html+="<option value="+categories[i].id+">"+categories[i].name+"</option>";
                  }
                  $("#category").append(html);
                  $("#category").attr('disabled', false);
               } 
         },
         error:function(response){
                     $("#category").attr('disabled', 'disabled');
            }, 
      });
   }
    // This function is used to get subcategories

    const getSubCategories=()=>{
      $.ajax({
            type: 'GET',
            url: "{{ url('/api/tags/subcategories') }}",
            processData: false,
            contentType: false,
            dataType:'JSON',
            headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
            beforeSend:function()
            {
                    $("#sub_category").attr('disabled', 'disabled');
            },
            success:function(response){
               let subcategories=response.data;
               let html="";
                if(response.result='success'){
                  for(i=0;i<subcategories.length;i++){
                        html+="<option value="+subcategories[i].id+">"+subcategories[i].name+"</option>";
                     }
                     console.log("html",html);
                     $("#sub_category").append(html);
                     $("#sub_category").attr('disabled', false);
                  } 
            },
            error:function(response){
                      $("#sub_category").attr('disabled', 'disabled');
               }, 
        });
    }
    // This function is used to get Carousals
   const getCarousals=()=>{
      $.ajax({
         type: 'GET',
         url: "{{ url('/api/tags/carousal') }}",
         processData: false,
         contentType: false,
         dataType:'JSON',
         headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
         beforeSend:function()
         {
                  $("#carousals").attr('disabled', 'disabled');
         },
         success:function(response){
            let carousals=response.data;
            let html="";
               if(response.result=="success"){
               for(i=0;i<carousals.length;i++){
                     html+="<option value="+carousals[i].id+">"+carousals[i].text+"</option>";
                  }
                  $("#carousals").append(html);
                  $("#carousals").attr('disabled', false);
               } 
         },
         error:function(response){
                     $("#carousals").attr('disabled', 'disabled');
            }, 
      });
   }
     // This function is used to get all product offers
     const getOffers=()=>{
      $.ajax({
         type: 'GET',
         url: "{{ url('/api/tags/product') }}",
         processData: false,
         contentType: false,
         dataType:'JSON',
         headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
         beforeSend:function()
         {
                  $("#Offers").attr('disabled', 'disabled');
         },
         success:function(response){
            let offers=response.data;
            let html="";
            console.log("offers",offers[0].tag_name)
               if(response.result=="success"){
               for(i=0;i<offers.length;i++){
                     html+="<option value="+offers[i].id+">"+offers[i].tag_name+"</option>";
                  }
                  $("#Offers").append(html);
                  $("#Offers").attr('disabled', false);
               } 
         },
         error:function(response){
                     $("#Offers").attr('disabled', 'disabled');
            }, 
      });
   }
    //This function is used to get Brands of products
    const getBrand=()=>{
      $.ajax({
            type: 'GET',
            url: "{{ url('/api/tags/brand') }}",
            processData: false,
            contentType: false,
            dataType:'JSON',
            headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
            beforeSend:function()
            {
                    $("#brand").attr('disabled', 'disabled');
            },
            success:function(response){
               console.log("brands response=",response);
               let brand=response.data;
               let html="";
               console.log(brand)
                if(response.result=="success"){
                  for(i=0;i<brand.length;i++){
                        html+="<option value="+brand[i].id+">"+brand[i].name+"</option>";
                     }
                     $("#brand").append(html);
                     $("#brand").attr('disabled', false);
                  } 
            },
            error:function(response){
                      $("#brand").attr('disabled', 'disabled');
               }, 
        });
    }
    // to get attributes
    const getAttributes=()=>{
      $.ajax({
         type: 'GET',
         url: "{{ url('/api/tags/attributes') }}",
         processData: false,
         contentType: false,
         dataType:'JSON',
         headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
         beforeSend:function()
         {
                  $("#attributes").attr('disabled', 'disabled');
         },
         success:function(response){
            let attributes=response.data;
            let html="";
          
               if(response.result=="success"){
               for(i=0;i<attributes.length;i++){
                     html+="<option value="+[attributes[i].id,attributes[i].name]+">"+attributes[i].name+"</option>";
                  }
                  $("#attributes").append(html);
                  $("#attributes").attr('disabled', false);
               } 
         },
         error:function(response){
                     $("#attributes").attr('disabled', 'disabled');
            }, 
      });
   }
   var checkattribute= new Array();
   const addAttribute=(_this)=>{
      console.log($(_this).val());
      var res = $(_this).val().split(",");
      console.log(res);
      if(!checkattribute.includes(res[1]) ){
         checkattribute.push(res[1]);
         var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '<input type="hidden" name="label[]" value="'+res[1]+'"  id="'+res[0]+res[1]+'">';
        if(res[1]=="color"){
         html+=' <label for="value[]" class="form-control">Select  color:</label>';
          // html+='<input type="color" name="value[]" value="" id="'+res[0]+res[1]+'" class="form-control" placeholder="Choose '+res[1]+'" autocomplete="off">'
          html += '<input type="color" name="value[]" id="favcolor" class="form-control" value="#ff0000">   '    ;
      
        }else{
          
           html+='<input type="text" name="value[]" value="" id="'+res[0]+res[1]+'" class="form-control" placeholder="Enter '+res[1]+'" autocomplete="off">';
        }
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" value="'+res[1]+'" type="button" class="btn btn-dark pull-right">Remove</button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
      }
     

   }
   
   
   $(document).on('click', '#removeRow', function () {
      console.log("delete key value=",this.value);
      checkattribute=checkattribute.filter((index,key)=>index!=this.value);
      $(this).closest('#inputFormRow').remove();
      console.log("re selecting",$('attributes').val(1));
      $('[name=attributes]').val( '' ); 
        });
</script>
@endsection
