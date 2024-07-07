@extends('layouts.appvv_auth')

@section('content')	
<div class="d-flex mb-3">
		<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('vv.all_in_one') }}">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Address Change Information</li>
		</ol>
	</nav>
	
	</div>
<div class="table-responsive">
	<div class="form form-view">
		<div class="table-wrapper">
			<fieldset class="section">
				<table class="table table-bordered m-0">
					<tr>
						<th>Name</th>	
						<td>{{ $address_change->full_name }}</td>
							
						<th>PHONE NUMBER</th>	
						<td>{{ $address_change->phone_no }}</td>
					</tr>
					
					<tr>
						<th>Email</th>	
						<td>{{ $address_change->email }}</td>
							
						<th>OLD ADDRESS</th>	
						<td>{{ $address_change->old_address }}</td>
					</tr>
					
					
					<tr>
						<th>NEW ADDRESS</th>	
						<td>{{ $address_change->new_address }}</td>
						
						<th>PINCODE</th>	
						<td>{{ $address_change->pincode }}</td>
					</tr>
				</table>
			</fieldset> 
		</div>
		
	</div>
</div>
@endsection

	
					
					
			