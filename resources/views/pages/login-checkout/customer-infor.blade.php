@extends('layout')
@section('content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="{{URL::to('/homepage')}}">Home</a></li>
			  <li class="active">My infor</li>
			</ol>
		</div><!--/breadcrums-->
        <style>
            table{
                border: 1px solid grey;
                padding: 10px;
                margin-bottom: 40px;
                width: 100%;
            }
            caption{
                background: black;
                color: white;
                font-weight: 600;
                padding: 10px;
                font-size: 16px;
            }
            th{
                text-align: center;
                padding: 5px;
                border-bottom: 1px solid grey;
                font-weight: 600;
            }
            td{
                padding: 5px 10px;
                text-align: center;
            }
            th:nth-child(2n),td:nth-child(2n){
                background: aliceblue;
            }
        </style>
        <div class="row">
        <div class="col-sm-3">
			<div class="left-sidebar">
				<!--category-productsr-->
				<div class="category-products">
					<h2>Category Product</h2>
					<div class="panel-group category-products" id="accordian" style="margin-bottom: 0;">
						@foreach($category as $key => $cate )
						<div class="panel panel-default drop-down1">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a href="{{URL::to('/show-category-product/'.$cate->category_id)}}">{{ $cate->category_name }}</a>
								</h4>
							</div>
						</div>
						@endforeach
						<a href="" class="btn-dd1" style="font-size: 16px; color: black; font-weight: bold; display: block; margin: 20px;">View more<i class="fa fa-chevron-circle-right" aria-hidden="true" style="margin-left: 10px;"></i></a>
					</div>
				</div>
				<!--/category-products-->

				<!--brands_products-->
				<div class="brands_products">
					<h2>Brands Product</h2>
					<div class="brands-name"> 
						<ul class="nav nav-pills nav-stacked">
							@foreach($brand as $key => $bra )
							<li class="drop-down2">
								<a href="{{URL::to('/show-brands-products/'.$bra->brand_id)}}"> 
									{{ $bra->brand_name }}
								</a>
							</li>
							@endforeach
							<a href="" class="btn-dd2" style="font-size: 16px; color: black; font-weight: bold; display: block; margin: 20px 25px;">View more<i class="fa fa-chevron-circle-right" aria-hidden="true" style="margin-left: 10px;"></i></a>
						</ul>
					</div>
				</div>
				<!--/brands_products-->
			</div>
		</div>
            <!--features_items-->
            <div class="col-sm-9 padding-right" style="padding-top: 15px;">
                <h2 class="title text-center">Customer</h2>    
                <table>
                    <caption>YOUR INFORMATION</caption>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Shipping address</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($customer as $key => $ct )
                        <tr>
                            <td>{{  $ct->customer_name }}</td>
                            <td>{{  $ct->customer_phone }}</td>
                            <td>{{  $ct->customer_email }}</td>
                            <td>{{  $ct->customer_address }}</td>
                            <td>
                                <button class="btn btn-primary" style="margin: 0;"> <a href="#" style="color: white;">Change</a> </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- end  -->
                <table>
                    <caption>YOUR ORDER</caption>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Total</th>
                            <th>Order status</th>
                            <th>Date</th>
                        </tr>
                    </thead> 
                    <tbody>
                    @foreach($order as $key => $or )
                        <tr style="border-bottom: 1px solid whitesmoke;">
                            <td>{{  $or->order_id }}</td>
                            <td>{{  $or->order_total }}</td>
                            <td>{{  $or->order_status }}</td>
                            <td>{{  $or->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
	</div>
</section> <!--/#cart_items-->
@endsection