@extends('layouts.appvv_auth')

@section('title')
	
@endsection

@section('navs')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('vv.all_in_one') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">VV - Prayer Points</li>
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
				<b class = "text-dark">Prayer Points</b> 
				<div class="badge bg-info"> {{ $prayer_points->total() }} </div>
			</div>
			
			<div class="col-lg-8 mb-3">
				<div class="d-lg-flex justify-content-end" style="width: 100%; overflow-x: auto;">
				{!! Form::open(['method' => 'get', 'class' => 'd-flex']) !!}
				{!! Form::select('region',  AppHelper::options('cities'), request()->region, ['class' => ' mr-2', 'placeholder' => 'Select Region']) !!}&nbsp;
				
				{!! Form::select('district',  AppHelper::options('districts'), request()->district, ['class' => ' mr-2', 'placeholder' => 'Select District']) !!}&nbsp;
				
				&nbsp;
					<button  class="btn btn-primary btn-sm mr-2">
						<i class="bi bi-search"></i>
					</button>&nbsp;&nbsp;&nbsp;
				<a class = "btn btn-sm btn-primary mr-2" href = "{{ url('prayer_points') }}">Reset</a>&nbsp;
				<a class="btn btn-sm btn-primary " href="{{ route('prayer_point.export',['prayer_points']) }}?{{ request()->getQueryString() }}" data-toggle="tooltip" title="Report">
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
								<th>EU Name</th>
								<th>Region</th>
								<th>District</th>
								<th>Place</th>
								<th>Thank God for</th>
								<th>Pray for</th>
								<th>Name </th>
								<th> Email ID </th>
								<th> Mobile Number </th>
								<th> Responsibility in EU/EGF Committee</th>
								<th>Created On</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						<?php $r = 1; ?>
						@foreach($prayer_points as $prayer_point)
							<tr>
								<td>{{ $r++}}</td>
								<td>
									<a href="{{ url('prayer_point/show/'.$prayer_point->id) }}">{{ $prayer_point->eu_name }}</a>
								</td>
								<td>{{ $prayer_point->region }}</td>
								<td>{{ $prayer_point->district }}</td>
								<td>{{ $prayer_point->place }}</td>
								<td>{{ $prayer_point->thank_god }}</td>
								<td>{{ $prayer_point->prayer }}</td>
								<td>{{ $prayer_point->full_name }}</td>
								<td>{{ $prayer_point->email }}</td>
								<td>{{ $prayer_point->mobile }}</td>
								<td>{{ $prayer_point->responsibility }}</td>
								<td>{!! date('d M Y', strtotime($prayer_point->created_at)) !!}</td>
								<td>
									<?php $route = url('prayer_point/delete/'.$prayer_point->id)?>
									<a href="#" onclick="deleteRow('{{ $route }}')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a><br>
								
								</td>
								
							</tr>
						@endforeach
						</tbody>
					</table>
					{{ $prayer_points->withQueryString()->links() }}
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
