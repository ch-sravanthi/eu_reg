@extends('layouts.appvv_auth')

@section('title')	
	<a href="#">Renewals Details</a> 
@endsection

@section('navs')	
	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('vv.all_in_one') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('renewals') }}">VV - Renewals</a></li>
		
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
						<th style="width:30%;">{{ $renewal->label('full_name') }}</th>	
						<td style="width:30%;">{{ $renewal->full_name }}</td>
							
						<th style="width:25%;">{{ $renewal->label('email') }}</th>	
						<td style="width:25%;">{{ $renewal->email }}</td>	
					</tr>
					
					<tr>
						<th>{{ $renewal->label('address') }}</th>	
						<td>{{ $renewal->address }}</td>
						<th>{{ $renewal->label('district') }}</th>
						<td>{{ $renewal->district }}</td>
					</tr>	
					
					<tr>
						<th>{{ $renewal->label('pincode') }}</th>	
						<td>{{ $renewal->pincode }}</td>
						
						@if($renewal->state)
							<th>{{ $renewal->label('state') }}</th>
							<td>{{ $renewal->state }} 	</td>
						@else
							<th>{{ $renewal->label('state') }}</th>					
							<td>{{ $renewal->other_state }}	</td>
						@endif
					
					</tr>
					
					<tr>
						<th>{{ $renewal->label('mobile_num') }}</th>	
						<td>{{ $renewal->mobile_num }}</td>
						<th>{{ $renewal->label('type_of_subscription') }}</th>	
						<td>{{ $renewal->type_of_subscription }}</td>
					</tr>	
					
					<tr>
						<th>{{ $renewal->label('amount') }}</th>
						<td>{{ $renewal->amount }}</td>
						<th>{{ $renewal->label('date') }}</th>	
						<td>{{ $renewal->date }}</td>
					</tr>
					
					<tr>
						<th>{{ $renewal->label('reference_number') }}</th>
						<td>{{ $renewal->reference_number }}</td>
					</tr>
					<tr>
						<th>Posted On</th>	
						<td colspan=3>{!! date('d M Y', strtotime($renewal->created_at)) !!}</td>
					</tr>
					
				</table>
			</fieldset> 
		</div>
		
	</div>
</div>
@endsection

	
					
					
			