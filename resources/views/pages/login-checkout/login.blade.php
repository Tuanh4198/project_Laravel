@extends('layout')
@section('content')
<section id="form" style="margin-bottom: 30px; margin-top: 0px; "><!--form-->
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="{{URL::to('/homepage')}}">Home</a></li>
			  <li class="active">Log in</li>
			</ol>
		</div><!--/breadcrums-->

		<div class="row">
			<div class="col-sm-5">
				<div class="login-form"><!--login form-->
					<h2>Login to your account</h2>
					<form action="{{URL::to('/login-customer')}}" method="POST">
						{{ csrf_field() }}
						<input type="email" name="email_ac" placeholder="Email Address" require="require"/>
						<input type="password" name="password_ac" placeholder="Password" class="txt_pass" require="require"/>
						<span style="color: black;"><input type="checkbox" id="check" />Show password</span>
						<button type="submit" class="btn btn-default">Login</button>
					</form>
				</div><!--/login form-->
			</div>
			<div class="col-sm-2" style="display: flex; align-items: center; justify-content: center;">
				<h2 class="or">OR</h2>
			</div>
			<div class="col-sm-5">
				<div class="signup-form"><!--sign up form-->
					<h2>New User Signup!</h2>
					<button class="btn btn-primary" style="margin: 0; padding: 10px 15px;"> 
						<a style="color: white;" href="{{URL::to('/new-customer')}}">Create new account</a>
					</button>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form-->
@endsection