@extends('master')
@section('content')
<script src="{{ asset('admin_assets/dist/ejs/spartan-multi-image-picker-min.js') }}"></script>
<!-- Main Content -->
<div class="hk-pg-wrapper">
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
   <ol class="breadcrumb breadcrumb-light bg-transparent">
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      <li class="breadcrumb-item " aria-current="page">Edit Product</li>
      
   </ol>
</nav>
<!-- /Breadcrumb -->
<!-- Container -->

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
                  <select class="custom-select" id="category" name="category">
                     <option disabled selected>Select category</option>
                  </select>
            </div>
         </div>
         <div class="form-group">
                  <div class="input-group">
                     <select class="custom-select"  id="sub_category" name="sub_category">
                        <option disabled selected>Select subcategory</option>
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
                <select class="custom-select" id="brand"  name="brand">
                      <option value=""  selected disabled>Choose brand</option>
               </select>
            </div>
          </div>
      </div>
    </div>
</section>
<section class="hk-sec-wrapper">
    <div class="row ">
    <div class="col-sm-12" style="border-bottom:1px solid #eaecec">
					<h5 class="panel-title" >{{__('Product Images')}}</h5>
	</div>
      <div class="col-sm-8 offset-md-2">
     

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
							<div class="row" id="thumbnail_img">

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
                  <span class="input-group-text"  id="inputGroup-sizing-default">Original Price</span>
               </div>
               <input type="number" id="product_original_price" class="form-control" required name="product_original_price" aria-label="no default" aria-describedby="inputGroup-sizing-default">
            </div>
         </div>
        
         <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"  id="inputGroup-sizing-default">Tax</span>
               </div>
               <input type="number" id="product_tax" class="form-control" required name="product_tax" aria-label="no default" aria-describedby="inputGroup-sizing-default">
            </div>
         </div>
         <!-- <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"  id="inputGroup-sizing-default">Discount</span>
               </div>
               <input type="number" id="product_discount" class="form-control" required name="product_discount" aria-label="no default" aria-describedby="inputGroup-sizing-default">
            </div>
         </div> -->
         <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"  id="inputGroup-sizing-default">Selling Price</span>
               </div>
               <input type="number" id="product_sale_price" class="form-control" required name="product_sale_price" aria-label="no default" aria-describedby="inputGroup-sizing-default">
            </div>
         </div>
         <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"  id="inputGroup-sizing-default">Quantity</span>
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
                  <select class="custom-select"  onchange="addAttribute(this);"  id="attributes" name="attributes">
                     <option value="" disabled selected>Select attributes</option>
                  </select>
                  <div id="newRow"></div>
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
            <div class="tinymce-wrap">
            <span class="input-group-text"  id="inputGroup-sizing-default">Product Description</span>
                    <textarea class="tinymce" id="product_description" name="product_description"></textarea>
            </div>
            <div class="tinymce-wrap">
   <span class="input-group-text"  id="inputGroup-sizing-default">Product Cart Description</span>
   <textarea class="tinymce" name="product_cart_description"></textarea>
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
   
         <div class="tinymce-wrap">
            <span class="input-group-text"  id="inputGroup-sizing-default">Meta Description</span>
                    <textarea class="tinymce" id="meta_description" name="meta_description"></textarea>
            </div>
            <div class="tinymce-wrap" style="margin-top:10px">
   <span class="input-group-text"  id="inputGroup-sizing-default">Meta Keywords</span>
   <textarea class="tinymce" name="meta_keywords"></textarea>
   </div>



      </div>
    </div>
</section>
</div>
<div class="row ">
      <div class="col-sm-12">
<input type="submit"  class="btn btn-dark pull-right" name="add_new_product" id="add_new_product" style="margin-right:1%" value="Update" >

</div>
</div>
</form>

<script>
let id;
$(document).ready(function(){
       id = "{!! $id !!}";
       setTimeout(() => {
         imageInputPlugin(); 
       }, 1000);
       getProductsData();
         getCategories();
         getSubCategories();
         getCarousals();
         getBrand();
         getOffers();
          getAttributes();
     
});

       


        // This function is used to update product
      $('form#add_new_product_form').on('submit', function(event){
         event.preventDefault();
         tinyMCE.triggerSave();
         let formData = new FormData($(this)[0]);
         // let message = ($("input[name='photos[]']").val() == "")?"You are saving product without gallery images.Please add some gallery images before saving it!":
         // ($("input[name='thumbnail_img']").val() == "")?"You are saving product without thumbnail images.Please add some thumbnail images before saving it!":
         // ($("input[name='alt_image_tag_photo[]']").val() == "")?"Please add gallery alt image text":
         // ($("input[name='alt_image_tag_thumbnail']").val() == "")?"Please add thumbnail alt image text":"";
         // if(($("input[name='photos[]']").val() == "" || $("input[name='previous_photos[]']").val() == "") || ($("input[name='thumbnail_img']").val() == "" || $("input[name='previous_thumbnail_img']").val() == "") || ($("input[name='previous_alt_image_tag_photo[]']").val() == "" || $("input[name='alt_image_tag_photo[]']").val() == "") || ($("input[name='previous_alt_image_tag_thumbnail']").val() == "" || $("input[name='alt_image_tag_thumbnail']").val() == "")){
         //       swal({
         //             title: message,
         //             text: "Not a good practice of saving product!",
         //             type: "warning",
         //             showCancelButton: true,
         //             confirmButtonClass: "btn-danger",
         //             confirmButtonText: "Yes, save it!",
         //             cancelButtonText: "Cancel",
         //          }).then(function(isConfirm) {
         //             if(isConfirm.value==true){
                        addProductWithoutImages(formData);
         //             }else{
         //                console.log("cancelled");
         //             }
         //          });
         // }else{
         //     addProductWithoutImages(formData);
         // }
   });


   const addProductWithoutImages = (formData) => {
     if($('#add_new_product_form').parsley().isValid())
     {
            $.ajax({
               type: 'Post',
               url: '{{ url("/api/products", "id") }}'.replace('id', id),
               data: formData,
               processData: false,
               contentType: false,
               dataType:'JSON',
               headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
               beforeSend:function()
                {
                    $('#add_new_product').attr('disabled', 'disabled');
                    $('#add_new_product').val('Updating...');
                },
               success:function(response){
                  if(response.result=="success"){
                      $('#add_new_product').attr('disabled', false);
                      $('#add_new_product').val('Update');
                      Toaster(response['message'],'success');
                      window.location = "{{ url('/products/show') }}";
                  }else if(response.result=="fail"){
                      $('#add_new_product').attr('disabled', false);
                      $('#add_new_product').val('Update');
                      Toaster(response['message'],'danger');
                  }else if(response.result=="error"){
                      $('#add_new_product').attr('disabled', false);
                      $('#add_new_product').val('Update');
                      Toaster(response['message'],'danger');
                  }
                      
               },
               error:function(response){
                  console.log(response.data)
                   $('#add_new_product').attr('disabled', false);
                   $('#add_new_product').val('Update');
                   Toaster('Something went wrong!','danger');
                }, 
             });
      }
   }
          // $('#add_new_product_form').parsley();
 
// });


// This function is used to upload images
var count=1;
var count2=1;
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

const imageInputPlugin=()=>{
         $("#photos").spartanMultiImagePicker({
			fieldName:        'photos[]',
			maxCount:         5,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6 input'+count,
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
         onAddRow: function() {
            putInput();
         },
		});
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
	
      $('.remove-files').on('click', function(){
            $(this).parents(".col-md-4").remove();
        });
}

// This function retrieves data from backend for update
let Category_id,Subcategory_id,Brand_id,Carousal_id,Offer_id,attVal;
const getProductsData=()=>{
      //   let id = "{!! $id !!}";
        let img;
        $.ajax({
            url: '{{ url("/api/products", "id") }}'.replace('id', id),
            type:  'GET',
            dataType: 'JSON',
            headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
            success:function(response){
               let product=response.data;
               attVal=product.attributes;
               console.log("attVal=",attVal);
               Category_id=product.category_id;
               Subcategory_id=product.subcategory_id;
               Brand_id=product.brand_id;
               Carousal_id=product.carousal_id;
               Offer_id=product.tag_id;
               editAttribute();
               console.log("index",product.photos);
                if(product.photos.length>= 1){
                    img="";
                    let phototag=product.photos_tags;
                    for(i=0;i<product.photos.length;i++){
                     let tag=(phototag != "" && phototag != undefined && phototag.length >= 1)?phototag[i]:"";
                     img=setImage(product.photos[i],'previous_photos[]',tag,'previous_alt_image_tag_photo[]');
                     $('#photos').append(img);
                    };
                }else{
                   let phototag=product.photos_tags;
                      img="";
                      let tag=(phototag != "" && phototag != undefined && phototag.length >= 1)?phototag[1]:"";
                      img=setImage(product.photos[0],'previous_photos[]',tag,'previous_alt_image_tag_photo[]');
                      $('#photos').append(img);
                }
                img="";
                img=setImage(product.thumbnail_img,'previous_thumbnail_img',product.thumbnail_img_tag,'previous_alt_image_tag_thumbnail');
                $("#thumbnail_img").append(img);
               //  img="";
               //  img=setImage(product.featured_img,'previous_featured_img');
               //  $("#featured_img").append(img);
               //  img="";
               //  img=setImage(product.flash_deal_img,'previous_flash_deal_img');
               //  $("#flash_deal_img").append(img);
                $("#name").val(product.name);
                $("#category").val(product.category_id);
                $("#sub_category").val(product.subcategory_id);
                $("#brand").val(product.brand_id);
                $("#product_original_price").val(product.product_original_price);
                $("#product_sale_price").val(product.product_discounted_price);
                $("#product_tax").val(product.product_tax);
               //  $("#product_discount").val(product.product_discount);
                $("#product_quantity").val(product.product_quantity);
                $("#product_description").val(product.product_description);
                $("#product_cart_description").val(product.product_cart_description);
                $("#product_specification").val(product.product_specification);
                $("#meta_description").val(product.meta_description);
                $("#meta_keywords").val(product.meta_keywords);
                $("#meta_title").val(product.meta_title);
            },
            error:function(response){
            }, 
         });
}  
//This function appends html
const setImage=(img,name,tag,inputname)=>{
   let html='{{asset("uploads/img")}}'.replace('img',img)
   return "<div class='col-md-4 col-sm-4 col-xs-6'>\
                        <div class='img-upload-preview'>\
                        <img loading='lazy'  src='"+html+"' alt='productPic' width='100px' class='img-responsive'>\
                        <input type='hidden' name='"+name+"' value="+img+">\
                        <button type='button' class='btn btn-danger close-btn remove-files'><i class='fa fa-times'></i></button>\
                        </div>\
                        <div class='form-group mt-2'>\
                                 <label for='alt_image_tag'>Tag</label>\
                                 <input type='text' class='form-control' name='"+inputname+"' id='alt_image_tag' value='"+tag+"'  placeholder='Alt tag...'>\
                              </div>\
                        </div>"
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
                     if(categories[i].id==Category_id)
                     {
                        html+="<option value="+categories[i].id+" selected>"+categories[i].name+"</option>";
                     }else{
                        html+="<option value="+categories[i].id+">"+categories[i].name+"</option>";
                     }
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
               console.log(subcategories)
                if(response.result=="success"){
                  
                  for(i=0;i<subcategories.length;i++){
                     if(subcategories[i].id == Subcategory_id){
                        html+="<option value="+subcategories[i].id+" selected>"+subcategories[i].name+"</option>";
                     }else{
                        html+="<option value="+subcategories[i].id+">"+subcategories[i].name+"</option>";
                     }
                  }
                     $("#sub_category").append(html);
                     $("#sub_category").attr('disabled', false);
                  } 
            },
            error:function(response){
                      $("#sub_category").attr('disabled', 'disabled');
            }, 
        });
    }
     // This function is used to get offers
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
               for(i=0;i<offers.length;i++)

                  {
                     if(offers[i].id==Offer_id)
                     {
                        html+="<option value="+offers[i].id+" selected>"+offers[i].tag_name+"</option>";
                     }else{
                        html+="<option value="+offers[i].id+">"+offers[i].tag_name+"</option>";
                     }
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
                  if(carousals[i].id==Carousal_id)
                  html+="<option value="+carousals[i].id+" selected>"+carousals[i].text+"</option>";
                  else
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
    //This function is used to get Brands of products
    const getBrand = () => {
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
               let brand=response.data;
               let html;
                if(response.result=="success"){
                  for(i=0;i<brand.length;i++){
                     if(brand[i].id == Brand_id)
                     {
                        html+="<option value="+brand[i].id+" selected>"+brand[i].name+"</option>";
                     }else{
                        html+="<option value="+brand[i].id+">"+brand[i].name+"</option>";
                     }
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
   const editAttribute=()=>{
      attVal.forEach((obj) => {
      Object.entries(obj).forEach(([key, value]) => {
         checkattribute.push(key);
       var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '<input type="hidden" name="label[]" value="'+key+'"  id="'+value+'">';
        if(key=="color"){
         html+=' <label for="value[]" class="form-control">Select  color:</label>';
         html += '<input type="color" name="value[]" id="favcolor" class="form-control" value="'+value+'">   '    ;
      
        }else{
         html+=' <label for="value[]" class="form-control">Select  '+key+':</label>';
           html+='<input type="text" name="value[]" value="'+value+'" id="'+value+'" class="form-control" placeholder="Enter '+key+'" autocomplete="off">';
        }
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" value="'+key+'" type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
         
      });
});
   }

   const addAttribute=(_this)=>{
     
      var res = $(_this).val().split(",");
      if(!checkattribute.includes(res[1]) ){
         checkattribute.push(res[1]);
         console.log('checkattrigutes',checkattribute);
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
        html += '<button id="removeRow" value="'+res[1]+'"type="button" class="btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
      }
     

   }

 $(document).on('click', '#removeRow', function () {
   checkattribute=checkattribute.filter((index,key)=>index!=this.value);
 
    $(this).closest('#inputFormRow').remove();
    console.log("re selecting",$('attributes').val(1));
    $('[name=attributes]').val( '' );
});






  
        
</script>
@endsection
