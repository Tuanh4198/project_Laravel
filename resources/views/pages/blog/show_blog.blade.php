@extends('layout')
@section('content')
<div class="container have-sidebar" >
    <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="{{URL::to('/homepage')}}">Home</a></li>
          <li class="active">Blog</li>
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
					<div class="brands-name"> 
						<ul class="nav nav-pills nav-stacked">
							@foreach($brand as $key => $bra )
							<li class="drop-down2">
								<a href="{{URL::to('/show-brands-products/'.$bra->brand_id)}}"> <span class="pull-right">(50)</span>{{ $bra->brand_name }}</a>
							</li>
							@endforeach
							<a href="" class="btn-dd2" style="font-size: 16px; color: black; font-weight: bold; display: block; margin: 20px 25px;">View more<i class="fa fa-chevron-circle-right" aria-hidden="true" style="margin-left: 10px;"></i></a>
						</ul>
					</div>
				</div>
				<!--/brands_products-->
			</div>
		</div>
        <!--features_items-->
        <div class="col-sm-9 padding-right" style="padding-top: 15px;">
            <div class="blog-post-area">
                <h2 class="title text-center">Latest From our Blog</h2>
                @foreach($blog as $key => $bl )
                <div class="single-blog-post">
                    <div class="blog-img">
                        <a href="">
                            <img src="{{URL::to('public/upload/blog/'.$bl->blog_image)}}" alt="">
                        </a>
                    </div>
                    <div class="blog-content">
                        <h3 style="font-weight: bolder; text-align: center;"> {{ $bl->blog_name }} </h3>
                        <div class="post-meta"> Date: {{ $bl->created_at }} </div>
                        <div style="max-height: 140px; text-overflow: ellipsis; overflow: hidden; line-height: 20px;"> 
                            {{ $bl->blog_content }}
                        </div>
                        <a  class="btn btn-primary" href="{{URL::to('/blog-content/'.$bl->blog_id)}}" >Read More</a>
                    </div>
                </div>
                @endforeach
                <div class="pagination-area">
                    {{ $blog->links() }}
                </div>
            </div>
        </div>
        <!--features_items-->
    </div>
</div>
<div class="home-page" style="padding: 0; display: flex; flex-direction: column; width: 100%;">   
    <!--brand product-->
    <div class="container">
        <div class="recommended_items">
            <h2 class="title text-center">brands</h2>        
            <div id="recommended-item-carousel" class="carousel slide ">
                <div class="carousel-inner">
                    <div class="item active autoplay" 
                    data-dots='false'
                    data-infinite="true"
                    data-speed="300"
                    data-autoplay="true"
                    data-slides-To-Show="5"
                    data-slides-To-Scroll="1"
                    data-space="15"
                    data-responsive= '[{"breakpoint": 1024, "settings": {"slidesToShow": 4}}, {"breakpoint": 992, "settings": {"slidesToShow": 4}}, {"breakpoint": 768, "settings": {"slidesToShow": 3}}, {"breakpoint": 481, "settings": {"slidesToShow": 2}}, {"breakpoint": 361, "settings": {"slidesToShow": 1}}]'
                    data-next-Arrow='.recommended_items .right'
                    data-prev-Arrow='.recommended_items .left'>
                        @foreach($brand as $key => $bra )
                            <div class="item-brand wow zoomIn" style="padding: 0px 15px;">
                                <a href="{{URL::to('/show-brands-products/'.$bra->brand_id)}}">
                                    <img src="public/upload/brand/{{ $bra->brand_img }}" width="200" height="100">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <!--/brand product-->
</div>
@endsection