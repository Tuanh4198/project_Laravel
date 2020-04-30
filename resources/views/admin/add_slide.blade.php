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
			<header class="panel-heading">ADD NEW SLIDE PRODUCT</header>
			<div class="panel-body">
				<div class="position-center">
					<form role="form" action="{{URL::to('/save-slide')}}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="exampleInputEmail1">Slide name</label>
							<input type="text" name="slide_name" class="form-control" id="exampleInputEmail1" placeholder="Enter name blog" 
							data-validation="length"
							data-validation-length="min1"
							data-validation-error-msg="Enter name pleas!">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Slide image</label>
							<input type="file" name="slide_img" class="form-control" id="exampleInputEmail1"
							data-validation="mime size required" 
							data-validation-allowing="jpg, png"
							data-validation-max-size="30000kb"
							data-validation-error-msg-required="No image selected">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Display</label>
							<select name="slide_status" class="form-control input-sm m-bot15">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
						</div>
						<input type="submit" name="add-blog" class="btn btn-info" value="ADD NEW">
						<input type="reset" value="Reset" class="btn btn-info"/>	
					</form> 
					<?php
						$message = Session::get('message');
						if($message){
							echo '<span class="txt-alert" style="color:#27c24c;">',$message.'</span>';
							Session::put('message',null);
						}
					?>
				</div>				
			</div>
		</section>
    </div>
    <div class="col-lg-8">
    <div class="panel panel-default">
		<div class="panel-heading"> LIST SLIDE </div>
		<div class="table-responsive">
			<table class="table table-striped b-t b-light">
				<thead>
					<tr>
						<th>Name</th>
						<th>Images</th>
						<th>Display</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
                    @foreach($list_slide as $key => $value)
					<tr>
						<td>
							<span class="text-ellipsis">{{ $value->slide_name }}</span>
						</td>
						<td><span class="text-ellipsis">
							<img src="public/upload/slide/{{ $value->slide_img }}" width="300" height="150" style="margin: auto;">
						</span></td>
						<td><span class="text-ellipsis">
							<?php	if($value->slide_status == 0){	?>
									<a href="{{URL::to('/active-slide/'.$value->slide_id)}}">No</a>
							<?php	}else{	?>
									<a href="{{URL::to('/unactive-slide/'.$value->slide_id)}}">Yes</a>
							<?php	}	?>
						</span></td>
						<td>
							<a href="{{URL::to('/delete-slide/'.$value->slide_id)}}" class="active" ui-toggle-class="" onclick="return confirm('Are you sure to delete?')">
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
					{{ $list_slide->links() }}
				</div>
			</div>
		</footer>
	</div>
    </div>
</div>
@endsection