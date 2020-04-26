@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
	<div class="panel panel-default">
		<div class="panel-heading">
			LIST MESAGE CUSTOMER
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
						<th style="width: 15%">Nam</th>
						<th style="width: 15%">Email</th>
						<th style="width: 20%">Type</th>
                        <th style="width:15%;">Time</th>
						<th style="width:30%;">Content</th>
                        <th style="width:5%;"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($mesage as $key => $mes)
					<tr>
						<td>{{ $mes->messenger_name }}</td>
						<td>{{ $mes->messenger_email }}</td>
                        <td>{{ $mes->messenger_decs }}</td>
                        <?php $datetime = $mes->created_at; ?>
						<td> <?php echo date("F j, Y"); ?> </td>
                        <td>{{ $mes->messenger_content }}</td>
                        <td><a href="#">Reply</a></td>
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