@extends('layouts.appvv')

@section('title')	
	
@endsection

@section('navs')	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		@if(Auth::user())
			<li class="breadcrumb-item"><a href="{{ route('vv.all_in_one') }}">Home</a></li>
		@else
			<li class="breadcrumb-item"><a href="{{ route('authenticate.vv') }}">Home</a></li>
		@endif
		<li class="breadcrumb-item active" aria-current="page">VV Subscription Details New/Renewal</li>
	  </ol>
	</nav>
@endsection


@section('content')
<style>
	label {
		line-height: 2;
		
	}
	input {
		width:15px;
		
	}
	.form-check{
		line-height:2;
		padding:1px;
		
		font-size:13px;
	}
	.text-dark{
		font-size:18px;
	}
	p{
		line-height: 1.4;
	}
	
</style>

	{!! Form::open(['url' => route('new_subscription.save', $new_subscription->id)]) !!}
		@csrf
	{!! EasyForm::setErrors($errors) !!}

	<div class="container">
		<div class=" row p-4 bg-light">
			<h2 class="card bg-primary text-white text-center p-3">Vidhyarthi Velugu New Subscription</h3>
		</div>
			
			<div class="row p-4 bg-light">
				<text style="font-size:25px;">Subscription Details (Revised)</text>
				
				<div class="col-lg-3 p-2 ">
					<img class="float-center" src="{{ asset('images/payment-scan-code.jpg') }}" width="100%">
				</div>
				
				<div class="col-lg-1"></div>
				<div class="col-lg-4 p-2 bg-light">
					<b>UESI - TS Publication Trust<br> Account Details</b>
					
					<p><br>Name:  UESI Publication Trust</p>
					<b>	A/c No:  0624101037187</b>
					<p>	Bank:  Canara Bank<br>
						Branch:  East Marredpally, Secunderabad<br>
						IFSC:  CNRB0000624<br>
						Kindly inform office or SMS <br>after depositing the amount 
						Ph.7993397630</p>

					<b>Please Furnish the Details</b>
					<p>Address, Pincode, Phone Number,<br> Mail Id, Payment Transaction Details</p>
				</div>
				
				<div class="col-lg-4 p-1 bg-light">
					<b>Annual</b>
					<p>For Students<br>
					Hard+Soft copy -150/-</p>
				
					<p>For Graduates</br>
					 Hard+soft copy - 300/-</p>
					<b>Life (10 Years)</b>
					<p>For Students & Graduates<br>
					Hard+Soft Copy - 2000/-</p>
				
					<b>Overseas (10 Years)</b><br>
					<p>Soft copy - 2000/-</p>
					
					<b>For 3 Years</b>
					<p>STUDENTS  - 450/- <br>
					GRADUATES  - 900/-</p>
				</div>
			
				
			</div>
			
			<br>
			<div class="col-lg-12 text-danger">
				Note: * Mark as Mandatory.
			</div>
			
			<div class="row mt-4 p-2">
				<div class="col-lg-6 p-2">
					
					<label class="text-dark">{{ $new_subscription->nicenames['email'] }} *</label>
						{{ Form::text('email', old('email', $new_subscription->email), ['class' => 'form-control', 'type' => 'email']) }}
						@if($errors->has('email'))
							<div class="text-danger">{{ $errors->first('email') }}</div>
						@endif
				
					<label class="text-dark">{{ $new_subscription->nicenames['full_name'] }} *</label>
						{{ Form::text('full_name', old('full_name', $new_subscription->full_name), ['class' => 'form-control']) }}
						@if($errors->has('full_name'))
							<div class="text-danger">{{ $errors->first('full_name') }}</div>
						@endif
				
					<label class="text-dark">{{ $new_subscription->nicenames['address'] }}  * </label>
						{!! EasyForm::textarea('address', '', old('address', $new_subscription->address), ['rows' => 2]) !!}
							@if($errors->has('address'))
								<div class="text-danger">{{ $errors->first('address') }}</div>
							@endif
					<label class="text-dark">{{ $new_subscription->nicenames['state'] }} *</label>
						{!! EasyForm::radio('state', '', old('state', $new_subscription->state), AppHelper::options('subscription_state')) !!}
							@if($errors->has('state'))
								<div class="text-danger">{{ $errors->first('state') }}</div>
							@endif
							
					<label class="text-dark">{{ $new_subscription->nicenames['district'] }}  * </label>
						{{ Form::select('district', AppHelper::options('districts'), old('district', $new_subscription->district), ['class' => 'form-control', 'onchange' => "loadOptions(this, 'category')"]) }}
							@if($errors->has('district'))
								<div class="text-danger">{{ $errors->first('district') }}</div>
							@endif
					
					<label class="text-dark">{{ $new_subscription->nicenames['pincode'] }} *</label>
						{{ Form::number('pincode', old('pincode', $new_subscription->pincode), ['class' => 'form-control']) }}
							@if($errors->has('pincode'))
								<div class="text-danger">{{ $errors->first('pincode') }}</div>
							@endif
					
					
						
					<label class="text-dark">{{ $new_subscription->nicenames['other_state'] }} </label>
						{{ Form::text('other_state', old('other_state', $new_subscription->other_state), ['class' => 'form-control']) }}
							@if($errors->has('other_state'))
								<div class="text-danger">{{ $errors->first('other_state') }}</div>
							@endif
					
					<label class="text-dark">{{ $new_subscription->nicenames['mobile_num'] }} *</label>
					   {{ Form::number('mobile_num', old('mobile_num', $new_subscription->mobile_num), ['class' => 'form-control']) }}
						   @if($errors->has('mobile_num'))
								<div class="text-danger">{{ $errors->first('mobile_num') }}</div>
							@endif
					
				</div>
				
				<div class="col-lg-6 p-3">
				
				
					<label class="text-dark">{{ $new_subscription->nicenames['type_of_subscription'] }}  * </label>
						{!! EasyForm::radio('type_of_subscription', '', old('type_of_subscription', $new_subscription->type_of_subscription), AppHelper::options('type_new')) !!}
							@if($errors->has('type_of_subscription'))
								<div class="text-danger">{{ $errors->first('new_subscription') }}</div>
							@endif
							
					<label class="text-dark">{{ $new_subscription->nicenames['amount'] }} *</label>
					{!! EasyForm::radio('amount', '', old('amount', $new_subscription->amount), AppHelper::options('new_subscription_amount')) !!}
						@if($errors->has('amount'))
							<div class="text-danger">{{ $errors->first('amount') }}</div>
						@endif<br>
					
					<label class="text-dark">{{ $new_subscription->nicenames['date'] }} *</label>
						{{ Form::date('date', old('date', $new_subscription->date), ['class' => 'form-control','type' => 'date']) }}
						@if($errors->has('date'))
							<div class="text-danger">{{ $errors->first('date') }}</div>
						@endif
				
					<label class="text-dark">{{ $new_subscription->nicenames['reference_number'] }} *</label>
					{{ Form::text('reference_number', old('reference_number', $new_subscription->reference_number), ['class' => 'form-control']) }}
					   
					   @if($errors->has('reference_number'))
							<div class="text-danger">{{ $errors->first('reference_number') }}</div>
						@endif
				
				</div>	
					
			</div>		
		</div>
		
		<div class="row">
		   <div class="col-lg-12 text-center p-2">
			   {{Form::submit('Submit', ['class' => 'btn btn-success']) }}
		   </div>
		</div> 
			
	
	{!! Form::close() !!}		
	
@endsection	
