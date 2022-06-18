@extends('master')
@section('content')
 <!-- Main Content -->
<div class="hk-pg-wrapper">
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
   <ol class="breadcrumb breadcrumb-light bg-transparent">
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Users</li>
   </ol>
</nav>
<!-- /Breadcrumb -->
<!-- Container -->
<div class="container">
   <!-- Title -->
   <div class="hk-pg-header">
      <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather=""></i></span></span>User</h4>
      <a type="button" href="{{url('user/create')}}" class="btn btn-dark pull-right">Add New User</a>
   </div>
   <!-- /Title -->
   <!-- Row -->
   <div class="row">
      <div class="col-xl-12">
         <section class="hk-sec-wrapper">
            <div class="row">
               <div class="col-sm">
                  <div class="table-wrap">
                     <table id="userTable" class="table table-hover w-100 display pb-30">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Phone</th>
                              <th>Role_id</th>
                           </tr>
                        </thead>
                        <tbody>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </section>
      </div>
   </div>
   <!-- /Row -->
</div>

<script type="text/javascript"> 
                $(document).ready(function () {
                    // Fetch Categories
                    fetchUsers();
                  
                });
                function fetchUsers(){
                    // var token =  '{{ Session::get('access_token') }}';
                    // console.log(token);
                    $("#userTable").DataTable().destroy();
                    $('#userTable').DataTable({
                        ajax: {
                            url: "{{ url('/api/auth/user') }}",
                            type: 'GET',
                            dataType: 'JSON',
                            headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
                            dataSrc: function (json) {
                                 return json.data;
                            }
                        },   
                        responsive: true,
                        autoWidth: false,
                        language: {
                            search: "",
                            searchPlaceholder: "Search"
                        },
                        'columnDefs': [
                            {
                                "targets": 0, 
                                "className": "text-center",
                            },
                            {
                                "targets": 1,
                                "className": "text-center",
                            },
                            {
                                "targets": 2, 
                                "className": "text-center",
                            },
                            {
                                "targets": 3, 
                                "className": "text-center",
                            },
                            {
                                "targets": 4, 
                                "className": "text-center",
                            },
                            {
                                "targets": 5, 
                                "className": "text-left",
                            }
                              
                            ],
                        sLengthMenu: "_MENU_items",
                        columns: [
                            {"data": "id"},
                            {"data": "name"},
                            {"data": "email"},
                            {"data": "phone"},
                            {"data": "user_role"},
                            {
                                "data": "null",
                                "render": function (data, type, full, meta) {
                                   let id=full.id;

                                return `<div class="input-group ">
                                      <div class="input-group-prepend btn-block">
                                    <button class="btn btn-dark dropdown-toggle btn-sm btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                    <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{url('user/edit/${id}')}}">Edit</a>
                                    <a class="dropdown-item" id="{{'${id}'}}" onclick="deleteme(this)">Delete</a>
                                    </div>
                                    </div>
                                    </div>` 
                                }
                            }
                        ]
                    });
                }
    function deleteme(_this){
       // displays the pop-up box 
 swal({
                title: "Delete User!",
                text: "You cannot undo this process!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
            }).then(function(isConfirm) {
                if(isConfirm.value==true){
                    ConfirmedDeleteProduct(_this);
                }else{
                    console.log("cancelled");
                }
            });
    }
   
//This function deletes product at server
function ConfirmedDeleteProduct(_this)  {

        let id=$(_this).attr('id');
        console.log(_this);
        $(_this).closest('tr').remove();
        // console.log("reached here in deleteme and id=",$id);
        let urlv = '{{ url("/api/auth/user", "id") }}';
      urlv = urlv.replace('id', id);
        $.ajax({
                type:  'DELETE',
                url: urlv,
                headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
                success:function(response){
                    console.log(response['message']);
                    if(response['message']=='success'){
                        $(_this).closest('tr').remove();

                    }
                      Toaster(response['message'],'success');
                    //   window.location = "{{ url('category/show') }}";
               },
               error:function(response){
              
                      console.log("error",response);
               }, 

    
        });
     }
               
</script>
@endsection