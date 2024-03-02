@extends('layouts.apppartner')
@section('title')
	
@endsection

@section('navs')
	<li class="nav-item active">
		<a class="nav-link" href="{{ route('field_staff_report.donation_sub_menu') }}"><i class="fas fa-list"></i> View </a>
	</li>
@endsection

@section('content')	
@include ('common.flash')

<div class="pb-3">
<div class="container">
	<div class="row justify-content-md-center">
						<h5>&nbsp;&nbsp;&nbsp;ARE YOU A FACILITATOR?</h5>
	</div>
</div>
<?php 
if($model_name=='al')
{
	$project_model='al_project';
	$ministry_general_donation_model='al_general_donation';
} 
elseif($model_name=='cdp')
{
	$project_model='cdp_project';
	$ministry_general_donation_model='cdp_general_donation';
}
?>
<div class="container">
	<div class="row justify-content-md-center">
	  <div class="col col-6 col-lg-1 mb-4">
				@if($model_name=='al')
					<div style="background-color:#298f07" onclick="location.href='{{ route('ministry_donation.create', [$project_model]) }}'">
				@elseif($model_name=='cdp')
					<div style="background-color:#298f07" onclick="location.href='{{ route('ministry_donation.create', [$project_model]) }}'">
				@endif
			<div class="card-body">
				<div class="block">
					<div class="txt" style="cursor: pointer;">
						<h6> YES </h6>
					</div>							
				</div>
			</div>
		  </div>
	  </div>
	  <div class="col col-6 col-lg-1 mb-4">
					<div style="background-color:#db1616" onclick="location.href='{{ route('donation.create', ['promotion_donor',$ministry_general_donation_model]) }}'">
			<div class="card-body">
				<div class="block">
					<div class="txt" style="cursor: pointer;">
						<h6> NO </h6>
					</div>		
				</div>
			</div>
		  </div>
	  </div>
	</div>
</div>
</div>

	

@endsection
 
 <style>
        li{
            cursor: pointer;
        }
		div.txt{
		 color:white; cursor: pointer;
		text-align:center;
		  font-weight: bold;
;
		}

    </style>