@extends('layouts.public')

@section('content')
<div class="p-5">
			<div class="card mx-auto" style="max-width: 400px;">
				<div class="card-body text-center">
					<div class="pt-3 color1">
						<i class="fas fa-user-circle" style="font-size: 3.5rem;"></i>
					</div>

					<h5 class="pt-3 pb-4">Reset Password</h5>

					{!! Form::open(['url' => route('password.email')]) !!}
						@include('common.flash')
							
						<div  class="mb-4">
							{!! Form::email('email', old('email', ''), ['class' => 'form-control', 'placeholder' => 'Email', 'required' => true]) !!}						
							<div class="medium pt-2 suggestion">We will send password reset link to this email id</div>
							@if ($errors->has('email'))
								<div class="text-danger">{{ $errors->first('email') }}</div>
							@endif
						</div>
						
						<div class="pb-2">
							<button class="btn mr-3 w-100">Send Password Reset Link</button>
						</div>
						<div class="text-center">
							<a href="{{ route('login') }}"><i class="fas fa-arrow-alt-circle-left"></i> Login Page</a>
						</div>
					{!! Form::close() !!}

		</div>
	</div>
</div>
@endsection