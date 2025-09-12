@extends('layouts.app_report')
@section('title')	
	<a href="{{ route('home') }}">Home</a> 
@endsection

@section('navs')	
	<nav aria-label="breadcrumb">
	   
	</nav>
@endsection


@section('content')	
	<style>
		input {
			width:11px;
		}
		.form-check{
			line-height:2;
		}
		label{
			font-size:17px;
				line-height:2;
		}
		.form-control{
			background-color:#fff9f9;
				 
		}
		.form-control:focus{
			background-color:#f3f6f8;
		}
	</style>
	
	{!! Form::open(['url' => route('egf_basic_info.save', $egf_basic_info->id)]) !!}
		
	<div class="container ">
		<div class="p-2 bg-light">
			<h4 class="card bg-cyan text-dark text-center p-3"> EGF Basic Information </h4>
		</div>
		<div class="col-lg-12  text-danger">
			Note: * Mark as Mandatory.
		</div>
		
		<div class="row p-3">
			<div class="col-lg-2 mb-2"> &nbsp; 	</div>
			<div class="col-lg-8 mb-2">
				<label class="form-label" for="year">{{ $egf_basic_info->niceNames()['year'] }} *</label>
					{{ Form::select('year', AppHelper::options('years'), old('year', $egf_basic_info->year), ['class' => 'form-control', 'onchange' => "loadOptions(this, 'year')"]) }}
						@if($errors->has('year'))
							<div class="text-danger">{{ $errors->first('year') }}</div>
						@endif
				<label class="form-label" for="region">{{ $egf_basic_info->niceNames()['region'] }} *</label>
					{{ Form::text('region', old('region', $egf_basic_info->region), ['class' => 'form-control']) }}
					@if ($errors->has('region'))
						<div class="text-danger">{{ $errors->first('region') }}</div>
					@endif
 
				<label class="form-label" for="district">{{ $egf_basic_info->niceNames()['district'] }} *</label>
					{{ Form::text('district', old('district', $egf_basic_info->district), ['class' => 'form-control']) }}
					@if ($errors->has('district'))
						<div class="text-danger">{{ $errors->first('district') }}</div>
					@endif
 
				<label class="form-label" for="revenue_division">{{ $egf_basic_info->niceNames()['revenue_division'] }} *</label>
					{{ Form::text('revenue_division', old('revenue_division', $egf_basic_info->revenue_division), ['class' => 'form-control']) }}
					@if ($errors->has('revenue_division'))
						<div class="text-danger">{{ $errors->first('revenue_division') }}</div>
					@endif
			 
				<label class="form-label" for="egf_name">{{ $egf_basic_info->niceNames()['egf_name'] }} *</label>
					{{ Form::text('egf_name', old('egf_name', $egf_basic_info->egf_name), ['class' => 'form-control']) }}
					@if ($errors->has('egf_name'))
						<div class="text-danger">{{ $errors->first('egf_name') }}</div>
					@endif

				<label class="form-label" for="egf_status">{{ $egf_basic_info->niceNames()['egf_status'] }} *</label>
					{{ Form::select('egf_status', ['Affiliated' => 'Affiliated', 'Provisionally Affiliated' => 'Provisionally Affiliated', 'Functional' => 'Functional', 'Contact' => 'Contact'], old('egf_status', $egf_basic_info->egf_status), ['class' => 'form-control']) }}
					@if ($errors->has('egf_status'))
						<div class="text-danger">{{ $errors->first('egf_status') }}</div>
					@endif

				<label class="form-label" for="egf_committee_formed">{{ $egf_basic_info->niceNames()['egf_committee_formed'] }} *</label>
					
					{{ Form::select('egf_committee_formed', ['Yes' => 'Yes', 'No' => 'No'], old('egf_committee_formed', $egf_basic_info->egf_committee_formed), ['class' => 'form-control']) }}
					@if ($errors->has('egf_committee_formed'))
						<div class="text-danger">{{ $errors->first('egf_committee_formed') }}</div>
					@endif
			</div>
			<div class="col-lg-2 mb-2"> &nbsp; </div>
		</div>	
		
		<div class="row">
			<div class="col-lg-12 mb-2 text-center">
			<button class="btn btn-success">Submit</button>
			</div>
		</div>
			
	</div>
	{!! Form::close() !!}		
 
@endsection	