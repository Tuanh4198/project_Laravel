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
						<th style="width:10px;">
							<label class="i-checks m-b-none">
								<input type="checkbox"><i></i>
							</label>
						</th>
						<th style="width:10%">Brand name</th>
						<th>Brand image</th>
						<th>Describe</th>
						<th style="width:10%">Display</th>
						<th style="width:30px;"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($list_brand as $key => $bra_pro)
					<tr>
						<td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
						<td>
							<span class="text-ellipsis">{{ $bra_pro->brand_name }}</span>
						</td>
						<td>
							<span class="text-ellipsis"><img src="public/upload/brand/{{ $bra_pro->brand_img }}" width="200" height="100"></span>
						</td>						
						<td style="max-height: 100px; text-overflow: ellipsis; overflow: hidden; display: block; line-height: 21px;">{{ $bra_pro->brand_desc }}</td>
						<td><span class="text-ellipsis">
							<?php
								if($bra_pro->brand_status == 0){
							?>
									<a href="{{URL::to('/active-brand/'.$bra_pro->brand_id)}}">No</a>
							<?php
								}else{
							?>
									<a href="{{URL::to('/unactive-brand/'.$bra_pro->brand_id)}}">Yes</a>
							<?php
								}
							?>
						</span></td>
						<td>
							<a href="{{URL::to('/edit-brand/'.$bra_pro->brand_id)}}" class="active" ui-toggle-class="">
								<i class="fa fa-wrench text-success text-active"></i>
							</a>
							<a href="{{URL::to('/delete-brand/'.$bra_pro->brand_id)}}" class="active" ui-toggle-class="" onclick="return confirm('Are you sure to delete?')">
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
					{{ $list_brand->links() }}
				</div>
			</div>
		</footer>
	</div>
</div>
@endsection