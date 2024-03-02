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
	<?php $incharge_id = isset($incharge->id) ? $incharge->id : '';?>
	
	{!! Form::open(['url' => route('incharge.save', [$project->model_name, $project->id, $type, $incharge_id]), 'id' => 'idForm', 'files' => true]) !!}
	
		@if(isset($incharge->id))
			{{ Form::hidden('id', $incharge->id) }}
		@endif
		
		
		<script type="text/javascript">
			function getFtrelated(x) { 
			  if(x.value == 'No'){
				document.getElementById("ifYes").style.display = 'none'; // you need a identifier for changes
				document.getElementById("ifNo").style.display = 'block'; // you need a identifier for changes
			  }
			  else{
				document.getElementById("ifYes").style.display = 'block';  // you need a identifier for changes
			   document.getElementById("ifNo").style.display = 'none'; // you need a identifier for changes
			  }
			}
		</script>

		<script type="text/javascript">
			function check() {
				let form = document.getElementById("idForm");
				form.submit();
			}
		</script>

		<?php $non_ft = ($type != 'active_project_incharge' && $incharge->name() == 'ict_center_incharge')?>
			
		<script src="{{ URL::asset('js/map.js?v='.config('custom.js.map')) }}"></script>	

		{!! EasyForm::setErrors($errors) !!}
		{!! EasyForm::setNoRows() !!}
		{!! EasyForm::setColSizes(2, 4) !!}	
		<div class="row">
			<div class="col-lg-12">
				<h6>Aadhaar Details</h6>
			</div>
			{!! EasyForm::select('title', $person->label('title').' *', old('title', $person->title), AppHelper::options('titles_new')) !!}
			{!! EasyForm::input('full_name', $person->label('full_name').' *', old('full_name', $person->full_name))!!}
			{!! EasyForm::date('birthdate', $person->label('birthdate').' *', old('birthdate', $person->birthdate), ['class' => 'dob'])!!}
			{!! EasyForm::radio('gender', $person->label('gender').' *', old('gender', $person->gender), AppHelper::options('gender')) !!}
			
			{!! EasyForm::input('address_proof_id', $person->label('address_proof_id').' *', old('address_proof_id',  (request()->aadhar_id ? request()->aadhar_id : $person->address_proof_id)), ['readonly' => $readonly])!!}
			
			{!! EasyForm::file('photo', $person->label('photo').' *', old('photo', $person->photo))!!}
			
			<?php $type = $person->address_proof_type ?  $person->address_proof_type : 'aadhar_card'?>
			{!! Form::hidden('address_proof_type',  $type)!!}
			{!! EasyForm::file('address_proof_copy', $person->label('address_proof_copy').' *', old('address_proof_copy', $person->address_proof_copy), ['readonly' => $readonly])!!}
		</div>	
				
		<div class="row">				
			<div class="col-lg-12">
				<h6>Personal and Contact Details</h6>
			</div>
			{!! EasyForm::select('state', $person->label('state').' *', old('state', $person->state), AppHelper::options('states')) !!}
			{!! EasyForm::dependent('district', $person->label('district').' *', old('district', $person->district), AppHelper::options('districts'), 'state')!!}
			{!! EasyForm::input('city', $person->label('city').' *', old('city', $person->city))!!}
			{!! EasyForm::input('street_address', $person->label('street_address').' *', old('street_address', $person->street_address))!!}
			
			
			
			{!! EasyForm::input('h_no', $person->label('h_no').' *', old('h_no', $person->h_no))!!} 
			{!! EasyForm::input('pin', $person->label('pin').' *', old('pin', $person->pin))!!}
			{!! EasyForm::input('phone_mobile', $person->label('phone_mobile').' *', old('phone_mobile', $person->phone_mobile))!!}
			{!! EasyForm::input('email', $person->label('email').' *', old('email', $person->email))!!}					
		</div>	
		<div class="row">
			<div class="col-lg-12">
				<h6>Other Details</h6>
			</div>
					
			{!! EasyForm::radio('educational_qualifications', $person->label('educational_qualifications').' *', old('educational_qualifications', $person->educational_qualifications), AppHelper::options('educational_qualifications')) !!}
		
			{!! EasyForm::radio('job_profession', $person->label('job_profession').' *', old('job_profession', $person->job_profession), AppHelper::options('job_profession')) !!}
						
			<?php $languages = AppHelper::autoOptions('languages')?>	
			{!! EasyForm::autocomplete("languages", $person->label('languages').' *', old("languages",  $person->languages), $languages, 'languages') !!}
			
		</div>
			
		<div class="row">
			@if($non_ft)
				{!! EasyForm::radio('is_facilitator_related', $person->label('is_facilitator_related').' *', old('is_facilitator_related', $incharge->is_facilitator_related), AppHelper::options('yes_no_list'),['onclick' => 'getFtrelated(this)']) !!}
			
				<div id="ifYes" style="display:none">
					{!! EasyForm::select('facilitator_relationship', $person->label('facilitator_relationship').' *', old('facilitator_relationship', $incharge->facilitator_relationship), AppHelper::options('facilitator_relationships')) !!}
				</div>
			@endif	
		</div>
			
		<div class="row">
			<div class="col-lg-12"><h6>Any ministry Experiences </h6></div>
			{!! EasyForm::radio('min_exp', $person->label('min_exp').' *', old('min_exp', $person->min_exp), AppHelper::options('min_experience')) !!}
			
			{!! EasyForm::radio('theological_qualifications', $person->label('theological_qualifications').' *', old('theological_qualifications', $person->theological_qualifications), AppHelper::options('theological_qualifications')) !!}
			
		</div>

		<div class="row">
					
			<div class="col-lg-12">
				<h6>Bank Account Details</h6>
			</div>
			<?php $readonlyBank = $bank_account->passbook_name ? true : false?>
			{!! EasyForm::input('passbook_name', $person->label('passbook_name').' *', old('passbook_name',$bank_account->passbook_name), ['readonly' => $readonlyBank])!!}
			{!! EasyForm::input('account_no', $person->label('account_no').' *', old('account_no', $bank_account->account_no), ['readonly' => $readonlyBank])!!}
			{!! EasyForm::input('ifsc_code', $person->label('ifsc_code').' *', old('ifsc_code',  $bank_account->ifsc_code),['readonly' => $readonlyBank])!!}
			{!! EasyForm::select('bank_name', $person->label('bank_name').' *', old('bank_name',  $bank_account->bank_name), AppHelper::options('banks'),['readonly' => $readonlyBank]) !!}
		
			{!! EasyForm::input('branch_name', $person->label('branch_name').' *', old('branch_name', $bank_account->branch_name), ['readonly' => $readonlyBank])!!}
			{!! EasyForm::input('branch_code', $person->label('branch_code').' *', old('branch_code', $bank_account->branch_code), ['readonly' => $readonlyBank])!!}
			{!! EasyForm::file('passbook_copy', $person->label('passbook_copy').' *', old('passbook_copy',  $bank_account->passbook_copy), ['readonly' => $readonlyBank])!!}
			@if(!$readonlyBank && !$bank_account->bank_statement)
				{!! EasyForm::file('bank_statement', $person->label('bank_statement'), old('bank_statement', $bank_account->bank_statement), ['readonly' => $readonlyBank])!!}	
			@endif
		</div>
			
			
		<?php $ministry = isset($model_name) && in_array($model_name, ['wep_llt_center_incharge', 'llt_center_incharge'])?>
		@if($ministry)	
		<div class="row">
			<div class="col-lg-8">
				<legend class="w-auto">Why do you want to get trained as Lay Leader(LEAP/WE)</legend>
				{!! EasyForm::checkbox ('intrest[]', $person->label('intrest'), old('intrest', $person->intrest), AppHelper::options('program_request_intrest'), ['id' => 'intrest']) !!}
			</div>
		</div>			
		@endif
					
		@if($model_name == 'al_project' && $incharge->name() == 'al_center_incharge')
			<div class="row">
				<div class="col-lg-12"><h6>{{$incharge->label('location_label')}}</h6></div>
					
					{!! EasyForm::location('location', $incharge->label('location').' *', old('location', $incharge->location))!!}							
					{!! EasyForm::input('location_latlong', $incharge->label('location_latlong').' *', old('location_latlong', $incharge->location_latlong), ['readonly' => true, 'placeholder' => 'Autofille'])!!}
			</div>
		@endif
		<h6>Testimony</h6>
		<div style="border: 1px solid #ccc; border-radius: 5px; padding: 0.5em;">
			<div class="row">
				<div class="col-lg-12"><h6>Previous Experience (worldly)</h6></div>
				{!! EasyForm::textarea('family_background', $person->label('family_background').' *', old('family_background', $person->family_background), ['rows' => 3,'placeholder' => 'max limit to 100 words.'])!!}
				{!! EasyForm::textarea('belief_faith', $person->label('belief_faith').' *', old('belief_faith', $person->belief_faith), ['rows' => 3,'placeholder' => 'max limit to 100 words.'])!!}
				{!! EasyForm::textarea('lifestyle', $person->label('lifestyle').' *', old('lifestyle', $person->lifestyle), ['rows' => 3,'placeholder' => 'max limit to 100 words.'])!!}
			</div>
			<div class="row">
				<div class="col-lg-12"><h6>How s/he has accepted Jesus Christ</h6></div>	
				{!! EasyForm::date('when_date', $person->label('when_date'), old('when_date', $person->when_date), ['class' => 'dob'])!!}
				{!! EasyForm::input('where_place', $person->label('where_place'), old('where_place', $person->where_place))!!}
				{!! EasyForm::select('who_led_you', $person->label('who_led_you').' *', old('who_led_you', $person->who_led_you), AppHelper::options('who_led_you')) !!}
			
				{!! EasyForm::select('what_occasion', $person->label('what_occasion').' *', old('what_occasion', $person->what_occasion), AppHelper::options('what_occasion')) !!}
				{!! EasyForm::input('bible_verse', $person->label('bible_verse'), old('bible_verse', $person->bible_verse))!!}
			</div>
		
			<div class="row">
				<div class="col-lg-12"><h6>Current changes (after accepting Christ)</h6></div>
				{!! EasyForm::textarea('glorify_god', $person->label('glorify_god').' *', old('glorify_god', $person->glorify_god), ['rows' => 3,'placeholder' => 'max limit to 100 words.'])!!}
			</div>
		</div>	
		@if($model_name == 'ict_project' && $incharge->name() == 'ict_tutor')
			<h6>{{$incharge->label('languages_label')}}</h6>
			<table class="table table-bordered table-striped table-hover text-center">
				<thead>	
					<tr>
						<th>Language</th>
						<th>Read </th>
						<th>Write </th>
						<th>Speak </th>
					</tr>	
				</thead>
				<tbody class="text-center">	
					@for($i=1; $i<=3; $i++)
						<tr>
							<td>{!! EasyForm::select("language_$i", null, old("language_$i", $incharge->{"language_$i"}), AppHelper::options('our_languages')) !!}</td>
							<td>{!! EasyForm::select("read_$i", null, old("read_$i", $incharge->{"read_$i"}), AppHelper::options('yes_no')) !!}</td>
							<td>{!! EasyForm::select("write_$i", null, old("write_$i", $incharge->{"write_$i"}), AppHelper::options('yes_no')) !!}</td>
							<td>{!! EasyForm::select("speak_$i", null, old("speak_$i", $incharge->{"speak_$i"}), AppHelper::options('yes_no')) !!}</td>
						</tr>
					@endfor
				</tbody>		
			</table>
		@endif
		
		@if($model_name == 'ict_project' && $incharge->name() == 'ict_center_incharge')
			<h6>{{$incharge->label('adopted_areas_of_people_groups')}}</h6>
			<?php $people_group = AppHelper::autoOptions('people_groups')?>				
			<table class="table table-bordered table-stripedtext-center">									
				<thead>	
					<tr>
						<th>People Groups(Caste and Sub Caste)</th>
						<th>Location</th>
					</tr>	
				</thead>
				<tbody>	
					@for($i=1; $i<=3; $i++) 
						<tr>
							<td> 
								{!! EasyForm::autocomplete("people_group_$i", null, old("people_group_$i", $incharge->{"people_group_$i"}), $people_group, 'people_group') !!}
							</td>
							<td>
								{!! EasyForm::location("location_$i", null, old("location_$i",  $incharge->{"location_$i"})) !!}
								{!! EasyForm::input("location_{$i}_latlong", null, old("location_{$i}_latlong", $incharge->{"location_{$i}_latlong"}), ['readonly' => true]) !!}
								
								
							</td>
						</tr>
					@endfor
				</tbody>		
			</table>
			
			<script>
				function initMapCustom() {
					initMapParams('location_1', 'location_1_latlong', 'map_location_1');
					initMapParams('location_2', 'location_2_latlong', 'map_location_2');
					initMapParams('location_3', 'location_3_latlong', 'map_location_3');
				}
			</script>	
			<?php $callback = 'initMapCustom'?>
		@else			
		@endif
		<div class="py-3">
			<button type="button" class="btn btn-success" onclick="saveModel(this)">@include('layouts.loader') Save <span class="progressval"></span></button>
		</div>
	{!! Form::close() !!}
			
	@include('project.tabs_close')
	
	@include ('layouts.map', ['callback' => isset($callback) ? $callback : null])
@endsection	
