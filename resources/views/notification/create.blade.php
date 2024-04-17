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
			<li class="breadcrumb-item"><a href="{{ route('notification.index') }}">Home</a></li>
		@endif
			<li class="breadcrumb-item active" aria-current="page">Submit Notification Information</li>
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
	{!! Form::open(['url' => route('notification.save', [$notification->id]), 'id' => 'idForm', 'files' => true]) !!}	
	@csrf
		{!! EasyForm::setErrors($errors) !!}	
		<div class="col-lg-12  text-danger">
			Note: * Mark as Mandatory.
		</div>
			<?php $categories = AppHelper::options('categories');?>
			<div class="">
				<div class="card-header">
					<h6> Please Enter Notification Details :</h6>
					<div class="row">
			
						<div class="col-lg-6 mb-2">
							<label>{{ $notification->nicenames['description'] }}</label>
							{!! EasyForm::textarea('description', '', old('description', $notification->description), ['rows' => 5,'placeholder' => 'Notification Description'])!!}
						</div>
						
						<div class="col-lg-6 mb-2">
							<label>{{ $notification->nicenames['image_1'] }} (if any images like jpeg, jpg, png)</label>
								{!! Form::file('image_1', ['class' => 'form-control']) !!}
								@if ($errors->has('image_1'))
								<div class="text-danger">{{ $errors->first('image_1') }}</div>
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
							<label>{{ $notification->nicenames['person_name'] }} *</label>
							{{ Form::text('person_name', old('person_name', $notification->person_name), ['class' => 'form-control' ]) }}
								@if($errors->has('person_name'))
									<div class="text-danger">{{ $errors->first('person_name') }}</div>
								@endif
						</div>
						<div class="col-lg-4 mb-2">
							<label>{{ $notification->nicenames['person_mobile'] }} </label>
								{{ Form::text('person_mobile', old('person_mobile', $notification->person_mobile), ['class' => 'form-control' ]) }}
									@if($errors->has('person_mobile'))
										<div class="text-danger">{{ $errors->first('person_mobile') }}</div>
									@endif
						</div>
						<div class="col-lg-4 mb-2">
							<label>{{ $notification->nicenames['person_email'] }} </label>
								{{ Form::text('person_email', old('person_email', $notification->person_email), ['class' => 'form-control' ]) }}
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

