@extends('layouts.public')

@section('content')

  <div class="w-50 mx-auto mt-5">

  {{ Form::open(['url' => route('signup.validate', 'email')]) }}
    <div class="card shadow">
      <div class="card-body">
          <h5 class="mb-5">Welcome to Signup!</h5>
		  @include('common.flash')

          <div class="mb-3">
              <h5 class="small">Name</h5> {{ Form::text('name', old('name', null), ['class' => 'form-control']) }}
                @if ($errors->has('name'))
                  <div class="text-danger">{{ $errors->first('name') }}</div>
                @endif
          </div>
          <div class="mb-3">
              <h5 class="small">Working Email ID</h5> {{ Form::text('email', old('email', null), ['class' => 'form-control']) }}
                @if ($errors->has('email'))
                  <div class="text-danger">{{ $errors->first('email') }}</div>
                @endif
          </div>
          <div class="mb-3">
              <h5 class="small">Mobile No.</h5> {{ Form::text('mobile', old('mobile', null), ['class' => 'form-control']) }}
                @if ($errors->has('mobile'))
                  <div class="text-danger">{{ $errors->first('mobile') }}</div>
                @endif
          </div>
			<div class="d-flex ">
				<div class="flex-fill"><button class="btn btn-success">Verify</button>	</div>	 
				<a  type="button"  class="btn btn-info" href="{{ route('login') }} "><i class="bi bi-arrow-left"></i>Login</a>
			</div>
        </div>
    </div>
    {{ Form::close() }}
  </div>

@endsection
