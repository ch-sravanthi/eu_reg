@extends('layouts.app')

@section('title')	
	<a href="{{ route('welcome') }}">Home</a> 
@endsection

@section('navs')	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('more_link.index') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Verify Notification Details </li>
	  </ol>
	</nav>
@endsection

@section('content')	

<div class="container">
	<div class="table table-striped ">
		{!! Form::open(['url' => route('more_link.update', [$more_link->id]),'method' => 'post', 'id' => 'idForm', 'files' => true]) !!}		
		{!! EasyForm::setErrors($errors) !!}
			@csrf
		<div class="">
				<div class="card-header">
					<h6> Please Enter Notification Details :</h6>
					<div class="row">
			
						<div class="col-lg-6 mb-2">
							<label>  </label>
								
								{!! EasyForm::textarea('link_url', $more_link->label('link_url'), old('link_url', $more_link->link_url), ['rows' => 3])!!}
									
						</div>
					</div>
				</div>
			</div>
		</div>
			<div class="row">
			   <div class="col-lg-12 text-center p-2">
				   {{Form::submit('Submit', ['class' => 'btn btn-success']) }}
			   </div>
			</div> 
		{{Form::close()}}	
    </div>

@endsection		
