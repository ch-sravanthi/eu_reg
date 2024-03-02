@extends('layouts.appnew')

@section('title')
	
@endsection

@section('navs')

@endsection

@section('content')
	<div class="card card-body text-center m-3">
		<div class="text-end">
			<a  type="button"  class="btn btn-info" class="btn" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
		</div>
		<div class="text-center p-5">
			<a class="card card-body d-inline-block h5 p-5 me-3" style="background-color: #f4325c; color: #fff; text-decoration: none;" href="{{ route('field_staff_report.sub_menu') }}"><i class="fas fa-tasks"></i> Bill Submission</a>
			<a class="card card-body d-inline-block h5 p-5" style="background-color: #7854f6; color: #fff; text-decoration: none;" href="{{ route('donation.select') }}"><i class="fas fa-money-bill"></i> Donation Submission</a>
		</div>
	</div>
@endsection