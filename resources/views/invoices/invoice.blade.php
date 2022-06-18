
<!-- <html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BrotherCart | Ecommerce  </title>
    <meta http-equiv="Content-Type" content="text/html;"/>
    <meta charset="UTF-8">
		<style media="all">
		@font-face {
            font-family: 'Roboto';
            font-weight: normal;
            font-style: normal;
        }
        *{
            margin: 0;
            padding: 0;
            line-height: 1.3;
            font-family: 'Roboto';
            color: #333542;
        }
		/* body{
			font-size: .875rem;
		} */
		.gry-color *,
		.gry-color{
			color:#878f9c;
		}
		/* table{
			width: 100%;
		} */
		/* table th{
			font-weight: normal;
		} */
		/* table.padding th{
			padding: .5rem .7rem;
		} */
		/* table.padding td{
			padding: .7rem;
		} */
		/* table.sm-padding td{
			padding: .2rem .7rem;
		} */
		/* .border-bottom td,
		.border-bottom th{
			border-bottom:1px solid #eceff4;
		} */
		.text-left{
			text-align:left;
		}
		.text-right{
			text-align:right;
		}
		.small{
			font-size: .85rem;
		}
		.currency{

		}
	</style>
</head>
<body style="font-size: .875rem">
	<div>

		@php
			$generalsetting = \DB::table('general_settings')->first(); 
			$order=\DB::table('orders')->where(['id'=>$order_id])->first(); 
			$order_details=\DB::table('order_details')->join('products','products.id','=','order_details.product_id')->where(['order_id'=>$order_id])->get(); 
		@endphp

		<div style="background: #eceff4;padding: 1.5rem;">
			<table style="width: 100%;">
				<tr>
					<td style="padding: .7rem; border-bottom:1px solid #eceff4;">
						@if($generalsetting->logo != null)
							<img loading="lazy"  src="{{ asset('images/logo/'.$generalsetting->logo) }}" height="40" style="display:inline-block;">
						@else
							<img loading="lazy"  src="{{ asset('images/logo/logo.png') }}" height="40" style="display:inline-block;">
						@endif
					</td>
					<td style="font-size: 2.5rem; padding: .7rem; border-bottom:1px solid #eceff4;" class="text-right">INVOICE</td>
				</tr>
			</table>
			<table style="width: 100%;">
				<tr>
					<td style="font-size: 1.2rem; padding: .7rem; border-bottom:1px solid #eceff4;">{{ isset($generalsetting->sitename)?$generalsetting->sitename:"" }}</td>
					<td style="padding: .7rem; border-bottom:1px solid #eceff4;" class="text-right"></td>
				</tr>
				<tr>
					<td style="padding: .7rem; border-bottom:1px solid #eceff4;" class="gry-color small">{{ isset($generalsetting->address)?$generalsetting->address:"" }}</td>
					<td style="padding: .7rem; border-bottom:1px solid #eceff4;" class="text-right"></td>
				</tr>
				<tr>
					<td style="padding: .7rem; border-bottom:1px solid #eceff4;" class="gry-color small">Email: {{ isset($generalsetting->email)?$generalsetting->email:"" }}</td>
					<td style="padding: .7rem; border-bottom:1px solid #eceff4;" class="text-right small"><span class="gry-color small">Order ID:</span> <span>{{ isset($order->code)?$order->code:"" }}</span></td>
				</tr>
				<tr>
					<td style="padding: .7rem; border-bottom:1px solid #eceff4;" class="gry-color small">Phone: {{ isset($generalsetting->phone)?$generalsetting->phone:"" }}</td>
					<td style="padding: .7rem; border-bottom:1px solid #eceff4;" class="text-right small"><span class="gry-color small">Order Date:</span> <span>{{ isset($order->created_at)?date('d-m-Y', strtotime($order->created_at)):"" }}</span></td>
				</tr>
			</table>

		</div>

		<div style="padding: 1.5rem;padding-bottom: 0">
			<table style="width: 100%;">
				@php
					$shipping_address = isset($order->shipping_address)?json_decode($order->shipping_address):"";
				
				@endphp
				<tr><td style="padding: .7rem; border-bottom:1px solid #eceff4;" class="small gry-color">Bill to:</td></tr>
				<tr><td style="padding: .7rem; border-bottom:1px solid #eceff4;">{{ isset($shipping_address->name)?$shipping_address->name:"" }}</td></tr>
				<tr><td style="padding: .7rem; border-bottom:1px solid #eceff4;" class="gry-color small">{{ isset($shipping_address->address1)?$shipping_address->address1:"" }},{{  isset($shipping_address->address2)?$shipping_address->address2:"" }}, {{ isset($shipping_address->city)?$shipping_address->city:"" }}, {{ isset($shipping_address->country)?$shipping_address->country:"" }}</td></tr>
				<tr><td style="padding: .7rem; border-bottom:1px solid #eceff4;" class="gry-color small">Email: {{ isset($shipping_address->email)?$shipping_address->email:"" }}</td></tr>
				<tr><td style="padding: .7rem; border-bottom:1px solid #eceff4;" class="gry-color small">Phone: {{ isset($shipping_address->pincode)?$shipping_address->pincode: "" }}</td></tr>
			</table>
		</div>

	    <div style="padding: 1.5rem;">
			<table class="padding text-left small border-bottom" style="width: 100%;">
				<thead>
	                <tr class="gry-color" style="background: #eceff4;">
	                    <th width="35%" style="font-weight: normal; padding: .5rem .7rem;">Product Name</th>
						<th width="15%" style="font-weight: normal; padding: .5rem .7rem;">Delivery Type</th>
	                    <th width="10%" style="font-weight: normal; padding: .5rem .7rem;">Qty</th>
	                    <th width="15%" style="font-weight: normal; padding: .5rem .7rem;">Unit Price</th>
	                    <th width="10%" style="font-weight: normal; padding: .5rem .7rem;">Tax</th>
	                    <th width="15%" class="text-right" style="font-weight: normal; padding: .5rem .7rem;">Total</th>
	                </tr>
				</thead>
				<tbody>
				@foreach ($order_details as $key => $orderDetail)
				
				@if ($orderDetail->name != null)
					<tr class="">
						<td style="padding: .7rem;">{{ $orderDetail->name }}</td>
						<td style="padding: .7rem;">
							Home Delivery
						</td>
						<td style="padding: .7rem;" class="gry-color">{{ $orderDetail->quantity }}</td>
						<td style="padding: .7rem;" class="gry-color">{{$orderDetail->price/$orderDetail->quantity }}</td>
						<td  style="padding: .7rem;" class="gry-color">{{ $orderDetail->tax/$orderDetail->quantity }}</td>
						<td style="padding: .7rem;" class="text-right">{{ $orderDetail->price+$orderDetail->tax }}</td>
					</tr>
				@endif
			@endforeach
	            </tbody>
			</table>
		</div>

	    <div style="padding:0 1.5rem;">
	        <table style="width: 40%;margin-left:auto;" class="text-right sm-padding small">
		        <tbody>
				<tr>
			            <th class="gry-color text-left" style="font-weight: normal; padding: .5rem .7rem;">Sub Total</th>
			            <td style="padding: .7rem;">0.00</td>
			        </tr>
			        <tr>
			            <th class="gry-color text-left" style="font-weight: normal; padding: .5rem .7rem;">Shipping Cost</th>
			            <td style="padding: .7rem;">0.00</td>
			        </tr>
			        <tr class="border-bottom">
			            <th class="gry-color text-left" style="font-weight: normal; padding: .5rem .7rem;">Total Tax</th>
			            <td style="padding: .7rem;">0.00</td>
			        </tr>
			        <tr>
			            <th class="text-left" style="font-weight: normal; padding: .5rem .7rem;">Grand Total</th>
			            <td style="padding: .7rem;">{{ $order->grand_total }}</td>
			        </tr>
				
		        </tbody>
		    </table>
	    </div>

	</div>
</body>
</html> -->





















<!-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>BrotherCart | Ecommerce </title>
    <link rel="stylesheet" href="style.css" media="all" />
	<style>
  <?php
        $logo=isset($generalsetting->logo)?$generalsetting->logo:"logo.png";
        $date = strtotime(date('Y-m-d H:i:s'));
        $newDate = date("Y-m-d H:i:s", strtotime("+7 day", $date));
  ?>
	@font-face {
  font-family: SourceSansPro;
  src:"{{ asset('images/logo/'.$logo) }}";
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #0087C3;
  text-decoration: none;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 14px; 
  font-family: SourceSansPro;
}

header {
  padding: 10px 0;
  margin-bottom: 20px;
  border-bottom: 1px solid #AAAAAA;
}

#logo {
  float: left;
  margin-top: 8px;
}

#logo img {
  height: 70px;
}

#company {
  float: right;
  text-align: right;
}


#details {
  margin-bottom: 50px;
}

#client {
  padding-left: 6px;
  border-left: 6px solid #0087C3;
  float: left;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}

#invoice {
  float: right;
  text-align: right;
}

#invoice h1 {
  color: #0087C3;
  font-size: 2.4em;
  line-height: 1em;
  font-weight: normal;
  margin: 0  0 10px 0;
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table th,
table td {
  padding: 20px;
  background: #EEEEEE;
  text-align: center;
  border-bottom: 1px solid #FFFFFF;
}

table th {
  white-space: nowrap;        
  font-weight: normal;
}

table td {
  text-align: right;
}

table td h3{
  color: #57B223;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

table .no {
  color: #FFFFFF;
  font-size: 1.6em;
  background: #57B223;
}

table .desc {
  text-align: left;
}

table .unit {
  background: #DDDDDD;
}

table .qty {
}

table .total {
  background: #57B223;
  color: #FFFFFF;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table tbody tr:last-child td {
  border: none;
}

table tfoot td {
  padding: 10px 20px;
  background: #FFFFFF;
  border-bottom: none;
  font-size: 1.2em;
  white-space: nowrap; 
  border-top: 1px solid #AAAAAA; 
}

table tfoot tr:first-child td {
  border-top: none; 
}

table tfoot tr:last-child td {
  color: #57B223;
  font-size: 1.4em;
  border-top: 1px solid #57B223; 

}

table tfoot tr td:first-child {
  border: none;
}

#thanks{
  font-size: 2em;
  margin-bottom: 50px;
}

#notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3;  
}

#notices .notice {
  font-size: 1.2em;
}

footer {
  color: #777777;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #AAAAAA;
  padding: 8px 0;
  text-align: center;
}


	</style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="{{ asset('images/logo/'.$logo) }}">
      </div>
      <div id="company">
        <h2 class="name">BrotherCart | Ecommerce</h2>
        <div>113 Barnum street West babylon New York-11704</div>
        <div>+1(855) 241 1209</div>
        <div><a href="mailto:support@brothercart.us">support@brothercart.us</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name">Muzamil Ahmad</h2>
		  @php
		  	$shipping_address = isset($order->shipping_address)?json_decode($order->shipping_address):"";
		  @endphp
          <div class="address"> {{ isset($shipping_address->name)?$shipping_address->name:"" }} {{ isset($shipping_address->address1)?$shipping_address->address1:"" }},{{  isset($shipping_address->address2)?$shipping_address->address2:"" }}, {{ isset($shipping_address->city)?$shipping_address->city:"" }}, {{ isset($shipping_address->country)?$shipping_address->country:"" }}</div>
          <div class="email"><a href="mailto:john@example.com">{{ isset($generalsetting->email)?$generalsetting->email:"" }}</a></div>
        </div>
        <div id="invoice">
          <h1>INVOICE</h1>
          <div class="date">Date of Invoice:{{ date('Y-m-d H:i:s') }}</div>
          <div class="date">Max Delivery Date:{{ $newDate }}</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="product_name">PRODUCT NAME</th>
            <th class="delivery_type">DELIVERY TYPE</th>
            <th class="qty">QUANTITY</th>
            <th class="unit_price">UNIT PRICE</th>
			<th class="tax">TAX</th>
			<th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
     
			@foreach ($order_details as $key => $orderDetail)
			  @if ($orderDetail->name != null)
				<tr>
					<td>{{ $key+1 }}</td>
					<td class="product_name"><h3>{{ $orderDetail->name }}</h3></td>
					<td class="deliery_type">Home Delivery</td>
					<td class="qty">{{ $orderDetail->quantity }}</td>
          <td class="unit">{{ $orderDetail->price}}</td>
					<td class="tax">{{ $orderDetail->tax }}</td>
					<!-- <td class="unit">{{ $orderDetail->price/$orderDetail->quantity }}</td>
					<td class="tax">{{ $orderDetail->tax/$orderDetail->quantity }}</td> -->
          
					<td>{{ ($orderDetail->price * $orderDetail->quantity ) + ($orderDetail->tax * $orderDetail->quantity) }}</td>
				</tr>
			@endif
		@endforeach
    <tfoot>
    <tr>
            <th class="no">Grand Total</th>
            <th class="product_name"></th>
            <th class="delivery_type"></th>
            <th class="qty"></th>
            <th class="unit_price"></th>
			<th class="tax"></th>
			<th class="total"></th>
          </tr>
    </tfoot>
      </table>
      <div id="thanks">Thank you!</div>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">Your order will be deliverd to you on time.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html> -->