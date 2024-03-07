@extends('layouts.app')
@section('title')
	

@endsection
@section('navs')

@endsection
@section('content')	
	<div class="container">
		<div class="card card-body ">
			<div class="table-responsive">
				<div class="col-lg-2">
					<b class = "text-dark">Job Information </b><div class="badge bg-info"> {{ $blogs->total() }} </div></a>
				</div>
					
				<div class="col-lg-10 text-right mb-2">
					{!! Form::open(['method' => 'get', 'class' => 'd-flex']) !!}
					
					<?php $options =  ['General' => 'General', 'IT-Sowftware' => 'IT-Sowftware', 'Pharma-Medical' => 'Pharma-Medical', 'Teaching' => 'Teaching', 'Walk-In' => 'Walk-In', 'Non IT' => 'Non IT',];?>
					{!! Form::text('blog_title', request()->blog_title, ['class' => ' mr-2', 'placeholder' => 'Title']) !!}&nbsp;
					{!! Form::text('description', request()->description, ['class' => ' mr-2', 'placeholder' => 'Job Description']) !!} &nbsp;
						
					{!! Form::select('category', $options, request()->category, ['class' => ' mr-2', 'placeholder' => 'Select Category']) !!}&nbsp;
								<button class = "btn btn-primary btn-sm mr-2">Search</button>
					&nbsp;
					<a class = "btn btn-sm btn-primary mr-2" href = "{{ route('blog.my_index') }}">Reset</a>&nbsp;
					<a class="btn btn-sm btn-primary mr-2" href="{{url('blog/create')}}"> <i class="bi bi-plus-circle"></i> Post a Job</a>	
					
				{!! Form::close() !!}	
				</div>
			</div>
		</div>
				
		<div class="card card-body table-wrapper">
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						 <tr>
							<th>Sno</th>
							<th>Job Title</th>
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
						<th>{{ $s++ }}</th>
						<td> 
							<a href="{{ url('blog/my_show/'.$blog->id) }}">
								{{ $blog->blog_title }}
							</a>
						</td>
						
						<td>{{ $blog->category }}</td>
						<td>{{ $blog->created_at }}</td>
						<td>{{ $blog->status }}</td>
						<td>
						<?php //var_dump(Auth::user());die();?>
						
							<a href="{{ url('blog/edit/'.$blog->id) }}"class="btn btn-sm btn-primary" ><i class = "bi bi-pen"></i></a>
						
							<?php $route = url('blog/delete/'.$blog->id)?>
							<a href="#" onclick="deleteRow('{{ $route }}')" class="btn btn-danger"><i class="bi bi-trash"></i></a>
						
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