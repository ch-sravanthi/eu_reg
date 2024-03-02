@extends('layouts.app')

@section('title')	
	<a href="{{ route('home') }}">Home</a> 
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



		<div class="form form-view">
			{!! EasyForm::setNoRows() !!}
			{!! EasyForm::setColSizes(3,3) !!}
			<h6>Organization Details</h6>
			<div class="row">
					{!! EasyForm::viewInput('partner_id', $organization->label('partner_id'),  $organization->partner_id) !!}
					{!! EasyForm::viewInput('objectives', $organization->label('objectives'), $organization->objectives) !!}
					{!! EasyForm::viewInput('organization_name', $organization->label('organization_name'), $organization->organization_name) !!}
			</div>
			<div class="row">			
					{!! EasyForm::viewSelect('denomination', $organization->label('denomination'), $organization->denomination, AppHelper::options('denominations')) !!}
					
					{!! EasyForm::viewDependent('sub_denomination', $organization->label('sub_denomination'), $organization->sub_denomination, AppHelper::options('sub_denominations'), $organization->denomination) !!}
					@if($organization->is_registered == 'No')					
						<div class="col-lg-12"><h6>Organization Chief Functionality</h6></div>
						{!! EasyForm::viewSelect('organization_type', $organization->label('organization_type'), $organization->organization_type, AppHelper::options('non_registration_type')) !!}	
						{!! EasyForm::viewInput('description', $organization->label('description'), $organization->description) !!}					
					@endif
					
					{!! EasyForm::viewSelect('is_registered', $organization->label('is_registered'), $organization->is_registered, AppHelper::options('yes_no_list')) !!}					
				
			</div>
			
			@if($organization->is_registered == 'Yes')	
				<h6>Registration Details</h6>		
				<div class="row">					
						{!! EasyForm::viewSelect('is_church', $organization->label('is_church'), $organization->is_church, AppHelper::options('yes_no_list')) !!}
						
						{!! EasyForm::viewSelect('registration_type', $organization->label('registration_type'), $organization->registration_type, AppHelper::options('registration_type')) !!}
						
					
						{!! EasyForm::viewInput('registration_date', $organization->label('registration_date'), $organization->registration_date) !!}
						
						{!! EasyForm::viewInput('registration_number', $organization->label('registration_number'), $organization->registration_number) !!}
						
						{!! EasyForm::viewSelect('is_fcra', $organization->label('is_fcra'), $organization->is_fcra, AppHelper::options('yes_no_list')) !!}
						
						{!! EasyForm::viewFile('registration_attachment', $organization->label('registration_attachment'), $organization->registration_attachment) !!} 
					
						
					
				</div>
			@endif
			
			@if($organization->is_fcra == 'Yes')
				<h6>FCRA & FCRA Bank Details</h6>				
				<div class="row">
						{!! EasyForm::viewInput('fcra_no', $organization->label('fcra_no'), $organization->fcra_no) !!}
						
						{!! EasyForm::viewFile('fcra_copy', $organization->label('fcra_copy'), $organization->fcra_copy) !!} 
						
						{!! EasyForm::viewFile('fcra_copy_apv', $organization->label('fcra_copy_apv'), $organization->fcra_copy_apv) !!}
				</div>
			
			
				<div class="row">			
						{!! EasyForm::viewInput('passbook_name', $bank_account->label('passbook_name'), $bank_account->passbook_name) !!}	
						
						
						{!! EasyForm::viewInput('account_no', $organization->label('account_no'), $bank_account->account_no) !!}	
						
						
						{!! EasyForm::viewInput('ifsc_code', $bank_account->label('ifsc_code'), $bank_account->ifsc_code) !!}	
						
					
						{!! EasyForm::viewInput('swift_code', $organization->label('swift_code'), $bank_account->swift_code) !!}
						
						{!! EasyForm::viewSelect('bank_name', $bank_account->label('bank_name'), $bank_account->bank_name, AppHelper::options('banks')) !!}
						
						{!! EasyForm::viewInput('branch_name', $organization->label('branch_name'), $bank_account->branch_name) !!}
						
						{!! EasyForm::viewInput('branch_code', $organization->label('branch_code'), $bank_account->branch_code) !!}
						
						{!! EasyForm::viewFile('passbook_copy', $organization->label('passbook_copy'), $bank_account->passbook_copy) !!} 
						
				</div>	
			@endif
			
			
			<h6>Organization Address</h6>
			<div class="row">
					{!! EasyForm::viewSelect('state', $organization->label('state'), $organization->state, AppHelper::options('states')) !!}
					{!! EasyForm::viewDependent('district', $organization->label('district'), $organization->district, AppHelper::options('districts'), $organization->state) !!}
					{!! EasyForm::viewInput('city', $organization->label('city'), $organization->city) !!}
					{!! EasyForm::viewInput('street', $organization->label('street'), $organization->street) !!}
				
					{!! EasyForm::viewInput('pin', $organization->label('pin'), $organization->pin) !!}
					{!! EasyForm::viewInput('phone_mobile', $organization->label('phone_mobile'), $organization->phone_mobile) !!}
					{!! EasyForm::viewInput('email', $organization->label('email'), $organization->email) !!}
			</div>
			
			<h6>Head of the Organization Details</h6>
			<div class="row">
					{!! EasyForm::viewInput('titles', $organization->label('titles'), AppHelper::multiple($organization->titles,'titles', '', '. ')) !!}
					
					{!! EasyForm::viewInput('organization_head', $organization->label('organization_head'), $organization->organization_head, AppHelper::options('titles')) !!}
					
					{!! EasyForm::viewInput('address_proof_id', $organization->label('address_proof_id'), $organization->address_proof_id) !!}
					
					{!! EasyForm::viewInput('designation', $organization->label('designation'), $organization->designation) !!}
					
					{!! EasyForm::viewSelect('gender', $organization->label('gender'), $organization->gender, AppHelper::options('gender')) !!}
			</div>
			<div class="row">				
					{!! EasyForm::viewFile('id_proof', $organization->label('id_proof'), $organization->id_proof) !!}
					{!! EasyForm::viewFile('photo', $organization->label('photo'), $organization->photo) !!}	
					
			</div>
				
			
		</div>
@endsection
