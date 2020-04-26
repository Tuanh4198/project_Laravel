@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
	<div class="panel panel-default">
		<div class="panel-heading">
			LIST PRODUCT
		</div>
		<?php
			$message = Session::get('message');
			if($message){
				echo '<span class="txt-alert" style="margin-top: 10px; letter-spacing: 1px; color:#27c24c;">',$message.'</span>';
				Session::put('message',null);
			}
		?>
		<div class="row w3-res-tb">
			<div class="col-sm-5 m-b-xs">
				<select class="input-sm form-control w-sm inline v-middle">
					<option value="0">Bulk action</option>
					<option value="1">Delete selected</option>
					<option value="2">Bulk edit</option>
					<option value="3">Export</option>
				</select>
				<button class="btn btn-sm btn-default">Apply</button>                
			</div>
			<div class="col-sm-4">
			</div>
			<div class="col-sm-3">
				<div class="input-group">
					<input type="text" class="input-sm form-control" placeholder="Search">
					<span class="input-group-btn">
						<button class="btn btn-sm btn-default" type="button">Search</button>
					</span>
				</div>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-striped b-t b-light">
				<thead>
					<tr>
						<th style="width:20px;">
							<label class="i-checks m-b-none">
								<input type="checkbox"><i></i>
							</label>
						</th>
						<th>Name</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Image</th>
						<th>Category</th>
						<th>Brand</th>
						<th>Display</th>
						<th style="width:20px;"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($list_product as $key => $pro)
					<tr>
						<td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
						<td>
							<span class="text-ellipsis">{{ $pro->product_name }}</span>
						</td>
						<td>
							<span class="text-ellipsis">{{ $pro->product_price }}</span>
						</td>
						<td>
							<span class="text-ellipsis">{{ $pro->product_qty }}</span>
						</td>
						<td>
							<span class="text-ellipsis"><img src="public/upload/product/{{ $pro->product_image }}" width="100" height="100"></span>
						</td>
						<td>
							<span class="text-ellipsis">{{ $pro->category_name }}</span>
						</td>
						<td>
							<span class="text-ellipsis">{{ $pro->brand_name }}</span>
						</td>
						<td><span class="text-ellipsis">
							<?php
								if($pro->product_status == 0){
							?>
									<a href="{{URL::to('/active-product/'.$pro->product_id)}}">No</a>
							<?php
								}else{
							?>
									<a href="{{URL::to('/unactive-product/'.$pro->product_id)}}">Yes</a>
							<?php
								}
							?>
						</span></td>
						<td>
							<a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active" ui-toggle-class="">
								<i class="fa fa-wrench text-success text-active"></i>
							</a>
							<a href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active" ui-toggle-class="" onclick="return confirm('Are you sure to delete?')">
								<i class="fa fa-times text-danger text"></i>
							</a>							
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-sm-5 text-center">
					<small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
				</div>
				<div class="col-sm-7 text-right text-center-xs">                
					<ul class="pagination pagination-sm m-t-none m-b-none">
						<li><a href=""><i class="fa fa-chevron-left"></i></a></li>
						<li><a href="">1</a></li>
						<li><a href="">2</a></li>
						<li><a href="">3</a></li>
						<li><a href="">4</a></li>
						<li><a href=""><i class="fa fa-chevron-right"></i></a></li>
					</ul>
				</div>
			</div>
		</footer>
	</div>
</div>
@endsection