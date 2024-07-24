@extends('layouts.appvv')
@section('title')	
	<a href="{{ route('home') }}">Home</a> 
@endsection

@section('navs')	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		@if(Auth::user())
			<li class="breadcrumb-item"><a href="{{ route('vv.all_in_one') }}">Home</a></li>
		@else
			<li class="breadcrumb-item"><a href="{{ route('authenticate.vv') }}">Home</a></li>
		@endif
		<li class="breadcrumb-item active" aria-current="page">VV - Prayer Points</li>
	  </ol>
	</nav>
@endsection


@section('content')	
	
	
	{!! Form::open(['url' => route('prayer_point.save', $prayer_point->id)]) !!}
	<div class="container">
		<div class="p-2 bg-light">
			<h2 class="card bg-success text-white text-center p-3">Vidhyarthi Velugu - Prayer Points</h2>
			<h5 class="text-center p-1">(Share only 3 Praise & 3 Prayer Points, Transformation Stories, Articles etc... to be published in Vidhyarthi Velugu).</h5>
			<p class="text-center">Kindly check once the Districts and Places of Hyderabad and Rangareddy Regions while sending the Prayer Points</p>
		</div>
			<div class="col-lg-12  text-danger">
				Note: * Mark as Mandatory.
			</div>
				<div class="row p-4">
					<div class="col-lg-6">
						<div class="row">
							<div class="col-lg-10 mb-2">
								<label>{{ $prayer_point->nicenames['full_name'] }} * </label>
								{{ Form::text('full_name', old('full_name', $prayer_point->full_name), ['class' => 'form-control' ]) }}
								@if($errors->has('full_name'))
									<div class="text-danger">{{ $errors->first('full_name') }}</div>
								@endif
							</div>
						</div>
						<div class="row">
							<div class="col-lg-10 mb-2">
								<label>{{ $prayer_point->nicenames['email'] }} * </label>
								{{ Form::email('email', old('email', $prayer_point->email), ['class' => 'form-control' ]) }}
								@if($errors->has('email'))
									<div class="text-danger">{{ $errors->first('email') }}</div>
								@endif
							</div>
						</div>
						<div class="row">
							<div class="col-lg-10 mb-2">
								<label>{{ $prayer_point->nicenames['mobile'] }} * </label>
								{{ Form::number('mobile', old('mobile', $prayer_point->mobile), ['class' => 'form-control' ]) }}
								@if($errors->has('mobile'))
									<div class="text-danger">{{ $errors->first('mobile') }}</div>
								@endif
							</div>
						</div>
						<div class="row">
							<div class="col-lg-10 mb-2">
								<label>{{ $prayer_point->nicenames['eu_name'] }} * </label>
								{{ Form::text('eu_name', old('eu_name', $prayer_point->eu_name), ['class' => 'form-control' ]) }}
								@if($errors->has('eu_name'))
									<div class="text-danger">{{ $errors->first('eu_name') }}</div>
								@endif
							</div>
						</div>
						<div class="row">
							<div class="col-lg-10 mb-2">
								<label>{{ $prayer_point->nicenames['responsibility'] }} * </label>
								{{ Form::text('responsibility', old('responsibility', $prayer_point->responsibility), ['class' => 'form-control' ]) }}
								@if($errors->has('responsibility'))
									<div class="text-danger">{{ $errors->first('responsibility') }}</div>
								@endif
							</div>
						</div>
						<div class="col-lg-6 mb-2">
							<label>{{ $prayer_point->nicenames['region'] }}  * </label>
								{{ Form::select('region', AppHelper::options('cities'), old('region', $prayer_point->region), ['class' => 'form-control', 'onchange' => "loadOptions(this, 'category')"]) }}
									@if($errors->has('region'))
										<div class="text-danger">{{ $errors->first('region') }}</div>
									@endif
						</div>
						<div class="col-lg-6 mb-2">
							<label>{{ $prayer_point->nicenames['district'] }}  * </label>
								{{ Form::select('district', AppHelper::options('districts'), old('district', $prayer_point->district), ['class' => 'form-control', 'onchange' => "loadOptions(this, 'category')"]) }}
									@if($errors->has('district'))
										<div class="text-danger">{{ $errors->first('district') }}</div>
									@endif
						</div>
						
						<div class="row">
							<div class="col-lg-10 mb-2">
								<label>{{ $prayer_point->nicenames['place'] }} * </label>
								{{ Form::text('place', old('place', $prayer_point->place), ['class' => 'form-control' ]) }}
								@if($errors->has('place'))
									<div class="text-danger">{{ $errors->first('place') }}</div>
								@endif
							</div>
						</div>
						
						<div class="row">
						
							<div class="col-lg-10 mb-2">
								<label>{{ $prayer_point->nicenames['thank_god'] }}</label>
								{!! EasyForm::textarea('thank_god', '', old('thank_god', $prayer_point->thank_god), ['rows' => 5,'placeholder' => 'Thank God for'])!!}
							</div>
						</div>
						
						<div class="row">
							
							<div class="col-lg-10 mb-2">
								<label>{{ $prayer_point->nicenames['prayer'] }}</label>
								{!! EasyForm::textarea('prayer', '', old('prayer', $prayer_point->prayer), ['rows' => 5,'placeholder' => 'Pray for'])!!}
									@if($errors->has('prayer'))
										<div class="text-danger">{{ $errors->first('prayer') }}</div>
									@endif
							</div>
						
							
						</div>
					</div>
					<div class="col-lg-3 p-3 bg-light">
					  <h6><b>Hyderabad Region:</b></h6><br>
					  <h6>I) Hyderabad District</h6>
					  <ol>
						<li>Ibrahimpatnam</li>
						<li>Vanasthalipuram</li>
						<li>Hayatnagar</li>
						<li>Saidabad</li>
						<li>Dilsukhnagar</li>
						<li>LB Nagar</li>
						<li>Vidyanagar</li>
						<li>Charminar</li>
						<li>Koti</li>
						<li>Secunderabad</li>
						<li>Tarnaka (OU zone)</li>
						<li>Mehdipatnam</li>
						<li>Khairatabad</li>
						<li>Ameerpet</li>
						<li>Motinagar</li>
						<li>Sanathnagar</li>
					  </ol>

					  <h6>II) Medchal Malkajgiri District</h6>
					  <ol>
						<li>Ramanthapur</li>
						<li>Uppal</li>
						<li>Ghatkesar</li>
						<li>Nacharam</li>
						<li>Malkajgiri</li>
						<li>Sainikpuri</li>
						<li>Bowenpally</li>
						<li>IDPL</li>
						<li>Kompally</li>
						<li>Jeedimetla</li>
					  </ol>
					</div> 
					<div class="col-lg-3 p-3 bg-light">
					  <h6><b>Ranga Reddy Region:</b></h6>
					<br>
					  <h6>A) Cyberabad District</h6>
					  <ol>
						<li>Rajendra Nagar</li>
						<li>Maheswaram</li>
						<li>SUNCITY</li>
						<li>Hitech City</li>
						<li>HCU</li>
						<li>BHEL</li>
						<li>JNTU</li>
						<li>Kukatpally</li>
						<li>Chevella</li>
						<li>Shankarpally</li>
						<li>Shamshabad</li>
					  </ol>

					  <h6>B) Vikarabad District</h6>
					  <ol>
						<li>Vikarabad zone</li>
						<li>Tandur zone</li>
					  </ol>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 mb-2 text-center">
					<button class="btn btn-success">Submit</button>
					</div>
				</div>
			</div>
	{!! Form::close() !!}		
 
@endsection	