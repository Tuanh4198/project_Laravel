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
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">EDIT ZIP CODE</header>
			<div class="panel-body">
            @foreach($edit_coupon as $key => $edit_value)
				<div class="position-center">
					<form role="form" action="{{URL::to('/update-code/'.$edit_value->coupon_id)}}" method="post">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="exampleInputEmail1">Coupon name</label>
							<input type="text" name="coupon_name" value="{{$edit_value->coupon_name}}" class="form-control" required="required">
                        </div>
                        <div class="form-group">
							<label for="exampleInputEmail1">Coupon code</label>
							<input type="text" name="coupon_code" value="{{$edit_value->coupon_code}}" class="form-control" required="required">
                        </div>
                        <div class="form-group">
							<label for="exampleInputEmail1">Coupon QTY</label>
							<input type="text" name="coupon_qty" value="{{$edit_value->coupon_qty}}" class="form-control" required="required">
                        </div>
						<div class="form-group">
							<label for="exampleInputPassword1">Coupon function</label>
							<select name="coupon_func" class="form-control input-sm m-bot15" id="selected">
                                <option value="0">Percent</option>
                                <option value="1">Money</option>
                            </select>
                        </div>
                        <script>
                            $("#selected option[value='{{$edit_value->coupon_func}}']").attr("selected","selected");
                        </script>
                        <div class="form-group">
							<label for="exampleInputEmail1">Enter percentage or amount of discount</label>
							<input type="text" name="coupon_num" value="{{$edit_value->coupon_num}}" class="form-control" required="required">
                        </div>
						<button type="submit" class="btn btn-info">UPDATE</button>
					</form>
                </div>
            @endforeach
            </div>
            
		</section>
    </div>
</div>
@endsection