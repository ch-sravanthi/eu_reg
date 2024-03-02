<style>
.outer {
  height: 120px;
  width: 200px;
}
.inner {
  height: 120px;
  width: 500px;
}
img {
  height: 50;
  width: 55%;
  display: none;
  position: absolute;
}
.inner:hover img {
  display: block;
}

</style>

	<h6>Basic Details</h6>
	<div class="row">			
		{!! EasyForm::viewSelect('state', $project->label('state'), $project->state, AppHelper::options('states')) !!}
		
		{!! EasyForm::viewDependent('district', $project->label('district'), $project->district, AppHelper::options('districts'), $project->state) !!}					
		
		
		{!! EasyForm::viewInput('impact', $project->label('impact'),$project->impact)!!}
						
		{!! EasyForm::viewCheckbox('intrest', $project->label('intrest'), $project->intrest, AppHelper::options('program_request_intrest')) !!}		
		{!! EasyForm::viewInput('location', $project->label('location'), $project->location)!!}	
	
			{!! EasyForm::viewRadio('training_present_address', $project->label('training_present_address'),  $project->training_present_address, AppHelper::options('yes_no_list'),['readonly' => 'false','onclick' => 'getLocation(this)']) !!}
		
	</div>
	
	<h6> TTP Training Venue (if not same as Incharge Present Address)</h6>
	<div class="row" >
			{!! EasyForm::viewSelect('ttp_state', $project->label('ttp_state'),  $project->ttp_state, AppHelper::options('states')) !!}
			{!! EasyForm::viewDependent('ttp_district', $project->label('ttp_district'),  $project->ttp_district, AppHelper::options('districts'), $project->ttp_state)!!}
			{!! EasyForm::viewInput('ttp_taluk', $project->label('ttp_taluk'),  $project->ttp_taluk)!!}
		
			{!! EasyForm::viewInput('ttp_street', $project->label('ttp_street'),  $project->ttp_street)!!}
			{!! EasyForm::viewInput('ttp_house_no', $project->label('ttp_house_no'),  $project->ttp_house_no)!!}
			{!! EasyForm::viewInput('ttp_pin_code', $project->label('ttp_pin_code'),  $project->ttp_pin_code)!!}
		
	</div>

	<h6> How many children are you planning to reach</h6>
	<div class="row">
		{!! EasyForm::viewRadio('package', 'Plan to Reach',  $project->package, 
			AppHelper::options('ttp_plan_to_reach'))!!}
				
		{!! EasyForm::viewInput('no_of_programs', $project->label('no_of_programs'),  $project->no_of_programs)!!}
			
		{!! EasyForm::viewInput('total', $project->label('total'),  ($project->package * $project->no_of_programs))!!}	
		
	</div>
	
	<h6>CDP TTP Proposed Dates</h6>
	<div class="row">
			{!! EasyForm::viewInput('proposed_date_one', $project->label('proposed_date_one'),  AppHelper::date($project->proposed_date_one))!!}
			{!! EasyForm::viewInput('proposed_date_two', $project->label('proposed_date_two'),  AppHelper::date($project->proposed_date_two))!!}
	</div>	
	
	<h6>10 Day Class Proposed Dates</h6>
	<div class="row">
			{!! EasyForm::viewInput('ten_day_proposed_from_date', $project->label('ten_day_proposed_from_date'),  AppHelper::date($project->ten_day_proposed_from_date))!!}
			{!! EasyForm::viewInput('ten_day_proposed_date', $project->label('ten_day_proposed_date'),  AppHelper::date($project->ten_day_proposed_date))!!}
		
	</div>
	
	<h6> Training Resources Info</h6>
	<div class="row">
			{!! EasyForm::viewRadio('training_resources', $project->label('training_resources'),  $project->training_resources, AppHelper::options('yes_no_list'),['readonly' => 'false','onclick' => 'getResource(this)']) !!}
	</div>
	
	<h6>Trainers Info</h6>
	<div class="row">
			{!! EasyForm::viewRadio('teacher_trainers', $project->label('teacher_trainers'),  $project->teacher_trainers, AppHelper::options('yes_no_list'),['readonly' => 'false','onclick' => 'getTeacher(this)']) !!}
		
	</div>
	
	<div class="row">
		{!! EasyForm::viewCheckbox('training_resources_type', $project->label('training_resources_type'),  $project->training_resources_type, AppHelper::options('ttp_training_resources')) !!}

		{!! EasyForm::viewCheckbox('trainers_info', $project->label('trainers_info'),  $project->trainers_info, AppHelper::options('trainers_to_train_teachers')) !!}
	
		{!! EasyForm::viewInput('christian_children', $project->label('christian_children'),  $project->christian_children)!!}
			
		{!! EasyForm::viewInput('non_christian_children', $project->label('non_christian_children'),  $project->non_christian_children)!!}
		
	</div>
