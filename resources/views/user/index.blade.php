@extends('layouts.appuser')

@section('title')
	
@endsection

@section('navs')

@endsection

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-lg-4 mb-3">
					<b class = "text-dark">Users </b>
					<div class="badge bg-info"> {{ $users->total() }} </div>
						<a class="btn btn-sm btn-warning mr-2" href="{{url('user/create')}}"> <i class="bi bi-plus-circle"></i>User</a>
			</div>	
			<div class="col-lg-8 mb-3">
				<div class="d-lg-flex justify-content-end" style="width: 100%; overflow-x: auto;">
					{!! Form::open(['method' => 'get', 'class' => 'd-flex']) !!}
						{!! Form::text('search', request()->search, ['class' => ' mr-4', 'placeholder' => 'Name/Email/Any']) !!}&nbsp;
						<button  class="btn btn-primary btn-sm mr-2">
							<i class="bi bi-search"></i>
						</button>&nbsp;
					<a class = "btn btn-sm btn-primary mr-2" href = "{{ route('user.index') }}">Reset</a>&nbsp;
					{!! Form::close() !!}	&nbsp;
				</div>
			</div>
		</div>
		
		<div class="table-responsive">
			<table class="table table-striped table-hover table-bordered">
				<thead>
					 <tr>
						<th style="text-align:center;">S.No</th>
						<th>User Name</th>
						<th>Email Id</th>
						<th>Mobile Number</th>
						<th>Role</th>
						<th>Status</th>
						
					 </tr>
				</thead>
				<?php $s=1;?>
				@foreach($users as $user)
				<?php $opt = AppHelper::options('categories'); 	?>
					<tr>
						<th style="text-align:center;">{{ $s++ }}</th>
						
						<td> {{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->mobile}}</td>
						<td>{{ $user->role}} </td>
						<td>{{ $user->status }}</td>
						
					</tr>
				@endforeach
			</table>
			{{ $users->withQueryString()->links() }}
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