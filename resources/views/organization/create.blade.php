@extends('layouts.app')

@section('title')	
	<a href="{{ route('home') }}">Home</a>
	
	<a href="#">Edit Organization Details</a>
@endsection


@section('navs')	
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Organization</li>
	  </ol>
	</nav>
@endsection

@section('content')	
<script type="text/javascript">

function getRegistration() {
	
	var chk = document.querySelector('input[name="is_registered"]:checked');
	  if(chk && chk.value == 'Yes'){
		document.getElementById("ifYes").style.display = 'block';
		document.getElementById("ifNo").style.display = 'none';
	  }
	  else{
		document.getElementById("ifYes").style.display = 'none'; 
		document.getElementById("ifNo").style.display = 'block'; 
	  }
}

function getfcraValue() {
	
	
	var chk = document.querySelector('input[name="is_fcra"]:checked');
	  if(chk && chk.value == 'Yes'){
			document.getElementById("iffcraYes").style.display = 'block'; 
	  } else{
		document.getElementById("iffcraYes").style.display = 'none'; 
	  }
}
</script>
	<?php $readonlyMain = isset($organization->partner_id);?>
	<?php $readonly = false;?>
	
		<div class="form">
			{!! EasyForm::setErrors($errors) !!}
			{!! EasyForm::setNoRows() !!}
			{!! EasyForm::setColSizes(3, 3) !!}
			
			{!! Form::open(['url' => route('organization.save', (isset($organization->id) ? $organization->id : null)), 'id' => 'idForm', 'files' => true]) !!}
			
					
				{!! EasyForm::setColSizes(6, 6) !!}
				<div class="row">
					<div class="col-lg-12"><h6>Organization Details</h6></div>
					<div class="col-lg-6 row">
						{!! EasyForm::input('organization_name', $organization->label('organization_name'), old('organization_name', $organization->organization_name), ['readonly' => $readonlyMain])!!}
				
						{!! EasyForm::select('denomination', $organization->label('denomination'), old('denomination', $organization->denomination), AppHelper::options('denominations'), ['readonly' => $readonlyMain]) !!}
						{!! EasyForm::dependent('sub_denomination', $organization->label('sub_denomination'), old('sub_denomination', $organization->sub_denomination), AppHelper::options('sub_denominations'), 'denomination', ['readonly' => $readonlyMain])!!}
				
						{!! EasyForm::radio('is_registered', $organization->label('is_registered'), old('is_registered', $organization->is_registered), AppHelper::options('yes_no_list'),['onclick' => 'getRegistration()']) !!}
						
						
						
					
					
					</div>
					<div class="col-lg-6 row">
				
						{!! EasyForm::checkbox('objectives', $organization->label('objectives'), old('objectives', $organization->objectives), AppHelper::options('organization_objectives')) !!}
				
					</div>
				</div>
				
				{!! EasyForm::setColSizes(3, 3) !!}
			
				
				<div id="ifYes" style="display:none">
					<h6>Registration Details</h6>
					<div class="row">
					
						{!! EasyForm::radio('is_church', $organization->label('is_church'), old('is_church', $organization->is_church), AppHelper::options('yes_no_list')) !!}
						
						{!! EasyForm::select('registration_type', $organization->label('registration_type'), old('registration_type', $organization->registration_type), AppHelper::options('registration_type'))!!}
						
						{!! EasyForm::input('registration_number', $organization->label('registration_number'), old('registration_number', $organization->registration_number))!!}
						
						{!! EasyForm::File('registration_attachment', $organization->label('registration_attachment'), $organization->registration_attachment) !!}
					
						{!! EasyForm::date('registration_date', $organization->label('registration_date'), old('registration_date', $organization->registration_date), ['class' => 'dob'])!!}
					
						{!! EasyForm::radio('is_fcra', $organization->label('is_fcra'), old('is_fcra', $organization->is_fcra), AppHelper::options('yes_no_list'),['onclick' => 'getfcraValue()']) !!}
						
						
					</div>
				</div>
				
				<div id="ifNo" style="display:none">
					<div class="row">
					
						<div class="col-lg-12"><h6>Organization Chief Functionality</h6></div>
					
						{!! EasyForm::radio('organization_type', $organization->label('organization_type'), old('organization_type', $organization->organization_type), AppHelper::options('non_registration_type')) !!}
						
						{!! EasyForm::textarea('description', $organization->label('description'), old('description', $organization->description))!!}
					</div>
				</div>
				
				{!! EasyForm::setColSizes(3, 3) !!}
				
				<div id="iffcraYes" style="display:none">
					
					<h6>FCRA & FCRA Bank Details</h6>				
					<div class="row">
						{!! EasyForm::input('fcra_no', $organization->label('fcra_no'), old('fcra_no', $organization->fcra_no), ['readonly' => $readonly])!!}
						{!! EasyForm::File('fcra_copy', $organization->label('fcra_copy'), $organization->fcra_copy, ['readonly' => $readonly]) !!} 
						
					
						{!! EasyForm::input('passbook_name', $bank_account->label('passbook_name'), old('passbook_name', $bank_account->passbook_name), ['readonly' => $readonly])!!}
						{!! EasyForm::input('account_no', $bank_account->label('account_no'), old('account_no', $bank_account->account_no), ['readonly' => $readonly])!!}
						{!! EasyForm::input('ifsc_code', $bank_account->label('ifsc_code'), old('ifsc_code', $bank_account->ifsc_code), ['readonly' => $readonly])!!}
					</div>
					
					<div class="row">		
						{!! EasyForm::input('swift_code', $bank_account->label('swift_code'), old('swift_code', $bank_account->swift_code), ['readonly' => $readonly])!!}
						{!! EasyForm::select('bank_name', $bank_account->label('bank_name'), old('bank_name', $bank_account->bank_name), AppHelper::options('banks'), ['readonly' => $readonly]) !!}
						{!! EasyForm::input('branch_name', $bank_account->label('branch_name'), old('branch_name', $bank_account->branch_name), ['readonly' => $readonly])!!}
						{!! EasyForm::input('branch_code', $bank_account->label('branch_code'), old('branch_code', $bank_account->branch_code), ['readonly' => $readonly])!!}
						{!! EasyForm::File('passbook_copy', $bank_account->label('passbook_copy'), $bank_account->passbook_copy, ['readonly' => $readonly]) !!} 
						{!! EasyForm::File('fcra_copy_apv', $bank_account->label('fcra_copy_apv'), $bank_account->fcra_copy_apv, ['readonly' => $readonly]) !!} 
					</div>
				</div>
				
				<h6>Head Office Address</h6>
				<div class="row">
						
						{!! EasyForm::select('state', $organization->label('state'), old('state', $organization->state), AppHelper::options('states'), ['readonly' => $readonly]) !!}	
						{!! EasyForm::dependent('district', $organization->label('district'), old('district', $organization->district), AppHelper::options('districts'), 'state', ['readonly' => $readonly])!!}
						{!! EasyForm::input('city', $organization->label('city'), old('city', $organization->city), ['readonly' => $readonly])!!}
						{!! EasyForm::input('street', $organization->label('street'), old('street', $organization->street), ['readonly' => $readonly])!!}
					
						{!! EasyForm::input('pin', $organization->label('pin'), old('pin', $organization->pin), ['readonly' => $readonly])!!}
						{!! EasyForm::input('phone_mobile', $organization->label('phone_mobile'), old('phone_mobile', $organization->phone_mobile), ['readonly' => $readonly])!!}
						{!! EasyForm::input('email', $organization->label('email'), old('email', $organization->email), ['readonly' => $readonly])!!}
				</div>

				<h6>Head of the Organization Details</h6>
				<div class="row">
						{!! EasyForm::select('titles', $organization->label('titles'), old('titles', $organization->titles), AppHelper::options('titles'), ['readonly' => $readonly])!!}
						{!! EasyForm::input('organization_head', $organization->label('organization_head'), old('organization_head', $organization->organization_head), ['readonly' => $readonlyMain])!!}
						{!! EasyForm::input('address_proof_id', $organization->label('address_proof_id'), old('address_proof_id', $organization->address_proof_id), ['readonly' => $readonlyMain])!!}
					
						{!! EasyForm::File('id_proof', $organization->label('id_proof'), old('id_proof',  $organization->id_proof), ['readonly' => $readonlyMain])!!}
						{!! EasyForm::File('photo', $organization->label('photo'), old('photo',  $organization->photo), ['readonly' => $readonly])!!}
						{!! EasyForm::input('designation', $organization->label('designation'), old('designation', $organization->designation), ['readonly' => $readonly])!!}
						{!! EasyForm::radio('gender', $organization->label('gender'), old('gender', $organization->gender), AppHelper::options('gender'), ['readonly' => $readonly]) !!}
				</div>	
					
				<div class="py-3">
					<button type="button" class="btn btn-success" onclick="saveModel(this)">@include('layouts.loader') Save <span class="progressval"></span></button>
				</div>
			{!! Form::close() !!}
		</div>
		<script>
			getRegistration();
			getfcraValue();
		</script>
@endsection
