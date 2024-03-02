	
	
		<?php 
			$non_ft = ($type != 'active_project_incharge' && $incharge->name() == 'ict_center_incharge');
			 ?>
		<div class="row">
			<div class="col-lg-12">
				<h6>Aadhaar Details</h6>
			</div>
			{!! EasyForm::viewSelect('title', $person->label('title').' *', old('title', $person->title), AppHelper::options('titles_new')) !!}
			{!! EasyForm::viewInput('full_name', $person->label('full_name').' *', old('full_name', $person->full_name))!!}
			{!! EasyForm::viewInput('birthdate', $person->label('birthdate').' *', old('birthdate', $person->birthdate))!!}
			{!! EasyForm::viewRadio('gender', $person->label('gender').' *', old('gender', $person->gender), AppHelper::options('gender')) !!}
			
			{!! EasyForm::viewInput('address_proof_id', $person->label('address_proof_id').' *', old('address_proof_id',  $person->address_proof_id))!!}
			
			{!! EasyForm::viewFile('photo', $person->label('photo').' *', old('photo', $person->photo))!!}
			
			<?php $type = $person->address_proof_type ?  $person->address_proof_type : 'aadhar_card'?>
			{!! Form::hidden('address_proof_type',  $type)!!}
			{!! EasyForm::viewFile('address_proof_copy', $person->label('address_proof_copy').' *', old('address_proof_copy', $person->address_proof_copy))!!}
		</div>	
				
		<div class="row">				
			<div class="col-lg-12">
				<h6>Personal and Contact Details</h6>
			</div>
			{!! EasyForm::viewSelect('state', $project->label('state'), $project->state, AppHelper::options('states')) !!}
			
			{!! EasyForm::viewDependent('district', $project->label('district'), $project->district, AppHelper::options('districts'), $project->state) !!}
			{!! EasyForm::viewInput('city', $person->label('city').' *', old('city', $person->city))!!}
			{!! EasyForm::viewInput('street_address', $person->label('street_address').' *', old('street_address', $person->street_address))!!}
			
			
			
			{!! EasyForm::viewInput('h_no', $person->label('h_no').' *', old('h_no', $person->h_no))!!} 
			{!! EasyForm::viewInput('pin', $person->label('pin').' *', old('pin', $person->pin))!!}
			{!! EasyForm::viewInput('phone_mobile', $person->label('phone_mobile').' *', old('phone_mobile', $person->phone_mobile))!!}
			{!! EasyForm::viewInput('email', $person->label('email').' *', old('email', $person->email))!!}					
		</div>	
		<div class="row">
			<div class="col-lg-12">
				<h6>Other Details</h6>
			</div>
					
			{!! EasyForm::viewRadio('educational_qualifications', $person->label('educational_qualifications').' *', old('educational_qualifications', $person->educational_qualifications), AppHelper::options('educational_qualifications')) !!}
		
			{!! EasyForm::viewRadio('job_profession', $person->label('job_profession').' *', old('job_profession', $person->job_profession), AppHelper::options('job_profession')) !!}
						
			<?php $languages = AppHelper::autoOptions('languages')?>	
		{!! EasyForm::viewInput('languages', $project->label('languages'), AppHelper::multiple($person->languages,'languages'))!!}	
		</div>
			
		<div class="row">
			@if($non_ft)
				{!! EasyForm::viewRadio('is_facilitator_related', $person->label('is_facilitator_related').' *', old('is_facilitator_related', $incharge->is_facilitator_related), AppHelper::options('yes_no_list'),['onclick' => 'getFtrelated(this)']) !!}
			
				<div id="ifYes" style="display:none">
					{!! EasyForm::viewInput('facilitator_relationship', $person->label('facilitator_relationship').' *', old('facilitator_relationship', $incharge->facilitator_relationship), AppHelper::options('facilitator_relationships')) !!}
				</div>
			@endif	
		</div>
			
		<div class="row">
			<div class="col-lg-12"><h6>Any ministry Experiences </h6></div>
			{!! EasyForm::viewRadio('min_exp', $person->label('min_exp').' *', old('min_exp', $person->min_exp), AppHelper::options('min_experience')) !!}
			
			{!! EasyForm::viewRadio('theological_qualifications', $person->label('theological_qualifications').' *', old('theological_qualifications', $person->theological_qualifications), AppHelper::options('theological_qualifications')) !!}
			
		</div>

		<div class="row">
					
			<div class="col-lg-12">
				<h6>Bank Account Details</h6>
			</div>
			{!! EasyForm::viewInput('passbook_name', $person->label('passbook_name').' *', old('passbook_name',$bank_account->passbook_name))!!}
			{!! EasyForm::viewInput('account_no', $person->label('account_no').' *', old('account_no', $bank_account->account_no))!!}
			{!! EasyForm::viewInput('ifsc_code', $person->label('ifsc_code').' *', old('ifsc_code',  $bank_account->ifsc_code))!!}
			{!! EasyForm::viewInput('bank_name', $person->label('bank_name').' *', old('bank_name',  $bank_account->bank_name), AppHelper::options('banks')) !!}
		
			{!! EasyForm::viewInput('branch_name', $person->label('branch_name').' *', old('branch_name', $bank_account->branch_name))!!}
			{!! EasyForm::viewInput('branch_code', $person->label('branch_code').' *', old('branch_code', $bank_account->branch_code))!!}
			{!! EasyForm::viewFile('passbook_copy', $person->label('passbook_copy').' *', old('passbook_copy',  $bank_account->passbook_copy))!!}
			{!! EasyForm::viewFile('bank_statement', $person->label('bank_statement'), old('bank_statement', $bank_account->bank_statement))!!}	
		</div>
			
			
		<?php $ministry = isset($model_name) && in_array($model_name, ['wep_llt_center_incharge', 'llt_center_incharge'])?>
		@if($ministry)	
		<div class="row">
			<div class="col-lg-8">
				<legend class="w-auto">Why do you want to get trained as Lay Leader(LEAP/WE)</legend>
				{!! EasyForm::viewCheckbox ('intrest[]', $person->label('intrest'), old('intrest', $person->intrest), AppHelper::options('program_request_intrest'), ['id' => 'intrest']) !!}
			</div>
		</div>			
		@endif
					
		@if($model_name == 'al_project' && $incharge->name() == 'al_center_incharge')
			<div class="row">
				<div class="col-lg-12"><h6>{{$incharge->label('location_label')}}</h6></div>
					
					{!! EasyForm::location('location', $incharge->label('location').' *', old('location', $incharge->location))!!}							
					{!! EasyForm::viewInput('location_latlong', $incharge->label('location_latlong').' *', old('location_latlong', $incharge->location_latlong), ['readonly' => true, 'placeholder' => 'Autofille'])!!}
			</div>
		@endif
		<h6>Testimony</h6>
		<div style="border: 1px solid #ccc; border-radius: 5px; padding: 0.5em;">
			<div class="row">
				<div class="col-lg-12"><h6>Previous Experience (worldly)</h6></div>
				{!! EasyForm::viewInput('family_background', $person->label('family_background').' *', old('family_background', $person->family_background), ['rows' => 3,'placeholder' => 'max limit to 100 words.'])!!}
				{!! EasyForm::viewInput('belief_faith', $person->label('belief_faith').' *', old('belief_faith', $person->belief_faith), ['rows' => 3,'placeholder' => 'max limit to 100 words.'])!!}
				{!! EasyForm::viewInput('lifestyle', $person->label('lifestyle').' *', old('lifestyle', $person->lifestyle), ['rows' => 3,'placeholder' => 'max limit to 100 words.'])!!}
			</div>
			<div class="row">
				<div class="col-lg-12"><h6>How s/he has accepted Jesus Christ</h6></div>	
				{!! EasyForm::viewInput('when_date', $person->label('when_date'), old('when_date', $person->when_date))!!}
				{!! EasyForm::viewInput('where_place', $person->label('where_place'), old('where_place', $person->where_place))!!}
				{!! EasyForm::viewSelect('who_led_you', $person->label('who_led_you').' *', old('who_led_you', $person->who_led_you), AppHelper::options('who_led_you')) !!}
			
				{!! EasyForm::viewSelect('what_occasion', $person->label('what_occasion').' *', old('what_occasion', $person->what_occasion), AppHelper::options('what_occasion')) !!}
				{!! EasyForm::viewInput('bible_verse', $person->label('bible_verse'), old('bible_verse', $person->bible_verse))!!}
			</div>
		
			<div class="row">
				<div class="col-lg-12"><h6>Current changes (after accepting Christ)</h6></div>
				{!! EasyForm::viewInput('glorify_god', $person->label('glorify_god').' *', old('glorify_god', $person->glorify_god), ['rows' => 3,'placeholder' => 'max limit to 100 words.'])!!}
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
					@for ($i=1; $i<=3; $i++)
					<tr>
						<td>{!! $incharge->{"language_$i"} !!}</td>
						<td>{!! $incharge->{"read_$i"} !!}</td>
						<td>{!! $incharge->{"write_$i"} !!}</td>
						<td>{!! $incharge->{"speak_$i"} !!}</td>
					</tr>
					@endfor
				</tbody>

			</table>
		@endif
		
		@if($model_name == 'ict_project' && $incharge->name() == 'ict_center_incharge')
			<h6>{{$incharge->label('adopted_areas_of_people_groups')}}</h6>
					
			<table class="table table-bordered table-striped table-hover text-center">
			<thead>	
				<tr>
					<th>People Groups (Caste and Sub Caste) </th>
					<th>Location</th>
				</tr>	
			</thead>
			<tbody class="text-center">	
				@for($i=1; $i<=3; $i++)
					
					@if ($incharge->{"people_group_$i"})
						<tr>
							<td>{!! AppHelper::multiple($incharge->{"people_group_$i"}, 'people_groups') !!}</td>
							<td>{!! $incharge->{"location_$i"}!!}</td>
						</tr>
					@endif
				@endfor
			</tbody>													
		</table>
		@endif
		