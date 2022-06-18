@extends('master')
@section('content')
<!-- Main Content -->
<div class="hk-pg-wrapper">
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
   <ol class="breadcrumb breadcrumb-light bg-transparent">
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      <li class="breadcrumb-item " aria-current="page">Roles</li>
   </ol>
</nav>
<!-- /Breadcrumb -->
<!-- Container -->
<div class="container">
   <!-- Title -->
   <div class="hk-pg-header">
      <h4 class="hk-pg-title offset-md-2"><span class="pg-title-icon"><span class="feather-icon"><i data-feather=""></i></span></span>Add User</h4>
   </div>
   <!-- /Title -->
</div>
<form id="userForm" >
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
      <div class="form-group">
         <div class="input-group">
            <div class="input-group-prepend">
               <span class="input-group-text"  id="inputGroup-sizing-default">E-mail</span>
            </div>
            <input type="text" id="email" class="form-control" required name="email" aria-label="no default" aria-describedby="inputGroup-sizing-default">
         </div>
      </div>
      <div class="form-group">
         <div class="input-group">
            <div class="input-group-prepend">
               <span class="input-group-text"  id="inputGroup-sizing-default">Password</span>
            </div>
            <input type="password" id="password" class="form-control" required name="password" aria-label="no default" aria-describedby="inputGroup-sizing-default">
         </div>
      </div>
      <div class="form-group">
         <div class="input-group">
            <div class="input-group-prepend">
               <span class="input-group-text"  id="inputGroup-sizing-default">confirm-Password</span>
            </div>
            <input type="password" id="confirm_password" class="form-control" required name="confirm_password" data-parsley-equalto="#password" aria-label="no default" aria-describedby="inputGroup-sizing-default">
         </div>
      </div>
      <div>
         <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
               <span class="input-group-text"  id="inputGroup-sizing-default">Role</span>
               </div>
               <select class="custom-select" id="fetchRole" required aria-label="Example select with button addon">
                  <option selected>Choose...</option>
                  <!-- <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option> -->
               </select>
            </div>
         </div>
         <div class="form-group">
         <div class="input-group">
            <div class="input-group-prepend">
               <span class="input-group-text"  id="inputGroup-sizing-default">Phone Number</span>
            </div>
            <input type="number" id="phone" class="form-control" required name="number" aria-label="no default" aria-describedby="inputGroup-sizing-default">
         </div>
      </div>
         
         <div>
            <input type="submit"  class="btn btn-dark pull-right" name="submit" id="submit" value="Save" >
         </div>
      </div>
   </div>
</form>
<script>

$(document).ready(function () {
   $("#email").on('focusout', function(){
      getEmailCheck();
   
   })
    $('#userForm').parsley();
      $('#userForm').on('submit', function(event){
         event.preventDefault();
         if($('#userForm').parsley().isValid())
         {
         let name=$('#name').val();
         let email=$("#email").val();
         let password=$('#password').val();
         let role=$('#fetchRole').val();
         let phone=$('#phone').val();
         $.ajax({
            type: 'POST',
            url: "{{ url('api/auth/signup') }}",
            data: {
                "name":name,
                "email":email,
                "password":password,
                "role":role,
                "phone":phone
            },
            dataType:'JSON',
            headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
            beforeSend:function()
            {
               $('#submit').attr('disabled', 'disabled');
               $('#submit').val('Saving...');
            },
            success:function(response){
               $('#userForm')[0].reset();
               // console.log(response['message']);
               $('#userForm').parsley().reset();
               $('#submit').attr('disabled', false);
               $('#submit').val('save');
               Toaster(response['message'],response['result']);
             
               window.location = "{{ url('user/show') }}";
               //window.location = "{{ url('user/show') }}";
            },
            error:function(response){
                     Toaster('Something went wrong!','danger');
                     $('#userForm').parsley().reset();
                     $('#submit').attr('disabled', false);
                     $('#submit').val('save');
                     console.log("error",response);;         
            },
         });  
      }
   });
   });
   fetchRoles();

   var slc = $('#fetchRole');
   slc.on('change', function(){
      value = slc.find(":selected").val();
      
   })

function fetchRoles(){
    console.log("reaches in fetch roles");
   $.ajax({
      type: 'GET',
      url: "{{ url('api/roles') }}",
   
      dataType:'JSON',
      headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
      success:function(response){
         console.log(response.data);
         let html=""
         let userData=response.data
         userData.forEach(function(index){
            html+="<option value="+index.id+">"+index.user_role+"</option>"
         })
         $("#fetchRole").append(html);
         console.log("response OF role TABLE",response);
      },
      error:function(response){
         console.log("error",response);
      }, 
   });
 }



</script>
@endsection     