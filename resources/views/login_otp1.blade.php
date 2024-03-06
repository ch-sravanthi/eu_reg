@extends('layouts.public')

@section('content')

  <div class="w-50 mx-auto mt-5">
    {{ Form::open(['url' => route('login.verify_otp')]) }}
    <div class="card shadow">
      <div class="card-body">
          <h5 class="mb-5">Verify OTP</h5>

          <div class="mb-3 d-flex">
              <b class="small">Email</b>: {{ $user->email }}
          </div>
          <div class="mb-3 d-flex">
              <b class="small">Mobile</b>: {{ $user->mobile }}
          </div>
          <div class="mb-3">
              <b class="small">Enter OTP</b> {{ Form::text('otp', old('otp', null), ['class' => 'form-control']) }}
          </div>
          <div>
            <button class="btn btn-success me-2">Verify</button>
            <a href="?resend=true" class="btn btn-outline-success">Resend</a>
          </div>
    </div>
  </div>
  {{ Form::close() }}
  </div>

@endsection
