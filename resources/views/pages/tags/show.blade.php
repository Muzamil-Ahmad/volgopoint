@extends('master')
@section('content')
 <!-- Main Content -->
 <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Product Offers</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->
  <!-- Container -->
<div class="container">

<!-- Title -->
<div class="hk-pg-header">
<h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather=""></i></span></span>Product Offers</h4>
 <a type="button" href="{{url('tags/create')}}" class="btn btn-dark pull-right">Add New Offer</a>
</div>
<!-- /Title -->

<!-- Row -->
<div class="row">
    <div class="col-xl-12">
        <section class="hk-sec-wrapper">
         <div class="row">
                <div class="col-sm">
                    <div class="table-wrap">
                        <table id="tags_list" class="table table-hover w-100 display pb-30">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tag</th>
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
                    getTags();
                });


let dt="";
const getTags = () =>{
    if($.fn.DataTable.isDataTable(dt) ) {
        $(dt).DataTable().destroy();
    }
    
    $("#tags_list tbody").empty();
    dt = $('#tags_list').dataTable({
        "processing": true,
        "serverSide": true,
        "retrieve": true,
        "autoWidth": false,
        "lengthChange":true,
        "paging":true,
        "searching":true,
        "lengthMenu": [
            [ 10, 25, 50, -1 ],
            [ '10', '25', '50', 'All' ]
        ],
        "columnDefs": [
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
            
        }
        ],
        "language": {
            "processing": "<img src='{{asset("/images/blocks.gif")}}' style='width:32px;height:32px;'/><p>Loading. Please wait...</p>"
        },
        "ajax":{
            "type": "GET",
            "url": "{{ url('api/tags') }}",
            "dataType": "json",
            "headers": {"Authorization": 'Bearer ' + localStorage.getItem('token')},
            "data":{ _token: "{{csrf_token()}}"}
        },
        "columns": [
            {"data": "id"},
            {"data": "tag_name"},
            {
                "data": "null",
                "render": function (data, type, full, meta) {
                let id=full.id;
                return `<div class="input-group">
                    <div class="input-group-prepend btn-block">
                    <button class="btn btn-dark btn-block dropdown-toggle btn-sm " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{url('tags/${id}')}}">Edit</a>
                    <a class="dropdown-item" id="{{'${id}'}}" onclick="deleteTag(this)">Delete</a>
                    </div>
                    </div>
                    </div>` 
                }
             }
            
        ],
        buttons: {
            dom: {
                button: {
                    tag: 'button',
                    className: 'btn btn-sm btn-white customprint',
                }
            },
           
        },
        
        "createdRow": function (row, data, index) {
            let info = this.api().page.info();
            $('td', row).eq(0).html(index + 1 + info.page * info.length);
        },
        drawCallback : function() {
           
        }
    });
}

//This function is used to delete a product
const deleteTag=(_obj)=>{
        swal({
                title: "Delete Tag!",
                text: "You cannot undo this process!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
            }).then(function(isConfirm) {
                if(isConfirm.value==true){
                    ConfirmedDeleteTag(_obj);
                }else{
                    console.log("cancelled");
                }
            });
      } 

//This function deletes product at server
const ConfirmedDeleteTag=(_obj)=>{
        let id=$(_obj).attr('id');
        console.log('Bearer ' + localStorage.getItem('token'))
        $.ajax({
            type: 'Delete',
            url: '{{ url("/api/tags", "id") }}'.replace('id', id),
            processData: false,
            contentType: false,
            dataType:'JSON',
            headers: {"Authorization": 'Bearer ' + localStorage.getItem('token')},
            beforeSend:function()
            {
                    $(_obj).attr('disabled', 'disabled');
                    $(_obj).val('Deleting...');
            },
            success:function(response){
                if(response.result=="success"){
                      $(_obj).attr('disabled', false);
                      $(_obj).closest('tr').remove();
                      Toaster(response['message'],'success');
                  }else if(response.result=="fail"){
                      $(_obj).attr('disabled', false);
                      $(_obj).val('Delete');
                      Toaster(response['message'],'danger');
                  }else if(response.result=="error"){
                    $(_obj).attr('disabled', false);
                      $(_obj).val('Delete');
                      Toaster(response['message'],'danger');
                  }  
            },
            error:function(response){
                      $(_obj).attr('disabled', false);
                      $(_obj).val('Delete');
                      Toaster(response['message'],'danger');
                }, 
        });
}

</script>
@endsection