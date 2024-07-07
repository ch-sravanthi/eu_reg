@extends('layouts.appvv_auth')

@section('title')
	
@endsection

@section('navs')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<<li class="breadcrumb-item"><a href="{{ route('vv.all_in_one') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">VV - Complaints</li>
	  </ol>
	</nav>
@endsection

@section('content')
	<div class="container">
		<div class=" row ">
			<div class="col-lg-4 mb-3">
				<b class = "text-dark">Vidhyarthi Velugu - Complaints</b> 
			<div class="badge bg-info"> {{ $complaints->total() }} </div>
			</div>
			
			<div class="col-lg-8 mb-3">
				<div class="d-lg-flex justify-content-end" style="width: 100%; overflow-x: auto;">
				{!! Form::open(['method' => 'get', 'class' => 'd-flex']) !!}
				
				{!! Form::select('district',  AppHelper::options('districts'), request()->district, ['class' => ' mr-2', 'placeholder' => 'Select District']) !!}&nbsp;
				&nbsp;
				<button class = "btn btn-primary btn-sm mr-2"><i class="bi bi-search"></i></a></button>&nbsp;&nbsp;
				<a class = "btn btn-sm btn-primary mr-2" href = "{{ url('complaints') }}">Reset</a>&nbsp;
				<a class="btn btn-sm btn-primary " href="{{ route('complaint.export',['complaints']) }}?{{ request()->getQueryString() }}" data-toggle="tooltip" title="Report">
				Excel Export</a>
				
				{!! Form::close() !!}	
				
				</div>
			</div>
		</div>

		<div class="card card-body table-wrapper">
			<div class="table-responsive">
				<div class="table-responsive">
					<table class="table table-striped table-hover table-bordered">
						<thead>
							<tr>
								<th>S.No</th>
								<th>NAME </th>
								<th>PHONE NUMBER </th>
								<th>DISTRICT</th>
								<th>Email </th>
								<th>COMPLAINT MESSAGE </th>
								<th>Created On</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1; ?>
							@foreach($complaints as $complaint)
								<tr>
									<td>{{ $i++ }}</td>
									<td> {{ $complaint->full_name }} </td>
									<td>{{ $complaint->phone_no }}</td>
									<td>{{ $complaint->district }}</td>
									<td>{{ $complaint->email }}</td>
									<td>{{ $complaint->complaint_message }}</td>
									<td>{!! date('d M Y', strtotime($complaint->created_at)) !!}</td>
									<td>
										<?php $route = url('complaint/delete/'.$complaint->id)?>
										<a href="#" onclick="deleteRow('{{ $route }}')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a><br>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>	
				{{ $complaints->withQueryString()->links() }}
				</div>
			</div>
		</div>
	</div>
	<script>
		function deleteRow(route) {
		var result = confirm("Are you sure?");
			if(result) {
				location.href = route;
			}
		}
	</script>
@endsection