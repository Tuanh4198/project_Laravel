@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
	<div class="panel panel-default">
		<div class="panel-heading">
			LIST ORDER
		</div>
		<?php
			$message = Session::get('message');
			if($message){
				echo '<span class="txt-alert" style="margin-top: 10px; letter-spacing: 1px; color:#27c24c;">',$message.'</span>';
				Session::put('message',null);
			}
		?>
		<div class="table-responsive">
			<table class="table table-striped b-t b-light">
				<thead>
					<tr>
						<th style="width:20px;"></th>
						<th style="width: 20%;">Customer name</th>
						<th>Total</th>
						<th>Date</th>
						<th style="width: 20%;">Order status</th>
						<th style="width: 60px;">View</th>
					</tr>
				</thead>
				<tbody>
					@foreach($list_order as $key => $lo)
					<tr>
						<td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
						<td>
							<span class="text-ellipsis">{{ $lo->customer_name }}</span>
						</td>
						<td>{{ $lo->order_total }}</td>
						<td>{{ $lo->created_at }}</td>
						<td>{{ $lo->order_status }}</td>
						<td style="text-align: center;">
							<a href="{{URL::to('/view-order/'.$lo->order_id)}}" class="active" ui-toggle-class="">
								<i class="fa fa-wrench text-success text-active"></i>
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
					{{ $list_order->links() }}
				</div>
			</div>
		</footer>
	</div>
</div>
@endsection