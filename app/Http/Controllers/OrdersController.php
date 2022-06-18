<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade as PDF;
use App\Orders;
use DB;

class OrdersController extends Controller
{
    /**
     * Show the table with specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function index(Request $request){
    // dd($request->all());
    
    $columns = array(
        0 => 'id',
        1 => 'order_code',
        2 => 'num_of_products',
        3 => 'customer',
        4 => 'amount',
        5 => 'delivery_status',
        7 => 'payment_method',
        8 => 'payment_status'
    );
     $limit = $request->input('length');
     $start = $request->input('start');
     $data = array();
     $totalData=DB::table('orders')->count();
    
     $details=DB::table('order_details')->where(['order_details.is_deleted'=>0,'orders.is_deleted'=>0])
            ->leftjoin('orders','orders.id','=','order_details.order_id')
            ->when($start, function($query,$start){
                return $query->offset($start);
              })
            ->select(DB::raw("sum(order_details.price*order_details.quantity) as amount"),DB::raw("count(order_details.id) as productscount"),"orders.*","order_details.delivery_status","order_details.quantity")
            ->groupBy('orders.id')
            ->limit($limit)
            ->get();
       if($details) {
        foreach ($details as $key => $entity) {
            $shipping_address=json_decode($entity->shipping_address);
            $nestedData['id'] = $entity->id;
            $nestedData['order_code'] = $entity->code;
            $nestedData['num_of_products'] = $entity->productscount;
            $nestedData['customer'] = $shipping_address->name;
            $nestedData['amount'] = $entity->amount;
            $nestedData['delivery_status'] =$entity->delivery_status;
            $nestedData['payment_method'] = $entity->payment_type;
            $nestedData['payment_status'] = $entity->payment_status;
            $data[] = $nestedData;
        }
    }
    // $totalData=count($details);
    $totalFiltered = $totalData;
    $json_data = array(
        "draw"            => intval($request->input('draw')),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data"            => $data
    );
    return response()->json($json_data);
}
 /**
 * Show the form to add specified resource.
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */

public function view(Request $request){
    $columns = array(
        0 => 'id',
        1 => 'photo',
        2 => 'description',
        3 => 'delivery_type',
        4 => 'qty',
        5 => 'price',
        7 => 'total'
    );
     $limit = $request->input('length');
     $start = $request->input('start');
     $data = array();
     $totalData=DB::table('order_details')->where(['order_details.is_deleted'=>0,'order_details.order_id'=>$request->id])->count();
    $details=DB::table('order_details')->where(['order_details.is_deleted'=>0,'order_details.order_id'=>$request->id])
    ->leftjoin('products','products.id','=','order_details.product_id')
    ->when($start, function($query,$start){
        return $query->offset($start);
       })
    ->limit($limit)
    ->get();
       if($details) {
        foreach ($details as $key => $entity) {
            $nestedData['id'] = $entity->id;
            $nestedData['photo'] = $entity->thumbnail_img;
            $nestedData['description'] = $entity->product_cart_description;
            $nestedData['delivery_type'] = $entity->shipping_type;
            $nestedData['qty'] = $entity->quantity;
            $nestedData['price'] = $entity->price;
            $nestedData['total'] = ($entity->price * $entity->quantity);
            $data[] = $nestedData;
        }
    }
    // $totalData=count($details);
    $totalFiltered = $totalData;
    $json_data = array(
        "draw"            => intval($request->input('draw')),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data"            => $data
    );
    return response()->json($json_data);
}

public function delete($id){
    try{
        $result=DB::table('orders')->join('order_details','order_details.order_id','=','orders.id')->where(['orders.id'=>$id])->update(['orders.is_deleted'=>1,'order_details.is_deleted'=>1]);
        if($result){
            return response()->json(['result'=>'success','message'=>"Deleted Successfully!",'data'=>'']); 
        }else{
            return response()->json(['result'=>'fail','message'=>"Something went wrong!",'data'=>'']); 
        }
    }catch(Exception $ex){
        return response()->json(['result'=>'error','message'=>"Contact your system admintrator!",'data'=>'']); 
    }
}
public function changePaymentStatus(Request $request){
    $payment_status= $request->value;
    $res_details = DB::update("UPDATE `order_details` SET `payment_status` = '$payment_status' WHERE `order_details`.`order_id` = $request->id");
    $result = DB::update("UPDATE `orders` SET `payment_status` = '$payment_status' WHERE `orders`.`id` = $request->id");
        return response()->json([
            'message'   => "Status Changed Successfully",
            'result'  => 'success',
        ]);
   }
   public function getPaymentStatus(Request $request){
    // $payment_status= $request->value;
    $result=DB::table('orders')
            ->select('orders.payment_status')
            ->where(['orders.id'=>$request->id])
            ->first();
            return response()->json([
                'message'   => "successfully retrieved",
                'result'  => 'success',
                'data' =>$result
            ]);
   }
   public function getDeliveryStatus(Request $request){
        $result=DB::table('orders')
                ->leftjoin('order_details','orders.id','=','order_details.order_id')
                ->select('order_details.delivery_status')
                ->where(['order_details.order_id'=>$request->id])
                ->first();
        return response()->json([
            'message'   => "successfully retrieved",
            'result'  => 'success',
            'data' =>$result
        ]);
   }
   public function changeDeliveryStatus(Request $request){
        $delivery_status= $request->value;
        $res = DB::update("UPDATE `order_details` SET `delivery_status` = '$delivery_status' WHERE `order_details`.`order_id` = $request->id");
        return response()->json([ 
            'message'   => "Status Changed Successfully",
            'result'  => 'success'
        ]);
   }
 
    public function downloadOrderInvoice($OrderID){ 
        $generalsetting = \DB::table('general_settings')->first(); 
        $order=\DB::table('orders')->where(['id'=>$OrderID])->first(); 
        $order_details=\DB::table('order_details')->join('products','products.id','=','order_details.product_id')->where(['order_id'=>$OrderID])->get(); 
        $pdf = PDF::loadView('invoices.customer_invoice',['generalsetting'=>$generalsetting,'order'=>$order,'order_details'=>$order_details])->setPaper('a4', 'landscape');
        return $pdf->download('BrotherCart_Invoice.pdf');
    }
}
