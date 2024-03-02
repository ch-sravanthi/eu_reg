<div class="form form-view pb-4">
	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<?php $url = isset($project->id) ? route('project.view', [$project->model_name, $project->id]) : '#'?>
		<li class="nav-item" role="presentation">
			<a class="nav-link {{ $tab == 'project' ? 'active' : '' }}" type="button" role="tab" href="{{ $url }}">Project Details</a>
		</li>
		@if(isset($project->id))
			<?php $url = $project->active_project_incharge ? route('incharge.create', [$project->model_name, $project->id, 'active_project_incharge', $project->active_project_incharge->id]) : 
						route('project.check', [$project->model_name, $project->id, 'active_project_incharge']) ?>
						
			<li class="nav-item" role="presentation">
				<a class="nav-link {{ $tab == 'project_incharge' ? 'active' : '' }}" type="button" role="tab" href="{{ $url }}">Facilitator</a>
			</li>
		@endif
		@if($project->model_name != 'cdp_ttp_project')
			@if(isset($project->active_project_incharge->id))
				<?php $url = route('incharge.listview', [$project->model_name, $project->id, 'center_incharges'])?>
				<li class="nav-item" role="presentation">
					<a class="nav-link {{ $tab == 'center_incharges' ? 'active' : '' }}" type="button" role="tab" href="{{ $url }}">Center</a>
				</li>
				@if($project->model_name == 'ict_project')
					<?php $url = route('incharge.listview', [$project->model_name, $project->id, 'ict_tutors'])?>
					<li class="nav-item" role="presentation">
						<a class="nav-link {{ $tab == 'ict_tutors' ? 'active' : '' }}" type="button" role="tab" href="{{ $url }}">Tutors</a>
					</li>
				@endif
			@endif
		 @endif
		 @if($project->model_name == 'cdp_ttp_project') 
			@if(isset($project->active_project_incharge->id) && $project->status == 'approved')
			
				<?php $url = $project->cdp_ttp_report ? route('project.view_ten_day_report', [$project->model_name, $project->id,  $project->cdp_ttp_report->id]) : route('project.create_ten_day_report', [$project->model_name, $project->id]) ?>
						
				<li class="nav-item" role="presentation">
					<a class="nav-link {{ $tab == 'cdp_ttp_report' ? 'active' : '' }}" type="button" role="tab" href="{{ $url }}">Ten Day Report</a>
				</li>
			@endif
		 @endif
		@if((isset($project->id)) && (isset($project->active_project_incharge->id)))
			<?php $url = route('project.submit', [$project->model_name, $project->id]) ?>
						
			<li class="nav-item" role="presentation">
				<a class="nav-link {{ $tab == 'submit' ? 'active' : '' }}" type="button" role="tab" href="{{ $url }}">Submit</a>
			</li>
		@endif	
	</ul>
		
	<div class="tab-content">
		<div class="tab-pane show active form" id="{{ $tab }}" role="tabpanel">
			
			<button class="btn btn-prev" onclick="navigate('Previous')"><</button>
			<button class="btn btn-next" onclick="navigate('Next')">></button>
			<script>
				function navigate(type) {
					var currentLi = $('.nav-tabs').find('.active').parent();
					var navLi = type == 'Previous' ? currentLi.prev('li') : currentLi.next('li');
					
					if ($(navLi).length) {
						window.location.href = navLi.find('a').attr('href');
					}
					
				}
			</script>