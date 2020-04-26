@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
	<div class="panel panel-default">
		<div class="panel-heading">
			LIST BRAND PRODUCT
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
						<th style="width:10%">Name</th>
						<th>Image</th>
						<th>Mail</th>
						<th>Address</th>
						<th>Phone</th>
						<th style="width:10%">Polici</th>
						<th style="width:30px;"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($list_staff as $key => $staff)
					<tr>
						<td>
							<span class="text-ellipsis">{{ $staff->admin_name }}</span>
						</td>
						<td>
							<span class="text-ellipsis"><img src="public/upload/admin/{{ $staff->staff_img }}" width="100" height="100"></span>
						</td>
						<td>
							<span class="text-ellipsis">{{ $staff->admin_email }}</span>
						</td>				
						<td style="max-height: 100px; text-overflow: ellipsis; overflow: hidden; display: block; line-height: 21px;">{{ $staff->staff_address }}</td>
						<td>
							<span class="text-ellipsis">{{ $staff->admin_phone }}</span>
						</td>
						<td><span class="text-ellipsis">
							<?php
								if($staff->admin_polici == 0){
							?>
								<a href="{{URL::to('/active-staff/'.$staff->admin_id)}}">Staff</a>
							<?php
								}else{
							?>
								<a href="{{URL::to('/unactive-staff/'.$staff->admin_id)}}">Admin</a>
							<?php
								}
							?>
						</span></td>
						<td>
							<a href="{{URL::to('/edit-staff/'.$staff->admin_id )}}" class="active" ui-toggle-class="" title="Change infor">
								<i class="fa fa-wrench text-success text-active"></i>
							</a>
							<a href="{{URL::to('/delete-staff/'.$staff->admin_id )}}" class="active" ui-toggle-class="" onclick="return confirm('Are you sure to delete?')" title="Delete">
								<i class="fa fa-times text-danger text"></i>
							</a>
							<a href="{{URL::to('/pass-staff/'.$staff->admin_id )}}" class="active" ui-toggle-class="" title="Fogot password">
								<i class="fa fa-key" aria-hidden="true"></i>
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