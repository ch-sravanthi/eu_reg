@extends('layouts.app')
@section('title')
	
@endsection

@section('navs')
	Check Details
@endsection

@section('content')	
	@include('project.tabs')		
		<?php $incharge_id = isset($incharge->id) ? $incharge->id : '';?>
		{!! Form::open(['url' => route('incharge.create', [$project->model_name, $project->id, $type, $incharge_id]), 'files' => true, 'method' => 'get']) !!}
			
			{!! EasyForm::input('aadhar_id', $person->label('address_proof_id'), old('aadhar_id', request()->aadhar_id), ['required' => 'true'])!!}
			
			<button class="btn btn-success btn-sm px-2">Check Details</button>
				
			
		{!! Form::close() !!}	

	@include('project.tabs_close')
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