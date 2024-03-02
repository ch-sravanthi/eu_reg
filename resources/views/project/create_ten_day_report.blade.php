@extends('layouts.app')


@section('navs')	
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Report</li>
  </ol>
</nav>
@endsection

@section('content')	
	@include('project.tabs')
			
	
				{!! Form::open(array('url' => route('project.save_ten_day_report', [$model_name, $project->id]), 'method' => 'post')) !!}
					@csrf
					{!! EasyForm::setErrors($errors) !!}
					{!! EasyForm::setNoRows() !!}
					{!! EasyForm::setColSizes(3,3) !!}
					<div class="form">
						<h6>TTP Conducted Details</h6>	
						<div class="row">
						{!! EasyForm::date('ttp_conducted_from_date', $cdp_ttp_report->label('ttp_conducted_from_date'), old('ttp_conducted_from_date', $cdp_ttp_report->ttp_conducted_from_date), ['class' => 'dob'])!!}
							{!! EasyForm::date('ttp_conducted_to_date', $cdp_ttp_report->label('ttp_conducted_to_date'), old('ttp_conducted_to_date',  $cdp_ttp_report->ttp_conducted_to_date), ['class' => 'dob'])!!}
							</div>
						<div class="row">								
							
							{!! EasyForm::input('ttp_conducted_place', $cdp_ttp_report->label('ttp_conducted_place'), old('ttp_conducted_place',  $cdp_ttp_report->ttp_conducted_place)) !!}
							{!! EasyForm::numbers('ttp_attended_teachers_no', $cdp_ttp_report->label('ttp_attended_teachers_no'), old('ttp_attended_teachers_no',  $cdp_ttp_report->ttp_attended_teachers_no))!!}
							{!! EasyForm::input('coordinator_staff_attended', $cdp_ttp_report->label('coordinator_staff_attended'), old('coordinator_staff_attended',  $cdp_ttp_report->coordinator_staff_attended)) !!}
					</div>

					
						<h6>{{$cdp_ttp_report->label('tenday_classes_info')}}</h6>
						<div class="row">	
							{!! EasyForm::date('classes_conducted_from_date', $cdp_ttp_report->label('classes_conducted_from_date'), old('classes_conducted_from_date',  $cdp_ttp_report->classes_conducted_from_date), ['class' => 'dob'])!!}
							{!! EasyForm::numbers('tenday_conducted_teachers_no', $cdp_ttp_report->label('tenday_conducted_teachers_no'), old('tenday_conducted_teachers_no',  $cdp_ttp_report->tenday_conducted_teachers_no))!!}
							{!! EasyForm::numbers('tenday_volunteers_trained_no', $cdp_ttp_report->label('tenday_volunteers_trained_no'), old('tenday_volunteers_trained_no',  $cdp_ttp_report->tenday_volunteers_trained_no))!!}
					</div>		
						
					
						<h6>{{$cdp_ttp_report->label('tenday_classes_results_report')}}</h6>
						<div class="row">	
							{!! EasyForm::numbers('total_christian_no', $cdp_ttp_report->label('total_christian_no'), old('total_christian_no',  $cdp_ttp_report->total_christian_no))!!}
							{!! EasyForm::numbers('total_non_christian_no', $cdp_ttp_report->label('total_non_christian_no'), old('total_non_christian_no',  $cdp_ttp_report->total_non_christian_no))!!}
							{!! EasyForm::numbers('children_decision_made_no', $cdp_ttp_report->label('children_decision_made_no'), old('children_decision_made_no',  $cdp_ttp_report->children_decision_made_no))!!}
							{!! EasyForm::numbers('children_new_life_members_no', $cdp_ttp_report->label('children_new_life_members_no'), old('children_new_life_members_no',  $cdp_ttp_report->children_new_life_members_no))!!}
							{!! EasyForm::numbers('parents_attended_no', $cdp_ttp_report->label('parents_attended_no'), old('parents_attended_no',  $cdp_ttp_report->parents_attended_no))!!}
							{!! EasyForm::numbers('parents_decisions_no', $cdp_ttp_report->label('parents_decisions_no'), old('parents_decisions_no',  $cdp_ttp_report->parents_decisions_no))!!}
							{!! EasyForm::numbers('parents_new_life_no', $cdp_ttp_report->label('parents_new_life_no'), old('parents_new_life_no',  $cdp_ttp_report->parents_new_life_no))!!}
							{!! EasyForm::numbers('places_conducted', $cdp_ttp_report->label('places_conducted'), old('places_conducted',  $cdp_ttp_report->places_conducted))!!}
							{!! EasyForm::input('groups_reached', $cdp_ttp_report->label('groups_reached'), old('groups_reached',  $cdp_ttp_report->groups_reached))!!}
					</div>		
					
						<h6>{{$cdp_ttp_report->label('people_groups_communities')}}</h6>
					<div class="row">	
							{!! EasyForm::input('tenday_people_group_reached', $cdp_ttp_report->label('tenday_people_group_reached'), old('tenday_people_group_reached',  $cdp_ttp_report->tenday_people_group_reached))!!}
							{!! EasyForm::input('tenday_villages_reached', $cdp_ttp_report->label('tenday_villages_reached'), old('tenday_villages_reached',  $cdp_ttp_report->tenday_villages_reached))!!}
					</div>			
												
						<h6>{{$cdp_ttp_report->label('go_green_info')}}</h6>
					<div class="row">	
							{!! EasyForm::numbers('trees_planted_no', $cdp_ttp_report->label('trees_planted_no'), old('trees_planted_no',  $cdp_ttp_report->trees_planted_no))!!}
							{!! EasyForm::numbers('harvest_pit_digged_no', $cdp_ttp_report->label('harvest_pit_digged_no'), old('harvest_pit_digged_no',  $cdp_ttp_report->harvest_pit_digged_no))!!}
							{!! EasyForm::input('suggestions', $cdp_ttp_report->label('suggestions'), old('suggestions',  $cdp_ttp_report->suggestions))!!}
						</div>							
					<div class="py-3">
						<button type="button" class="btn btn-success" onclick="saveModel(this)">Save <span class="progressval"></span></button>
					</div>
				</div>
			{!! Form::close() !!}
		@include('project.tabs_close')	
@endsection	
