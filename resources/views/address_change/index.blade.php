@extends('layouts.appvv_auth')

@section('title')
	
@endsection

@section('navs')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('vv.all_in_one') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">VV - Address Changes </li>
	  </ol>
	</nav>
@endsection

@section('content')
<style>
td{
	font-size:14px;
}
th{
	font-size:15px;
	text-align:center;
}

</style>
	<div class="container">
		<div class=" row ">
			<div class="col-lg-4 mb-3">
				<b class = "text-dark">Address Changes Requests </b>
				<div class="badge bg-info"> {{ $address_changes->total() }} </div>
			</div>
		
			
			<div class="col-lg-8 mb-3">
				<div class="d-lg-flex justify-content-end" style="width: 100%; overflow-x: auto;">
					{!! Form::open(['method' => 'get', 'class' => 'd-flex']) !!}
					
					
					{!! Form::text('full_name', request()->full_name, ['class' => ' mr-4', 'placeholder' => 'Name']) !!}&nbsp;
					&nbsp;
					<button class = "btn btn-primary btn-sm mr-2">Filter</button>&nbsp;&nbsp;
					<a class = "btn btn-sm btn-primary mr-2" href = "{{ url('address_changes.index') }}">Reset</a>&nbsp;
					<a class="btn btn-sm btn-primary " href="{{ route('address_change.export',['address_change']) }}?{{ request()->getQueryString() }}" data-toggle="tooltip" title="Export">
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
						<th>Name </th>
						<th>Phone Number</th>
						<th>Email-Id </th>
						<th>Reference Number</th>
						<th>Old Address </th>
						<th>New Address </th>
						<th>Pincode </th>
						<th>Created On </th>
						<th> </th>
					</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						@foreach($address_changes as $address_change)
							<tr>
								<td>{{ $i++ }}</td>
								<td>{{ $address_change->full_name }}</td>
								<td>{{ $address_change->phone_no }}</td>
								<td>{{ $address_change->email }}</td>
								<td>{{ $address_change->reference_number }}</td>
								<td>{{ $address_change->old_address }}</td>
								<td>{{ $address_change->new_address }}</td>
								<td>{{ $address_change->pincode }}</td>
								<td>{!! date('d M Y', strtotime($address_change->created_at)) !!}</td>
								<td>
								<?php $route = url('address_change/delete/'.$address_change->id)?>
								<a href="#" onclick="deleteRow('{{ $route }}')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a><br>
							
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>	
				{{ $address_changes->withQueryString()->links() }}
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