@extends('master')
@section('content')
 <!-- Main Content -->
 <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Carousals</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->
  <!-- Container -->
<div class="container">

<!-- Title -->
<div class="hk-pg-header">
<h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather=""></i></span></span>Carousals</h4>
 <a type="button" href="{{url('carousal/create')}}" class="btn btn-dark pull-right">Add New Carousal</a>
</div>
<!-- /Title -->

<!-- Row -->
<div class="row">
    <div class="col-xl-12">
        <section class="hk-sec-wrapper">
         <div class="row">
                <div class="col-sm">
                    <div class="table-wrap">
                        <table id="carousal_list" class="table table-hover w-100 display pb-30">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Text</th>
                                    <th>Image</th>
                                    <th>Alt Text</th>
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
                    getCarousals();
                });


let dt="";
const getCarousals= () =>{
    let data =   {
                "date" : 'date'
            }
   
    if($.fn.DataTable.isDataTable(dt) ) {
        $(dt).DataTable().destroy();
    }
    
    $("#carousal_list tbody").empty();
    dt = $('#carousal_list').dataTable({
        "processing": true,
        "serverSide": true,
        "retrieve": true,
        "autoWidth": false,
        "lengthChange":true,
        "paging":true,
        "searching":true,
        "order": [[ 0, "desc" ]],
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
        },
        {
            "targets": 3,
            "className": "text-center",
        },
        {
            "targets": 4,
            "className": "text-right",
            
        }
        ],
        "language": {
            "processing": "<img src='{{asset("/images/blocks.gif")}}' style='width:32px;height:32px;'/><p>Loading. Please wait...</p>"
        },
        "ajax":{
            "type": "GET",
            "url": "{{ url('api/carousals') }}",
            "dataType": "json",
            "headers": {"Authorization": 'Bearer ' + localStorage.getItem('token')},
            "data":{ _token: "{{csrf_token()}}",data:data}
        },
        "columns": [
            {"data": "id","orderable": false },
            {"data": "text"},
            {
                                "data": "null","orderable": false,
                                 "render": function (data, type, full, meta) {
                                 let image="{{asset('/img/image')}}".replace('image',full.image);
                                 return '<img id="image" src='+image+' class="card-img-top" alt="logo" style="width:20%;">'
                                }
                            },
            {"data": "alt_tag"},
            {
                "data": "null","orderable": false,
                "render": function (data, type, full, meta) {
                let id=full.id;
                return `<div class="input-group">
                    <div class="input-group-prepend btn-block">
                    <button class="btn btn-dark btn-block dropdown-toggle btn-sm " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{url('carousal/${id}')}}">Edit</a>
                    <a class="dropdown-item" id="{{'${id}'}}" onclick="deleteCarousal(this)">Delete</a>
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
const deleteCarousal=(_obj)=>{
        swal({
                title: "Delete Carousal!",
                text: "You cannot undo this process!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
            }).then(function(isConfirm) {
                if(isConfirm.value==true){
                    ConfirmedDeleteCarousal(_obj);
                }else{
                    console.log("cancelled");
                }
            });
      } 

//This function deletes product at server
const ConfirmedDeleteCarousal=(_obj)=>{
        let id=$(_obj).attr('id');
        console.log('Bearer ' + localStorage.getItem('token'))
        $.ajax({
            type: 'Delete',
            url: '{{ url("/api/carousals", "id") }}'.replace('id', id),
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
                  }else if(response.result=="assigned"){
                      $(_obj).attr('disabled', false);
                      $(_obj).val('Delete');
                      Toaster(response['message'],'danger');
                  }  else if(response.result=="fail"){
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