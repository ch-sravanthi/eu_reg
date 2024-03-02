@extends('layouts.public')

@section('content')

  <div class="w-50 mx-auto mt-5">

  {{ Form::open(['url' => route('login')]) }}
    <div class="card shadow">
      <div class="card-body">
          <h5 class="mb-5">Welcome to Login!</h5>
			@include('common.flash')
          <div class="mb-3">
			<div class="pb-4">
				{!! Form::text('email', old('email', ''), ['class' => 'form-control', 'placeholder' => 'Email']) !!}
				@if ($errors->has('email'))
					<div class="text-danger">{{ $errors->first('email') }}</div>
				@endif
			</div>
             

				
          </div>
         
          <div>
            <button class="btn btn-success">Login</button>
          </div>
        </div>
    </div>
    {{ Form::close() }}
  </div>

@endsection
