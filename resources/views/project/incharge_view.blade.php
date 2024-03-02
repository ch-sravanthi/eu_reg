@extends('layouts.app')


@section('navs')	
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <?php $name = explode('_',$model_name)?>
    <li class="breadcrumb-item active" aria-current="page">{{strtoupper($name[0])}} {{strtoupper($name[1])}}</li> 
  </ol>
</nav>
@endsection


@section('content')	
	
	@include('project.tabs')	
	

		{!! EasyForm::setErrors($errors) !!}
		{!! EasyForm::setNoRows() !!}
		{!! EasyForm::setColSizes(2, 4) !!}	
		
		@include('project.incharge_view_details')
		
	@include('project.tabs_close')
@endsection	
