<script type="text/javascript">
function getResource() {
  var chk = document.querySelector('input[name="training_resources"]:checked');
  if(chk && chk.value == 'Yes'){
    document.getElementById("ifYes2").style.display = 'block';
  }
  else{
    document.getElementById("ifYes2").style.display = 'none';
  }
}
function getTeacher() {

  var chk = document.querySelector('input[name="teacher_trainers"]:checked');
  if(chk && chk.value == 'Yes'){
    document.getElementById("ifYes1").style.display = 'block';
  }
  else{
    document.getElementById("ifYes1").style.display = 'none';
  }
}

function getLocation() {
  var chk = document.querySelector('input[name="training_present_address"]:checked');
  if(chk && chk.value == 'Yes'){
    document.getElementById("ifTTPVenue").style.display = 'none';
    
  }
  else{
    document.getElementById("ifTTPVenue").style.display = 'block';
  }
}
</script>
<style>
	.imgwrap{
		position: relative;
	}
	.imgwrap img{
		position: absolute;
		right: -50%;
		display: none;
	}
	.imgwrap:hover img{
		display: block;
		
	}
</style>
	{!! EasyForm::setColSizes(4, 8) !!}
	<div class="row">			
		<div class="col-lg-6 row">
			{!! EasyForm::select('state', $project->label('state'), old('state', $project->state), AppHelper::options('states')) !!}
			
			{!! EasyForm::dependent('district', $project->label('district'), old('district', $project->district), AppHelper::options('districts'), 'state')!!}						
			
			
			{!! EasyForm::checkbox('intrest', $project->label('intrest'), old('intrest', $project->intrest), AppHelper::options('program_request_intrest')) !!}
			
			{!! EasyForm::input('impact', $project->label('impact'), old('impact', $project->impact))!!}
		</div>
		<div class="col-lg-6 row">	
			{!! EasyForm::location('location', $project->label('location'), old('location', $project->location))!!}	
			
			{!! EasyForm::input('location_latlong', $project->label('location_latlong'), old('location_latlong', $project->location_latlong), ['readonly' => true, 'placeholder' => 'Autofill'])!!}	

		</div>
	</div>
	
	{!! EasyForm::setColSizes(2, 4) !!}
	<div class="row">
			{!! EasyForm::radio('training_present_address', $project->label('training_present_address'), old('training_present_address', $project->training_present_address), AppHelper::options('yes_no_list'),['onclick' => 'getLocation()']) !!}
		
	
	
		<div id="ifTTPVenue" style="display:none">
			
			<h6> TTP Training Venue (if not same as Incharge Present Address)</h6>
			<div class="row">
				{!! EasyForm::select('ttp_state', $project->label('ttp_state'), old('ttp_state', $project->ttp_state), AppHelper::options('states')) !!}
				{!! EasyForm::dependent('ttp_district', $project->label('ttp_district'), old('ttp_district', $project->ttp_district), AppHelper::options('districts'), 'ttp_state')!!}
				{!! EasyForm::input('ttp_taluk', $project->label('ttp_taluk'), old('ttp_taluk', $project->ttp_taluk))!!}
				{!! EasyForm::input('ttp_street', $project->label('ttp_street'), old('ttp_street', $project->ttp_street))!!}
				{!! EasyForm::input('ttp_house_no', $project->label('ttp_house_no'), old('ttp_house_no', $project->ttp_house_no))!!}
				{!! EasyForm::input('ttp_pin_code', $project->label('ttp_pin_code'), old('ttp_pin_code', $project->ttp_pin_code))!!}
			</div>
		</div>
	</div>

	{!! EasyForm::setColSizes(4, 8) !!}
	<h6>How many children are you planning to reach</h6>
	<div class="row">
			<div class="col-lg-6 row imgwrap">
				{!! EasyForm::radio('package', 'Plan to Reach', old('package', $project->package), AppHelper::options('ttp_plan_to_reach'))!!}
				<img src="{{ asset('/images/cdp_packages.png')}}" style="width:100%">	
			</div>
			<div class="col-lg-6 row">
				
				{!! EasyForm::input('no_of_programs', $project->label('no_of_programs'), old('no_of_programs', $project->no_of_programs))!!}
			
				{!! EasyForm::input('total', $project->label('total'), old('total', ''), ['readonly' => true, 'placeholder' => 'total = (Plan to reach * no. of programs)'])!!}	
			</div>
	</div>
	
	
	{!! EasyForm::setColSizes(4, 8) !!}
	<div class="row">			
		<div class="col-lg-6">
			<h6>CDP TTP Proposed Dates</h6>
			<div class="row">
				{!! EasyForm::date('proposed_date_one', $project->label('proposed_date_one'), old('proposed_date_one', $project->proposed_date_one))!!}
				{!! EasyForm::date('proposed_date_two', $project->label('proposed_date_two'), old('proposed_date_two', $project->proposed_date_two))!!}
			</div>
		</div>
		<div class="col-lg-6">
			<h6>10 Day Class Proposed Dates</h6>
			<div class="row">
				{!! EasyForm::date('ten_day_proposed_from_date', $project->label('ten_day_proposed_from_date'), old('ten_day_proposed_from_date', $project->ten_day_proposed_from_date))!!}
				{!! EasyForm::date('ten_day_proposed_date', $project->label('ten_day_proposed_date'), old('ten_day_proposed_date', $project->ten_day_proposed_date))!!}
			</div>
		</div>
	</div>
	
	{!! EasyForm::setColSizes(2, 4) !!}
	<div class="row">
		<div class="col-lg-6">
			<h6>Training Resources Info</h6>
		</div>
		<div class="col-lg-6">
			<h6>Trainers Info</h6>
		</div>
		
		{!! EasyForm::radio('training_resources', $project->label('training_resources'), old('training_resources', $project->training_resources), AppHelper::options('yes_no_list'),['onclick' => 'getResource()']) !!}
		
		{!! EasyForm::radio('teacher_trainers', $project->label('teacher_trainers'), old('teacher_trainers', $project->teacher_trainers), AppHelper::options('yes_no_list'),['onclick' => 'getTeacher()']) !!}
	</div>
	
	{!! EasyForm::setColSizes(4, 8) !!}
	<div class="row">
		<div class="col-lg-6">
			<div class="row" id="ifYes2" style="display:none">
				{!! EasyForm::checkbox('training_resources_type', $project->label('training_resources_type'), old('training_resources_type', $project->training_resources_type), AppHelper::options('ttp_training_resources')) !!}
			</div>
		</div>
		<div class="col-lg-6">
			<div class="row" id="ifYes1" style="display:none">
				{!! EasyForm::checkbox('trainers_info', $project->label('trainers_info'), old('trainers_info', $project->trainers_info), AppHelper::options('trainers_to_train_teachers')) !!}
			</div>
		</div>
	</div>
	
	{!! EasyForm::setColSizes(2, 4) !!}
	<div class="row">
		{!! EasyForm::input('christian_children', $project->label('christian_children'), old('christian_children', $project->christian_children))!!}
			
		{!! EasyForm::input('non_christian_children', $project->label('non_christian_children'), old('non_christian_children', $project->non_christian_children))!!}
		
	</div>

	<script>
		//init
		getResource();
		getTeacher();
		getLocation();
	</script>