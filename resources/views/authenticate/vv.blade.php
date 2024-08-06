@extends('layouts.appvv')

@section('content')

	<br>
	
	<div class="row text-center">
		<div class="col-lg-4 mb-2">
			<div class="card bg-primary text-white" style="height:120px;">
				<div class="card-body" style="padding-top:50px;padding-bottom:50px;">  <a style="color:white; font-size:21px; " href="{{route('new_subscription.create_new')}}">SUBSCRIPTION <div class="text-gray small pt-3">(New/Renewal)</div></a></div>
			</div>
		</div>
		<div class="col-lg-4 mb-2">
			<div class="card bg-secondary text-white" style="height:120px;">
				<div class="card-body" style="padding-top:50px;padding-bottom:50px;"> <a style="color:white; font-size:21px;" href="{{route('address_change.create')}}">ADDRESS CHANGE</a></div>
			</div>
		</div>
		<div class="col-lg-4 mb-2">
			<div class="card bg-warning text-white" style="height:120px;">
					<div class="card-body" style="padding-top:50px;padding-bottom:50px"> <a style="color:white; font-size:21px;" href="{{route('complaint.create')}}">COMPLAINTS </a></div>
				</div>
		</div>
	</div>
	
	<div class="row text-center">
		<div class="col-lg-4 mb-2">
			<div class="card bg-dark text-white" style="height:120px;">
				<div class="card-body" style="padding-top:50px;padding-bottom:50px;">  <a style="color:white; font-size:21px; " href="{{route('feedback.create')}}">FEEDBACK</a> </div>
			</div>
		</div>
		<div class="col-lg-4 mb-2">
				<div class="card bg-success text-white" style="height:120px;">
					<div class="card-body" style="padding-top:50px;padding-bottom:50px;"> <a style="color:white; font-size:21px;" href="{{ route('prayer_point.create') }}">PRAYER POINTS</a></div>
				</div>
			</div>
		<div class="col-lg-4 mb-2">
			<div class="card bg-danger text-white" style="height:120px;">
				<div class="card-body" style="padding-top:50px;padding-bottom:50px;"> <a style="color:white; font-size:21px;" href="{{ route('vv_prayer_point.monthly_prayer_points') }}"> <i class="bi bi-eye"></i> View Soft Copy</a></div>
			</div>
		</div>
	</div>
	
			
	<!--
					
	<div class="row">
		<div class="col-2"></div>		
			<div class="col-8">
				<div class="card bg-success text-white" style="height:50px;">
					<div class="card-body"><a style="color:white; font-size:20px;font-weight:400;" href="#">PRAYER POINTS</a></div>
				</div>
			</div>
			<div class="col-2"></div>							
	</div>-->
	
		
	<br><br>
	<div class="text-center py-2" style= "background-color: #fbfbfb;border-top: 1px solid #bebbd7;">
		<div class="row">
			<div class="col-lg-12">
				<b style="display: flex; align-items: center; justify-content: center;color:#1c0e91; font-size:16px; line-height:1.2;font-family: 'Roboto', sans-serif;width:100%;"> 
				Copyright @ UESI Publication Trust, Telangana Branch. All rights reserved  <img src="images/vv-pub.png" style="width:120px;height:90px;"> 
				<?php //echo date("Y");?> </b>
			</div>
		</div>
	</div>
	
		
@endsection
<style>
		body{
			line-height:0.5 !important;
		}
		a{
			text-decoration:none !important;
		}
		.small, small {
			font-size: 16px !important;
		}
</style>