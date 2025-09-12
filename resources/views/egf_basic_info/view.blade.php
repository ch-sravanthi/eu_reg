@extends('layouts.app_report')

@section('title')	
	<a href="{{ route('home') }}">Home</a> 
@endsection

@section('navs')	
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			 
		</ol>
	</nav>
@endsection


@section('content')	

<div class="table-responsive">	
	<div class="p-2 bg-light">
		<h4 class="card bg-cyan text-dark text-center p-3"> EGF Basic Information </h4>
	</div>
	<div class="form form-view">
		<div class="table-wrapper">
			<fieldset class="section">
				<table class="table table-bordered m-0">
					<tr>
						<th>Name Of The EGF</th>	
							<td>{{ $egf_basic_info->egf_name }}</td>
						<th>EGF ID</th>	
							<td>{{ $egf_basic_info->code }}</td>
					</tr>
					
					<tr>
						<th>Year</th>	
						<td>{{ $egf_basic_info->year }}</td>
							
						<th>Region  </th>	
						<td>{{ $egf_basic_info->region }}</td>
					</tr>
					
					<tr>
						<th>District</th>	
						<td>{{ $egf_basic_info->district }}</td>
							
						<th>Revenue Division</th>	
						<td>{{ $egf_basic_info->revenue_division }}</td>
					</tr>
					
					<tr>
						<th>EGF Status  </th>	
						<td>{{ $egf_basic_info->egf_status }}</td>
						
						<th>EGF Committee Formed  </th>	
						<td>{{ $egf_basic_info->egf_committee_formed }}</td>
					</tr>
				</table>
			</fieldset> 
		</div>
		
	</div>
</div>
@endsection

	
					
					
			