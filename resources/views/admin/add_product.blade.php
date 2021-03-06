@extends('admin_layout')
@section('admin_content')
<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">ADD NEW PRODUCT</header>
			<div class="panel-body">
				<div class="position-center">
					<?php
						$message = Session::get('message');
						if($message){
							echo '<span class="txt-alert" style="color:#27c24c;">',$message.'</span>';
							Session::put('message',null);
						}
					?>
					<form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="exampleInputEmail1">Product name</label>
							<input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Enter name product" required="required">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Product image</label>
							<input type="file" name="product_image" class="form-control" id="exampleInputEmail1" placeholder="Enter name product">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Product price</label>
							<input type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Enter price product" required="required">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Quantity</label>
							<input type="text" name="product_qty" class="form-control" id="exampleInputEmail1" placeholder="Enter price product" required="required">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Describe</label>
							<textarea name="product_describe" class="form-control" id="editor1" rows="5" style="resize: none;" value=""></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Content</label>
							<textarea name="product_content" class="form-control" id="editor2" rows="5" style="resize: none;" value=""></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Category product</label>
							<select name="category_id" class="form-control input-sm m-bot15">
								@foreach($category_name as $key => $cate)
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endforeach
                            </select>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Brand product</label>
							<select name="brand_id" class="form-control input-sm m-bot15">
								@foreach($brand_name as $key => $bra)
                                <option value="{{$bra->brand_id}}">{{$bra->brand_name}}</option>
								@endforeach
                            </select>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Display</label>
							<select name="product_status" class="form-control input-sm m-bot15">
                                <option value="1">Yes</option>		
                                <option value="0">No</option>
                            </select>
						</div>
						<button type="submit" name="add-product" class="btn btn-info">ADD NEW</button>		
						<input type="reset" value="Reset" class="btn btn-info"/>	
					</form>					
				</div>				
			</div>
		</section>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		CKEDITOR.replace( 'editor1' );
		CKEDITOR.replace( 'editor2' );
    });
</script>
@endsection