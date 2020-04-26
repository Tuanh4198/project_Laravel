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
						<td class="image">Item</td>
						<td class="description"></td>
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
					<tr>
						<td class="cart_product">
							<a href=""><img src="{{URL::to('public/upload/product/'.$key->options->image)}}" alt="" width="100"></a>
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

					<tr>
						<td colspan="4">&nbsp;</td>
						<td colspan="2">
							<table class="table table-condensed total-result">
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
									<td><span>${{ Cart::total() }}</span></td>
								</tr>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<form action="{{URL::to('/order-place')}}" method="POST">
		{{ csrf_field() }}
		<div class="payment-options">
			<p><b><h4>Select your method payment</h4></b></p>
			<span>
				<label><input name="payment_option" value="ATM" type="radio"> Direct bank transfer</label>
			</span>
			<span>
				<label><input name="payment_option" value="money" type="radio" id="checked"> Payment on delivery</label>
			</span>
			<span>
				<label><input name="payment_option" value="credit" type="radio"> Payment by credit cart </label>
			</span><br>
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
</section> <!--/#cart_items-->
@endsection