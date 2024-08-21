
@extends('layouts.public')
@section('content')
	<div class="py-5 mx-auto" style="max-width: 500px;">
		{!! Form::open(['url' => route('authenticate.vv_all'), 'class' => 'w-100 p-5']) !!}
		<div class="card shadow ">
			<div class="card-body">
				<h5 class="mb-3">VV Subscriber / Admin Login</h5>
				   <div class="mb-3">
						<div class="pb-4">
							{!! Form::email('email', old('email', ''), ['class' => 'form-control', 'placeholder' => 'Please Enter Your Subscribed email ID']) !!}
							@if ($errors->has('email'))
								<div class="text-danger">{{ $errors->first('email') }}</div>
								<script>
									document.addEventListener("DOMContentLoaded", function() {
										myFunction("{{ $errors->first('email') }}");
									});
								</script>
							@endif
						</div>
						
						<div class="pb-2">
							<button class="btn btn-theme mr-3 w-100"  onclick="return validateForm()">Login</button>
								<br/>
								<p style="text-align:center;font-size:15px; line-height:1.2">
									<br>"Issue with login, Please Contact VV Team - <u>9491595765,7993397630</u>"
								</p>
						</div>
					</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
	
	<script>
		function myFunction(errorMessage) {
			if (errorMessage) {
				alert("Error: " + errorMessage);
			}
		}

		function validateForm() {
			var email = document.querySelector("input[name='email']").value;
			
			if (!email) {
				alert("Email field cannot be empty.");
				return false; // Prevent form submission
			}
			if (!$user) { 
				alert("Please Subscribe VV Softcopy");
				return false; 
			}
			
			return true;
		}
	</script>

@endsection
