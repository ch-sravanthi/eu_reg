@extends('layouts.app')
@section('title')
	

@endsection
@section('navs')

@endsection
@section('content')	
	<div class="container">
		<div class="row">
			<div class="col-lg-4 mb-3">
					<b class = "text-dark">Jobs Posted </b>
					<div class="badge bg-info"> {{ $blogs->total() }} </div>
						
			</div>	
			<div class="col-lg-8 mb-3">
				<div class="d-lg-flex justify-content-end" style="width: 100%; overflow-x: auto;">
					{!! Form::open(['method' => 'get', 'class' => 'd-flex']) !!}
						{!! Form::text('search', request()->search, ['class' => ' mr-4', 'placeholder' => 'Title / Description']) !!}&nbsp;
						<button  class="btn btn-primary btn-sm mr-2">
							<i class="bi bi-search"></i>
						</button>&nbsp;
						<a class = "btn btn-sm btn-primary mr-2" href = "{{ route('blog.my_index') }}">Reset</a>&nbsp;
				
					{!! Form::close() !!}	&nbsp;
					</div>
			</div>
		</div>
		&nbsp;
				
		<div class="card card-body table-wrapper">
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						 <tr>
							<th>Sno</th>
							<th style="width:20%;">Details</th>
							<th style="width:20%;">Job Title </th>
							<th>Job Category</th>
							<th>Posted On</th>
							<th>Status</th>
							<th>Action</th>
						 </tr>
					</thead>
				<tbody>
				
				<?php $s=1;?>
				@foreach($blogs as $blog)
				<?php 
					
					$opt = AppHelper::options('categories');
					
					?>
					<tr>
						<th style="text-align:center;">{{ $s++ }}</th>
						<td style="text-align:center;">		
							<?php $img = $blog->image_1 ? url('viewfile/'.$blog->image_1) : asset('/images/default.png')?>
								<?php $img2 = $blog->image_2 ? url('viewfile/'.$blog->image_2) : null?>
								<a href="{{ $img }}">
									<img src="{{ $img }}" style="width: 40%"/>
								</a>
								<br>
								@if ($img2)
									<a href="{{ $img2 }}">
										<img src="{{ $img2 }}"  style="width: 40%"/>
									</a>
								@endif
						</td>
						<td style="text-align:justify-content-end;"> 
							<a href="{{ url('jobportal/my_show/'.$blog->id) }}">
								{{ $blog->blog_title }}
							</a>
							<?php $excerpt = AppHelper::excerpt($blog->description,55)?>
								<div title="{{ $excerpt != $blog->description ? $blog->description : '' }}" style="font-size:12px;">
									{{ $excerpt }}
								</div>
						</td>
						
						<td style="text-align:center;">{{ $blog->category }}</td>
						<td style="text-align:center;font-size:13px;">{!! date('d M Y', strtotime($blog->created_at)) !!} <br/>by {{ $blog->person_name }}</td>
						<td style="text-align:center;">{{ $blog->status }}</td>
						<td>
						<?php //var_dump(Auth::user());die();?>
						
							<a href="{{ url('jobportal/edit/'.$blog->id) }}"class="btn btn-sm btn-primary" ><i class = "bi bi-pen"></i></a>
						
							<?php $route = url('jobportal/delete/'.$blog->id)?>
							<a href="#" onclick="deleteRow('{{ $route }}')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
						
						</td>
					</tr>
					
				@endforeach
				</table>
			</div>
		</div>
	</div>
				
	<script>
		function deleteRow(route) {
		var result = confirm("Are you sure?");
			if(result) {
				location.href = route;
			}
		}
	</script>
			

@endsection