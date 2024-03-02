@extends('layouts.apppartner')

@section('title')
	{{ strtoupper($ministry_donation->title()) }}
@endsection

@section('navs')

@endsection

@section('content')
	@include ('common.flash')
	@include ('common.errors')
		<div class="form my-0 py-0"> <?php //var_dump($promotion->name()); die();?>
			{!! Form::open(['url' => route('ministry_donation.save', [$project->name()]), 'files' => true, 'id' => 'myform']) !!}
				{!! EasyForm::setErrors($errors) !!}	
					
				{!! Form::hidden('previous_url', old('previous_url',URL::previous())) !!}					
				@include ('ministry_donation.'.($ministry_donation->name()).'.create')			
				
			{!! Form::close() !!}
		</div>
@endsection
