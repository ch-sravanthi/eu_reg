@extends('layouts.appvv')
@section('title')	
	<a href="{{ route('home') }}">Home</a> 
@endsection

@section('navs')	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		@if(Auth::user())
			<li class="breadcrumb-item"><a href="{{ route('vv.all_in_one') }}">Home</a></li>
		@else
			<li class="breadcrumb-item"><a href="{{ route('authenticate.vv') }}">Home</a></li>
		@endif
		<li class="breadcrumb-item active" aria-current="page">VV Magazine Feedback Entries :</li>
	  </ol>
	</nav>
@endsection


@section('content')	
	<style>
		
		input {
			width:11px;
		}
		.form-check{
			line-height:2;
		}
		label{
			font-size:17px;
		}
	</style>
	{!! Form::open(['url' => route('feedback.save', $feedback->id)]) !!}
	
<div class="container ">
	<div class="p-2 bg-light">
		<h2 class="card bg-dark text-white text-center p-3">Vidhyarthi Velugu Magazine Feedback Form</h2>
			<h5 class="text-center">Your Suggestions help to Improve the Quality of the Magazine</h5>
	</div>
		<div class="col-lg-12  text-danger">
			Note: * Mark as Mandatory.
		</div>
			<div class="row p-3">
				
				<div class="col-lg-6 mb-6">
					<label class="mt-3">1. How would you rate the overall quality of the articles in our magazine?</label>
						
						{!! EasyForm::radio('rate', '', old('rate', $feedback->rate), AppHelper::options('rate')) !!}
						@if($errors->has('rate'))
							<div class="text-danger">{{ $errors->first('rate') }}</div>
						@endif
						
					<label class="mt-3">2. What type of articles/ information do you find most interesting? please tick the applicable*</label>
							
							{!! EasyForm::checkbox('article', '', old('article', $feedback->article), AppHelper::options('article')) !!}
						@if($errors->has('article'))
							<div class="text-danger">{{ $errors->first('article') }}</div>
						@endif
						
					
					
				</div>
				
				<div class="col-lg-6 ">
				
					<label class="mt-3">3. Are there any topics or themes you would like to see covered more frequently?</label>
						
						{!! EasyForm::textarea('topics_themes', '', old('topics_themes', $feedback->topics_themes), ['rows' => 4])!!}
						
						@if($errors->has('topics_themes'))
							<div class="text-danger">{{ $errors->first('topics_themes') }}</div>
						@endif
						
					<label class="mt-3">4. Is there anything else you would like to share with us about your experience with our magazine?</label>
						
						{!! EasyForm::textarea('experience', '', old('experience', $feedback->experience), ['rows' => 4])!!}
						
						@if($errors->has('experience'))
							<div class="text-danger">{{ $errors->first('experience') }}</div>
						@endif
						
				
					<label class="mt-3">5. Do you have any other suggestions, comments to improve VV?</label>
						
						{!! EasyForm::textarea('comments', '', old('comments', $feedback->comments), ['rows' => 4])!!}
						
						@if($errors->has('comments'))
							<div class="text-danger">{{ $errors->first('comments') }}</div>
						@endif
						
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-12 mb-2 text-center">
				<button class="btn btn-success">Submit</button>
				</div>
			</div>
	
</div>
	{!! Form::close() !!}		
 
@endsection	