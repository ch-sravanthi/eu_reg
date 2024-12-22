@extends('layouts.appvv_auth')


@section('title')
	
@endsection

@section('navs')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('vv.all_in_one') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">VV - Subscription</li>
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
					<b class = "text-dark">Vidhyarthi Velugu - Subscribers </b>
						
			</div>	
			<div class="col-lg-8 mb-3">
				<div class="d-lg-flex justify-content-end" style="width: 100%; overflow-x: auto;">
					{!! Form::open(['method' => 'get', 'class' => 'd-flex']) !!}
						{!! Form::select('district',  AppHelper::options('districts'), request()->district, ['class' => ' mr-2', 'placeholder' => 'Select District']) !!}&nbsp;
						<button  class="btn btn-primary btn-sm mr-2">
							<i class="bi bi-search"></i>
						</button>&nbsp;
					<a class = "btn btn-sm btn-primary mr-2" href = "{{ route('new_subscriptions') }}">Reset</a>&nbsp;
					<a class="btn btn-sm btn-primary " href="{{ route('new_subscription.export',['new_subscriptions']) }}?{{ request()->getQueryString() }}" data-toggle="tooltip" title="Report">
					Excel Export</a>
					{!! Form::close() !!}	&nbsp;
				</div>
			</div>
		</div>
		
		<div class="table-responsive">
			<table class="table table-striped table-hover table-bordered">
				<thead>
					 <tr>
						<th>S.No</th>
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
				@foreach($new_subscriptions as $new_subscription)
					<tr>
						<th style="text-align:center;">{{ $s++ }}</th>
						<td>
							<a href="{{ url('new_subscription/show/'.$new_subscription->id) }}">
							{{ $new_subscription->email }}</a>
						</td>
						<td>{{ $new_subscription->full_name }}</td>
						<td>{{ $new_subscription->type_of_subscription }}</td>
						<td>{{ $new_subscription->mobile_num}}</td>
						<td>{{ $new_subscription->address}},
							{{ $new_subscription->district }},
							{{ $new_subscription->pincode }},
							@if($new_subscription->state)
								{{ $new_subscription->state }} 
							@else
								{{ $new_subscription->other_state }}
							@endif
						</td>
						<td>{{ $new_subscription->date }}</td>
						<td>{{ $new_subscription->reference_number }}</td>
						<td>{{ $new_subscription->amount }}</td>
						<td>{{ date('d M Y', strtotime($new_subscription->created_at)) }}</td>
						<td>
							<?php $route = url('new_subscription/delete/'.$new_subscription->id)?>
							<a href="#" onclick="deleteRow('{{ $route }}')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a><br>
						</td>
						
					</tr>
				@endforeach
			</table>
			{{ $new_subscriptions->withQueryString()->links() }}
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
	<style>
		 svg,.shadow-sm{
			display:none;
		}
		.bg-white{
			background-color:#d77878 !important;
		}
	<style>	
@endsection