@extends('layout')
@section('content')
<div class="container">
	<div class="breadcrumbs">
		<ol class="breadcrumb">
		<li><a href="{{URL::to('/homepage')}}">Home</a></li>
		@foreach($product_detail as $key => $pro)
		<li class="active">{{ $pro->product_name }}</li>
		@endforeach
		</ol>
	</div><!--/breadcrums-->
    <div class="row">
		<div class="col-12">
			@foreach($product_detail as $key => $pro)
			<!--product-details-->
			<div class="product-details">
				<div class="col-sm-5">
					<div class="view-product">
						<img src="{{URL::to('public/upload/product/'.$pro->product_image)}}" alt="" />			
						<h3>ZOOM</h3>
					</div>
				</div>
				<div class="col-sm-7">
					<div class="product-information"><!--/product-information-->
						<img src="images/product-details/new.jpg" class="newarrival" alt="" />
						<h2> {{ $pro->product_name }} </h2>
						<p>ID: {{ $pro->product_id }} </p>
						<form action="{{URL::to('save-cart')}}" method="POST">
							{{ csrf_field() }}
							<span>
								<span>USD $.{{ $pro->product_price }}</span>
								<br>
								<label>Quantity:</label>
								<input type="number" value="1" min="1" name="qty" />
								<input type="hidden" value="{{ $pro->product_id }}" name="productid_hidden" />
								<br>
								<button type="submit" class="btn btn-fefault cart" style="margin-left: 0; margin-top: 15px; color: white">
									<i class="fa fa-shopping-cart"></i> Add to cart
								</button>
							</span>
						</form>
						<p><b>Availability:</b>
						<?php $qty =  $pro->product_qty;
						if($qty > 0){ ?>
							In Stock 
						<?php }else{ ?>
							Our Stock
						<?php } ?>
						</p>
						<p><b>Condition:</b> New</p>
						<p><b>Brand:</b> {{ $pro->brand_name }}</p>
						<p><b>Category:</b> {{ $pro->category_name }}</p>
						<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
					</div><!--/product-information-->
				</div>
			</div>
			<!--/product-details-->
			@endforeach

			<div class="category-tab shop-details-tab"><!--category-tab-->
				<div class="col-sm-12">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#reviews" data-toggle="tab">Reviews</a></li>
						<li><a href="#details" data-toggle="tab">Details</a></li>
						<li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
					</ul>
				</div>
				<div class="tab-content">
					<div class="tab-pane fade" id="details" style="padding: 15px 30px;">
						<p>
							<?php echo $pro->product_desc ?>
						</p>
					</div>				

					<div class="tab-pane fade" id="companyprofile" style="padding: 15px 30px;">
						<p>
							<?php echo $pro->product_content ?>
						</p>
					</div>

					<div class="tab-pane fade active in" id="reviews" >
						<div class="col-sm-12">
							<form role="form" action="{{URL::to('/save-comment')}}" method="post">
								{{ csrf_field() }}
								<p><b>Write Your Review</b></p>
								<textarea name="comment"></textarea>
								<?php $customer_id = Session::get('customer_id'); ?>
								<input type="hidden" name="customer_id" value="{{ $customer_id }}">
								<input type="hidden" name="product_id" value="{{ $pro->product_id }}">
								<div class="rate" style="display: flex;">
									<b style="margin-right: 15px;">Rating: </b>
									<fieldset class="field required review-field-ratings" style="border: none;">
								        <div class="control">
								            <div class="nested" id="product-review-table">
								                <div class="field choice review-field-rating">
								                    <div class="control review-control-vote">
								                        <input type="radio" name="ratings[2]" id="Value_1" value="6" class="radio" data-validate="{'rating-required':true}" aria-labelledby="Value_rating_label Value_1_label" aria-required="true">
								                        <label class="rating-1" for="Value_1" title="1 star" id="Value_1_label">
								                            <span>1 star</span>
								                        </label>
								                        <input type="radio" name="ratings[2]" id="Value_2" value="7" class="radio" data-validate="{'rating-required':true}" aria-labelledby="Value_rating_label Value_2_label" aria-required="true">
								                        <label class="rating-2" for="Value_2" title="2 stars" id="Value_2_label">
								                            <span>2 stars</span>
								                        </label>
								                        <input type="radio" name="ratings[2]" id="Value_3" value="8" class="radio" data-validate="{'rating-required':true}" aria-labelledby="Value_rating_label Value_3_label" aria-required="true">
								                        <label class="rating-3" for="Value_3" title="3 stars" id="Value_3_label">
								                            <span>3 stars</span>
								                        </label>
								                        <input type="radio" name="ratings[2]" id="Value_4" value="9" class="radio" data-validate="{'rating-required':true}" aria-labelledby="Value_rating_label Value_4_label" aria-required="true">
								                        <label class="rating-4" for="Value_4" title="4 stars" id="Value_4_label">
								                            <span>4 stars</span>
								                        </label>
								                        <input type="radio" name="ratings[2]" id="Value_5" value="10" class="radio" data-validate="{'rating-required':true}" aria-labelledby="Value_rating_label Value_5_label" aria-required="true">
								                        <label class="rating-5" for="Value_5" title="5 stars" id="Value_5_label">
								                            <span>5 stars</span>
								                        </label>
								                    </div>
								                </div>
								                <input type="hidden" name="validate_rating" class="validate-rating" value="" aria-required="true">
								            </div>
								        </div>
								    </fieldset>
								</div>
								<button type="submit" class="btn btn-default" style="margin: 10px 0 20px;">Send comment</button>
							</form>
							<div class="cover-comment">
								<p><b>Related comments</b></p>
								@foreach($comment as $key => $cmt)
								<div class="user" style="margin-bottom: 20px; padding: 10px; background-color: #F0F0E9; border-radius: 10px;">
									<ul style="background-color: #F0F0E9; margin-bottom: 5px; padding-bottom: 5px; border-bottom: 1px solid #e3e2e2 ">
										<li><a href=""><b><i class="fa fa-user"></i> {{ $cmt->customer_name }} </b></a></li>
										<?php $datetime = $cmt->created_at; ?>
										<li><a href=""><i class="fa fa-calendar-o"></i> 
											<?php echo date("F j, Y"); ?> 
										</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>
											<?php echo date(" g:i");; ?> 
										</a></li>
									</ul>
									<p> {{ $cmt->comment_content }} </p>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/category-tab-->

			<div class="recommended_items"><!--recommended_items-->
				<h2 class="title text-center">recommended items</h2>
				<div id="recommended-item-carousel" class="slide">
					@foreach($related_product as $key => $re)
						<div class="col-sm-3">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<form action="{{URL::to('/save-cart')}}" method="POST">
											{{ csrf_field() }}
											<a href="{{URL::to('/product-detail/'.$re->product_id)}}"><img src="{{URL::to('public/upload/product/'.$re->product_image)}}" alt="" style="height: 250px;" /></a>
											<h2>$.{{ $re->product_price }}</h2>
											<a href="{{URL::to('/product-detail/'.$re->product_id)}}"><p>{{ $re->product_name }}</p></a>
											<input type="hidden" value="1" min="1" name="qty" />
											<input type="hidden" value="{{ $re->product_id }}" name="productid_hidden" />
											<button type="submit" class="btn btn-fefault add-to-cart" style="margin-left: 0; margin-top: 15px;">
												<i class="fa fa-shopping-cart"></i> Add to cart
											</button>
										</form>
									</div>
								</div>								
	                            <div class="choose">
	                                <ul class="nav nav-pills nav-justified">
	                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
	                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
	                                </ul>
	                            </div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
			<!--/recommended_items-->
		</div>
	</div>
</div>
@endsection