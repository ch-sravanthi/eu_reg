@extends('layouts.app')

@section('navs')	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">New Project</li>
	  </ol>
	</nav>
@endsection

@section('content')	

	<?php $projects = AppHelper::options('programs')?>
	<div class="row">
	@foreach($projects as $k => $v)
		@if (in_array($k, ['wep_project', 'llt_batch']) || ($k == 'ict_project' && !$organization->apply_ict))
			@continue
		@endif
		
		<div class="col col-12 col-lg-3 my-4">
			<div class="card btn" onclick="location.href='{{  route('project.create',$k) }}'">
				<div class="card-body">
							{{$v}}
				</div>
			 </div>
		</div>
	@endforeach
	</div>
	

@endsection