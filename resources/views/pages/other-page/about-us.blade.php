@extends('layout')
@section('content')
<section class="page-content">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			<li><a href="{{URL::to('/homepage')}}">Home</a></li>
			<li class="active">About Us</li>
			</ol>
		</div><!--/breadcrums-->
		<div class="about-us">
			<div class="banner-about-us">
				<img src="{{asset('public/frontend/images/about_us.png')}}">
			</div>
			<article class="facts">
				<h3 class="about-us-title">Interesting Facts</h3>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the dummy text ever since the 1500s, when an unknown printer took a galley of type</p>
				<div class="achievements">
					<div class="achievements-box">
						<h1>10000</h1>
						<h6>Items in Store</h6>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the dummy text ever since the 1500s...</p>
					</div>
					<div class="achievements-box">
						<h1>90%</h1>
						<h6>Our Customers comeback</h6>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the dummy text ever since the 1500s...</p>
					</div>
					<div class="achievements-box">
						<h1>2 million</h1>
						<h6>User of the site</h6>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the dummy text ever since the 1500s...</p>
					</div>
				</div>
			</article>
			<!--  -->
			<article class="teams" style="margin: 0 -15px;">
				<h3 class="about-us-title">My Teams</h3>
				<div class="autoplay" 
          data-dots='false'
          data-autoplay="true"
          data-slides-To-Show="4"
          data-slides-To-Scroll="1">
          @foreach($staff as $key => $st )
          <div class="staff" style="padding: 0 15px;">
						<div class="staff-img">
							<a href="#"><img src="{{URL::to('public/upload/admin/'.$st->staff_img)}}" style="height: 263px;"></a>
						</div>
						<div class="staff-infor" style="display: flex; justify-content: space-between;">
							<strong class="name-staff">{{ $st->admin_name }}</strong>
							<span class="work" style="color: black;">
              <?php   if($st->admin_polici == 1){
              ?>  Manager  <?php
              }else{
              ?>  Member  <?php  }  ?>
              </span>
						</div>
						<p class="introduce-staff" style="text-align: left;">Email: {{ $st->admin_email }} </p>
					</div>
          @endforeach
				</div>
				<!-- end people -->
			</article>
			<!--  -->
			<article class="more-information-company">
				<div class="orientation">
					<div class="orientation-box">
						<h3 class="about-us-title">What we really do? </h3>
						<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,</p>
					</div>
					<div class="orientation-box">
						<h3 class="about-us-title">Our Vision </h3>
						<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,</p>
					</div>
					<div class="orientation-box">
						<h3 class="about-us-title">History of the Company </h3>
						<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,</p>
					</div>
					<div class="orientation-box">
						<h3 class="about-us-title">Cooperate with Us! </h3>
						<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,</p>
					</div>
				</div>
				<!--  -->
				<div class="support-option">
					<h3 class="about-us-title">What we can do for you</h3>
					<ul class="list-support-option accordion">
						<li>
							<div class="show-option">
								<div class="show">+</div>
								<div class="name-option">Support 24/7</div>
							</div>
							<p class="fretboard">Lorem Ipsum is simply dummy text of the printing and typesetting industry...</p>
						</li>
						<li>
							<div class="show-option">
								<div class="show">+</div>
								<div class="name-option">Best Quanlity</div>
							</div>
							<p class="fretboard">Lorem Ipsum is simply dummy text of the printing and typesetting industry...</p>
						</li>
						<li>
							<div class="show-option">
								<div class="show">+</div>
								<div class="name-option">Fastest Delivery</div>
							</div>
							<p class="fretboard">Lorem Ipsum is simply dummy text of the printing and typesetting industry...</p>
						</li>
						<li>
							<div class="show-option">
								<div class="show">+</div>
								<div class="name-option">Customer Care</div>
							</div>
							<p class="fretboard">Lorem Ipsum is simply dummy text of the printing and typesetting industry...</p>
						</li>
					</ul>
				</div>
			</article>
		</div>
	</div>
</section>
@endsection