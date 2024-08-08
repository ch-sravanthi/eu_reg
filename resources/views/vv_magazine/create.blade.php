@extends('layouts.appvv')


@section('navs')	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	  
		@if(Auth::user()->role == 'Admin')
			<li class="breadcrumb-item"><a href="{{ route('vv.all_in_one') }}">Home</a></li>
		@else
			<li class="breadcrumb-item"><a href="{{ route('vv_magazine.monthly_magazines') }}">Home</a></li>
		@endif
	
		<li class="breadcrumb-item active" aria-current="page">Upload Soft Copy</li>
	  </ol>
	</nav>
@endsection


@section('content')	
	{!! Form::open(['url' => route('vv_magazine.save', [$vv_magazine->id]), 'id' => 'idForm', 'files' => true]) !!}
	<div class="container my-2">
		<div class="p-2 bg-light">
			<h2 class="card bg-success text-white text-center p-3">Vidhyarthi Velugu - Prayer Points & Magazie</h2>
		</div>
		<div class="border my-3 p-4">
			<div class="card card-body mx-auto w-60">	
				<div class="col-lg-12 mb-2">
					<label>{{ $vv_magazine->nicenames['name_of_the_file'] }} * </label>
					{{ Form::text('name_of_the_file', old('name_of_the_file', $vv_magazine->name_of_the_file), ['class' => 'form-control' ]) }}
					@if($errors->has('name_of_the_file'))
						<div class="text-danger">{{ $errors->first('name_of_the_file') }}</div>
					@endif
				</div>
				<div class="col-lg-6 mb-2">
					<label>{{ $vv_magazine->nicenames['cover_page'] }} (if any images like jpeg, jpg, png)</label>
						{!! EasyForm::file('cover_page', '', old('cover_page', $vv_magazine->cover_page))!!}
						@if ($errors->has('cover_page'))
						<div class="text-danger">{{ $errors->first('cover_page') }}</div>
							@endif
				</div>
				<div class="col-lg-12 py-2">
					<label>{{ $vv_magazine->nicenames['magazine_month'] }} * </label>
					{{ Form::select('magazine_month', AppHelper::options('vv_months'), old('magazine_month', $vv_magazine->magazine_month), ['class' => 'form-control', 'onchange' => "loadOptions(this, 'magazine_month')"]) }}
					@if($errors->has('magazine_month'))
						<div class="text-danger">{{ $errors->first('magazine_month') }}</div>
					@endif
				</div>
				<div class="col-lg-12 py-2">
					<label>{{ $vv_magazine->nicenames['magazine_year'] }} * </label>
					{{ Form::select('magazine_year', AppHelper::options('vv_years'), old('magazine_year', $vv_magazine->magazine_year), ['class' => 'form-control', 'onchange' => "loadOptions(this, 'magazine_year')"]) }}
					@if($errors->has('magazine_year'))
						<div class="text-danger">{{ $errors->first('magazine_year') }}</div>
					@endif
				</div>
			
				<div class="col-lg-12 py-2">
					<div class="text-danger">(File type as Pdf, File Size as Upto 1Mb)</div>
					{!! EasyForm::file('prayer_copy', 'Prayer Points Attachment', old('prayer_copy', $vv_magazine->prayer_copy))!!}
				</div>
				
				<div class="col-lg-12 py-2">
					<div class="text-danger">(File type as Pdf, File Size as Upto 5Mb)</div>
					{!! EasyForm::file('magazine_copy', 'Magazine Edition', old('magazine_copy', $vv_magazine->magazine_copy))!!}
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