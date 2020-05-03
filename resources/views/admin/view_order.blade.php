@extends('admin_layout')
@section('admin_content')
<style>
.table-agile-info{
	background: transparent;
	padding: 15px;
}
</style>
<div class="row">
	<?php
		$message = Session::get('message');
		if($message){
			echo '<span class="txt-alert" style="margin-top: 10px; letter-spacing: 1px; color:#27c24c;">',$message.'</span>';
			Session::put('message',null);
		}
	?>
	<div class="col-sm-6 table-agile-info">
		<div class="panel panel-default">
			<div class="panel-heading">CUSTOMER INFORMATION</div>
			<div class="table-responsive">
				<table class="table table-striped b-t b-light">
					<tbody>
						<tr class="c_i">
							<th style="width: 15%">Customer name</th>
							<td><span class="text-ellipsis">{{ $customer_by_id->customer_name }}</span></td>
						</tr>
						<tr class="c_i">
							<th style="width: 30%">Customer address</th>
							<td>{{ $customer_by_id->shipping_address }}</td>
						</tr>
						<tr class="c_i">
							<th style="width: 15%">Customer phone</th>
							<td>{{ $customer_by_id->shipping_phone }}</td>
						</tr>
						<tr class="c_i">
							<th style="width: 15%">Customer mail</th>
							<td>{{ $customer_by_id->customer_email }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="col-sm-6 table-agile-info">
		<div class="panel panel-default">
			<div class="panel-heading">ORDER INFORMATION</div>
			<div class="table-responsive">
				<table class="table table-striped b-t b-light">
					<tbody valign="top">
						<tr>
							<th style="width: 15%">Order ID</th>
							<td style="width: 25%">{{ $customer_by_id->order_id }}</td>
						</tr>
						<tr>
							<th style="width: 15%">Payment method</th>
							<td style="width: 25%">{{ $customer_by_id->payment_method }}</td>
						</tr>
						<tr>
							<th style="width: 15%">Status</th>
							<td style="width: 25%">{{ $customer_by_id->order_status }}</td>
						</tr>
						<tr>
							<th style="width: 15%">Order note</th>
							<td style="width: 25%">{{ $customer_by_id->shipping_note }}</td>
						</tr>
						<tr>
							<th style="width: 15%">Zip code</th>
							<?php
								$money = 0;
								foreach($order_by_id as $key => $p_content){
									$money += ($p_content->product_sale_qty * $p_content->product_price);
								}
							?>
							<td style="width: 25%"><?php
							if($customer_by_id->order_total < $customer_by_id->order_tax + $money){
								echo('Yes');
							}else{
								echo('No');
							}
							?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="col-sm-12 table-agile-info">
		<div class="panel panel-default">
			<div class="panel-heading">VIEW ORDER DETAIL</div>
			<div class="table-responsive">
				<table class="table table-striped b-t b-light">
					<thead>
						<tr>
							<th style="width: 25%">Product ID</th>
							<th style="width: 25%">Product name</th>
							<th style="width: 25%">Quantity</th>
							<th style="width: 25%">Product price</th>
							<th style="width: 25%">Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($order_by_id as $key => $p_content)
						<tr>
							<td>{{ $p_content->product_id }}</td>
							<td><span class="text-ellipsis">{{ $p_content->product_name }}</span></td>
							<td>{{ $p_content->product_sale_qty }}</td>
							<td>{{ $p_content->product_price }}$</td>
							<td> <?php echo($p_content->product_sale_qty * $p_content->product_price); ?>$ </td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-sm-8 text-left">
						<h4 style="margin-bottom: 20px;">Sub total: <b>
						<?php
							$money = 0;
							foreach($order_by_id as $key => $p_content){
								$money += ($p_content->product_sale_qty * $p_content->product_price);
							}
							echo($money);
						?>$
						</b></h4>
						<h4 style="margin-bottom: 20px;">Tax: <b>{{ $customer_by_id->order_tax }}$</b></h4>
						<h4 style="margin-bottom: 20px;">Discount: <b>
						<?php
							$discount = ($money + $customer_by_id->order_tax - $customer_by_id->order_total);
							echo($discount);
						?>$
						</b></h4>
						<h4 style="margin-bottom: 20px;">Total: <b>{{ $customer_by_id->order_total }}$</b></h4>
						<a href="{{URL::to('/print-order/'.$p_content->order_id )}}" target='blank' class="btn btn-sm btn-danger">Print order</a>
						<a href="{{URL::to('/ship-order/'.$p_content->order_id )}}" class="btn btn-sm btn-primary">Ship now</a>
					</div>
				</div>
			</footer>
		</div>
	</div>
</div>
@endsection
.$order_tax+($p_content->product_sale_qty * $p_content->product_price)-$order_total.
$order_data['order_tax'] = Cart::tax();