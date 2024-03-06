@extends('layouts.app')

@section('title')	
	<a href="{{ route('welcome') }}">Home</a> 
@endsection

@section('navs')	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Verify Job Details </li>
	  </ol>
	</nav>
@endsection

@section('content')	

<div class="container">
	<div class="table table-striped ">
			{!! Form::open(['url' => route('blog.update', [$blog->id]),'method' => 'post', 'id' => 'idForm', 'files' => true]) !!}		
			{!! EasyForm::setErrors($errors) !!}
			@csrf
			{!! EasyForm::setNoRows() !!}
			{!! EasyForm::setColSizes(3,3) !!}
			
			
			
			<div class="d-flex h4 text-sucess">
					{!! EasyForm::viewInput('blog_title', $blog->label('blog_title'), $blog->blog_title) !!}</h5>
					
			</div>
			<div class="d-flex h5 text-warning">			
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
			
			<div class="row h5 text-success ">
					{!! EasyForm::viewInput('created_at', 'Posted On', $blog->created_at) !!}
			</div>
			
			<div class="col-md-12">
				<div class="row">
					<div class="label col-sm-2 ">
							  Attachments
					</div>
					
					<div class="col-sm-10 ">
						@if($blog->image_1)
							<img src="{{ url('viewfile/'.$blog->image_1) }}" style="background-image: url();width:30%; height:auto;border:1px solid #F8F8F8;"/>
						@endif
						@if($blog->image_1)
							<img  src="{{ url('viewfile/'.$blog->image_2) }}" style="background-image: url();width:30%; height:auto;border:1px solid #F8F8F8;"/>
						@endif
					</div>
					
				</div>
				
				<div class="row">
					{!! EasyForm::select('status', $blog->label('status'), old('status', $blog->status), AppHelper::options('blog_status'))!!}
					@if($errors->has('status'))
						<div class="text-danger">{{ $errors->first('status') }}</div>
					@endif
				</div>
				<br><br>
			<div class="text-center">
				<button type="submit" class="btn btn-outline-secondary">Verify Job Details</button>
			</div>				
			</div>
			{{Form::close()}}	
    </div>
</div>		

@endsection		
