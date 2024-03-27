@extends('layouts.app')

@section('title')	
	<a href="{{ route('welcome') }}">Home</a> 
@endsection

@section('navs')	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('notification.my_index') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Verify Notification Details </li>
	  </ol>
	</nav>
@endsection

@section('content')	

<div class="container">
	<div class="table table-striped ">
		{!! Form::open(['url' => route('notification.update', [$notification->id]),'method' => 'post', 'id' => 'idForm', 'files' => true]) !!}		
		{!! EasyForm::setErrors($errors) !!}
			@csrf
		<div class="form form-view">
			<div class="table-wrapper">
				<fieldset class="section">
					<table class="table table-bordered m-0">

						<tr>
							<th>{{ $notification->label('description') }}</th>	
							<td colspan=7 style="width:100%;">
								
								{!! EasyForm::textarea('description', '', old('description', $notification->description), ['rows' => 10])!!}
								@if($notification->image_1)
									<img src="{{ url('viewfile/'.$notification->image_1) }}" style="background-image: url();width:50%; height:auto;border:1px solid #F8F8F8;"/>
								@endif
								</td>
						</tr>
						
						<tr>
							<th>Posted On</th>	
							<td>{{ $notification->created_at }}</td>
						</tr>
						
						<tr>	
							<th>Person Name</th>	
							<td>{{ $notification->person_name }}</td>
						
							<th>Person Mobile No</th>	
							<td>{{ $notification->person_mobile }}</td>
							
							<th>Person E-mail</th>
							<td>{{ $notification->person_email }}</td>
						</tr>
						
						<tr>
							<th>{{ $notification->label('status') }}</th>	
							<td colspan=5>{{ $notification->status }}</td>
						</tr>
					</table>
				</fieldset> 
			</div>
				
			
		</div>
				
		<div class="table-wrapper">
			<fieldset class="section">
				<table class="table table-bordered m-0">
					{!! EasyForm::select('status', $notification->label('status'), old('status', $notification->status), AppHelper::options('blog_status'))!!}
						@if($errors->has('status'))
							<div class="text-danger">{{ $errors->first('status') }}</div>
						@endif
				</table>
			</fieldset> 
		</div>
		<br><br>
		
		<div class="text-center">
			<button type="submit" class="btn btn-outline-secondary">Verify Notification</button>
		</div>				
		</div>
		{{Form::close()}}	
    </div>

@endsection		
