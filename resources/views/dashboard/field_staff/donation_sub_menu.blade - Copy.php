@extends('layouts.apppartner')
@section('title')
	SELECT DONATION TYPE
@endsection

@section('navs')
	<li class="nav-item active">
		<a class="nav-link" href="{{ route('field_staff_report.main_menu') }}"><i class="fas fa-list"></i> View </a>
	</li>
@endsection

@section('content')	
@include ('common.flash')

<div class="pb-3">
<div class="container">
	<div class="row justify-content-md-center">
		<div class="col col-12 col-lg-2 mb-4">
		  <div class="card bg-danger" onclick="location.href='{{ route('donation.create', ['promotion_donor','sb_sunday']) }}'">
			<div class="card-body">
				<div class="block">
					<div class="txt">
						<h6>SB SUNDAY</h6>
					</div>		
				</div>
			</div>
		  </div>
	  </div>
	  <div class="col col-12 col-lg-2 mb-4">
		  <div style="background-color:#223A6F" onclick="location.href='{{ route('donation.create', ['promotion_donor','magazine']) }}'">
			<div class="card-body">
				<div class="block">
					<div class="txt">
						<h6>P&D M</h6>
					</div>							
				</div>
			</div>
		  </div>
	  </div>
	  <div class="col col-12 col-lg-2 mb-4">
		  <div style="background-color:#7B33C7" onclick="location.href='{{ route('donation.create', ['promotion_donor','coin_box']) }}'">
			<div class="card-body">
				<div class="block">
					<div class="txt">
						<h6>P&D BB</h6>
					</div>		
				</div>
			</div>
		  </div>
	  </div>
	  <div class="col col-12 col-lg-2 mb-4">
		  <div style="background-color:#476824" onclick="location.href='{{ route('donation.create', ['promotion_donor','donation']) }}'">
			<div class="card-body">
				<div class="block">
					<div class="txt">
						<h6>P&D G</h6>
					</div>		
				</div>
			</div>
		  </div>
	  </div>
	  <div class="col col-12 col-lg-2 mb-4">
		  <div  style="background-color:#2D59F1" onclick="location.href='{{ route('field_staff_report.donation_ft_sub_menu',['cdp']) }}'">
			<div class="card-body">
				<div class="block">
					<div class="txt">
						<h6>CDP DONATION</h6>
					</div>		
				</div>
			</div>
		  </div>
	  </div>
	  <div class="col col-12 col-lg-2 mb-4">
		  <div  style="background-color:#820585" onclick="location.href='{{ route('field_staff_report.donation_ft_sub_menu',['al']) }}'">
			<div class="card-body">
				<div class="block">
					<div class="txt">
						<h6>AL DONATION</h6>
					</div>		
				</div>
			</div>
		  </div>
	  </div>
	  <div class="col col-12 col-lg-2 mb-4">
		  <div class="card bg-success" onclick="location.href='{{  route('cashdonation.create') }}'">
			<div class="card-body">
				<div class="block">
					<div class="txt">
						<h6>DONATION</h6>
					</div>		
				</div>
			</div>
		  </div>
	  </div>
	  <div class="col col-12 col-lg-2 mb-4">
		  <div class="card bg-success" onclick="location.href=#">
			<div class="card-body">
				<div class="block">
					<div class="txt">
						<h6>OTHERS</h6>
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