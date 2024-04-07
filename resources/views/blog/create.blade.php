@extends('layouts.appuser')

@section('title')	
	<a href="{{ route('home') }}">Home</a> 
@endsection

@section('navs')	
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		@if(Auth::user())
			<li class="breadcrumb-item"><a href="{{ route('blog.my_index') }}">Home</a></li>
		@else
			<li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
		@endif
		<li class="breadcrumb-item active" aria-current="page">Submit Job Information</li>
	  </ol>
	</nav>
@endsection

@section('content')	
<style>
		
	label {
		line-height: 3;
	}
	</style>

<div class="container">

	<div class="table table-striped ">
	{!! Form::open(['url' => route('blog.save', [$blog->id]), 'id' => 'idForm', 'files' => true]) !!}	
	@csrf
		{!! EasyForm::setErrors($errors) !!}	
		<div class="col-lg-12  text-danger">
			Note: * Mark as Mandatory.
		</div>
			<?php $categories = AppHelper::options('categories');?>
			<div class="">
				<div class="card-header">
					<h6> Please Enter Job Details :</h6>
					<div class="row">
			
						<div class="col-lg-6 mb-2">
							<label>{{ $blog->nicenames['blog_title'] }} *</label>
								{{ Form::text('blog_title', old('blog_title', $blog->blog_title), ['class' => 'form-control' ]) }}
									@if($errors->has('blog_title'))
										<div class="text-danger">{{ $errors->first('blog_title') }}</div>
									@endif
						</div>
						<div class="col-lg-6 mb-2">
							<label>{{ $blog->nicenames['category'] }} *</label>
								{{ Form::select('category', AppHelper::options('categories'), old('category', $blog->category), ['class' => 'form-control', 'onchange' => "loadOptions(this, 'category')"]) }}
									@if($errors->has('category'))
										<div class="text-danger">{{ $errors->first('category') }}</div>
									@endif
						</div>
						<div class="col-lg-6 mb-2">
							<label>{{ $blog->nicenames['location'] }}</label>
								{{ Form::text('location', old('location', $blog->location), ['class' => 'form-control' ]) }}
									@if($errors->has('location'))
										<div class="text-danger">{{ $errors->first('location') }}</div>
									@endif
						</div>
						<div class="col-lg-6 mb-2">
							<label>{{ $blog->nicenames['last_date'] }}</label>
								{{ Form::date('last_date', old('last_date', $blog->last_date), ['class' => 'form-control' ]) }}
									@if($errors->has('last_date'))
										<div class="text-danger">{{ $errors->first('last_date') }}</div>
									@endif
						</div>
						
						<div class="col-lg-6 mb-2">
							<label>{{ $blog->nicenames['image_1'] }} (if any images like jpeg, jpg, png)</label>
								{!! Form::file('image_1', ['class' => 'form-control']) !!}
								@if ($errors->has('image_1'))
								<div class="text-danger">{{ $errors->first('image_1') }}</div>
									@endif
						</div>
						
						<div class="col-lg-6 mb-2">
							<label>{{ $blog->nicenames['image_2'] }} (if any images like jpeg, jpg, png)</label>
								{!! Form::file('image_2', ['class' => 'form-control']) !!}
								@if ($errors->has('image_2'))
								<div class="text-danger">{{ $errors->first('image_2') }}</div>
									@endif
						</div>
						
						<div class="col-lg-6 mb-2">
							<label>  </label>
								{{ Form::textarea('description', old('description', $blog->description), ['rows' => 5,'placeholder' => 'Job Description'],['class' => 'form-control' ]) }}
									@if($errors->has('description'))
										<div class="text-danger">{{ $errors->first('description') }}</div>
									@endif
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="">
				<div class="card-header">
					<h6>Please Enter Your Details :</h6>
					<div class="row">
						<div class="col-lg-4 mb-2">
							<label>{{ $blog->nicenames['person_name'] }} *</label>
							{{ Form::text('person_name', old('person_name', $blog->person_name), ['class' => 'form-control' ]) }}
								@if($errors->has('person_name'))
									<div class="text-danger">{{ $errors->first('person_name') }}</div>
								@endif
						</div>
						<div class="col-lg-4 mb-2">
							<label>{{ $blog->nicenames['person_mobile'] }} *</label>
								{{ Form::text('person_mobile', old('person_mobile', $blog->person_mobile), ['class' => 'form-control' ]) }}
									@if($errors->has('person_mobile'))
										<div class="text-danger">{{ $errors->first('person_mobile') }}</div>
									@endif
						</div>
						<div class="col-lg-4 mb-2">
							<label>{{ $blog->nicenames['person_email'] }} *</label>
								{{ Form::text('person_email', old('person_email', $blog->person_email), ['class' => 'form-control' ]) }}
									@if($errors->has('person_email'))
										<div class="text-danger">{{ $errors->first('person_email') }}</div>
									@endif
						</div>
					</div>
				</div>
			</div>
			
			
			
			<div class="row">
			   <div class="col-lg-12 text-center p-2">
				   {{Form::submit('Submit', ['class' => 'btn btn-success']) }}
			   </div>
			</div> 
		{!! Form::close() !!}		
	</div>	
</div>
@endsection	

