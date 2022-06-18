@extends('master')
@section('content')
<style>
    td {
        white-space: nowrap;
        max-width: 100%;
        
    }
    table.dataTable thead th, table.dataTable thead td {
        padding: 10px 18px;
        border-bottom: 1px solid #111;
}
    
</style>
 <!-- Main Content -->
<div class="hk-pg-wrapper">
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
   <ol class="breadcrumb breadcrumb-light bg-transparent">
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Attributes</li>
   </ol>
</nav>
<!-- /Breadcrumb -->
<!-- Container -->
<div class="container">
   <!-- Title -->
   <div class="hk-pg-header">
      <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather=""></i></span></span>Attributes</h4>
      <a type="button" href="{{url('attributes/create')}}" class="btn btn-dark pull-right">Add New Attribute</a>
   </div>
   <!-- /Title -->
   <!-- Row -->
   <div class="row">
      <div class="col-xl-12">
         <section class="hk-sec-wrapper">
            <div class="row">
               <div class="col-sm">
                  <div class="table-wrap">
                     <table id="attributeTable" class="table table-hover">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Slug</th>
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
                  fetchAttributes();
                });
                function fetchAttributes(){
                    $("#attributeTable").DataTable().destroy();
                    $('#attributeTable').DataTable({
                        ajax: {
                            url: "{{ url('/api/attribute') }}",
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
                        language: {
                            search: "",
                            searchPlaceholder: "Search"
                        },
                        "lengthMenu": [
                                 [ 5, 25, 50, -1 ],
                                 [ '5', '25', '50', 'All' ]
                           ],
                           "order":[
                                    [0,'desc']
                                ],
                           'columnDefs': [
                            {
                                "targets": 0, 
                                "className": "text-left",
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
                            }
                     
                            ],
                        columns: [
                            {"data": "id"},
                            {"data": "name"},
                            {"data": "slug"},  
                         
                            {
                                "data": "null", "orderable": false ,
                                "render": function (data, type, full, meta) {
                                   let id=full.id;
                                return `<div class="input-group ">
                                    <div class="input-group-prepend btn-block">
                                    <button class="btn btn-dark dropdown-toggle btn-sm btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                    <div class="dropdown-menu ">
                                    <a class="dropdown-item" href="{{url('attributes/edit/${id}')}}">Edit</a>
                                    <a class="dropdown-item" id="{{'${id}'}}" onclick="deleteAttribute(this)">Delete</a>
                                    </div>
                                    </div>
                                    </div>` 
                                }
                            }
                        ]
                    });
                }
    const  deleteAttribute = (_this) => {
            swal({
                title: "Delete Attribute!",
                text: "You cannot undo this process!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
            }).then(function(isConfirm) {
                if(isConfirm.value==true){
                    ConfirmedDeleteAttribute(_this);
                }else{
                    console.log("cancelled");
                }
            });
    }
   
//This function deletes product at server
const ConfirmedDeleteAttribute = (_this) => {
        let id=$(_this).attr('id');
        $.ajax({
                type:  'DELETE',
                url: '{{ url("/api/attribute", "id") }}'.replace('id', id),
                headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
                success:function(response){
                    console.log('response data',response);
                  if(response.result=="success"){
                      $(_this).attr('disabled', false);
                      $(_this).closest('tr').remove();
                      Toaster(response['message'],'success');
                  }else if(response.result=="fail"){
                      $(_this).attr('disabled', false);
                      $(_this).val('Delete');
                      Toaster(response['message'],'danger');
                  }else if(response.result=="assigned"){
                      $(_this).attr('disabled', false);
                      $(_this).val('Delete');
                      Toaster(response['message'],'danger');
                  }else if(response.result=="error"){
                      $(_this).attr('disabled', false);
                      $(_this).val('Delete');
                      Toaster(response['message'],'danger');
                  }    
               },
               error:function(error){
                if(error.status===419){
                    Toaster(error.responseJSON.message,'success');
                }
               }, 
    
        });
     }
               
</script>
@endsection