@extends('layouts.appvv_auth')

@section('title')
	
@endsection

@section('navs')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('vv.all_in_one') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">VV - Magazine</li>
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
				<b class = "text-dark">Magazine</b> 
				<div class="badge bg-info"> {{ $vv_magazines->total() }} </div>
			</div>
			
			<div class="col-lg-10 mb-3">
				<div class="d-lg-flex justify-content-end" style="width: 100%; overflow-x: auto;">
				{!! Form::open(['method' => 'get', 'class' => 'd-flex']) !!}
				
				{!! Form::text('name_of_the_file', request()->name_of_the_file, ['class' => ' mr-2', 'placeholder' => 'File Name']) !!}&nbsp;
				
				{!! Form::select('magazine_copy', AppHelper::options('vv_months'), request()->magazine_copy, ['class' => ' mr-2', 'placeholder' => ' Select Month ']) !!}
				{!! Form::select('vv_year', AppHelper::options('vv_years'), request()->vv_year, ['class' => ' mr-2', 'placeholder' => ' Select Year ']) !!}
				<button  class="btn btn-primary btn-sm mr-2">
					<i class="bi bi-search"></i>
				</button>&nbsp;
				<a class = "btn btn-sm btn-primary mr-2" href = "{{ url('vv_magazines') }}">Reset</a>&nbsp;
				<a class = "btn btn-sm btn-primary mr-2" href = "{{ url('vv_magazine/upload') }}"> Upload </a>&nbsp;
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
								<th>Magazine Title</th>
								<th>Magazine Copy</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php $r = 1; ?>
						@foreach($vv_magazines as $vv_magazine)
							<tr class="text-center">
								<td>{{ $r++}}</td>
								<td>{{ $vv_magazine->magazine_month }} &nbsp;{{ $vv_magazine->magazine_year }}</td>
								<td>
									{{ $vv_magazine->name_of_the_file }}
								</td>
								<td style="width:50%;">
									@if($vv_magazine->cover_page)
										<img src="{{ url('viewfile/'.$vv_magazine->cover_page) }}" style="background-image: url();width:20%; height:auto;border:1px solid #F8F8F8;"/>
									@else
										<img src="{{ asset('/images/default_magazine.png')}}" style="background-image: url();width:20%; height:auto;border:1px solid #F8F8F8;"/>
									@endif
								
								   <?php $ext = pathinfo($vv_magazine->magazine_copy, PATHINFO_EXTENSION); ?>
									@if($ext == 'pdf')
                                    {!! EasyForm::viewFile('magazine_copy', '', $vv_magazine->magazine_copy) !!}
                               
                                @endif
								</td>
								<td>
									<?php $editRoute = url('vv_magazine/upload/'.$vv_magazine->id)?>
									<a href="{{ $editRoute }}" class="btn btn-sm btn-danger"><i class="bi bi-pencil"></i></a>
									<?php $route = url('vv_magazine/delete/'.$vv_magazine->id)?>
									<a href="#" onclick="deleteRow('{{ $route }}')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a><br>
								</td>
								
							</tr>
						@endforeach
						</tbody>
					</table>
					{{ $vv_magazines->withQueryString()->links() }}
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
