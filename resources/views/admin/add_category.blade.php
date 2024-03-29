@extends('admin_layout')
@section('admin_content')
<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">ADD NEW CATEGORY PRODUCT</header>
			<div class="panel-body">
				<div class="position-center">
					<form role="form" action="{{URL::to('/save-category')}}" method="post">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="exampleInputEmail1">Name category</label>
							<input type="text" name="category_name" class="form-control" id="exampleInputEmail1" placeholder="Enter name category">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Describe</label>
							<textarea name="category_describe" class="form-control" id="editor1" rows="5" style="resize: none;"></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Display</label>
							<select name="category_status" class="form-control input-sm m-bot15">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
						</div>
						<button type="submit" name="add-category" class="btn btn-info">ADD NEW</button>				
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
	$(document).ready(function(){
		CKEDITOR.replace( 'editor1' );
    });
</script>
@endsection