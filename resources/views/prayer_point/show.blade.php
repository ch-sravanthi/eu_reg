@extends('layouts.appvv_auth')

@section('title')	
	<a href="#">Prayer Points</a> 
@endsection

@section('navs')	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('vv.all_in_one') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('prayer_points') }}">VV - Prayer Points</a></li>
	  </ol>
	</nav>
	
@endsection

@section('content')	

<?php
	
?>

	
<div class="table-responsive">
	<div class="form form-view">
		<div class="table-wrapper">
			<fieldset class="section">
				<table class="table table-bordered m-0">
					<tr>
						<th style="width:25%;">{{ $prayer_point->label('eu_name') }}</th>	
						<td style="width:25%;">{{ $prayer_point->eu_name }}</td>
						
						<th style="width:25%;">{{ $prayer_point->label('region') }}</th>	
						<td style="width:25%;">{{ $prayer_point->region }}</td>
						
					</tr>
					
					<tr>
						<th>{{ $prayer_point->label('district') }}</th>	
						<td>{{ $prayer_point->district }}</td>
							
						<th>{{ $prayer_point->label('place') }}</th>	
						<td>{{ $prayer_point->place }}</td>
					</tr>
					<tr>
						<th>{{ $prayer_point->label('thank_god') }}</th>	
						<td colspan=3>{{ $prayer_point->thank_god }}</td>
					<tr>
					
					</tr>		
						<th>{{ $prayer_point->label('prayer') }}</th>	
						<td colspan=3>{{ $prayer_point->prayer }}</td>
					</tr>
					
					<tr>	
						<th>{{ $prayer_point->label('full_name') }}</th>	
						<td>{{ $prayer_point->full_name }}</td>
						
						<th>{{ $prayer_point->label('email') }}</th>	
						<td>{{ $prayer_point->email }}</td>
					</tr>
					
					<tr>
						<th>{{ $prayer_point->label('mobile') }}</th>	
						<td>{{ $prayer_point->mobile }}</td>
							
						<th>{{ $prayer_point->label('responsibility') }}</th>	
						<td>{{ $prayer_point->responsibility }}</td>
					
					</tr>
					
					
					<tr>
						<th>Posted On</th>	
						<td colspan=3>{!! date('d M Y', strtotime($prayer_point->created_at)) !!}</td>
					</tr>
				</table>
			</fieldset> 
		</div>
			
		
	</div>
</div>
			
		
@endsection

	
					
					
			