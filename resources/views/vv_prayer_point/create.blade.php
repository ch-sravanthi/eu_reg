@extends('layouts.appvv')


@section('navs')	
	<nav aria-label="breadcrumb">
	</nav>
@endsection


@section('content')	
	{!! Form::open(['url' => route('vv_prayer_point.save', [$vv_prayer_point->id]), 'id' => 'idForm', 'files' => true]) !!}
	<div class="container my-2">
		<div class="p-2 bg-light">
			<h2 class="card bg-primary text-white text-center p-3">Vidhyarthi Velugu - Prayer Points</h2>
		</div>
		<div class="border my-3 p-4">
			<div class="card card-body mx-auto w-50">	
				<div class="col-lg-12 mb-2">
					<label>{{ $vv_prayer_point->nicenames['name_of_the_file'] }} * </label>
					{{ Form::text('name_of_the_file', old('name_of_the_file', $vv_prayer_point->name_of_the_file), ['class' => 'form-control' ]) }}
					@if($errors->has('name_of_the_file'))
						<div class="text-danger">{{ $errors->first('name_of_the_file') }}</div>
					@endif
				</div>
				<div class="col-lg-12 py-2">
					<label>{{ $vv_prayer_point->nicenames['vv_month'] }} * </label>
					{{ Form::select('vv_month', AppHelper::options('vv_months'), old('vv_month', $vv_prayer_point->vv_month), ['class' => 'form-control', 'onchange' => "loadOptions(this, 'vv_month')"]) }}
					@if($errors->has('vv_month'))
						<div class="text-danger">{{ $errors->first('vv_month') }}</div>
					@endif
				</div>
				<div class="col-lg-12 py-2">
					<label>{{ $vv_prayer_point->nicenames['vv_year'] }} * </label>
					{{ Form::select('vv_year', AppHelper::options('vv_years'), old('vv_year', $vv_prayer_point->vv_year), ['class' => 'form-control', 'onchange' => "loadOptions(this, 'vv_year')"]) }}
					@if($errors->has('vv_year'))
						<div class="text-danger">{{ $errors->first('vv_year') }}</div>
					@endif
				</div>
			
				<div class="col-lg-12 py-2">
					<div class="text-danger">(File type as Pdf, File Size as Upto 1Mb)</div>
					{!! EasyForm::file('attachment_1', 'Attachment', old('attachment_1', $vv_prayer_point->attachment_1))!!}
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 py-4 text-center">
					<button class="btn btn-success">Submit</button>
				</div>
			</div>
		</div>
	</div>
	{!! Form::close() !!}		
 
@endsection	