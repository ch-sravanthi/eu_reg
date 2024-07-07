@extends('layouts.appvv')

@section('navs')	
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		@if(Auth::user())
			<li class="breadcrumb-item"><a href="{{ route('vv.all_in_one') }}">Home</a></li>
		@else
			<li class="breadcrumb-item"><a href="{{ route('authenticate.vv') }}">Home</a></li>
		@endif
			<li class="breadcrumb-item active">Add Address Change Request</li>
		</ol>
	</nav>
@endsection

@section('content')


	{!! Form::open(['url' => route('address_change.save',[$address_change->id]), 'files' => true]) !!}
	{!! EasyForm::setErrors($errors) !!}	
		
      
	<div class="container">
		<div class="p-2 bg-light">
			<h2 class="card bg-secondary text-white text-center p-3">Vidhyarthi Velugu - Address Change</h3>
		</div>
			<div class="col-lg-12  text-danger">
				Note: * Mark as Mandatory.
			</div>
				<div class="row">	
				<div class="col-lg-6 mb-2">
				
					<label class="form-label" for="title">{{ $address_change->nicenames['full_name'] }} *</label>
						{{ Form::text('full_name', old('full_name', $address_change->full_name), ['class' => 'form-control' ]) }}
				
						@if($errors->has('full_name'))
							<div class="text-danger">{{ $errors->first('full_name') }}</div>
						@endif
						
					<label class="form-label" for="title">{{ $address_change->nicenames['phone_no'] }} *</label>
						{{ Form::number('phone_no', old('phone_no', $address_change->phone_no), ['class' => 'form-control' ]) }}
						
						@if($errors->has('phone_no'))
							<div class="text-danger">{{ $errors->first('phone_no') }}</div>
						@endif
				
					<label class="form-label" for="title">{{ $address_change->nicenames['email'] }} *</label>
						{{ Form::text('email', old('email', $address_change->email), ['class' => 'form-control' ]) }}
				
						@if($errors->has('email'))
							<div class="text-danger">{{ $errors->first('email') }}</div>
						@endif
					
					<label class="form-label" for="title">{{ $address_change->nicenames['old_address'] }} *</label>
						{!! EasyForm::textarea('old_address', '', old('old_address', $address_change->old_address), ['rows' => 2]) !!}
						@if($errors->has('old_address'))
							<div class="text-danger">{{ $errors->first('old_address') }}</div>
						@endif
				</div>
				
				<div class="col-lg-6 mb-2">
					<label class="form-label" for="title">{{ $address_change->nicenames['new_address'] }} *</label>
					{!! EasyForm::textarea('new_address', '', old('new_address', $address_change->new_address), ['rows' => 6]) !!}
				
					<label class="form-label" for="title">{{ $address_change->nicenames['pincode'] }} *</label>
					{{ Form::number('pincode', old('pincode', $address_change->pincode), ['class' => 'form-control' ]) }}
				</div>
				</div>
			</div>
					<div class="row justify-content-center">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
		</div>	
			

		{!! Form::close() !!}
     
    
@endsection
