@extends('layout')
@section('content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="{{URL::to('/homepage')}}">Home</a></li>
			  <li class="active">Thanks for use service</li>
			</ol>
		</div><!--/breadcrums-->
		<div class="heading">
			<h3>We will send goods to you quickly, thanks you for use service in store!!!</h3>
			<h3>Click <a href="{{URL::to('/homepage')}}" style="color: #d9534f; text-transform: uppercase;">here</a> to continue shopping </h3>
		</div>
	</div>
</section> <!--/#cart_items-->
@endsection