@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
	<div class="panel panel-default">
		<div class="panel-heading">
			LIST CATEGORY PRODUCT
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
						<th style="width: 20%">Category name</th>
						<th>Describe</th>
						<th style="width: 10%">Display</th>
						<th style="width:30px;"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($list_category as $key => $cate_pro)
					<tr>
						<td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
						<td>
							<span class="text-ellipsis">{{ $cate_pro->category_name }}</span>
						</td>
						<td>{{ $cate_pro->category_desc }}</td>
						<td><span class="text-ellipsis">
							<?php
								if($cate_pro->category_status == 0){
							?>
									<a href="{{URL::to('/active-category/'.$cate_pro->category_id)}}">No</a>
							<?php
								}else{
							?>
									<a href="{{URL::to('/unactive-category/'.$cate_pro->category_id)}}">Yes</a>
							<?php
								}
							?>
						</span></td>
						<td>
							<a href="{{URL::to('/edit-category/'.$cate_pro->category_id)}}" class="active" ui-toggle-class="">
								<i class="fa fa-wrench text-success text-active"></i>
							</a>
							<a href="{{URL::to('/delete-category/'.$cate_pro->category_id)}}" class="active" ui-toggle-class="" onclick="return confirm('Are you sure to delete?')">
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
				<div class="col-sm-12 text-center"> 
					{{ $list_category->links() }}
				</div>
			</div>
		</footer>
	</div>
</div>
@endsection