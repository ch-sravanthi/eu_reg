@extends('layouts.appvv_auth')

@section('title')
	
@endsection

@section('navs')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('authenticate.vv') }}">Home</a></li>
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
			<div class="col-lg-2 mb-3">
				<b class = "text-dark">VV Prayer Points</b> 
				<div class="badge bg-info"> {{ $vv_prayer_points->total() }} </div>
			</div>
			
			<div class="col-lg-10 mb-3">
				<div class="d-lg-flex justify-content-end" style="width: 100%; overflow-x: auto;">
				{!! Form::open(['method' => 'get', 'class' => 'd-flex']) !!}
				
				{!! Form::select('vv_month', AppHelper::options('vv_months'), request()->vv_month, ['class' => ' mr-2', 'placeholder' => ' Select Month ']) !!}
				{!! Form::select('vv_year', AppHelper::options('vv_years'), request()->vv_year, ['class' => ' mr-2', 'placeholder' => ' Select Year ']) !!}
				
				 &nbsp;
				<button  class="btn btn-primary btn-sm mr-2">
					<i class="bi bi-search"></i>
				</button>&nbsp;
				<a class = "btn btn-sm btn-primary mr-2" href = "{{ url('vv_prayer_points') }}">Reset</a>&nbsp;
				<a class = "btn btn-sm btn-primary mr-2" href = "{{ url('vv_prayer_point/upload') }}"> <i class="bi bi-plus-square-fill"></i></a>&nbsp;
				
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
								<th>Month - Year</th>
								<th>Prayer Points Attachment</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php $r = 1; ?>
						@foreach($vv_prayer_points as $vv_prayer_point)
							<tr class="text-center">
								<td>{{ $r++}}</td>
								<td>{{ $vv_prayer_point->vv_month }}&nbsp; - {{ $vv_prayer_point->vv_year }}</td>
								<td>
								   <?php $ext = pathinfo($vv_prayer_point->attachment_1, PATHINFO_EXTENSION); ?>
									@if($ext == 'pdf')
                                    {!! EasyForm::viewFile('attachment_1', '', $vv_prayer_point->attachment_1) !!}
                               
                                @endif
								</td>
								<td>
									<?php $editRoute = url('vv_prayer_point/upload/'.$vv_prayer_point->id)?>
									<a href="{{ $editRoute }}" class="btn btn-sm btn-danger"><i class="bi bi-pencil"></i> </a>
									<?php $route = url('vv_prayer_point/delete/'.$vv_prayer_point->id)?>
									<a href="#" onclick="deleteRow('{{ $route }}')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a><br>
								</td>
								
							</tr>
						@endforeach
						</tbody>
					</table>
					{{ $vv_prayer_points->withQueryString()->links() }}
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
