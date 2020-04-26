@extends('layout')
@section('content')
<!--/slider-->
<div class="home-page" style="padding: 0; display: flex; flex-direction: column; width: 100%; margin-top: 40px;">   
    <!--features_items-->
    <div class="container">
        <div class="breadcrumbs">
			<ol class="breadcrumb">
			<li><a href="{{URL::to('/homepage')}}">Home</a></li>
			<li class="active">Results for:  {{$keywords}}</li>
			</ol>
		</div><!--/breadcrums-->
        <div class="row">
            <div class="features_items">
                <h2 class="title text-center">Search results</h2>
                @foreach($search_product as $key => $pro )
                    <div class="col-sm-4 wow zoomIn">
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
                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--features_items-->

    <!--category-tab-->
    <div class="container">
        <div class="row">
            <div class="category-tab">
                <h2 class="title text-center">hot category</h2>
                <div class="col-sm-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tshirt" data-toggle="tab">Eye & Lip Care</a></li>
                        <li><a href="#blazers" data-toggle="tab">Power Infusing Concentrate</a></li>
                        <li><a href="#sunglass" data-toggle="tab">Face Wash & Shaving Cream</a></li>
                        <li><a href="#kids" data-toggle="tab">Cleanser & Makeup Remover</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tshirt" >
                        @foreach($tab1 as $key => $pro )
                            <div class="col-sm-3 wow zoomIn">
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
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="blazers" >
                        @foreach($tab2 as $key => $pro )
                            <div class="col-sm-3 wow zoomIn">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <form action="{{URL::to('/save-cart')}}" method="POST">
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
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="tab-pane fade" id="sunglass" >
                        @foreach($tab3 as $key => $pro )
                            <div class="col-sm-3 wow zoomIn">
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
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="tab-pane fade" id="kids" >
                        @foreach($tab4 as $key => $pro )
                            <div class="col-sm-3 wow zoomIn">
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
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <!--/category-tab-->

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