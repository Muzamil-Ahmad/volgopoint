<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>BrotherCart | Ecommerce </title>
    <link rel="stylesheet" href="style.css" media="all" />
	<style>
	@font-face {
  font-family: SourceSansPro;
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
    <div id="details" style="border-bottom:2px solid green" class="clearfix">
        <div id="client" style="float:right;margin-bottom:10px">
           <h2 class="name">BrotherCart | Ecommerce</h2>
           <div>113 Barnum street West babylon New York-11704</div>
           <div>+1(855) 241 1209</div>
          <div><a href="mailto:support@brothercart.us">support@brothercart.us</a></div>
        </div>
      </div>
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
        <!-- <div id="invoice">
          <h1>INVOICE 3-2-1</h1>
          <div class="date">Date of Invoice: 01/06/2014</div>
          <div class="date">Due Date: 30/06/2014</div>
        </div> -->
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
        <?php $sum=0; ?>
			@foreach ($order_details as $key => $orderDetail)
			  @if ($orderDetail->name != null)
				<tr>
					<td>01</td>
					<td class="product_name"><h3>{{ $orderDetail->name }}</h3></td>
					<td class="deliery_type">Home Delivery</td>
					<td class="qty">{{ $orderDetail->quantity }}</td>
					<td class="unit">{{$orderDetail->price }}</td>
					<td class="tax">{{ $orderDetail->tax }}</td>
					<td>{{ ($orderDetail->price * $orderDetail->quantity ) + ($orderDetail->tax * $orderDetail->quantity) }}</td>
				</tr>
        <?php $sum+=($orderDetail->price * $orderDetail->quantity ) + ($orderDetail->tax * $orderDetail->quantity) ?>
			@endif
		@endforeach
    </tbody>
    <tfoot>
      <tr>
            <th class="no">Grand Total</th>
            <th class="product_name"></th>
            <th class="delivery_type"></th>
            <th class="qty"></th>
            <th class="unit_price"></th>
            <th class="tax"></th>
            <th class="total">{{$sum}}</th>
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
</html>