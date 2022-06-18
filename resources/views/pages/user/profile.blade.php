@extends('master')
@section('content')
<div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>

            <div class="container">

<!-- Title -->

<div class="row">
    
   <div class="col-sm-3">
   </div>
   <div class="col-sm-6">
   <section class="hk-sec-wrapper">
   <div class="container my-4 ">

   
    
<h4 class="mb-5 h4 text-center ">Profile</h4><br>

<!-- Default horizontal form -->
<form id="profile_form">

<!-- Grid row -->
<div class="form-group row">
    <!-- Default input -->
    <label for="name" class="col-sm-4 col-form-label text-center">Name</label>
    <div class="col-sm-8">
      <input type="text" required class="form-control" id="name" placeholder="name">
    </div>
  </div>
  <!-- Grid row -->
  
  <!-- Grid row -->
  <div class="form-group row">
    <!-- Default input -->
    <label for="inputEmail3" class="col-sm-4 col-form-label text-center">E-mail</label>
    <div class="col-sm-8">
      <input type="email" required class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <!-- Grid row -->

<!-- Grid row -->
<div class="form-group row">
    <!-- Default input -->
    <label for="phone" class="col-sm-4 col-form-label text-center">Phone</label>
    <div class="col-sm-8">
      <input type="text" required class="form-control" id="phone" placeholder="phone">
    </div>
  </div>
  <!-- Grid row -->


  <!-- Grid row -->
  <div class="form-group row">
    <!-- Default input -->
    <label for="inputPassword3" class="col-sm-4 col-form-label text-center">Password</label>
    <div class="col-sm-8">
      <input type="password" required class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <!-- Grid row -->


  <div class="form-group row">
           <div  class="col-sm-4 col-form-label text-center">
                              <span class="input-group-text" onclick="chooseDP()">Profile Picture</span>
                              <input  id="dp"  class="d-none" type="file" name="dp" >
                        </div>
           </div>
  <div class="chooseDpClass ">
                     <div class="text-right">
                           <img src="https://image.shutterstock.com/image-vector/c-letter-logo-vector-260nw-1219328149.jpg" id="dpimg" width="50%" class="rounded" alt="...">
                     </div>
  </div>
  <!-- Grid row -->
  <div class="form-group row">
    <div class="col">
      <button type="submit" id="save" class="btn btn-primary btn-md pull-right">Save</button>
    </div>
  </div>
  <!-- Grid row -->
</form>
</div>  
</section> 
   </div>
   <div class="col-sm-3">
   </div>
</div>
</div>

<script type="text/javascript"> 
 var displaypic;

function FetchProfile(){
  console.log("reached here!");
  let email=localStorage.getItem("email");
  console.log("email here!",email);
  let urlv = '{{ url("/api/profile", "email") }}';
  urlv = urlv.replace('email', email);
  $.ajax({
                type: 'GET',
                url: urlv,
                dataType:'JSON',
                headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
              
                beforeSend:function()
                {
                   
                },
                success:function(response){
                     let temp=response.data;
                     document.getElementById("inputEmail3").value=response.data[0].email;
                     document.getElementById("name").value=response.data[0].name;
                     document.getElementById("phone").value=response.data[0].phone;
                      displaypic="{{asset('/img/dp')}}".replace('dp',temp[0].dp);
                                 $("#dpimg").attr("src",displaypic);
                                 
                                
                    },
                error:function(response){
                  
                console.log(" some error",response);
                }
                    
            });

}
const chooseDP = () => {
         $("#dp").click();
   }
$(document).ready(function(){
 
   FetchProfile();
    $('#dp').change( function(event) {
  
    $("#dpimg").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
    });
    $('#profile_form').parsley();
    $('#profile_form').on('submit', function(event){
    event.preventDefault();
                      
   console.log("reached in update profile");
    if($('#profile_form').parsley().isValid())
    {
         let name=$('#name').val();
         let email=$('#inputEmail3').val();
         let password=$('#inputPassword3').val();
         let phone=$('#phone').val();
         let fdd = new FormData($(this)[0]);
         fdd.append("name",name);
         fdd.append("email",email);
         fdd.append("password",password);
         fdd.append("phone",phone);
        
         fdd.append("_token","{{ csrf_token()}}");
        // console.log("fdd=",fdd);
       
   $.ajax({
               type:  'POST',
               url:"{{ url('api/profile') }}",
               dataType:'JSON',
               data: fdd,
               headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
               processData: false,
               contentType: false,
              
               beforeSend:function()
                {
                    $('#save').attr('disabled', 'disabled');
                    $('#save').val('saving...');
                },
               success:function(response){
                     console.log(response['data']);
                      $('#profile_form').parsley().reset();
                      $('#save').attr('disabled', false);
                      $('#save').val('save');
                     // displaypic=response['data'];
                     console.log("we got=",response['data']);
                     if(response['data']!=null){
                      displaypic="{{asset('/img/dp')}}".replace('dp',response['data']);
                      localStorage.setItem("dp",response['data']);
                      $("#adminprofile").attr("src",displaypic);
                   
                     }
                    
                      Toaster(response['message'],'success');
                     
               },
               error:function(response){
                  Toaster('Something went wrong!','danger');
                  $('#save').attr('disabled', false);
                  $('#save').val('save');
                      console.log("error",response);
               }, 
             });
}
    });
});
</script>



@endsection