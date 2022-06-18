@extends('master')
@section('content')
 <!-- Main Content -->
<div class="hk-pg-wrapper">
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
   <ol class="breadcrumb breadcrumb-light bg-transparent">
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Category</li>
   </ol>
</nav>
<!-- /Breadcrumb -->
<!-- Container -->
<div class="container">
   <!-- Title -->
   <div class="hk-pg-header">
      <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather=""></i></span></span>Categories</h4>
      <a type="button" href="{{url('category/create')}}" class="btn btn-dark pull-right">Add New Category</a>
   </div>
   <!-- /Title -->
   <!-- Row -->
   <div class="row">
      <div class="col-xl-12">
         <section class="hk-sec-wrapper">
            <div class="row">
               <div class="col-sm">
                  <div class="table-wrap">
                     <table id="categoryTbl1" class="table table-hover w-100 display pb-30">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Banner</th>
                              <th>Icon</th>
                              <th>Action</th>
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
                    fetchCategories();
                   
                });
                function fetchCategories(){
                    // var token =  '{{ Session::get('access_token') }}';
                    // console.log(token);
                    $("#categoryTbl1").DataTable().destroy();
                    $('#categoryTbl1').DataTable({
                        ajax: {
                            url: "{{ url('/api/categories') }}",
                            type: 'GET',
                            dataType: 'JSON',
                            headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
                            dataSrc: function (json) {
                                 return json.data;
                            }
                        },   
                        "processing": true,
                        "serverSide": true,
                        "retrieve": true,
                        "autoWidth": false,
                        "lengthChange":true,
                        "paging":true,
                        "searching":false,
                        "responsive": true,
                        "autoWidth": false,
                        "responsive": true,
                        "autoWidth": false,
                        "order": [[ 0, "desc" ]],
                        language: {
                            search: "",
                           
                            searchPlaceholder: "Search"
                        },
                        sLengthMenu: "_MENU_items",
                        columnDefs: [
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
                            }
                                                 
                            ],
                        columns: [
                            {"data": "id"},
                            {"data": "name"},
                            {
                                "data": "null",
                                 "render": function (data, type, full, meta) {
                                    let imagebanner="{{asset('/img/image')}}".replace('image',full.banner);
                                 return '<img id="image" src='+imagebanner+'  alt="banner" width="40%">'
                                }
                            },
                           
                            {
                                "data": "null",
                                 "render": function (data, type, full, meta) {
                                    let imageicon="{{asset('/img/image')}}".replace('image',full.icon);
                                 return '<img id="image" src='+imageicon+'  alt="icon" width="40%">'
                                }
                            },
                            {
                                "data": "null",
                                "render": function (data, type, full, meta) {
                                   let id=full.id;

                                return `<div class="input-group ">
                                    <div class="input-group-prepend btn-block">
                                    <button class="btn btn-dark dropdown-toggle btn-sm btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                    <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{url('category/edit/${id}')}}">Edit</a>
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
                title: "Delete Category!",
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
const ConfirmedDeleteProduct=(_this)=>{
        let id=$(_this).attr('id');
        console.log(_this);
        let urlv = '{{ url("/api/categories", "id") }}';
        urlv = urlv.replace('id', id);
        $.ajax({
                type:  'DELETE',
                url: urlv,
                headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
                success:function(response){
                    console.log(response['message']);
                    if(response['message']=='Deleted Successfully'){
                        let id=$(_this).attr('id');
                        $(_this).closest('tr').remove();
                        
                    }
                      Toaster(response['message'],'success');
                    //   window.location = "{{ url('category/show') }}";
               },
               error:function(error){
                //    console.log(error.responseJSON.message)
                    if(error.status===419){
                        Toaster(error.responseJSON.message,'success');
                    }   
               }, 

    
        });
     }
               
</script>
@endsection
