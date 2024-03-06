@extends('layouts.page')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mailtoharshit/San-Francisco-Font-/sanfrancisco.css">
  <style>
    body{
      font-family: "San Francisco";
      background: #642B73;  /* fallback for old browsers */
background: -webkit-linear-gradient(to top, #C6426E, #642B73);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to top, #C6426E, #642B73); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }
    .shadow{
      width: 600px;
      margin-left: auto;
      margin-right: auto;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }     
  </style>
  <div class=" mt-5">
    {{ Form::open(['url' => route('signup.verify_otp', $type)]) }}
    <div class="card shadow">
      <div class="card-body">
          <h5 class="mb-5">Verify {{ $user->label($type) }}</h5>

          <div class="mb-3 d-flex">
              <h6>{{ $user->label($type) }}<h6>: {{ $user->$type }}
          </div>
          <div class="mb-3">
              <h6>Enter OTP<h6> {{ Form::text('otp', old('otp', null), ['class' => 'form-control']) }}
          </div>
          <div>
            <button class="btn btn-success me-2">Verify</button>
            <button class="btn btn-outline-success">Resend</button>
          </div>
    </div>
  </div>
  {{ Form::close() }}
  </div>

@endsection
