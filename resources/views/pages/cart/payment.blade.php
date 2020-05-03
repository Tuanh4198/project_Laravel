@extends('layout')
@section('content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="{{URL::to('/homepage')}}">Home</a></li>
			  <li class="active">Patment</li>
			</ol>
		</div><!--/breadcrums-->

		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Image</td>
						<td class="description">Name</td>
						<td class="price">Price</td>
						<td class="quantity">Quantity</td>
						<td class="total">Total</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php
						$content = Cart::content();
					?>
					@foreach($content as $key)
					<tr class="row-product">
						<td class="cart_product" style="margin: 5px;">
							<img src="{{URL::to('public/upload/product/'.$key->options->image)}}" alt="" width="100">
						</td>
						<td class="cart_description">
							<h4><a href="">{{ $key->name }}</a></h4>
							<p>Product ID: {{ $key->id }}</p>
						</td>
						<td class="cart_price">
							<p>$.{{ $key->price }}</p>
						</td>
						<td class="cart_quantity">
							<form action="{{URL::to('/qty-cart')}}" method="POST">
								{{ csrf_field() }}
							<div class="cart_quantity_button" style="display: flex; align-items: center; border-radius: 5px; overflow: hidden;">
								<input class="cart_quantity_input" type="number" name="quantity" value="{{ $key->qty }}" autocomplete="off" size="2" style="width: 50px; border: 1px solid #F0F0E9;">
								<input type="hidden" value="{{ $key->rowId }}" name="rowId_cart">
								<button class="cart_delete" style="border: none; background-color: white; padding: 0;" type="submit"><a class="cart_quantity_delete" style="line-height: 18px;"><i class="fa fa-shopping-cart"></i></a></button>
							</div>
							</form>
						</td>
						<td class="cart_total">
							<p class="cart_total_price">$.
								<?php
									$subtotal = $key->price * $key->qty;
									echo $subtotal;
								?>
							</p>
						</td>
						<td class="cart_delete">
							<a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$key->rowId)}}"><i class="fa fa-times"></i></a>
						</td>
					</tr>
					@endforeach
					<tr valign="top" >
						<td colspan="2" style="padding-top: 20px;">
							<p><b><h4>Cart infor</h4></b></p>
							<table class="table table-condensed total-result" style="margin-top: 0;">
								<tr>
									<td>Cart Sub Total</td>
									<td>${{ Cart::subtotal() }}</td>
								</tr>
								<tr>
									<td>Exo Tax</td>
									<td>${{ Cart::tax() }}</td>
								</tr>
								<tr class="shipping-cost">
									<td>Shipping Cost</td>
									<td>Free</td>										
								</tr>
								<tr>
									<td>Total</td>
									@if(Session::get('coupon'))
										<?php if(Session::get('coupon_func') == '0'){ 
											$total =  Cart::total() - (Cart::total()/100*Session::get('coupon_num'));
											$discount = Cart::total()/100*Session::get('coupon_num')
										?>
										<?php }else{ 
											$total =  Cart::total() - Session::get('coupon_num');
											$discount = Session::get('coupon_num')
										?>
										<?php } ?>
									@else
										<?php 
											$total = Cart::total();
										?>
									@endif
									<td><span>${{ $total }}</span></td>
								</tr>
							</table>
						</td>
						<td colspan="2" style="padding-top: 20px;">
							<div class="heading">	<p><b><h4>Select your method payment</h4></b></p>	</div>
							<form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="{{URL::to('/check-coupon')}}">
								{{ csrf_field() }}
								<div class="form-group">
									<input type="text" name="discount_code" class="form-control" required="required" placeholder="Enter your code...">
								</div>         
								<div class="form-group">
									<input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
								</div>
							</form>
							@if(Session::get('coupon'))
								<?php if(Session::get('coupon_func') == '0'){ ?>
									<p>Discount: <b><?php	echo(Session::get('coupon_num'));	?> %</b><p>
								<?php }else{ ?>
									<p>Discount: <b><?php	echo(Session::get('coupon_num'));	?> USD</b><p>
								<?php } ?>
							@endif
						</td>
						<td colspan="2" style="padding-top: 20px;"> </td>
					</tr>
				</tbody>
			</table>
			<form action="{{URL::to('/order-place')}}" method="POST">
				{{ csrf_field() }}
				@if(Session::get('coupon'))
					<?php 
						$code = Session::get('coupon_code');
					?>
					<?php if(Session::get('coupon_func') == '0'){ 
						$total =  Cart::total() - (Cart::total()/100*Session::get('coupon_num'));
						$discount = Cart::total()/100*Session::get('coupon_num');
					?>
						<input type="hidden" value="<?php echo($discount); ?>" name="discount">
						<input type="hidden" value="<?php echo($code); ?>" name="coupon_code">
					<?php }else{
						$total =  Cart::total() - Session::get('coupon_num');
						$discount = Session::get('coupon_num');
					?>
						<input type="hidden" value="<?php echo($discount); ?>" name="discount">
						<input type="hidden" value="<?php echo($code); ?>" name="coupon_code">
					<?php } ?>
				@endif
				<div class="payment-options">
					<p><b><h4>Select your method payment</h4></b></p>
					<div class="payment-table">
						<span>
							<label><input name="payment_option" value="ATM" type="radio"> Direct bank transfer</label>
						</span>
						<span>
							<label><input name="payment_option" value="money" type="radio" id="checked"> Payment on delivery</label>
						</span>
						<span>
							<label><input name="payment_option" value="credit" type="radio"> Payment by credit cart </label>
						</span>
					</div>
					<?php
						$message = Session::get('message');
						if($message){
							echo '<span class="txt-alert" style="color:red;">',$message.'</span> <br>';
							Session::put('message',null);
						}
					?>
					<button type="submit" class="btn btn-default" style="margin-top: 20px;">Send Order</button>
				</div>
			</form>
		</div>
	</div>
</section> <!--/#cart_items-->
@endsection