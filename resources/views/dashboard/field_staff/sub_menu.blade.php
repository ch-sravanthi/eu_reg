@extends('layouts.apppartner')
@section('title')
	SELECT PROJECT TYPE
@endsection

@section('navs')
	<li class="nav-item active">
		<a class="nav-link" href="{{ url('/') }}"><i class="fas fa-list"></i> View </a>
	</li>
@endsection

@section('content')	
					@include ('common.flash')
<div class="pb-3">
<div class="container">

	<div class="row justify-content-md-center">
		<div class="col col-12 col-lg-2 mb-4">
		  <div class="card bg-danger" onclick="location.href='{{ route('project_partner_bill.create', ['ict_project']) }}'">
			<div class="card-body">
				<div class="block">
					<div class="txt">
						<h6 style="color: white;">ICT</h6>
					</div>
								
				</div>
			</div>
		  </div>
	  </div>
	  <br/><br/>
	  <div class="col col-12 col-lg-2 mb-4">
		  <div style="background-color:#223A6F" onclick="location.href='{{ route('project_partner_bill.create', ['al_project']) }}'">
			<div class="card-body">
				<div style="width: white;">
					<div class="txt">
						<h6 style="color: white;">AL</h6>
					</div>
								
				</div>
			</div>
		  </div>
	  </div>
	  <div class="col col-12 col-lg-2 mb-4">
		  <div style="background-color:#7B33C7" onclick="location.href='{{ route('project_partner_bill.create', ['asc_project']) }}'">
			<div class="card-body">
				<div class="block">
					<div class="txt">
						<h6 style="color: white;">ASC</h6>
					</div>
								
				</div>
			</div>
		  </div>
	  </div>
	  <div class="col col-12 col-lg-2 mb-4">
		  <div style="background-color:#476824" onclick="location.href='{{ route('project_partner_bill.create', ['wep_project']) }}'">
			<div class="card-body">
				<div class="block">
					<div class="txt">
						<h6 style="color: white;">WEP</h6>
					</div>			
				</div>
			</div>
		  </div>
	  </div>
	  <div class="col col-12 col-lg-2 md-4">
		  <div style="background-color:#2D59F1" onclick="location.href='{{ route('project_partner_bill.create', ['cdp_ttp_conveyance']) }}'">
			<div class="card-body">
				<div class="block">
					<div class="txt">
						<h6 style="color: white;">10Day</h6>
					</div>
								
				</div>
			</div>
		  </div>
	  </div>
	   <div class="col col-12 col-lg-2 md-4">
		  <div style="background-color:#2D59F1" onclick="location.href='{{ route('project_partner_bill.create', ['cdp_ttp_Project']) }}'">
			<div class="card-body">
				<div class="block">
					<div class="txt">
						<h6 style="color: white;">CDP TTP</h6>
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