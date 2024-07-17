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
					<a class = "btn btn-sm btn-primary mr-2" href = "{{ route('blog.jobportal') }}">Reset</a>&nbsp;
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
						<div class="row" style=" line-height: 2;">
							<a style=" font-size:22px; font-weight:500;text-transform:uppercase;" href="{{ url('jobportal/show/'.$blog->id) }}">
								{{ $blog->blog_title }} </a>
							<div class="col-sm-6" >
								<td>	
									<?php $img = $blog->image_1 ? url('viewfile/'.$blog->image_1) : asset('/images/default.png')?>
									<?php $img2 = $blog->image_2 ? url('viewfile/'.$blog->image_2) : null?>
									
									<?php $ext = pathinfo($blog->image_1, PATHINFO_EXTENSION); ?>
									@if($ext =='pdf')
										{!! EasyForm::viewFile('image_1', '', $blog->image_1) !!}	
									@else
									<a href="{{ $img }}">
										<img src="{{ $img }}" style="width:60%"/><br><br>
									</a>
									@endif
									
									<?php $ext = pathinfo($blog->image_2, PATHINFO_EXTENSION);?>
									@if($ext =='pdf')
										{!! EasyForm::viewFile('image_2', '', $blog->image_2) !!}	
									
									@else
										<a href="{{ $img2 }}">
											<img src="{{ $img2 }}"  style="width:60%"/>
										</a>
									@endif
									
									
								</td>
							</div>
							
							<div class="col-sm-6" >
								<td><i class="bi bi-stack"></i> &nbsp;{{ $blog->category }}</td><br>
								
								@if($blog->location)
									<td><i class="bi bi-geo-alt"></i> &nbsp;{{ $blog->location}}</td><br>
								@endif
								
								@if($blog->last_date)
									<td><i class="bi bi-calendar3"></i> &nbsp;{{ $blog->label('last_date') }} : {{ date('d M Y', strtotime($blog->last_date)) }}</td><br>
								@endif
							
								@if($blog->description)
								<i class="bi bi-chat-left-text"></i>&nbsp;
								{!! hyperlinks($blog->description) !!}
								@endif
								<br><br>
								
								<p style="color:grey;font-size:14px;"> <i class="bi bi-person-circle"></i> By {{ $blog->person_name }} at {!! date('d M Y', strtotime($blog->created_at)) !!} 
								</p>
							</div>
						</tr>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div><br>
	{{ $blogs->withQueryString()->links() }}
</div>
	<style>
		 svg,.shadow-sm{
			display:none;
		}
		.bg-white{
			background-color:#d77878 !important;
		}
	<style>
@endsection