@extends('layouts.app_report')

@section('content')

	<br>
	
	<div class="row text-center">
		<div class="col-lg-4 mb-2">
			<div class="card bg-primary text-white" style="height:120px;">
				<div class="card-body" style="padding-top:50px;padding-bottom:50px;">  <a style="color:white; font-size:21px; " href="#">EGF Report 1 </a></div>
			</div>
		</div>
		<div class="col-lg-4 mb-2">
			<div class="card bg-secondary text-white" style="height:120px;">
				<div class="card-body" style="padding-top:50px;padding-bottom:50px;"> <a style="color:white; font-size:21px;" href="#">EGF Report 2</a></div>
			</div>
		</div>
		<div class="col-lg-4 mb-2">
			<div class="card bg-success text-white" style="height:120px;">
				<div class="card-body" style="padding-top:50px;padding-bottom:50px;"> <a style="color:white; font-size:21px;" href="#">EGF Report 3</a></div>
			</div>
		</div>
		
	</div>
	
		
	<br><br>
	<div class="text-center py-2" style= "background-color: #fbfbfb;border-top: 1px solid #bebbd7;">
		<div class="row">
			<div class="col-lg-12">
				<b style="display: flex; align-items: center; justify-content: center;color:#1c0e91; font-size:16px; line-height:1.2;font-family: 'Roboto', sans-serif;width:100%;"> 
				Copyright @ UESI TG EGF REPORTS. All rights reserved  <img src="{{ asset('images/logo.png') }}" style="width:100px;height:50px;"> 
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