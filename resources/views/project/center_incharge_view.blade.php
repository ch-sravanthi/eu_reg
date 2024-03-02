
		{!! EasyForm::setNoRows() !!}
		{!! EasyForm::setColSizes(3,3) !!}
		<?php $person = $project->active_project_incharge->person; //var_dump($project_incharge->project->model_name);die();?>
		
		<div class="float-end">
			<a class="btn" href="{{ route('incharge.create', [$project->model_name, $project->id, 'project_incharges', $project->center_project_incharge->id]) }}">Edit</a>
		</div>
		<div class="form form-view">
			<h6>Basic Details</h6>
			<div class="row">					
					{!! EasyForm::viewSelect('title', $person->label('title'), $person->title, AppHelper::options('titles')) !!}
					<?php
						//$name = "<a href='". route('person.view', $person->id) ."' target='_blank'>$person->full_name</a>";
					?>
						{!! EasyForm::viewInput('full_name', $person->label('full_name'), $person->full_name) !!}
				
					@if(isset($incharge))
						{!! EasyForm::viewSelect('status', $incharge->label('status'), $incharge->status, AppHelper::options('status_active')) !!}
					@endif
					{!! EasyForm::viewImage('photo', $person->label('photo'), $person->photo, false) !!}							
					{!! EasyForm::viewSelect('educational_qualifications', $person->label('educational_qualifications'), $person->educational_qualifications, AppHelper::options('educational_qualifications')) !!}
					{!! EasyForm::viewInput('birthdate', $person->label('birthdate'), $person->birthdate) !!}
					{!! EasyForm::viewSelect('gender', $person->label('gender'), $person->gender, AppHelper::options('gender')) !!}
					{!! EasyForm::viewInput('languages', $person->label('languages'), AppHelper::multiple($person->languages,'our_languages'))!!}	
					{!! EasyForm::viewSelect('marital_status', $person->label('marital_status'), $person->marital_status, AppHelper::options('marital_status')) !!}
					{!! EasyForm::viewInput('children_count', $person->label('children_count'), $person->children_count) !!}
			</div>
			
			<h6>Contact & ID Proofs</h6>
			<div class="row">	
					{!! EasyForm::viewSelect('address_proof_type', $person->label('address_proof_type'), $person->address_proof_type, AppHelper::options('address_proof_types')) !!}
					{!! EasyForm::viewInput('address_proof_id', $person->label('address_proof_id'), $person->address_proof_id) !!}	
					@if(!empty($pan_card))
						{!! EasyForm::viewInput('pan_card', $person->label('pan_card'), $person->pan_card) !!}			
						{!! EasyForm::viewFile('pan_card_copy', $person->label('pan_card_copy'), $person->pan_card_copy) !!}
					@endif
					{!! EasyForm::viewInput('phone_mobile', $person->label('phone_mobile'), $person->phone_mobile) !!}
					{!! EasyForm::viewInput('email', $person->label('email'), $person->email) !!}
					{!! EasyForm::viewSelect('job_profession', $person->label('job_profession'), $person->job_profession, AppHelper::options('job_profession')) !!}
			</div>
			
			<h6>Address</h6>
			<div class="row">		
					{!! EasyForm::viewSelect('state', $person->label('state'), $person->state, AppHelper::options('states')) !!}
					{!! EasyForm::viewDependent('district', $person->label('district'), $person->district, AppHelper::options('districts'), $person->state) !!}
					{!! EasyForm::viewInput('city', $person->label('city'), $person->city) !!}
					{!! EasyForm::viewInput('h_no', $person->label('h_no'), $person->h_no) !!}
					{!! EasyForm::viewInput('street_address', $person->label('street_address'), $person->street_address) !!}
					{!! EasyForm::viewInput('pin', $person->label('pin'), $person->pin) !!}
					
		</div>
		
		<h6>Testimony</h6>
			<div class="row">
				
				{!! EasyForm::viewSelect('min_exp', $person->label('min_exp'), $person->min_exp, AppHelper::options('min_experience')) !!}		
				
				{!! EasyForm::viewInput('family_background', $person->label('family_background'), AppHelper::excerpt($person->family_background, 100, true), ['class' => 'unselectable'])!!}
							
				{!! EasyForm::viewSelect('theological_qualifications', $person->label('theological_qualifications'), $person->theological_qualifications, AppHelper::options('theological_qualifications')) !!}	
				
				{!! EasyForm::viewInput('belief_faith', 'Past Belief', AppHelper::excerpt($person->belief_faith, 100, true), ['class' => 'unselectable'])!!}	
					
				
				{!! EasyForm::viewInput('lifestyle', 'Past LifeStyle', AppHelper::excerpt($person->lifestyle, 160, true), ['class' => 'unselectable'])!!}	
			
	
				{!! EasyForm::viewInput('when_date', 'Accepted Date', $person->when_date) !!}		
				
				{!! EasyForm::viewInput('where_place', 'Accepted Place', $person->where_place) !!}	
				
				{!! EasyForm::viewSelect('who_led_you', $person->label('who_led_you'), $person->who_led_you, AppHelper::options('who_led_you')) !!}	
					
				{!! EasyForm::viewSelect('what_occasion', $person->label('what_occasion'), $person->what_occasion, AppHelper::options('what_occasion')) !!}	
				
				{!! EasyForm::viewInput('bible_verse', 'Bible Verse', $person->bible_verse) !!}		
					
				{!! EasyForm::viewInput('glorify_god', 'Current LifeStyle', AppHelper::excerpt($person->glorify_god, 160, true), ['class' => 'unselectable'])!!}	
			</div>	
	</div><hr>
	<?php $bank_account = $person->bank_accounts; //var_dump($person);die();?>
	<table class="table table-bordered table-striped">
		<tr>
			<th>Bank A/C</th>
		</tr>
		@foreach ($person->bank_accounts as $bank_account)
		<tr>
			<td> 
				{{ $bank_account->passbook_name }}  <br>
				{{ AppHelper::dropdown($bank_account->bank_name, 'banks') }} <br>
				<b>A/C:</b> {{ $bank_account->account_no }}</a><br>
				<div><b>IFSC:</b> {{ $bank_account->ifsc_code }}</div> 
				@if($bank_account->swift_code)
					<div><b>Swift Code:</b>{{ $bank_account->swift_code}}</div>
				@endif 
				@if($bank_account->bank_statement)
					{!! EasyForm::viewImage('bank_statement', $bank_account->label('bank_statement'), $bank_account->bank_statement, false) !!}							
				@endif
				
				@if($bank_account->fcra_copy_apv)
					{!! EasyForm::viewImage('fcra_copy_apv', $bank_account->label('fcra_copy_apv'), $bank_account->fcra_copy_apv, false) !!}							
				@endif
				@if(!empty($bank_account->passbook_copy))
					{!! EasyForm::viewImage('passbook_copy', 'Passbook Copy', $bank_account->passbook_copy, false) !!}							
				@endif
			</td>
		</tr>
		@endforeach
	</table>
					
	
	
