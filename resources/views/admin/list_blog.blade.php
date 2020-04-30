@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
	<div class="panel panel-default">
		<div class="panel-heading">
			LIST blog PRODUCT
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
						<th style="width:10px;">
							<label class="i-checks m-b-none">
								<input type="checkbox"><i></i>
							</label>
						</th>
						<th style="width:10%">blog name</th>
						<th style="width: 220px;">blog image</th>
						<th>Content</th>
						<th style="width:10%">Display</th>
						<th style="width:30px;"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($list_blog as $key => $blog)
					<tr>
						<td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
						<td>
							<span class="text-ellipsis">{{ $blog->blog_name }}</span>
						</td>
						<td><span class="text-ellipsis">
							<img src="public/upload/blog/{{ $blog->blog_image }}" width="200" height="100" style="margin: auto;">
						</span></td>						
						<td style="max-height: 100px; text-overflow: ellipsis; overflow: hidden; display: block; line-height: 21px;">{{ $blog->blog_content }}</td>
						<td><span class="text-ellipsis">
							<?php
								if($blog->blog_status == 0){
							?>
									<a href="{{URL::to('/active-blog/'.$blog->blog_id)}}">No</a>
							<?php
								}else{
							?>
									<a href="{{URL::to('/unactive-blog/'.$blog->blog_id)}}">Yes</a>
							<?php
								}
							?>
						</span></td>
						<td>
							<a href="{{URL::to('/edit-blog/'.$blog->blog_id)}}" class="active" ui-toggle-class="">
								<i class="fa fa-wrench text-success text-active"></i>
							</a>
							<a href="{{URL::to('/delete-blog/'.$blog->blog_id)}}" class="active" ui-toggle-class="" onclick="return confirm('Are you sure to delete?')">
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
				<div class="col-sm-7 text-center">
					{{ $list_blog->links() }}
				</div>
			</div>
		</footer>
	</div>
</div>
@endsection