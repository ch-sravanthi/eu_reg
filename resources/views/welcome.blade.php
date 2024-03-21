@extends('layouts.appuser')

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
						<a class="btn btn-sm btn-warning mr-2" href="{{url('blog/create')}}"> <i class="bi bi-plus-circle"></i>Post a Job</a>
			</div>	
			<div class="col-lg-8 mb-3">
				<div class="d-lg-flex justify-content-end" style="width: 100%; overflow-x: auto;">
					{!! Form::open(['method' => 'get', 'class' => 'd-flex']) !!}
						{!! Form::text('search', request()->search, ['class' => ' mr-4', 'placeholder' => 'Title/Description/Any']) !!}&nbsp;
						<button  class="btn btn-primary btn-sm mr-2">
							<i class="bi bi-search"></i>
						</button>&nbsp;
					<a class = "btn btn-sm btn-primary mr-2" href = "{{ route('welcome') }}">Reset</a>&nbsp;
					{!! Form::close() !!}	&nbsp;
				</div>
			</div>
		</div>
		
		<div class="table-responsive">
			<table class="table table-striped table-hover table-bordered">
				<thead >
					 <tr style="text-align:center;">
						<th>S.No</th>
						<th style="width:20%;">Details</th>
						<th style="width:20%;">Job Title </th>
						<th>Job Category</th>
						<th>Location</th>
						<th>Posted On</th>
					 </tr>
				</thead>
				<?php $s=1;?>
				@foreach($blogs as $blog)
				<?php $opt = AppHelper::options('categories'); 	?>
					<tr>
						<th style="text-align:center;">{{ $s++ }}</th>
						<td style="text-align:center;">	
							@if($blog->image_1)
								<img src="{{ url('viewfile/'.$blog->image_1) }}" style="background-image: url();width:50%; height:auto;border:1px solid #F8F8F8;"/>
							@else
								<img src="{{ asset('/images/default.png')}}" style="background-image: url();width:70%; height:auto;border:1px solid #F8F8F8;"/>
							@endif
						</td>
						<td style="text-align:justify-content-end;"> 
							<a href="{{ url('blog/show/'.$blog->id) }}">
								{{ $blog->blog_title }} </a>
								<?php $excerpt = AppHelper::excerpt($blog->description,55)?>
									<div title="{{ $excerpt != $blog->description ? $blog->description : '' }}" style="font-size:12px;">
										{{ $excerpt }}
									</div>
						</td>
						<td style="text-align:center;">{{ $blog->category }}</td>
						<td style="text-align:center;">{{ $blog->location}}</td>
						<td style="text-align:center;">{{ $blog->created_at}} <br/>by {{ $blog->person_name }}</td>
					</tr>
				@endforeach
			</table>
			{{ $blogs->withQueryString()->links() }}
		</div>
	</div>
		
@endsection