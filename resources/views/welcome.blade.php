@extends('layouts.appuser')

@section('title')
	
@endsection

@section('navs')

@endsection

@section('content')
	<div class="card card-body text-center m-3">
		
		<div class="container">
			<div class=" container row mb-1">
				<div class="col-lg-2">
					<b class = "text-dark">Jobs Posted </b>
					<div class="badge bg-info"> {{ $blogs->total() }} </div></a>
				</div>
				
				<div class="col-lg-10 text-right mb-2">
					{!! Form::open(['method' => 'get', 'class' => 'd-flex']) !!}
					
					<?php $options =  ['General' => 'General', 'IT-Sowft Ware' => 'IT-Sowft Ware', 'Pharma-Medical' => 'Pharma-Medical', 'Teaching' => 'Teaching', 'Non IT' => 'Non IT',];?>
					{!! Form::text('blog_title', request()->blog_title, ['class' => ' mr-2', 'placeholder' => 'Job Title']) !!}&nbsp;
					{!! Form::text('description', request()->description, ['class' => ' mr-2', 'placeholder' => 'Job Description']) !!} &nbsp;
						
					{!! Form::select('category', $options, request()->category, ['class' => ' mr-2', 'placeholder' => 'Select Category']) !!}&nbsp;
								<button class = "btn btn-primary btn-sm mr-2">Filter</button>
					&nbsp;
					<a class = "btn btn-sm btn-primary mr-2" href = "{{ route('welcome') }}">Reset</a>&nbsp;
					<a class="btn btn-sm btn-primary mr-2" href="{{url('blog/create')}}">Add</a>			
					
				{!! Form::close() !!}	
				</div>
			</div>
			
			<div class="card card-body ">
				<div class="table-responsive">
					<table class="table table-striped table-hover table-bordered">
						<thead>
							 <tr>
								<th>S.No</th>
								<th>Details</th>
								<th>Job Title</th>
								<th>Job Category</th>
								<th>Location</th>
								<th>Posted On</th>
							 </tr>
						</thead>
						<?php $s=1;?>
						@foreach($blogs as $blog)
						<?php $opt = AppHelper::options('categories'); 	?>
							<tr>
								<th>{{ $s++ }}</th>
								<td>	
									<img src="{{ url('viewfile/'.$blog->image_1) }}" style="background-image: url();width:100px; height:auto;border:1px solid #F8F8F8;"/>
								</td>
								<td> 
									<a href="{{ url('blog/show/'.$blog->id) }}">
										{{ $blog->blog_title }} </a>
								</td>
								<td>{{ $blog->category }}</td>
								<td>{{ $blog->location}}</td>
								<td>{{ $blog->created_at}}</td>
							</tr>
						@endforeach
					</table>
					{{ $blogs->withQueryString()->links() }}
				</div>
			</div>
		</div>
	</div>
		
@endsection