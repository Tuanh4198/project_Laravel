@extends('admin_layout')
@section('admin_content')
<div class="row">
    <p style="text-align: center; margin-bottom: 10px; background-color: floralwhite; margin: 0 15px 15px; border-radius: 5px;">
        <?php
            $message = Session::get('message');
            if($message){
                echo '<span class="txt-alert" style="color:#27c24c;">',$message.'</span>';
                Session::put('message',null);
            }
        ?>
    </p>
	<div class="col-lg-4">
		<section class="panel">
			<header class="panel-heading">ADD NEW ZIP CODE</header>
			<div class="panel-body">
				<div class="position-center">
					<form role="form" action="{{URL::to('/save-code')}}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="exampleInputEmail1">Coupon name</label>
							<input type="text" name="coupon_name" class="form-control" required="required">
                        </div>
                        <div class="form-group">
							<label for="exampleInputEmail1">Coupon code</label>
							<input type="text" name="coupon_code" class="form-control" required="required">
                        </div>
                        <div class="form-group">
							<label for="exampleInputEmail1">Coupon QTY</label>
							<input type="text" name="coupon_qty" class="form-control" required="required">
                        </div>
						<div class="form-group">
							<label for="exampleInputPassword1">Coupon function</label>
							<select name="coupon_func" class="form-control input-sm m-bot15">
                                <option value="0">Percent</option>
                                <option value="1">Money</option>
                            </select>
                        </div>
                        <div class="form-group">
							<label for="exampleInputEmail1">Enter percentage or amount of discount</label>
							<input type="text" name="coupon_num" class="form-control" required="required">
                        </div>
						<button type="submit" name="add-staff" class="btn btn-info">ADD NEW</button>
						<input type="reset" value="Reset" class="btn btn-info"/>
					</form>
				</div>				
			</div>
		</section>
    </div>
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">LIST CODE</div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th style="">Coupon name</th>
                            <th style="">Coupon code</th>
                            <th style="">Coupon QTY</th>
                            <th style="">Coupon function</th>
                            <th style="">Discount</th>
                            <th style="">Time</th>
                            <th style="width:10px;"></th>
                            <th style="width:10px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($list_coupon as $key => $coupon)
					<tr>
						<td>{{ $coupon->coupon_name }}</td>
						<td>{{ $coupon->coupon_code }}</td>
                        <td>{{ $coupon->coupon_qty }}</td>
						<td>
                            <?php	if($coupon->coupon_func == 0){	?>	
                                Percent
                            <?php	}else{	?>	
                                Money
                        	<?php	}	?>
						</td>
                        <td>{{ $coupon->coupon_num }}</td>
                        <td>{{ $coupon->created_at }}</td>
                        <td>
							<a href="{{URL::to('/edit-coupon/'.$coupon->coupon_id)}}" class="active" ui-toggle-class="">
								<i class="fa fa-wrench text-success text-active"></i>
							</a>						
                        </td>
                        <td>
							<a href="{{URL::to('/delete-coupon/'.$coupon->coupon_id)}}" class="active" ui-toggle-class="" onclick="return confirm('Are you sure to delete?')">
								<i class="fa fa-times text-danger text"></i>
                            </a>
                        </td>
					</tr>
					@endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection