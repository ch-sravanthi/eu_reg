@extends('layouts.appnew')
@section('title')
	
@endsection

@section('content')	
	<style>
		@media (max-width: 576px) {
			.wsm100 { width: 100%!important; }
		}
	</style>
	<?php $donationTypes = AppHelper::options('donations')?>
		<div class="card card-body text-center m-3">
			<div>

				
				<div class="float-end">
					@if (!$user)
						<a class="btn btn-outline-success" href="{{ url('/') }}"><i class="fas fa-arrow-circle-left"></i> Home</a>
					@else
						<b>Welcome {{ $user[1] }}</b> &nbsp; 
						<a class="btn btn-outline-success" href="{{ route('donation.home') }}"><i class="fas fa-times-circle"></i> Exit</a>
					@endif
				</div>
				<h5 class="mb-4">
					<span style="border-bottom: 2px solid #f00; display: inline-block!important;">
						Select Donation Type
					</span>
				</h5>
			</div>
			
			@include ('common.flash')
			
			<div class="d-lg-flex p-5">
			  @foreach($donationTypes as $type => $donation)
			  	  <a class="card card-body m-2 d-inline-block  wsm100" style="background-color: {{ $donation['color'] }}; color: #fff; text-decoration: none; font-size: 1.2em; font-weight: bold;" href="{{ route('donation.create', $type ) }}">
					{{ $donation['name'] }}
				  </a>
			  @endforeach
			</div>
	  </div>
@endsection