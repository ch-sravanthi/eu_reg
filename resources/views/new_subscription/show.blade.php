@extends('layouts.appvv_auth')
@section('title')	
	<a href="#">New Subscription Details</a> 
@endsection

@section('navs')	
	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('vv.all_in_one') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('new_subscriptions') }}">VV - Subscription</a></li>
		
	  </ol>
	</nav>
@endsection

@section('content')	

<div class="table-responsive">
	<div class="form form-view">
		<div class="table-wrapper">
			<fieldset class="section">
				<table class="table table-bordered m-0">
					<tr>
						<th style="width:30%;">{{ $new_subscription->label('full_name') }}</th>	
						<td style="width:30%;">{{ $new_subscription->full_name }}</td>
							
						<th style="width:20%;">{{ $new_subscription->label('email') }}</th>	
						<td style="width:20%;">{{ $new_subscription->email }}</td>	
					</tr>
					
					<tr>
						<th>{{ $new_subscription->label('address') }}</th>	
						<td>{{ $new_subscription->address }}</td>
						<th>{{ $new_subscription->label('district') }}</th>
						<td>{{ $new_subscription->district }}</td>
					</tr>	
					
					<tr>
						<th>{{ $new_subscription->label('pincode') }}</th>	
						<td>{{ $new_subscription->pincode }}</td>
						
						@if($new_subscription->state)
							<th>{{ $new_subscription->label('state') }}</th>
							<td>{{ $new_subscription->state }} 	</td>
						@else
							<th>{{ $new_subscription->label('state') }}</th>					
							<td>{{ $new_subscription->other_state }}	</td>
						@endif
					
					</tr>
					
					<tr>
						<th>{{ $new_subscription->label('mobile_num') }}</th>	
						<td>{{ $new_subscription->mobile_num }}</td>
						<th>{{ $new_subscription->label('type_of_subscription') }}</th>	
						<td>{{ $new_subscription->type_of_subscription }}</td>
					</tr>	
					
					<tr>
						<th>{{ $new_subscription->label('amount') }}</th>
						<td>{{ $new_subscription->amount }}</td>
						<th>{{ $new_subscription->label('date') }}</th>	
						<td>{{ $new_subscription->date }}</td>
					</tr>
					
					<tr>
						<th>{{ $new_subscription->label('reference_number') }}</th>
						<td>{{ $new_subscription->reference_number }}</td>
						<th>Posted On</th>	
						<td>{!! date('d M Y', strtotime($new_subscription->created_at)) !!}</td>
					</tr>
					
				</table>
			</fieldset> 
		</div>
		
	</div>
</div>
@endsection

	
					
					
			