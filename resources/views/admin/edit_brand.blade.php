@extends('admin_layout')
@section('admin_content')
<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">EDIT BRAND PRODUCT</header>
			<div class="panel-body">
				@foreach($edit_brand as $key => $edit_value)
				<div class="position-center">
					<form role="form" action="{{URL::to('/update-brand/'.$edit_value->brand_id)}}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="exampleInputEmail1">Name brand</label>
							<input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" placeholder="Enter name brand" value="{{$edit_value->brand_name}}">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Product image</label>
							<input type="file" name="brand_img" class="form-control" id="exampleInputEmail1" placeholder="Enter name product">
							<img src="{{URL::to('public/upload/brand/'.$edit_value->brand_img)}}" width="200" height="100">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Describe</label>
							<textarea name="brand_describe" class="form-control" id="editor1" rows="5" style="resize: none;">{{$edit_value->brand_desc}}</textarea>
						</div>
						<button type="submit" name="add-brand" class="btn btn-info">UPDATE</button>				
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