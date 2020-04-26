@extends('admin_layout')
@section('admin_content')
<div class="col-sm-6 agile-calendar">
	<div class="cover" style="margin-bottom: 30px;">
		<h3 class="text-center">WELLCOME TO MY ADMIN</h3>
		<table style="margin-top: 30px;">
			<tbody>
				<tr style="width: 10%;">
					<td style="width: 30%; padding-right: 10px;" rowspan="4">
						<?php $img = Session::get('staff_img'); ?>
						<img style="width: 100%;" src="{{URL::to('public/upload/admin/'.$img)}}">
					</td>
					<td style="width: 15%;"><b>Name:</b></td>
					<td style="width: 30%">
					<?php
	                    $name = Session::get('admin_name');
	                    echo $name;
	                ?>
	                </td>
				</tr>
				<tr>
					<td><b>Email:</b></td>
					<td>
					<?php
	                    $mail = Session::get('admin_email');
	                    echo $mail;
	                ?>
					</td>
				</tr>
				<tr>
					<td><b>Phone:</b></td>
					<td>
					<?php
	                    $phone = Session::get('admin_phone');
	                    echo $phone;
	                ?>
					</td>
				</tr>
				<tr>
					<td><b>Address:</b></td>
					<td>
					<?php
	                    $address = Session::get('staff_address');
	                    echo $address;
	                ?>
					</td>
				</tr>
				
			</tbody>
		</table>
		<?php
	        $admin_id = Session::get('admin_id');
	    ?>
		<button type="button" class="btn btn-dark btn-sm" style="margin-top: 20px;">
			<a href="{{URL::to('/edit-staff/'.$admin_id )}}" style="color: black; font-weight: bold;">
				Change infor
			</a>
		</button>
		<?php
			$message = Session::get('message');
			if($message){
				echo '<span class="txt-alert" style="color:#27c24c;">',$message.'</span>';
				Session::put('message',null);
			}
		?>
	</div>
	<div class="cover">
		<h3 class="text-center">Store view</h3>
		<table style="margin-top: 30px; width: 100%;">
			<tbody>
				<tr>
					<td style="width: 20%;"><b>Order:</b></td>
					<td>
					<?php
	                    $order = Session::get('order');
	                    echo $order;
	                ?>
					</td>
				</tr>
				<tr>
					<td style="width: 20%;"><b>Mesage:</b></td>
					<td>
					<?php
	                    $mesage = Session::get('mesage');
	                    echo $mesage;
	                ?>
					</td>
				</tr>
				<tr>
					<td style="width: 20%;"><b>Product:</b></td>
					<td>
					<?php
	                    $product = Session::get('product');
	                    echo $product;
	                ?>
					</td>
				</tr>
				<tr>
					<td><b>Category:</b></td>
					<td>
					<?php
	                    $category = Session::get('category');
	                    echo $category;
	                ?>
					</td>
				</tr>
				<tr>
					<td><b>Brand:</b></td>
					<td>
					<?php
	                    $brand = Session::get('brand');
	                    echo $brand;
	                ?>
					</td>
				</tr>
				
			</tbody>
		</table>
	</div>
</div>
<!-- calendar -->
<div class="col-sm-6 agile-calendar">
	<div class="calendar-widget">
        <div class="panel-heading ui-sortable-handle">
			<span class="panel-icon">
              <i class="fa fa-calendar-o"></i>
            </span>
            <span class="panel-title"> Calendar Widget</span>
        </div>
		<!-- grids -->
		<div class="agile-calendar-grid">
			<div class="page">
				<div class="w3l-calendar-left">
					<div class="calendar-heading">
					</div>
					<div class="monthly" id="mycalendar"></div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
</div>
<!-- //calendar -->
@endsection