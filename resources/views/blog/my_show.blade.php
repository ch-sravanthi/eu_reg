@extends('layouts.app')

@section('title')	
	<a href="#">Job Details</a> 
@endsection

@section('navs')	
	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ url('blog/my_index') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Job Information</li>
	  </ol>
	</nav>
@endsection

@section('content')	


	<div class="form form-view">
			{!! EasyForm::setNoRows() !!}
			{!! EasyForm::setColSizes(3,3) !!}
			
			<div class="d-flex h4 text-sucess">
					{!! EasyForm::viewInput('blog_title', $blog->label('blog_title'), $blog->blog_title) !!}</h5>
			</div>
			<div class="d-flex h5 text-black">			
					{!! EasyForm::viewSelect('category', $blog->label('category'), $blog->category, AppHelper::options('categories')) !!}
			</div>
			<div class="row text-black ">
					{!! EasyForm::viewInput('location', $blog->label('location'), $blog->location) !!}
					</div>
			<div class="row text-black ">
					{!! EasyForm::viewInput('last_date', $blog->label('last_date'), $blog->last_date) !!}
					</div>
			<div class="row text-black ">
					{!! EasyForm::viewInput('description', $blog->label('description'), $blog->description) !!}
			</div>
			
			<div class="row h5 text-black ">
					{!! EasyForm::viewInput('person_name', $blog->label('person_name'), $blog->person_name) !!}
			</div>
			
			<div class="row h5 text-black ">
					{!! EasyForm::viewInput('person_mobile', $blog->label('person_mobile'), $blog->person_mobile) !!}
			</div>
			
			<div class="row h5 text-black ">
					{!! EasyForm::viewInput('person_email', $blog->label('person_email'), $blog->person_email) !!}
			</div>
			
			<div class="row h5 text-success ">
					{!! EasyForm::viewInput('created_at', 'Posted On', $blog->created_at) !!}
			</div>
			
			
			<div class="col-md-12">
				<div class="row">
					<div class="label col-sm-8 ">
						Job Information Attachments
					</div>
					<?php //var_dump($blog->image_1);die();?>
					<div class="col-sm-10 ">
						
						@if($blog->image_1)
							<img src="{{ url('viewfile/'.$blog->image_1) }}" style="background-image: url();width:50%; height:auto;border:1px solid #F8F8F8;"/>
						@endif
						@if($blog->image_1)
							<img  src="{{ url('viewfile/'.$blog->image_2) }}" style="background-image: url();width:50%; height:auto;border:1px solid #F8F8F8;"/>
						@endif
					</div>
					
				</div>
			</div>
@endsection

	
					
					
			