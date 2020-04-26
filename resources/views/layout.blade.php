<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- seo -->
    <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <link rel="canonical" href="{{$url_canonical}}" />
    <meta property="og:title" content="{{$meta_title}}" />
    <link rel="icon" type="image/x-icon" href="" />
    <meta name="author" content="">
    <title>{{$meta_title}}</title>
    <!-- /seo -->
    <link href="{{ asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/slick-theme.css')}}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/slick.css')}}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{ asset('public/frontend/fonts/flaticon.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="fonts/flaticon.css">
    <link rel="shortcut icon" href="{{ asset('public/frontend/images/home/favicon.ico')}}">
    <style type="text/css">
        .preloading{
            overflow: hidden;
        }
        .loading{
            position: fixed;
            background-color: black;
            top: 0;
            left: 0;
            opacity: 0.7; 
            width: 100%;
            height: 100%;
            z-index: 1000000;
        }
        .loading .img{
            width: 100%;
            width: auto;
            opacity: 1; 
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%);
        }
    </style>
</head><!--/head-->

<body class="preloading">
    <!--loading-->
    <div class="loading">
        <svg width="50" height="50" viewBox="0 0 50 50" class="img">
            <path fill="white" d="M25,5A20.14,20.14,0,0,1,45,22.88a2.51,2.51,0,0,0,2.49,2.26h0A2.52,2.52,0,0,0,50,22.33a25.14,25.14,0,0,0-50,0,2.52,2.52,0,0,0,2.5,2.81h0A2.51,2.51,0,0,0,5,22.88,20.14,20.14,0,0,1,25,5Z">
                <animateTransform attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.5s" repeatCount="indefinite" />
            </path>
        </svg>
    </div>
    <!--/loading-->

    <!--header-->
    <header id="header">
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row" style="display: flex; align-items: center;">
                    <div class="col-sm-6" style="display: flex;">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="tel:84386876699"><i class="fa fa-phone"></i> +84 386876699</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> nguyenanh.it.4198@gmail.com </a></li>
                            </ul>
                        </div>                        
                    </div>
                    <div class="col-sm-6">
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">VietNammese</button>
                            </div>                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">USD</button>
                            </div>
                            <?php
                            $customer_id = Session::get('customer_id');
                            if($customer_id == NULL){
                            ?>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">Welcome to SHISEIDO! <?php $customer_name = Session::get('customer_name'); ?></button>
                                </div>
                            <?php
                            }else{
                            ?>
                                <?php $customer_name = Session::get('customer_name'); ?>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">Welcome! {{ $customer_name }} </button>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-3" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="logo pull-left">
                            <a href="{{URL::to('/homepage')}}"><img src="{{asset('public/frontend/images/home/logo2.png')}}" alt="" width="100" /></a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <form action="{{URL::to('/search')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="search_box pull-left search-box">
                                <input type="text" name="keywords_submit" placeholder="Enter product name..."/>
                                <button type="submit" name="search_item" style="background-color: white; border: 0;">
                                    <a href="#" style="color: black;"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-3" style="padding: 0;">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">

                            <?php
                            $customer_id = Session::get('customer_id');
                            $shipping_id = Session::get('shipping_id');
                            $cartsub = Cart::subtotal();
                            if($customer_id != NULL && $shipping_id == NULL && $cartsub != 0){ ?>
                                <li><a style="color: black" href="{{URL::to('/checkout/'.$customer_id)}}"><i style="font-size: 20px;" class="fa fa-crosshairs"></i> Checkout </a></li>
                            <?php }elseif($customer_id != NULL && $shipping_id != NULL && $cartsub != 0){ ?>
                                <li><a style="color: black" href="{{URL::to('/payment')}}"><i style="font-size: 20px;" class="fa fa-crosshairs"></i> Checkout </a></li>
                            <?php }elseif($customer_id == NULL){ ?>
                                <li><a style="color: black" href="{{URL::to('/login-checkout')}}"><i style="font-size: 20px;" class="fa fa-crosshairs"></i> Checkout </a></li>
                            <?php }else{ ?>
                                <li><a style="color: black" href="{{URL::to('/homepage')}}"><i style="font-size: 20px;" class="fa fa-crosshairs"></i> Checkout </a></li>
                            <?php } ?>

                            <?php
                            $customer_id = Session::get('customer_id');
                            if($customer_id == NULL){ ?>
                                <li><a style="color: black" href="{{URL::to('/login-checkout')}}"><i style="font-size: 20px;" class="fa fa-lock"></i> Login</a></li>
                            <?php }else{ ?>
                                <li><a style="color: black" href="{{URL::to('/logout-checkout')}}"><i style="font-size: 20px;" class="fa fa-lock"></i> Logout</a></li>
                            <?php } ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom fixed-main-menu"><!--header-bottom-->
            <div class="container">
                <div class="row" style="align-items: center; display: flex;">
                    <div class="col-sm-3">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="all-category">
                            <div class="onclick command-button">
                                <i class="fa fa-bars"></i>
                                <span>All Categories</span>
                            </div>
                            <div class="cover-extra-menu drop-down">
                                <ul class="extra-menu">
                                    @foreach($category as $key => $cate )
                                    <li><a href="{{URL::to('/show-category-product/'.$cate->category_id)}}">{{ $cate->category_name }}</a></li>
                                    @endforeach
                                </ul>
                                <div class="control-all-category">
                                    <span class="load-more">View more</span>
                                    <span class="load-more close-loadmore">Close</span>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-sm-5">
                        <div class="mainmenu ">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/homepage')}}" class="active">Home</a></li>
                                <li><a href="{{URL::to('/blogpage')}}">Blog</a></li> 
                                <li><a href="{{URL::to('/show-cart')}}">Cart</a></li>
                                <li><a href="{{URL::to('/about-us')}}">About us</a></li>
                                <?php $customer_id = Session::get('customer_id');
                                if($customer_id == NULL){ ?>
                                    <li><a href="{{URL::to('/contact-un')}}">Contact</a></li>
                                <?php }else{ ?>
                                    <li><a href="{{URL::to('/contact-us/'.$customer_id)}}">Contact</a></li>
                                <?php } ?>
                            </ul>
                        </div>                        
                    </div>
                    <div class="col-sm-4">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                            <?php
                                $customer_id = Session::get('customer_id');
                            if($customer_id == NULL){
                            ?>
                                <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-user"></i> Account </a></li>
                            <?php
                            }else{
                            ?>
                               <li><a href="{{URL::to('/customer-infor/'.$customer_id)}}"><i class="fa fa-user"></i> Account </a></li>
                            <?php
                            }
                            ?>
                                <li><a href=""><i class="fa fa-heart"></i> Wishlist</a></li>
                                <li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header>
    <!--/header-->    
    
    <section>
        @yield('content')
    </section>

    <!--address-->
    <address class="social-network" style="margin-top: 50px;">
        <div class="container">
             <div class="social-icons-link">
                <h2 class="title text-center">social bearing</h2> 
                <ul class="navsocial-icons-link" style="display: flex; justify-content: center; align-items: center;">
                    <li class="wow zoomIn"><a href="#"><i class="fa fa-facebook-square"></i></a></li>
                    <li class="wow zoomIn"><a href="#"><i class="fa fa-twitter-square"></i></a></li>
                    <li class="wow zoomIn"><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
                    <li class="wow zoomIn"><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                    <li class="wow zoomIn"><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
                    <li class="wow zoomIn"><a href="#"><i class="fa fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </address>
    <!--/address-->

    <!--Footer-->
    <footer id="footer" class="wow slideInUp">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <a href="{{URL::to('/homepage')}}"><img src="{{asset('public/frontend/images/home/logo.png')}}" alt="" /></a>
                            <p style="margin-top: 10px;">We work hard on further building a distinctive and concentrated brand portfolio as well as creating social value.</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('public/frontend/images/home/iframe1.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('public/frontend/images/home/iframe2.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('public/frontend/images/home/iframe3.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('public/frontend/images/home/iframe4.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="{{asset('public/frontend/images/home/map.png')}}" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Get the most recent updates from <br />our site and be updated your self...</p>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2020 E-SHOPPER Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="https://www.facebook.com/profile.php?id=100022928231297">Anh Nguyen</a></span></p>
                </div>
            </div>
        </div>
    </footer>
    <!--/Footer-->
  
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <script src="{{asset('public/frontend/js/slick.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/wow.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/sweetalert.js')}}"></script>
    <script type="text/javascript">
        $(window).on('load', function(event) {
            $('body').removeClass('preloading');
            $('.loading').delay(1000).fadeOut('fast');           
            $('html,body').animate({scrollTop: 0}, 1000);
        });

        $(".autoplay").each(function() {
            $(this).slick($(this).data());
        });

        new WOW().init();

        $('.btn-dd1').on('click', function(event) {
            event.preventDefault();
            $('.drop-down1:nth-child(n+6)').slideToggle();
        });

        $('.btn-dd2').on('click', function(event) {
            event.preventDefault();
            $('.drop-down2:nth-child(n+6)').slideToggle();
        });

        $('#check').click(function(){
            $(this).is(':checked') ? $('.txt_pass').attr('type', 'text') : $('.txt_pass').attr('type', 'password');
        });
        
        $(function() {
            $('.accordion .show-option').click(function(event) {
                event.preventDefault();
                $(this).parent().siblings().find('.fretboard').slideUp();
                $(this).parent().find('.fretboard').slideToggle();

                $(this).parent().siblings().find('.show').removeClass('active').text('+');
                ($(this).parent().find('.show').text() == '-') ? ($(this).parent().find('.show').removeClass('active').text('+')) : ($(this).parent().find('.show').addClass('active').text('-'))

                $(this).parent().find('i').toggleClass('rotate');
                $(this).parent().siblings().find('i').removeClass('rotate');
            });

            $('.all-category .control-all-category .load-more').on('click', function(event) {
                $('.all-category .extra-menu > li:nth-child(n+11)').toggle();
                $('.all-category .control-all-category .load-more').toggle();
            });
        });
    </script>
</body>
</html>