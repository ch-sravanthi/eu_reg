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
						<h5>&nbsp;&nbsp;&nbsp;Multiple Donations?</h5>
	</div>
</div>
<?php 
if($donation_name=='sb_sunday'||$donation_name=='coin_box'||$donation_name=='donation')
{
	$transaction_model='promotion_transaction';
	$donation_model='promotion_donor';
} 
elseif($donation_name=='magazine')
{
	$transaction_model='magazine_transaction';
	$donation_model='promotion_donor';
} 
?>
<div class="container">
	<div class="row justify-content-md-center">
	  <div class="col col-6 col-lg-1 mb-4">
					<div style="background-color:#298f07" onclick="location.href='{{ route('transaction.create', [$transaction_model,$donation_name]) }}'">
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
					<div style="background-color:#db1616" onclick="location.href='{{ route('donation.create', [$donation_model,$donation_name]) }}'">
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