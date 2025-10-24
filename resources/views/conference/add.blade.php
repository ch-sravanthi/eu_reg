@extends('layouts.appuser')

@section('title')	
	Register for Conferences
@endsection

@section('content')	
<style>
	label { line-height: 3; }
</style>

<div class="container">
	<div class="table table-striped">
	{!! Form::open(['url' => route('conference.save', [$conference->id ?? null]), 'id' => 'idForm']) !!}	
	@csrf
	{!! EasyForm::setErrors($errors) !!}	

	<div class="col-lg-12 text-danger mb-3">
		<h4>Please keep following details ready before proceeding to Registration. <br>
		1) Name of the person who is recommending you (EGF committee member OR Staff OR DC)<br>
		2) Fee paid details UTR number , date of Payment</h4>
	</div>
	
	<div class="col-lg-12 text-danger mb-3">
		Note: * Marked fields are mandatory.
	</div>

	<div class="card-header col-lg-12">
		<h6>Personal Details:</h6>
		<div class="row">
			<div class="col-lg-6 mb-2">
				<label>{{ $conference->nicenames['full_name'] }}</label>
				{{ Form::text('full_name', old('full_name', $conference->full_name), ['class' => 'form-control']) }}
			</div>
			<div class="col-lg-6 mb-2">
				<label>{{ $conference->nicenames['email'] }}</label>
				{{ Form::email('email', old('email', $conference->email), ['class' => 'form-control']) }}
			</div>
			<div class="col-lg-6 mb-2">
				<label>{{ $conference->nicenames['gender'] }}</label>
				{{ Form::select('gender', ['Male'=>'Male', 'Female'=>'Female'], old('gender', $conference->gender), ['class' => 'form-control']) }}
			</div>
			<div class="col-lg-6 mb-2">
				<label>{{ $conference->nicenames['mobile_no'] }}</label>
				{{ Form::text('mobile_no', old('mobile_no', $conference->mobile_no), ['class' => 'form-control']) }}
			</div>
		</div>
	</div>

	<div class="card-header mt-3 col-lg-12">
		<h6>Recommendation & Region Details:</h6>
		<div class="row">
			<div class="col-lg-6 mb-2">
				<label>{{ $conference->nicenames['recommender_type'] ?? 'Recommender Type' }}</label>
				{{ Form::select('recommender_type', ['conference Committee Member'=>'conference Committee Member','Staff'=>'Staff','DC'=>'DC'], old('recommender_type', $conference->recommender_type), ['class' => 'form-control mb-2']) }}
			</div>
			<div class="col-lg-6 mb-2">
				<label>{{ $conference->nicenames['category'] ?? 'Category' }}</label>
				{{ Form::select('category', ['Member'=>'Member','Guest'=>'Guest','Other'=>'Other'], old('category', $conference->category), ['class' => 'form-control mb-2']) }}
			</div>
			<div class="col-lg-6 mb-2">
				<label>{{ $conference->nicenames['attending_as'] ?? 'Attending As' }}</label>
				{{ Form::select('attending_as', ['Self'=>'Self','With Family'=>'With Family','Accompanying'=>'Accompanying'], old('attending_as', $conference->attending_as), ['class' => 'form-control']) }}
			</div>
			<div class="col-lg-6 mb-2">
				{{ Form::select('recommender_type', ['conference Committee Member'=>'conference Committee Member','Staff'=>'Staff','DC'=>'DC'], old('recommender_type', $conference->recommender_type), ['class' => 'form-control']) }}
			</div>
			<div class="col-lg-6 mb-2">
				<label>{{ $conference->nicenames['region'] }}</label>
				{{ Form::select('region', ['Hyderabad'=>'Hyderabad','Rangareddy'=>'Rangareddy'], old('region', $conference->region), ['class' => 'form-control']) }}
			</div>
			<div class="col-lg-6 mb-2">
				<label>{{ $conference->nicenames['uesi_district_hyd'] }}</label>
				{{ Form::text('uesi_district_hyd', old('uesi_district_hyd', $conference->uesi_district_hyd), ['class' => 'form-control']) }}
			</div>
			<div class="col-lg-6 mb-2">
				<label>{{ $conference->nicenames['uesi_district_rr'] }}</label>
				{{ Form::text('uesi_district_rr', old('uesi_district_rr', $conference->uesi_district_rr), ['class' => 'form-control']) }}
			</div>
			 
			<div class="col-lg-6 mb-2">
				<label>{{ $conference->nicenames['recommender_name'] }}</label>
				{{ Form::text('recommender_name', old('recommender_name', $conference->recommender_name), ['class' => 'form-control']) }}
			</div>
			<div class="col-lg-6 mb-2">
				<label>{{ $conference->nicenames['recommender_mobile'] }}</label>
				{{ Form::text('recommender_mobile', old('recommender_mobile', $conference->recommender_mobile), ['class' => 'form-control']) }}
			</div>
		</div>
	</div>

	<div class="card-header mt-3 col-lg-12">
		<h6>Family & Children Details:</h6>
		<div class="row">
			<div class="col-lg-6 mb-2">
				<label>{{ $conference->nicenames['spouse_name'] }}</label>
				{{ Form::text('spouse_name', old('spouse_name', $conference->spouse_name), ['class' => 'form-control']) }}
			</div>
			<div class="col-lg-6 mb-2">
				<label>{{ $conference->nicenames['spouse_contact'] }}</label>
				{{ Form::text('spouse_contact', old('spouse_contact', $conference->spouse_contact), ['class' => 'form-control']) }}
			</div>
			<div class="col-lg-6 mb-2">
				<label>{{ $conference->nicenames['children_count_below_15'] }}</label>
				{{ Form::number('children_count_below_15', old('children_count_below_15', $conference->children_count_below_15), ['class' => 'form-control']) }}
			</div>
			<div class="col-lg-6 mb-2">
				<label>{{ $conference->nicenames['children_count_above_15'] }}</label>
				{{ Form::number('children_count_above_15', old('children_count_above_15', $conference->children_count_above_15), ['class' => 'form-control']) }}
			</div>
			<div class="col-lg-4 mb-2">
				<label>{{ $conference->nicenames['child_1_name'] }}</label>
				{{ Form::text('child_1_name', old('child_1_name', $conference->child_1_name), ['class' => 'form-control']) }}
			</div>
			<div class="col-lg-4 mb-2">
				<label>{{ $conference->nicenames['child_2_name'] }}</label>
				{{ Form::text('child_2_name', old('child_2_name', $conference->child_2_name), ['class' => 'form-control']) }}
			</div>
			<div class="col-lg-4 mb-2">
				<label>{{ $conference->nicenames['child_3_name'] }}</label>
				{{ Form::text('child_3_name', old('child_3_name', $conference->child_3_name), ['class' => 'form-control']) }}
			</div>
		</div>
	</div>

	<div class="card-header mt-3 col-lg-12">
		<h6>Transaction Details:</h6>
		<div class="row">
			<div class="col-lg-6 mb-2">
				<label>{{ $conference->nicenames['registration_fee'] }}</label>
				{{ Form::text('registration_fee', old('registration_fee', $conference->registration_fee), ['class' => 'form-control']) }}
			</div>
			<div class="col-lg-6 mb-2">
				<label>{{ $conference->nicenames['transaction_date'] }}</label>
				{{ Form::date('transaction_date', old('transaction_date', $conference->transaction_date), ['class' => 'form-control']) }}
			</div>
			<div class="col-lg-6 mb-2">
				<label>{{ $conference->nicenames['transaction_channel'] }}</label>
				{{ Form::text('transaction_channel', old('transaction_channel', $conference->transaction_channel), ['class' => 'form-control']) }}
			</div>
			<div class="col-lg-6 mb-2">
				<label>{{ $conference->nicenames['transaction_utr'] }}</label>
				{{ Form::text('transaction_utr', old('transaction_utr', $conference->transaction_utr), ['class' => 'form-control']) }}
			</div>
			<div class="col-lg-12 mb-2">
				<label>{{ $conference->nicenames['transaction_remarks'] }}</label>
				{{ Form::textarea('transaction_remarks', old('transaction_remarks', $conference->transaction_remarks), ['class' => 'form-control','rows'=>3]) }}
			</div>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-lg-12 text-center p-2">
			{{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
		</div>
	</div>

	{!! Form::close() !!}
	</div>
</div>
@endsection
