@extends('layouts.appvv_auth')

@section('title')
	
@endsection

@section('navs')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('vv.all_in_one') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">VV - Renewal Subscribers</li>
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
					<b class = "text-dark">Vidhyarthi Velugu - Renewal Subscribers </b>
						
			</div>	
			<div class="col-lg-8 mb-3">
				<div class="d-lg-flex justify-content-end" style="width: 100%; overflow-x: auto;">
					{!! Form::open(['method' => 'get', 'class' => 'd-flex']) !!}
						{!! Form::select('district',  AppHelper::options('districts'), request()->district, ['class' => ' mr-2', 'placeholder' => 'Select District']) !!}&nbsp;
						<button  class="btn btn-primary btn-sm mr-2">
							<i class="bi bi-search"></i>
						</button>&nbsp;
					<a class = "btn btn-sm btn-primary mr-2" href = "{{ route('renewals') }}">Reset</a>&nbsp;
					<a class="btn btn-sm btn-primary " href="{{ route('renewal.export',['renewals']) }}?{{ request()->getQueryString() }}" data-toggle="tooltip" title="Report">
					Excel Export</a>
					{!! Form::close() !!}	&nbsp;
				</div>
			</div>
		</div>
		
		<div class="table-responsive">
			<table class="table table-striped table-hover table-bordered">
				<thead>
					 <tr>
						<th style="text-align:center;">S.No</th>
						<th>Email</th>
						<th>Name</th>
						<th>Subscription Type</th>
						<th>Mobile</th>
						<th>Full Address </th>
						<th>Transaction Date</th>
						<th>Transaction Number</th>
						<th>Amount </th>
						<th>Created On</th>
						<th></th>
						
					 </tr>
				</thead>
				<?php $s=1;?>
				@foreach($renewals as $renewal)
				<?php $opt = AppHelper::options('categories'); 	?>
					<tr>
						<th style="text-align:center;">{{ $s++ }}</th>
						<td>
							<a href="{{ url('renewal/show/'.$renewal->id) }}">
							{{ $renewal->email }}</a>
						</td>
						<td>{{ $renewal->full_name }}</td>
						<td>{{ $renewal->type_of_subscription }}</td>
						<td>{{ $renewal->address}},
							{{ $renewal->district }},
							{{ $renewal->pincode }},
							@if($renewal->state)
								{{ $renewal->state }} 
							@else
								{{ $renewal->other_state }}
							@endif
						</td>
						<td>{{ $renewal->date }}</td>
						<td>{{ $renewal->reference_number }}</td>
						<td>{{ $renewal->amount }}</td>
						<td>{{ date('d M Y', strtotime($renewal->created_at)) }}</td>
						<td>
							<?php $route = url('renewal/delete/'.$renewal->id)?>
							<a href="#" onclick="deleteRow('{{ $route }}')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a><br>
						</td>
						
					</tr>
				@endforeach
			</table>
			{{ $renewals->withQueryString()->links() }}
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