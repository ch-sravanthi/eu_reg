@extends('layouts.app')


@section('navs')	
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
	<?php $name = explode('_',$model_name)?>
    <li class="breadcrumb-item active" aria-current="page">{{strtoupper($name[0])}} {{strtoupper($name[1])}}</li> 
  </ol>
</nav>
@endsection

@section('content')	
	@include('project.tabs')
			
		@include ('layouts.map')
		
		{{ Form::open(['url' => route('project.save', [$project->model_name, isset($project->id) ? $project->id : null]), 'files' => true]) }}
			<div class="form">
				{!! EasyForm::setErrors($errors) !!}
				{!! EasyForm::setNoRows() !!}
				{!! EasyForm::setColSizes(2, 4) !!}
			@if(in_array($project->model_name,['al_project', 'ict_project', 'wep_project']))
				<div class="row">
					
					{!! EasyForm::select('state', $project->label('state'), old('state', $project->state), AppHelper::options('states')) !!}
					
					{!! EasyForm::dependent('district', $project->label('district'), old('district', $project->district), AppHelper::options('districts'), 'state')!!}						
					
					{!! EasyForm::checkbox('intrest', $project->label('intrest'), old('intrest', $project->intrest), AppHelper::options('program_request_intrest')) !!}
					
					{!! EasyForm::input('impact', $project->label('impact'), old('impact', $project->impact))!!}
			
				</div>
				
				<h6>{{$project->label('other_details_label')}}</h6>
				<div class="row">
					<?php $people_groups = AppHelper::autoOptions('people_groups')?>	

					{!! EasyForm::autocomplete("people_groups", $project->label('people_groups'), old("people_groups",  $project->people_groups), $people_groups, 'people_groups') !!}								
					
					<?php $class_language = AppHelper::autoOptions('languages')?>	
					{!! EasyForm::autocomplete('class_language', $project->label('class_language'), old('class_language', $project->class_language), $class_language, 'class_language')!!}
					
					<?php $languages = AppHelper::autoOptions('languages')?>	

					{!! EasyForm::autocomplete("languages", $project->label('languages'), old("languages",  $project->languages), $languages, 'languages') !!}		
				</div>
			@endif				
			@if($project->model_name == 'cdp_ttp_project')
				@include('project.cdp_ttp_other_details_create')
			@endif		
			
			<div class="py-3">
				<button type="button" class="btn btn-success" onclick="saveModel(this)">@include('layouts.loader') Save <span class="progressval"></span></button>
			</div>
		</div>

		{{ Form::close() }}
		
	@include('project.tabs_close')
@endsection