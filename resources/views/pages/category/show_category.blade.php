@extends('layout')
@section('content')	
<div class="container have-sidebar" >
	<div class="breadcrumbs">
		<ol class="breadcrumb">
		  <li><a href="{{URL::to('/homepage')}}">Home</a></li>
		  <li class="active">Category</li>
		</ol>
	</div><!--/breadcrums-->
    <div class="row">
		<div class="col-sm-3">
			<div class="left-sidebar">
				<!--category-productsr-->
				<div class="category-products">
					<h2>Category Product</h2>
					<div class="panel-group category-products" id="accordian" style="margin-bottom: 0;">
						@foreach($category as $key => $cate )
						<div class="panel panel-default drop-down1">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a href="{{URL::to('/show-category-product/'.$cate->category_id)}}">{{ $cate->category_name }}</a>
								</h4>
							</div>
						</div>
						@endforeach
						<a href="" class="btn-dd1" style="font-size: 16px; color: black; font-weight: bold; display: block; margin: 20px;">View more<i class="fa fa-chevron-circle-right" aria-hidden="true" style="margin-left: 10px;"></i></a>
					</div>
				</div>
				<!--/category-products-->
				<!--brands_products-->
				<div class="brands_products">
					<h2>Brands Product</h2>
					<div class="brands-name drop-down"> 
						<ul class="nav nav-pills nav-stacked">
							@foreach($brand as $key => $bra )
							<li class="drop-down2">
								<a href="{{URL::to('/show-brands-products/'.$bra->brand_id)}}"> 
									{{ $bra->brand_name }}
								</a>
							</li>
							@endforeach
							<a href="" class="btn-dd2" style="font-size: 16px; color: black; font-weight: bold; display: block; margin: 20px 25px;">View more<i class="fa fa-chevron-circle-right" aria-hidden="true" style="margin-left: 10px;"></i></a>
						</ul>
					</div>
				</div>
				<!--/brands_products-->

				<div class="price-range"><!--price-range-->
					<h2>Price Range</h2>
					<div class="well text-center">
						<input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
						<b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
					</div>
				</div><!--/price-range-->

				<div class="shipping text-center"><!--shipping-->
					<a href="#"><img src="{{asset('public/frontend/images/home/banner.PNG')}}" alt="" style="width: 100%;" /></a>
				</div><!--/shipping-->
			</div>
		</div>
		<div class="col-sm-9 padding-right" style="padding-top: 15px;">
			<!--features_items-->
			<div class="features_items">
				@foreach($category_name as $key => $cn )
					<h2 class="title text-center">{{ $cn->category_name }}</h2>
					<div class="introdute" style="margin-bottom: 30px; border-bottom: 1px solid #f5f5f5;">
						<p style="margin: 0px 15px 15px; font-style: italic; font-size: 15px;">
							<?php echo $cn->category_desc ?>
						</p>
					</div>
				@endforeach
				@foreach($list_product_category_id as $key => $pro )
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<form action="{{URL::to('save-cart')}}" method="POST">
										{{ csrf_field() }}
										<a href="{{URL::to('/product-detail/'.$pro->product_id)}}"><img src="{{URL::to('public/upload/product/'.$pro->product_image)}}" alt="" /></a>
										<h2>$.{{ $pro->product_price }}</h2>
							            <a href="{{URL::to('/product-detail/'.$pro->product_id)}}"><p>{{ $pro->product_name }}</p></a>
										<input type="hidden" value="1" min="1" name="qty" />
										<input type="hidden" value="{{ $pro->product_id }}" name="productid_hidden" />
										<button type="submit" class="btn btn-fefault add-to-cart" style="margin-left: 0; margin-top: 15px;">
											<i class="fa fa-shopping-cart"></i> Add to cart
										</button>
									</form>
								</div>
							</div>
							<div class="choose">
								<ul class="nav nav-pills nav-justified">
									<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
									<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
								</ul>
							</div>
						</div>
					</div>
				@endforeach

				<ul class="pagination" style="width: 100%;">
					<li class="active"><a href="">1</a></li>
					<li><a href="">2</a></li>
					<li><a href="">3</a></li>
					<li><a href="">&raquo;</a></li>
				</ul>
			</div>
			<!--features_items-->
		</div>
	</div>
</div>
@endsection