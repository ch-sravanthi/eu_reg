@extends('layouts.app')


@section('navs')
	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<?php $name = explode('_',$project->model_name)?>
    <li class="breadcrumb-item active" aria-current="page">{{strtoupper($name[0])}} {{strtoupper($name[1])}}</li> 
	  </ol>
	</nav>
@endsection

@section('content')	
		@include('project.tabs')
	<div class="form">
		<?php //$center_incharges = $center_incharges; ?>
		<div class="table-wrapper" >
			<table class="table  table-hover">
				<thead>
					<tr>
						<th></th>
						<th>Sno</th>
						<th>Photo</th>
						<th>Name</th>
						<th>Code</th>
						<th>Status</th>
						<th>Comments</th>
						<th>View</th>
						@if($project->status == 'entry')
							<th>Edit</th>
						@endif
					</tr>
				</thead>
				<tbody>
				<?php $i = 1?>
					@foreach ($incharges as $incharge)
					<tr id="idCenterIncharge{{$incharge->id}}">

					<?php $person= $incharge->person?>
							<td style="width: 20px">
								
							</td>
							<td style="width: 30px">
								@if ($incharge->isActive())
									{{ $i++ }}
								@endif
							</td>
							<td>{!! EasyForm::viewThumbnail('photo', null, $person->photo) !!}</td>
							<td>
									{!! $person->full_name !!} 
							</td>
							<td>
									{{ $incharge->code }}
							</td>
							<td>
									{{ 	AppHelper::dropdown($incharge->status, 'center_status') }}
							</td>
							<td>
								{{ $incharge->comments }}
							</td>
							<td>
								<a href="{{ route('incharge.view', [$project->model_name, $project->id, $type, $incharge->id]) }}" title="View"  class="btn-sm btn btn-success px-2 fw-bold py-0 mx-1">
									<i class="bi bi-eye"></i>
								</a>
							</td>
							@if($project->status == 'entry')
								<td>
									<a class="btn-sm btn btn-warning px-2 fw-bold py-0 mx-1" title="Edit" href="{{ route('incharge.create', [$project->model_name, $project->id, $type, $incharge->id])}}"><i class="bi bi-pencil-square"></i></a>	
								</td>
							@endif
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<?php 
		if($type == 'ict_tutors'){ 
			$canAdd =  count($incharges) < 7;
		}else{
			$canAdd =  count($incharges) < $project->hasRequiredCenters();
		}?>
	@if($project->model_name != 'cdp_ttp_project')
		@if(isset($project->active_project_incharge->id))
			@if($canAdd) <?php //var_dump($canAdd)?>
				<a href="{{ route('project.check', [$project->model_name, $project->id, $type]) }}" class="btn btn-primary"> <i class="bi bi-plus-circle"></i>  Add New</a>
			@endif
		@endif
	@endif
	@include('project.tabs_close')
@endsection