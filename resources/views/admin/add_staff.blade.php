@extends('admin_layout')
@section('admin_content')
<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">ADD NEW staff PRODUCT</header>
			<div class="panel-body">
				<div class="position-center">
					<form role="form" action="{{URL::to('/save-staff')}}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="exampleInputEmail1">User name</label>
							<input type="text" name="admin_name" class="form-control" id="exampleInputEmail1" placeholder="Enter name staff" required="required">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Phone number</label>
							<input type="text" name="admin_phone" class="form-control" id="exampleInputEmail1" placeholder="Enter name staff" required="required">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Email</label>
							<input type="text" name="admin_email" class="form-control" id="exampleInputEmail1" placeholder="Enter name staff" required="required">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Password</label>
							<input type="text" name="admin_password" class="form-control" id="exampleInputEmail1" placeholder="Enter name staff" required="required">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Image</label>
							<input type="file" name="staff_img" class="form-control" id="exampleInputEmail1" placeholder="Enter name product" required="required">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Address</label>
							<textarea name="staff_address" class="form-control" rows="5" style="resize: none;" required></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Polici</label>
							<select name="admin_polici" class="form-control input-sm m-bot15">
                                <option value="0">Staff</option>
                                <option value="1">Admin</option>
                            </select>
						</div>
						<button type="submit" name="add-staff" class="btn btn-info">ADD NEW</button>				
						<input type="reset" value="Reset" class="btn btn-info"/>	
					</form> 
					<?php
						$message = Session::get('message');
						if($message){
							echo '<span class="txt-alert" style="color:#27c24c;">',$message.'</span>';
							Session::put('message',null);
						}
					?>
				</div>				
			</div>
		</section>
	</div>
</div>
@endsection