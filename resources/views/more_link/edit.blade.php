@extends('layouts.app')

@section('title')	
	<a href="{{ route('welcome') }}">Home</a> 
@endsection

@section('navs')	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('more_link.my_index') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Verify Website URL's : </li>
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
				<h6> Verify Website URL's  :</h6>
				<div class="row">
					<div class="col-lg-6 mb-2">
						{!! EasyForm::textarea('link_url', $more_link->label('link_url'), old('link_url', $more_link->link_url), ['rows' => 3])!!}
					</div>
				</div>
			</div>
			<div class="table-wrapper">
				<fieldset class="section">
					<table class="table table-bordered m-0">
						{!! EasyForm::select('status', $more_link->label('status'), old('status', $more_link->status), AppHelper::options('blog_status'))!!}
							@if($errors->has('status'))
								<div class="text-danger">{{ $errors->first('status') }}</div>
							@endif
					</table>
				</fieldset> 
			</div>
		</div>
	</div>
	
	<div class="text-center">
		<button type="submit" class="btn btn-outline-secondary">Verify Notification</button>
	</div>	
	{{Form::close()}}				
</div>
@endsection		
