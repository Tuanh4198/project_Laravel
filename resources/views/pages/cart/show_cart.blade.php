@extends('layout')
@section('content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs" style="margin-top: 30px; margin-bottom: 30px;">
			<ol class="breadcrumb" style="margin-bottom: 0;">
			  <li><a href="#">Home</a></li>
			  <li class="active">Shopping Cart</li>
			</ol>
		</div>
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
							<a href=""><img src="{{URL::to('public/upload/product/'.$key->options->image)}}" alt="" width="100" height="100"></a>
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
								<input type="hidden" value="{{ $key->id }}" name="rowId_product">
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
				</tbody>
			</table>
		</div>
	</div>
</section> <!--/#cart_items-->
<section id="do_action">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="heading">
					<h3>Payment orders</h3>
				</div>
				<div class="total_area">
					<ul>
						<li>Cart Sub Total: <span style="color: black; font-weight: bold;">$.{{ Cart::subtotal() }}</span></li>
						<li>Eco Tax: <span style="color: black; font-weight: bold;">$.{{ Cart::tax() }}</span></li>
						<li>Shipping Cost: <span style="color: black; font-weight: bold;">Free</span></li>
						<li>Total: <span style="color: black; font-weight: bold;">$.{{ Cart::total() }}</span></li>
					</ul>
					<a class="btn btn-default update" href="{{URL::to('/homepage')}}">Continue shopping </a> 
					<?php
					$customer_id = Session::get('customer_id');
					$cartsub = Cart::subtotal();
                    if($customer_id == NULL){
                    ?>
                        <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Check Out</a>
                    <?php
                    }elseif($cartsub != 0){
                    ?>
                        <a class="btn btn-default check_out" href="{{URL::to('/checkout/'.$customer_id)}}">Check Out</a>
                    <?php
                    }else{
                    ?>
						<a class="btn btn-default update" href="{{URL::to('/homepage')}}">Check Out</a> 
					<?php
                    }
                    ?>
				</div>
			</div>
			<div class="col-sm-6">
			<img src="{{asset('public/frontend/images/cart/banner.jpg')}}" alt="" style="display: block; margin: auto; width: 100%;">
			</div>
		</div>
	</div>
</section><!--/#do_action-->
@endsection