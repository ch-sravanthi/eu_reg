@extends('layouts.apppartner')

@section('title')
	{{ strtoupper( $title ?? 'Cash Donation' ) }}
@endsection

@section('navs')

@endsection

@section('content')
	@include ('common.flash')
	@include ('common.errors')
		<div class="form my-0 py-0"> <?php //var_dump($promotion->name()); die();?>
			{!! Form::open(['url' => route('cashdonation.save')]) !!}
			@csrf
				{!! EasyForm::setErrors($errors) !!}	
					
				{!! Form::hidden('previous_url', old('previous_url',URL::previous())) !!}
				@include ('cashdonation.donation.create')
				
			{!! Form::close() !!}
		</div>
@endsection
