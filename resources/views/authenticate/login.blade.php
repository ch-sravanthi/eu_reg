
@extends('layouts.public')
@section('content')
	<div class="py-5 mx-auto" style="max-width: 500px;">
		{!! Form::open(['url' => route('authenticate.authenticate'), 'class' => 'w-100 p-5']) !!}
		<div class="card shadow ">
			<div class="card-body">
				<h5 class="mb-3">Welcome to Login!</h5>
				   <div class="mb-3">
						<div class="pb-4">
							{!! Form::email('email', old('email', ''), ['class' => 'form-control', 'placeholder' => 'Email']) !!}
							@if ($errors->has('email'))
								<div class="text-danger">{{ $errors->first('email') }}</div>
							@endif
						</div>
						
						<div class="pb-2">
							<button class="btn btn-theme mr-3 w-100">Login</button>
						</div>
					</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
@endsection