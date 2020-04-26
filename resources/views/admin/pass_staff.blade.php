@extends('admin_layout')
@section('admin_content')
<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">ADD NEW staff PRODUCT</header>
			<div class="panel-body">
				<div class="position-center">
	@foreach($edit_staff as $key => $staff)
	<table style="margin: 30px 0;">
		<tbody>
			<tr style="width: 10%;">
				<td style="width: 10%; padding-right: 20px;" rowspan="4">
					<img src="{{URL::to('public/upload/admin/'.$staff->staff_img)}}" style="width: 100%;">
				</td>
				<td style="width: 5%;"><b>Name staff:</b></td>
				<td style="width: 30%">{{$staff->admin_name}} </td>
			</tr>
			<tr>
				<td><b>Email:</b></td>
				<td>{{ $staff->admin_email }} </td>
			</tr>
			<tr>
				<td><b>Phone:</b></td>
				<td>{{ $staff->admin_phone }} </td>
			</tr>
			<tr>
				<td><b>Address:</b></td>
				<td>{{ $staff->staff_address }} </td>
			</tr>
		</tbody>
	</table>
	
					<form role="form" action="{{URL::to('/updatepass-staff/'.$staff->admin_id)}}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="exampleInputEmail1">New password</label>
							<input type="text" name="admin_password" class="form-control" id="exampleInputEmail1" placeholder="Enter name brand">
						</div>
						<button type="submit" class="btn btn-info">UPDATE PASSWORD</button>
					</form>
					@endforeach
				</div>				
			</div>
		</section>
	</div>
</div>
@endsection