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
      <h4 class="hk-pg-title offset-md-2"><span class="pg-title-icon"><span class="feather-icon"><i data-feather=""></i></span></span>Edit User</h4>
   </div>
   <!-- /Title -->
</div>
<form id="userForm" >
   <div class="row ">
   <div class="col-sm-8 offset-md-2">
     
         <div class="form-group">
            <div class="input-group">
               <div class="input-group-prepend">
               <span class="input-group-text"  id="inputGroup-sizing-default">Role</span>
               </div>
               <select class="custom-select" id="fetchRole" aria-label="Example select with button addon">
                  <option value="" disabled>Choose...</option>
                  <!-- <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option> -->
               </select>
            </div>
         </div>
        
         
         <div>
            <input type="submit" onclick="updateUser()"  class="btn btn-dark pull-right" name="submit" id="submit" value="Update" >
         </div>
      </div>
   </div>
   <!-- <input type="hidden" id="role_id" value=""> -->
</form>
<script>

$(document).ready(function () {
      
      var id = "{!! $id !!}";
      let urlv = '{{ url("/api/auth/user", "id") }}';
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
                                
                                     roleId=temp.role_id
                                 console.log("here is role id:",roleId);
                               
                                  },
                             error:function(response){
              
                               console.log(" the error here is:",response);
                              }, 
             });
      
   // }
   fetchRoles();
   });
function updateUser()
{
   // event.preventDefault();
   // $('#userForm').parsley();
  
   console.log("reached in update user");
      var id = "{!! $id !!}";
      let urlv = '{{ url("/api/auth/user", "id") }}';
      urlv = urlv.replace('id', id);
      if($('#userForm').parsley().isValid())
    {
      console.log("reached in parsley is valid");  
        
         let role=$('#fetchRole').val();
        
   $.ajax({
                type:  'POST',
                url: urlv,
                dataType:'JSON',
                 data: {
                "role":role,
                "id":id
                 } ,
                 headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
             
               beforeSend:function()
                {
                    $('#submit').attr('disabled', 'disabled');
                    $('#submit').val('updating...');
                },
               success:function(response){
                      
                      console.log(response['message']);
                     
                      $('#submit').attr('disabled', false);
                      $('#submit').val('update');
                     //  $("#banner").val(" ");
                    //alert("hhhh");
                      setTimeout(() => {
                         console.log("timein")
                         window.location = "{{ url('user/show') }}";
                        
                     }, 3000);
                     console.log('timeout');
                    
                     Toaster(response['message'],'success');       
                     // 1
               },
               error:function(response){
                  Toaster('Something went wrong!','danger');
               //   $('#roleForm').parsley().reset();
                      $('#submit').attr('disabled', false);
                      $('#submit').val('update');
                      console.log("error",response);
               }, 
             });
}
}


var slc = $('#fetchRole');
slc.on('change', function(){
   value = slc.find(":selected").val();
   
})
let roleId;
function fetchRoles(){
 console.log("reaches in fetch roles");
$.ajax({
   type: 'GET',
   url: "{{ url('api/roles') }}",

   dataType:'JSON',
   headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
   success:function(response){
      let html=""
      let userData=response.data
        console.log("indexid",roleId)  
        userData.forEach(function(index){
            if(roleId==index.id){
                html+="<option value="+index.id+" selected>"+index.user_role+"</option>"
            }else{
               html+="<option value="+index.id+">"+index.user_role+"</option>"
            }
      })
      $("#fetchRole").append(html);
     
   },
   error:function(response){
      console.log("error",response);
   }, 
});
}
</script>
@endsection
