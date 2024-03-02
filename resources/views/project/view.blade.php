@extends('layouts.app')


@section('navs')
	
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Project</li>
  </ol>
</nav>
@endsection

@section('content')	
	@include('project.tabs')
	
	@include('project.view_project_details')
@include('project.tabs_close')
@endsection