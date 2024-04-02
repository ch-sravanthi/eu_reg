@extends('layouts.appuser')

@section('title')
	
@endsection

@section('navs')

@endsection

@section('content')
<?php
	function hyperlinks($text) {
		$v = preg_replace('@(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@', '<a target="ref" href="http$2://$4">$1$2$3$4</a>', $text);
		return nl2br($v);
	}
?>
	<div class="container">
		<div class="row">
			<div class="col-lg-4 mb-3">
				<b class = "text-dark">Jobs Posted </b>
				<div class="badge bg-info"> {{ $blogs->total() }} </div>
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
		<div class="card">
			 <div class="card-header">
				Job Details 
			</div>
		</div><br>
		<div class="table-responsive">
			@foreach($blogs as $blog) 
			<div class="row row-cols-1 row-cols-md-3 g-4">
				<div class="col-md-12">
				   <div class="card mb-3" style="border-radius:4%;  box-shadow: 0 2px 4px 0 rgba(0,0,0,0.2)">
					<div class="card-body">
						<tr>
							<th>
								<a style=" font-size:22px; font-weight:500;text-transform:uppercase;" href="{{ url('blog/show/'.$blog->id) }}">
								{{ $blog->blog_title }} </a>
							</th>
							<div class="row">
							<div class="col-sm-3"><i class="bi bi-stack"></i> {{ $blog->category }}</div>
							@if($blog->last_date)
								
							 <div class="col-sm-4"><i class="bi bi-calendar3"></i> {{ $blog->label('last_date') }} : {{ $blog->last_date}}</div>
							@endif
							@if($blog->location)
							 <div class="col-sm-5"><i class="bi bi-geo-alt"></i> {{ $blog->location}}</div>
							@endif
							</div><br/>
							<td>	
								@if($blog->image_1)
								<img src="{{ url('viewfile/'.$blog->image_1) }}" style="background-image: url();width:40%; height:auto;border:1px solid #F8F8F8;"/>
								@else
									<img src="{{ asset('/images/default.png')}}" style="background-image: url();width:30%; height:auto;border:1px solid #F8F8F8;"/>
								@endif
								@if($blog->image_2)<br>
									<br><img src="{{ url('viewfile/'.$blog->image_2) }}" style="background-image: url();width:40%; height:auto;border:1px solid #F8F8F8;"/>
								@endif
								<br/><br/>
								@if($blog->description)
								<i class="bi bi-chat-left-text"></i>
								{!! hyperlinks($blog->description) !!}
								@endif
							</td><br/><br/>
							
							<p style="color:grey;font-size:14px;"> <i class="bi bi-person-circle"></i> By {{ $blog->person_name }} at {!! date('d M Y', strtotime($blog->created_at)) !!} 
							</p>
						</tr>
					
					</div>
				  </div>
				</div>
			</div>
		@endforeach
		
			{{ $blogs->withQueryString()->links() }}
		</div>
	</div>
		
@endsection