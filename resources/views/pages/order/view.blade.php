@extends('master')
@section('content')
 <!-- Main Content -->
 <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Order</li>
        </ol>
    </nav>
            <!-- /Breadcrumb -->
  <!-- Container -->
<div class="container">

<!-- Title -->
<div class="hk-pg-header">
    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather=""></i></span></span>View Order</h4>
</div>
<!-- /Title -->

<!-- Row -->
<div class="row mb-3">
                        <div class="col-md-4 offset-md-4">
                                <select class="custom-select" name="" id="delstatus" onChange=changeDeliveryStatus()>
                                    <option value="" disabled>Delivery status..</option>
                                </select>
                        </div>
                        <div class="col-md-4">
                                    <select class="custom-select" name="" id="paymentstatus" onChange=changePaymentStatus()>
                                        <option value="" disabled>Payment status..</option>
                                    </select>
                        </div>
  </div>
<div class="row">
    <div class="col-md-12">
        <section class="hk-sec-wrapper">
                    <div class="col-sm-12">
                        <div class="table-wrap">
                            <table id="order_item" class="table table-hover w-100 display pb-30" style="border-bottom: none !important;">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>photo</th>
                                        <th>Description</th>
                                        <th>Delivery Type</th>
                                        <th>QTY</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="container">
  <div class="row">
    <div class="col-lg">
      
    </div>
    <div class="col-lg">
     
    </div>
    <div class="col-lg">
     
<table style="width:100%;margin-top:3rem;margin-left:3rem;">
  <tr>
    <td style="color: #324148;
    font-family: inherit;
    font-weight: 500;
    line-height: 1.2;font-weight: bold;">Shipping Cost:</td>
    <td>$10.0</td>
  </tr>
  <tr>
    <td style="color: #324148;
    font-family: inherit;
    font-weight: 500;
    line-height: 1.2;font-weight: bold;">Tax:</td>
    <td>$0.0</td>
  </tr>
  <tr>
    <td style="color: #324148;
    font-family: inherit;
    font-weight: 500;
    line-height: 1.2;font-weight: bold;">Grand Total:</td>
    <td id="grand_total"></td>
  </tr>
</table>
</div>
    </div>
  </div>
        </section>
    </div>
</div>


</div>




<script type="text/javascript"> 

    let id;
    let nettotal=0;
    let deliveryStatus=['Pending','Processing','Shipped','Delivered'];
    let paymentStatus=['Paid','Unpaid']
        $(document).ready(function () {
            setTimeout(() => {
                getDeliveryStatus(); 
                getPaymentStatus();
            },500);
           

            id = "{!! $id !!}";
                    // viewProduct();
var dt="";

// const viewProduct=()=>{
    let data =   {
                "date" : 'date'
            }
   
    if($.fn.DataTable.isDataTable(dt) ) {
        $(dt).DataTable().destroy();
    }
    let total=0;
    $("#order_item tbody").empty();
    dt = $('#order_item').dataTable({
        "processing": true,
        "serverSide": true,
        "retrieve": true,
        "autoWidth": false,
        "lengthChange":true,
        "paging":false,
        "searching":false,
        "ordering":false,
        "bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
    "paging": false,//Dont want paging                
    "bPaginate": false,//Dont want paging 
    
        // "dom": 'lBfrtip',
        // "dom": "<'row'<'col-md-8'l><'col-md-4'Bf>>" +
        // // "<'row'<'col-md-6'><'col-md-6'>>" +
        // "<'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
        "lengthMenu": [
            [ 10, 25, 50, -1 ],
            [ '10', '25', '50', 'All' ]
        ],
        "columnDefs": [
        {
            "targets": 0, 
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
            "targets": 4,
            "className": "text-right",
        }
        ],
        "language": {
            "processing": "<img src='{{asset("/images/blocks.gif")}}' style='width:32px;height:32px;'/><p>Loading. Please wait...</p>"
        },
        "ajax":{
            "type": "GET",
            "url": "{{ url('api/orders/view') }}",
            "dataType": "json",
            "headers": {"Authorization": 'Bearer ' + localStorage.getItem('token')},
            "data":{data:data,id:id}
        },
        "columns": [
            {"data": "id"},
            {
                "data": "photo",
                "render": function (data, type, full, meta) {
                return `<div class="input-group">
                <a href="#" target="_blank"><img height="50" src="{{asset('${full.photo}')}}" /></a>
                    </div>` 
                }
             },
             
            // {"data": "photo"},
            {"data": "description"},
            {"data": "delivery_type"},
            {"data": "qty"},
            {"data": "price"},
            {"data": "total"},    
            
            {"data": "",
                "render": function (data, type, full, meta) {
                    
                    total=Number(full.total)+Number(total);
                     $("#grand_total").html("$"+total)
                return '';
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
// }
});

// function payStatus(){
//     // var block = $("#paystatus option:selected").text();
//     postpaid();
// };

// function postpaid(){
//     let block = $("#paystatus option:selected").text()
//     $.ajax({
//         method: "POST",
//         url: "{{ url('api/orders/paystatus') }}",
//         data: {block,id},
//         "dataType": "json",
//         "headers": {"Authorization": 'Bearer ' + localStorage.getItem('token')},
//         success: function (data) 
//         {
//             if (data!= null) 
//             {
//                 $('#order_item').DataTable()
//                 .rows().invalidate('data')
//                 .draw(false);
//             }       
//         }
//     });
// }

const getDeliveryStatus = () => {
    let html="";
    $.ajax({
        method: "GET",
        url: "{{ url('api/orders/deliverystatus') }}",
        "dataType": "json",
        data: {'id':id},
        "headers": {"Authorization": 'Bearer ' + localStorage.getItem('token')},
        success: function (data) 
        {
            html=""; 
            $("#delstatus").append(html) 
            for(i=0;i<deliveryStatus.length;i++){
                 if(deliveryStatus[i] == data.data.delivery_status){
                     html+="<option value="+deliveryStatus[i] +" selected>"+deliveryStatus[i] +"</option>"
                 }else{
                     html+="<option value="+deliveryStatus[i] +">"+deliveryStatus[i] +"</option>"
                 }
            };
            $("#delstatus").append(html)     
        }
    });
}
const changeDeliveryStatus = () => {
    let value = $("#delstatus option:selected").text()
    $.ajax({
        method: "POST",
        url: "{{ url('api/orders/deliverystatus') }}",
        data: {value,id},
        "dataType": "json",
        "headers": {"Authorization": 'Bearer ' + localStorage.getItem('token')},
        success: function (data) 
        {
            Toaster(data.message,'success');
        }
    });
};


const getPaymentStatus = () => {
    let html="";
    $.ajax({
        method: "GET",
        url: "{{ url('api/orders/paymentstatus') }}",
        "dataType": "json",
        data: {'id':id},
        "headers": {"Authorization": 'Bearer ' + localStorage.getItem('token')},
        success: function (data) 
        {
            html=""; 
            $("#paymentstatus").append(html) 
            for(i=0;i<paymentStatus.length;i++){
                 if(paymentStatus[i] == data.data.payment_status){
                     html+="<option value="+paymentStatus[i] +" selected>"+paymentStatus[i] +"</option>"
                 }else{
                     html+="<option value="+paymentStatus[i] +">"+paymentStatus[i] +"</option>"
                 }
            };
            $("#paymentstatus").append(html)     
        }
    });
}
const changePaymentStatus = () => {
    let value = $("#paymentstatus option:selected").text()
    $.ajax({
        method: "POST",
        url: "{{ url('api/orders/paymentstatus') }}",
        data: {value,id},
        "dataType": "json",
        "headers": {"Authorization": 'Bearer ' + localStorage.getItem('token')},
        success: function (data) 
        {
            Toaster(data.message,'success');
        }
    });
};

// $('#order_item').DataTable().rows().iterator('row', function(context, index){
//     var total = $('#order_item').DataTable().row('.Total').data();
//     var nettotal = nettotal + total; 
//     //node.context is element of tr generated by jQuery DataTables.
// });
// $("#grand_total").val=22;
</script>
@endsection