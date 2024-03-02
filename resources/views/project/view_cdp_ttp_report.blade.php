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
		{!! EasyForm::setNoRows() !!}
		{!! EasyForm::setColSizes(3,3) !!}
		<?php $cdp_ttp_report = $project->cdp_ttp_report; //var_dump($project->cdp_ttp_report);die();?>
		
		
		<div class="form form-view">
			<h6>Ten Day Reports</h6>	
						<div class="row">	
							{!! EasyForm::viewSelect('ttp_support', $cdp_ttp_report->label('ttp_support'), old('ttp_support', $cdp_ttp_report->ttp_support), AppHelper::options('yes_no')) !!}
							{!! EasyForm::viewInput('no_of_programs', $cdp_ttp_report->label('no_of_programs'),old('no_of_programs', $cdp_ttp_report->no_of_programs)) !!}
							
							
							{!! EasyForm::viewInput('ttp_conducted_from_date', $cdp_ttp_report->label('ttp_conducted_from_date'), old('ttp_conducted_from_date', $cdp_ttp_report->ttp_conducted_from_date))!!}
							{!! EasyForm::viewInput('ttp_conducted_to_date', $cdp_ttp_report->label('ttp_conducted_to_date'), old('ttp_conducted_to_date', $cdp_ttp_report->ttp_conducted_to_date))!!}
							{!! EasyForm::viewInput('ttp_conducted_place', $cdp_ttp_report->label('ttp_conducted_place'), old('ttp_conducted_place', $cdp_ttp_report->ttp_conducted_place)) !!}
							{!! EasyForm::viewInput('ttp_attended_teachers_no', $cdp_ttp_report->label('ttp_attended_teachers_no'), old('ttp_attended_teachers_no', $cdp_ttp_report->ttp_attended_teachers_no))!!}
							{!! EasyForm::viewInput('coordinator_staff_attended', $cdp_ttp_report->label('coordinator_staff_attended'), old('coordinator_staff_attended', $cdp_ttp_report->coordinator_staff_attended)) !!}
					</div>

					
						<h6>10 Day Classes Information</h6>
						<div class="row">	
							{!! EasyForm::viewInput('classes_conducted_from_date', $cdp_ttp_report->label('classes_conducted_from_date'), old('classes_conducted_from_date', $cdp_ttp_report->classes_conducted_from_date))!!}
							{!! EasyForm::viewInput('tenday_conducted_teachers_no', $cdp_ttp_report->label('tenday_conducted_teachers_no'), old('tenday_conducted_teachers_no', $cdp_ttp_report->tenday_conducted_teachers_no))!!}
							{!! EasyForm::viewInput('tenday_volunteers_trained_no', $cdp_ttp_report->label('tenday_volunteers_trained_no'), old('tenday_volunteers_trained_no', $cdp_ttp_report->tenday_volunteers_trained_no))!!}
					</div>		
						
					
						<h6>Ten Day Classes Results (Report after 10day Classes)</h6>
						<div class="row">	
							{!! EasyForm::viewInput('total_christian_no', $cdp_ttp_report->label('total_christian_no'), old('total_christian_no', $cdp_ttp_report->total_christian_no))!!}
							{!! EasyForm::viewInput('total_non_christian_no', $cdp_ttp_report->label('total_non_christian_no'), old('total_non_christian_no', $cdp_ttp_report->total_non_christian_no))!!}
							{!! EasyForm::viewInput('children_decision_made_no', $cdp_ttp_report->label('children_decision_made_no'), old('children_decision_made_no', $cdp_ttp_report->children_decision_made_no))!!}
							{!! EasyForm::viewInput('children_new_life_members_no', $cdp_ttp_report->label('children_decision_made_no'), old('children_new_life_members_no', $cdp_ttp_report->children_decision_made_no))!!}
							{!! EasyForm::viewInput('parents_attended_no', $cdp_ttp_report->label('parents_attended_no'), old('parents_attended_no', $cdp_ttp_report->parents_attended_no))!!}
							{!! EasyForm::viewInput('parents_decisions_no', $cdp_ttp_report->label('parents_decisions_no'), old('parents_decisions_no', $cdp_ttp_report->parents_decisions_no))!!}
							{!! EasyForm::viewInput('parents_new_life_no', $cdp_ttp_report->label('parents_new_life_no'), old('parents_new_life_no', $cdp_ttp_report->parents_new_life_no))!!}
							{!! EasyForm::viewInput('places_conducted', $cdp_ttp_report->label('places_conducted'), old('places_conducted', $cdp_ttp_report->places_conducted))!!}
							{!! EasyForm::viewInput('groups_reached', $cdp_ttp_report->label('groups_reached'), old('groups_reached', $cdp_ttp_report->groups_reached))!!}
					</div>		
					
						<h6>People Group/Communities</h6>
					<div class="row">	
							{!! EasyForm::viewInput('tenday_people_group_reached', $cdp_ttp_report->label('tenday_people_group_reached'), old('tenday_people_group_reached', $cdp_ttp_report->tenday_people_group_reached))!!}
							{!! EasyForm::viewInput('tenday_villages_reached', $cdp_ttp_report->label('tenday_villages_reached'), old('tenday_villages_reached', $cdp_ttp_report->tenday_villages_reached))!!}
					</div>			
												
					<h6>Go Green & Water Harvest Pit Information</h6>
					<div class="row">	
							{!! EasyForm::viewInput('trees_planted_no', $cdp_ttp_report->label('trees_planted_no'), old('trees_planted_no', $cdp_ttp_report->trees_planted_no))!!}
							{!! EasyForm::viewInput('harvest_pit_digged_no', $cdp_ttp_report->label('harvest_pit_digged_no'), old('harvest_pit_digged_no', $cdp_ttp_report->harvest_pit_digged_no))!!}
							{!! EasyForm::viewInput('suggestions', $cdp_ttp_report->label('suggestions'), old('suggestions', $cdp_ttp_report->suggestions))!!}
						</div>	
	</div>
	
	@include('project.tabs_close')	
@endsection	

	
