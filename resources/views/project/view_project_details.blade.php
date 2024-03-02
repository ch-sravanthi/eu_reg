<div class="form">
			
		@if(in_array($project->model_name,['al_project', 'ict_project', 'wep_project']))
				<div class="row">				
					<?php $dt = date('d M Y', strtotime($project->updated_at));
						$status = ucfirst($project->status);
					?>
					
					{!! EasyForm::viewInput('status', $project->label('status'), $status.' on '. $dt) !!}
					
					{!! EasyForm::viewSelect('state', $project->label('state'), $project->state, AppHelper::options('states')) !!} 
					
					{!! EasyForm::viewDependent('district', $project->label('district'), $project->district, AppHelper::options('districts'), $project->state) !!}				
					
					{!! EasyForm::viewCheckbox('intrest', $project->label('intrest'), $project->intrest, AppHelper::options('program_request_intrest')) !!}
					
					{!! EasyForm::viewInput('impact', $project->label('impact'), old('impact', $project->impact))!!}
						
					<?php $people_groups = AppHelper::autoOptions('people_groups')?>
					{!! EasyForm::viewInput('people_groups', $project->label('people_groups'), AppHelper::multiple($project->people_groups,'people_groups'))!!}	
					
					<?php $class_language = AppHelper::autoOptions('languages')?>	
					{!! EasyForm::viewInput('class_language', $project->label('class_language'), AppHelper::multiple($project->class_language,'languages'))!!}	
					
					<?php $languages = AppHelper::autoOptions('languages')?>
					{!! EasyForm::viewInput('languages', $project->label('languages'), AppHelper::multiple($project->languages,'languages'))!!}	
				</div>
		@endif				
		@if($project->model_name == 'cdp_ttp_project')
			@include('project.cdp_ttp_other_details_view')
		@endif		
		
	</div>
