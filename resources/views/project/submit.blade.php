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

		{!! Form::open(['url' => route('project.submit_save', [$project->name(), $project->id]), 'id' => 'idForm']) !!}
			@csrf
				
		<div class="form">
			{!! EasyForm::setNoRows() !!}
			{!! EasyForm::setColSizes(2, 4) !!}	
			<div>
				<?php $name = explode('_', $model_name)?>
				<h5 class="text-center"> <u> {{ strtoupper($name[0])}} Project Details</u></h5>			
				@include('project.view_project_details')
				<hr>
					
				<h5 class="text-center"><u>Facilitator Details</u></h5>
				<?php $project_incharge = $project->active_project_incharge;?>
				<?php $person =  $project_incharge ? $project_incharge->person : null; ?>
					
				<?php if($person){
					$bank_account = \app\Helpers\ApiHelper::getModel('person', 'id', $person->id, null, 'bank_account');
				}?>
					
				@if($project_incharge && $project_incharge->person)
					
					@include('project.incharge_view_details', ['incharge' => $project->active_project_incharge,'person' => $person, 'type' => 'project_incharge', 'bank_account' => $bank_account])		
					<hr>
				@endif	
				@if($model_name == 'ict_project')
					<h5 class="text-center"><u>Community Volunteers Profile </u></h5>
				@elseif($model_name == 'al_project')
					<h5 class="text-center"><u>Assistants Profile </u></h5>
				@elseif($model_name == 'asc_project')
					<h5 class="text-center"><u>Club Leaders Profile </u></h5>
				@endif
				<?php if($model_name != 'cdp_ttp_project') {
						$incharges =  $project->center_incharges;
					}
					$sno=1;?>
				@if($model_name != 'cdp_ttp_project') 		
					@foreach ($incharges as $incharge)
						<?php $person =  $incharge->person; ?>
						<?php $name = AppHelper::dropdown($person->title, 'titles_new').'. '.$person->full_name;?>
						<h6 style="text-align: center!important;">{{$sno++}} - {{$name}}</h6>
						
						<?php if($person){
							$bank_account = \app\Helpers\ApiHelper::getModel('person', 'id', $person->id, null, 'bank_account');
						} //var_dump($bank_account);die();?>
						<h4 style="text-align:center;"> <b> </b></h4>
						
						@include('project.incharge_view_details', ['incharge' => $project->active_project_incharge,'person' => $person, 'type' => 'center_incharges', 'bank_account' => $bank_account])	
						<hr>
					@endforeach
					
					@if($model_name == 'ict_project') 	
						<h5 class="text-center"><u>Tutor Profiles</u></h5>
						<?php $incharges =  $project->ict_tutors; $slno=1;?>	
						@foreach ($incharges as $incharge)
						<?php $person =  $incharge->person; ?>
						<?php $name = AppHelper::dropdown($person->title, 'titles_new').'. '.$person->full_name;?>
						<h6 style="text-align: center!important;">{{$slno++}} - {{$name}}</h6>
						
						<?php if($person){
							$bank_account = \app\Helpers\ApiHelper::getModel('person', 'id', $person->id, null, 'bank_account');
						} //var_dump($bank_account);die();?>
						<h4 style="text-align:center;"> <b> </b></h4>
						
						@include('project.incharge_view_details', ['incharge' => $project->active_project_incharge,'person' => $person, 'type' => 'center_incharges', 'bank_account' => $bank_account])	
						<hr>
					@endforeach
					
					@endif
				@endif
				<div class="text-center">
					@if($project->status == 'created' && $project->active_project_incharge->id)
						@if($project->canSubmit() )
							<button  class="btn btn-theme" >Submit Project</button> 
						@else 
							@foreach($project->requirements() as $req) 
								{!! $req !!} <br>
							@endforeach
						@endif
					@else
						<?php $dt = date('d M Y', strtotime($project->updated_at))?>
						{!!  ucfirst($project->status).' on '. $dt !!}
					@endif
				</div>
			</div>
		</div>
		{!! Form::close() !!}
	@include('project.tabs_close')
@endsection
