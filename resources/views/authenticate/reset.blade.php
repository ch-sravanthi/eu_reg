@extends('layouts.public')

@section('content')
<div class="ccard">
			{!! Form::open(['url' => route('password.update')]) !!}
					{{ Form::hidden('token', $token) }}
					<div class="text-center mx-auto mb-5 h2">
						Reset Password
					</div>
					@include('flash')
					
					<div class="mb-4">
						{!! Form::email('email', old('email', ''), ['class' => 'form-control', 'placeholder' => 'Email']) !!}
						
						@if ($errors->has('email'))
							<div class="error">{{ $errors->first('email') }}</div>
						@endif
					</div>
					
					<div class="mb-4">
						{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
						
						<div class="suggestion">The password must be at least 8 characters.</div>
						@if ($errors->has('password'))
							<div class="error">{{ $errors->first('password') }}</div>
						@endif
					</div>					
					
					<div class="mb-4">						
						{!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) !!}
						
						@if ($errors->has('password_confirmation'))
							<div class="error">{{ $errors->first('password_confirmation') }}</div>
						@endif
					</div>
					
					<div class="pb-2">
						<button class="btn-small mr-3 w-100">Reset Password</button>
					</div>
					<div class="text-center small">
						<a href="{{ route('login') }}"><i class="fas fa-arrow-alt-circle-left"></i> Login Page</a>
					</div>
				</div>
			{!! Form::close() !!}
</div>
@endsection