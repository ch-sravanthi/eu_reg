@extends('layouts.appvv_auth')

@section('title')	
	<a href="{{ route('home') }}">Home</a> 
@endsection

@section('navs')	
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('vv.all_in_one') }}">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Submit Complaints Information</li>
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
						<th>Name</th>	
						<td>{{ $complaint->full_name }}</td>
							
						<th>PHONE NUMBER</th>	
						<td>{{ $complaint->phone_no }}</td>
					</tr>
					
					<tr>
						<th>DISTRICT</th>	
						<td>{{ $complaint->district }}</td>
							
						<th>Email</th>	
						<td>{{ $complaint->email }}</td>
					</tr>
					<tr>
						<th>COMPLAINT MESSAGE</th>	
						<td>{{ $complaint->complaint_message }}</td>
					</tr>
				</table>
			</fieldset> 
		</div>
		
	</div>
</div>
@endsection

	
					
					
			