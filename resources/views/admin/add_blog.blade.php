@extends('admin_layout')
@section('admin_content')
<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">ADD NEW BLOG PRODUCT</header>
			<div class="panel-body">
				<div class="position-center">
					<form role="form" action="{{URL::to('/save-blog')}}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="exampleInputEmail1">Blog name</label>
							<input type="text" name="blog_name" class="form-control" id="exampleInputEmail1" placeholder="Enter name blog" 
							data-validation="length"
							data-validation-length="min1"
							data-validation-error-msg="Enter blog name pleas!">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Blog image</label>
							<input type="file" name="blog_image" class="form-control" id="exampleInputEmail1"
							data-validation="mime size required" 
							data-validation-allowing="jpg, png"
							data-validation-max-size="30000kb"
							data-validation-error-msg-required="No image selected">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Blog content</label>
							<textarea name="blog_content" class="form-control" id="editor1" rows="5" style="resize: none;"
							data-validation="length"
							data-validation-length="min1"
							data-validation-error-msg="Enter blog name pleas!"></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Display</label>
							<select name="blog_status" class="form-control input-sm m-bot15">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
						</div>
						<input type="submit" name="add-blog" class="btn btn-info" value="ADD NEW">
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
<script type="text/javascript">
	$.validate();
	$(document).ready(function(){
		CKEDITOR.replace( 'editor1' );
    });
</script>
@endsection