@extends('admin_layout')
@section('admin_content')
<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">EDIT BRAND PRODUCT</header>
			<div class="panel-body">
				@foreach($edit_staff as $key => $edit_value)
				<div class="position-center">
					<form role="form" action="{{URL::to('/update-staff/'.$edit_value->admin_id)}}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="exampleInputEmail1">Name</label>
							<input type="text" name="admin_name" class="form-control" id="exampleInputEmail1" placeholder="Enter name brand" value="{{$edit_value->admin_name}}">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Email</label>
							<input type="text" name="admin_email" class="form-control" id="exampleInputEmail1" placeholder="Enter name brand" value="{{$edit_value->admin_email}}">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Phone number</label>
							<input type="text" name="admin_phone" class="form-control" id="exampleInputEmail1" placeholder="Enter name brand" value="{{$edit_value->admin_phone}}">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Product image</label>
							<input type="file" name="staff_img" class="form-control" id="exampleInputEmail1" placeholder="Enter name product">
							<img src="{{URL::to('public/upload/admin/'.$edit_value->staff_img)}}" width="100" height="100">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Address</label>
							<textarea name="staff_address" class="form-control" rows="5" style="resize: none;">{{$edit_value->staff_address}}</textarea>
						</div>
						<button type="submit" class="btn btn-info">UPDATE</button>
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
				@endforeach
			</div>
		</section>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		CKEDITOR.replace( 'editor1' );
    });
</script>
@endsection