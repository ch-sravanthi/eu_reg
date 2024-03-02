@extends('layouts.apppartner')

@section('title')
	{{ strtoupper($project_partner_bill->title()) }}
@endsection

@section('navs')

@endsection

@section('content')
	@include ('common.flash')
	@include ('common.errors')
		<div class="form my-0 py-0">
			{!! Form::open(['url' => route('project_partner_bill.save', [$project->name()]), 'files' => true]) !!}
			@csrf
				{!! EasyForm::setErrors($errors) !!}	
					
				{!! Form::hidden('previous_url', old('previous_url',URL::previous())) !!}					
				@include ('project_partner_bill.'.($project->name()).'.create')			
				
			{!! Form::close() !!}
		</div>
@endsection
