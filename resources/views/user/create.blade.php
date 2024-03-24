@extends('layouts.app')

@section('title')	
	<a href="{{ route('welcome') }}">Home</a> 
@endsection

@section('navs')	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('user.index') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">User Details </li>
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
		<div class="table table-striped">
			{!! Form::open(['url' => route('user.save', $user->id)]) !!}
					@csrf
			{!! EasyForm::setErrors($errors) !!}
			<div class="col-lg-12  text-danger">
				Note: * Mark as Mandatory.
			</div>
				<h6> Please Enter/edit User Details :</h6>
			<div class="">
				<div class="row">
					<div class="col-lg-6">
						<label>{{ $user->nicenames['name'] }}</label>
							{{ Form::text('name', old('name', $user->name), ['class' => 'form-control']) }}
							@if($errors->has('name'))
								<div class="text-danger">{{ $errors->first('name') }}</div>
							@endif
					</div>
					<div class="col-lg-6">
					   <label>{{ $user->nicenames['email'] }}</label>
					   {{ Form::text('email', old('email', $user->email), ['class' => 'form-control']) }}
						   
						   @if($errors->has('email'))
								<div class="text-danger">{{ $errors->first(email) }}</div>
							@endif
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
					   <label>{{ $user->nicenames['mobile'] }}</label>
						   {{ Form::text('mobile', old('mobile', $user->mobile), ['class' => 'form-control']) }}
						   @if($errors->has('mobile'))
								<div class="text-danger">{{ $errors->first('mobile') }}</div>
							@endif
					</div>
					<div class="col-lg-6">
				       <label>{{ $user->nicenames['role'] }}</label>
						{{ Form::select('role', [''=>'--Select Here--','Admin' => 'Admin'], old('role', $user->role),['class' => 'form-control']) }}
						@if($errors->has('role'))
								<div class="text-danger">{{ $errors->first('role') }}</div>
							@endif
					</div>
				</div>

				<div class="row">
					<div class="col-lg-6">
					  <label>{{ $user->nicenames['status'] }}</label>
							{{ Form::select('status', [''=>'','Active' => 'Active', 'Inactive' => 'Inactive',], old('status', $user->status),['class' => 'form-control']) }}
					</div>
				</div>
			
				<div class="row">
				   <div class="col-lg-12 text-center p-2">
					   {{Form::submit('Submit', ['class' => 'btn btn-success']) }}
				   </div>
				</div> 
			</div>
		</div>	
		{!! Form::close() !!}		
</div>	
@endsection	
