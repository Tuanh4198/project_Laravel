@extends('layout')
@section('content')
<section id="form" style="margin-bottom: 30px; margin-top: 0px; "><!--form-->
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="{{URL::to('/homepage')}}">Home</a></li>
			  <li class="active">Create new account</li>
			</ol>
		</div><!--/breadcrums-->

		<div class="row">
			<div class="col-sm-6">
				<div class="signup-form" ><!--sign up form-->
					<h2>New User Signup!</h2>
					<form action="{{URL::to('/add-customer')}}" method="POST">
						{{ csrf_field() }}
						<input type="text" name="c_name" placeholder="Name" require/>
						<input type="email" name="c_email" placeholder="Email Address" require/>
						<input type="text" name="c_phone" placeholder="Phone number" require/>
						<input type="password" name="c_pass" placeholder="Password" require/>
                        <textarea name="c_address" placeholder="Shipping address" require style="height: 100px;"></textarea>
						<div class="_btn" style="display: flex; margin-top: 20px;   ">
							<button type="submit" class="btn btn-default" style="margin-right: 10px;">Sign Up</button>
							<button type="reset" class="btn btn-default">Reset</button>
						</div>
					</form>
				</div><!--/sign up form-->
			</div>
            <div class="col-sm-6">
                <div class="shipping text-center"><!--shipping-->
					<a href="#"><img src="{{asset('public/frontend/images/home/welcome.PNG')}}" alt="" style="width: 100%;" /></a>
				</div><!--/shipping-->
            </div>
		</div>
	</div>
</section><!--/form-->
@endsection