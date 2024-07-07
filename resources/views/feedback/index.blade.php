@extends('layouts.appvv_auth')

@section('title')
	
@endsection

@section('navs')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('vv.all_in_one') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">VV - Magazine Feedbacks</li>
	  </ol>
	</nav>
@endsection

@section('content')

	<div class="container">
		<div class=" row ">
			<div class="col-lg-4 mb-3">
				<b class = "text-dark">VV - Magazine Feedbacks</b> 
				<div class="badge bg-info"> {{ $feedbacks->total() }} </div>
			</div>
			
			<div class="col-lg-8 mb-3">
				<div class="d-lg-flex justify-content-end" style="width: 100%; overflow-x: auto;">
				{!! Form::open(['method' => 'get', 'class' => 'd-flex']) !!}
					{!! Form::select('article',  AppHelper::options('article'), request()->article, ['class' => ' mr-2', 'placeholder' => 'Select Article']) !!}&nbsp;
					&nbsp;
					<button class = "btn btn-primary btn-sm mr-2"><i class="bi bi-search"></i></a></button>&nbsp;&nbsp;
					<a class = "btn btn-sm btn-primary mr-2" href = "{{ url('feedbacks') }}">Reset</a>&nbsp;
					<a class="btn btn-sm btn-primary " href="{{ route('feedback.export',['prayer_points']) }}?{{ request()->getQueryString() }}" data-toggle="tooltip" title="Report">
					Export</a>
				
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
							<th>Article</th>
							<th>Rate</th>
							<th>Themes</th>
							<th>Experience</th>
							<th>Comments</th>
							<th>Created On</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $r=1; ?>
						@foreach($feedbacks as $feedback)
						<tr>
							<td>{{ $r++}}</td>
							<td>{{ $feedback->article }}</td>
							<td>{{ EasyForm::valueSelect($feedback->rate, AppHelper::options('rate'))  }}</td>
							<td>{{ $feedback->topics_themes }}</td>
							<td>{{ $feedback->experience }}</td>
							<td>{{ $feedback->comments }}</td>
							<td>{!! date('d M Y', strtotime($feedback->created_at)) !!}</td>
							<td>
								<?php $route = url('feedback/delete/'.$feedback->id)?>
								<a href="#" onclick="deleteRow('{{ $route }}')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a><br>
							
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				{{ $feedbacks->withQueryString()->links() }}
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