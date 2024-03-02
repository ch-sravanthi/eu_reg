@extends('layouts.app')


@section('dashboard')

<div class="container my-5">
	@if ($organization)
		<div class="card shadow">
			<div class="card-body">
				<div class="table-wrapper">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Organization</th>
								<th>Head of the Organization</th>
								<th>Partner ID</th>
								<th>Denomination</th>
								<th>State</th>
								<th>Address Proof ID</th>
								<th>View</th>
								<th>Edit</th>
							</tr>
						</thead>
						<tbody> <?php //var_dump($organizations);die();?>
							@if ($organization)				
								<tr>
									<td>
										@if ($organization)
										<?php $excerpt = AppHelper::excerpt($organization->organization_name,25)?>
											<div title="{{ $excerpt != $organization->organization_name ? $organization->organization_name : '' }}">{{ $excerpt }}
											</div>
										@endif	
									</td>
									<td>
										{!! $organization->organization_head !!}
									</td>
									<td>
										{!! isset($organization->partner_id) ? $organization->partner_id : '<span class="text-danger">In Process</span>' !!}
									</td>
									<td>
										{!! EasyForm::valueSelect($organization->denomination, AppHelper::options('denominations')) !!}
									</td>
									<td>
										{!! EasyForm::valueSelect($organization->state, AppHelper::options('states')) !!}
									</td>
									<td>{!! $organization->address_proof_id !!}</td>	
									<td>
										<a href="{{ route('organization.view') }}" title="View"  class="btn-sm btn btn-success px-2 fw-bold py-0 mx-1">
											<i class="bi bi-eye"></i>
										</a>
									</td>
									<td>
										<a class="btn-sm btn btn-warning px-2 fw-bold py-0 mx-1" title="Edit" href="{{ route('organization.create')}}"><i class="bi bi-pencil-square"></i></a>		
									</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div> 
			</div>
		</div>
	
			<div class="card shadow mt-3">
				<div class="card-body">

					<div class="table-wrapper">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Project Year</th>
									<th>Zone</th>
									<th>State</th>
									<th>Status</th>
									<th>View</th>
									<th>Edit</th>
								</tr>
							</thead>
							<tbody>
							@if($projects)
								@foreach($projects as $project)									
									<tr>										
										<td>
											{!! $project->project_year !!}
										</td>
										<td>
											{!! EasyForm::valueSelect($project->zone, AppHelper::options('zones')) !!}
										</td>
										<td>
											{!! EasyForm::valueSelect($project->state, AppHelper::options('states')) !!}
										</td>
										<td class="{{ $project->status == 'created' ? 'text-danger' : '' }}">
											{{ $project->status == 'created' ? 'Saved' : 'Submitted' }}
										</td>
										<td>
											<a href="{{ route('project.view', [$project->model_name, $project->id]) }}" title="View"  class="btn-sm btn btn-success px-2 fw-bold py-0 mx-1">
												<i class="bi bi-eye"></i>
											</a>
										</td>
										<td>
											@if(!in_array($project->status,['entry','submitted', 'approved']))
												<a class="btn-sm btn btn-warning px-2 fw-bold py-0 mx-1" title="Edit" href="{{ route('project.create', [$project->model_name, $project->id])}}"><i class="bi bi-pencil-square"></i></a>
											@endif
										</td>
									</tr>
								@endforeach
							@endif
							
							@if (!isset($organization->partner_id))
								<tr>
									<th colspan=6><h5 class="text-danger">Projects can be added after Partner ID is alloted</h5></th>
								</tr>
							
							@endif
							</tbody>
						</table>
					</div> 
				</div> 
			</div>
	@else
		<div class="card ">
			<div class="card-body text-center shadow">
					<a href="{{ route('organization.create') }}" class="btn btn-danger btn-lg">Enroll New Organization</a>
		  </div>
		</div>
	@endif
</div> 
@endsection




