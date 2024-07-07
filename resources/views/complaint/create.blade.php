@extends('layouts.appvv')


@section('title')	
	<a href="{{ route('home') }}">Home</a> 
@endsection

@section('navs')	
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		@if(Auth::user())
			<li class="breadcrumb-item"><a href="{{ route('vv.all_in_one') }}">Home</a></li>
		@else
			<li class="breadcrumb-item"><a href="{{ route('authenticate.vv') }}">Home</a></li>
		@endif
			<li class="breadcrumb-item active">Add Complaint</li>
		</ol>
	</nav>
@endsection

@section('content')
<style>
	label {
		
		margin: 5px;
	}
</style>

	{!! Form::open(['url' => route('complaint.save',[$complaint->id]), 'files' => true]) !!}
	{!! EasyForm::setErrors($errors) !!}	
		
	<div class="container">
		<div class="p-2 bg-light">
			<h2 class="card bg-warning text-white text-center p-3">Complaints</h3>
		</div>
			<div class="col-lg-12 text-center  text-danger">
				Note: * Mark as Mandatory.
			</div>
			<div class="row mt-4">
		
				<div class="col-lg-3 mb-2">&nbsp;</div>
					<div class="col-lg-6 mb-2">
					
						<label class="form-label" for="title">{{ $complaint->nicenames['full_name'] }} *</label>
							{{ Form::text('full_name', old('full_name', $complaint->full_name), ['class' => 'form-control' ]) }}
					
							@if($errors->has('full_name'))
								<div class="text-danger">{{ $errors->first('full_name') }}</div>
							@endif
							
						<label class="form-label" for="title">{{ $complaint->nicenames['phone_no'] }} *</label>
							{{ Form::number('phone_no', old('phone_no', $complaint->phone_no), ['class' => 'form-control' ]) }}
							
							@if($errors->has('phone_no'))
								<div class="text-danger">{{ $errors->first('phone_no') }}</div>
							@endif
						
						<label>{{ $complaint->nicenames['email'] }} * </label>
							{{ Form::email('email', old('email', $complaint->email), ['class' => 'form-control' ]) }}
							@if($errors->has('email'))
								<div class="text-danger">{{ $errors->first('email') }}</div>
							@endif
							
						<label>{{ $complaint->nicenames['district'] }}  * </label>
							{{ Form::select('district', AppHelper::options('districts'), old('district', $complaint->district), ['class' => 'form-control', 'onchange' => "loadOptions(this, 'district')"]) }}
								@if($errors->has('district'))
									<div class="text-danger">{{ $errors->first('district') }}</div>
								@endif
							
						<label class="form-label" for="title">{{ $complaint->nicenames['complaint_message'] }} *</label>
							{!! EasyForm::textarea('complaint_message', '', old('complaint_message', $complaint->complaint_message), ['rows' => 4]) !!}
							
							@if($errors->has('complaint_message'))
								<div class="text-danger">{{ $errors->first('complaint_message') }}</div>
							@endif
					</div>
				<div class="col-lg-3 mb-2"> &nbsp;</div>
				
			</div>
	</div>	
			
		<div class="row justify-content-center">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
     
    
		{!! Form::close() !!}
@endsection

