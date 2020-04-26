@extends('layout')
@section('content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="{{URL::to('/homepage')}}">Home</a></li>
			  <li class="active">Check out</li>
			</ol>
		</div><!--/breadcrums-->

		<div class="register-req">
			<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
		</div><!--/register-req-->

		<div class="shopper-informations">
			<div class="row">
				<div class="col-sm-12 clearfix">
					<div class="bill-to">
						<p>Shipping Order</p>
						<div class="form-one" style="width: 100%">
							<form action="{{URL::to('/save-checkout')}}" method="POST">
								{{ csrf_field() }}
								@foreach($customer as $key => $ct )
								<input type="text" name="shipping_email" placeholder="Email *" style="width: 60%" value="{{  $ct->customer_email }}">
								<input type="text" name="shipping_name" placeholder="Name *" style="width: 60%" value="{{  $ct->customer_name }}">
								<input type="text" name="shipping_phone" placeholder="Phone *" style="width: 60%" value="{{  $ct->customer_phone }}">
								<input type="text" name="shipping_address" placeholder="Address *" style="width: 60%" value="{{  $ct->customer_address }}">
								<textarea style="height: 190px;" name="shipping_note"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
								<button type="submit" class="btn btn-primary">Send order</button>
								@endforeach
							</form>
						</div>
					</div>
				</div>		
			</div>
		</div>
	</div>
</section> <!--/#cart_items-->
@endsection