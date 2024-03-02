@extends('layouts.appnew')

@section('title')
	
@endsection

@section('navs')

@endsection

@section('content')
	@include ('common.flash')
	@include ('common.errors')	
	<?php $donationTypes = AppHelper::options('donations')?>
	<?php $isProject = in_array($type, ['cdp', 'al'])?>
	
		{!! Form::open(['url' => route('donation.save', [$type]), 'files' => true, 'id' => 'myform']) !!}
		{{ Form::hidden('uid', $uid) }}
	<div class="card card-body m-3 mb-0"> 
		<div>
			<div class="float-end">
				@if($user)
					<b>Welcome {{ $user[1] }}</b> &nbsp; 
					<a class="btn btn-outline-success" href="{{ route('donation.home') }}"><i class="fas fa-times-circle"></i> Exit</a>	
				@endif
				<a class="btn btn-outline-success" href="{{ route('donation.select') }}"><i class="fas fa-arrow-circle-left"></i> Back</a>	
			</div>
			<h5 class="mb-4">
				<span style="border-bottom: 2px solid {{$donationTypes[$type]['color']}}; display: inline-block!important;">
					{{ $donationTypes[$type]['name'] }}
				</span>
			</h5>
		</div>
		
			{!! EasyForm::setErrors($errors) !!}
			{!! Form::hidden('previous_url', old('previous_url',URL::previous())) !!}
				
			<div class="row form">
				<div class="col col-12 col-md-6 col-lg-3">
					<label>Mode of Payment*</label>
					{!! Form::select('mode_of_payment', ['' =>'-Select-']+AppHelper::options('transaction_types'), '', ['required' => true, 'onchange' => 'trPattern(this)']) !!}														
				</div>
				<div class="col col-12 col-md-6 col-lg-3">	
					<label>Transaction No*.</label>
					{!! Form::text('transaction_no', '', ['pattern' => '[a-zA-Z0-9]+', 'required' => true, 'style'=>"width:230px; max-width:100%!important"]) !!}														
				</div>
				<div class="col col-12 col-md-6 col-lg-3">	
					<label>Transaction Date*</label>
					{!! Form::date('transaction_date', '', ['max' => date('Y-m-d'), 'required' => true]) !!}														
				</div>
				
				<div class="col col-12 col-md-6 col-lg-3">
					<label>Transaction Image(jpg,png)*</label>
					{!!  Form::file('attachment', ['required' => true, 'accept' => '.png, .jpg, .jpeg']) !!}
				</div>
				<div class="col col-12 col-md-6 col-lg-3">	
					<label>State*</label>
					{!!  Form::select('state', ['' =>'-Select-']+AppHelper::options('states'), null,  ['select-id' => 'state', 'required' => true, 'class'=>'flex-fill state', 'onchange' => 'dependentAll(this, "district")']) !!}
				</div>
				
				@if($type == 'other')
					<div class="col col-12 col-md-6 col-lg-3">	
						<label>Category*</label>
						{!!  Form::select('category', ['' =>'-Select-']+AppHelper::options('categories'), null,  [ 'required' => true]) !!}
					</div>				
				@endif
				@if(!$isProject)
					<div class="col col-12 col-md-6 col-lg-3">
						<label>Staff/Contact Person who inspired you*</label>				
						{!!  Form::text('staff_name', '',[ 'required' => true]) !!}
					</div>
				@endif
				<div class="col col-12 col-md-6 col-lg-3">
					<label>Remarks</label>
					{!!  Form::text('remarks', '', ['style' => 'width: 400px']) !!}
				</div>
			</div>

			@if ($donation_record)
				<div class="mt-3">
					<button type="button" onclick="autofill()" class="btn btn-warning btn-sm">Auto fill donor({{ $donation_record['name'] }}) details?</button>
				</div>
				<script>var donation_record = {!! json_encode($donation_record) !!};</script>
			@endif

			<div class="p-3">			
				<div class="table-responsive bill">						
					<table class="table table-bordered table-stripped table-sm" id="idRequirementsTable",>
						<thead class="bg-theme-light">
							<tr>
								<th>Title*</th>
								<th>Name*</th>
								@if(!in_array($type, ['al', 'cdp']))
									<th class="xs">Donor Type*</th>
								@endif
								@if ($isProject)
									<th>Code/App. ID  <i class="fas fa-info-circle text-info pointer" data-bs-toggle="tooltip" title="You can find Application ID in project page*"></i></th>
								@endif
								@if($type == 'magazine')
									<th>Language*</th>
								@endif
								<th>Phone*</th>
								<th>Email*</th>
								<th>Address*</th>
								<th>District*</th>
								<th>Pincode*</th>
								<th>Amount*</th>
								
								<th class="text-center">+/-</th>
							</tr>
						
							<tbody>
								<tr>
									<td class="xs">
										{!!  Form::select('donation[title][]', ['' =>'']+AppHelper::options('titles'), null,  ['id' => 'title', 'required' => true, 'class' => 'title xs']) !!}
									</td>
									<td>
										{!!  Form::text('donation[name][]', '',['class' => 'name', 'placeholder' => 'Name', 'pattern' => '[a-zA-Z. ]+', 'oninput' => 'checkForm();','required' => true]) !!}
									</td>
									@if(!in_array($type, ['al', 'cdp']))
										<td class="xs">
											{!!  Form::select('donation[donor_type][]', ['' =>'']+AppHelper::options('donor_types'), null,  ['id' => 'donor_type', 'required' => true, 'class' => 'donor_type', 'required' => true]) !!}
										</td>
									@endif
									@if ($isProject)
										<td class="sm">
											{!!  Form::text('donation[code][]', '',['placeholder' => 'Code/App.ID', 'class' => 'code']) !!}
										</td>
									@endif
									@if ($type == 'magazine')
										<td class="sm">
										{!!  Form::select('donation[language][]', ['' =>'']+AppHelper::options('our_languages'), null,  ['id' => 'language', 'required' => true, 'class' => 'language xs']) !!}
										</td>
									@endif
									<td class="sm">
										{!!  Form::text('donation[phone][]',old('phone', ''),['placeholder' => 'Phone', 'pattern'=>'[6789][0-9]{9}', 'required' => true, 'class' => 'phone']) !!}
									</td>
									<td>
										{!!  Form::email('donation[email][]', '',['placeholder' => 'Email',  'required' => true, 'class' => 'email']) !!}
									</td>
									<td>
										{!!  Form::text('donation[address][]', '',['placeholder' => 'Address', 'required' => true, 'rows' => 2, 'cols' => 25, 'class' => 'address']) !!}
									</td>
									<td class="sm">
										{!!  Form::select('donation[district][]', ['' =>'-District-'], null, ['required' => true, 'select-id' => 'district', 'class'=>'flex-fill district']) !!}
										{!! FormHelper::dependentScript('district', old('district', ''), AppHelper::options('districts'), 'state', '') !!}		
									</td>
									<td class="xs">
										{!!  Form::text('donation[pin][]', '',['placeholder' => 'Pin', 'pattern' => '[1-9][0-9]{5}', 'required' => true, 'class' => 'pin']) !!}
									</td>
									
									<td class="sm">
										{!! Form::number('donation[amount][]', '',['class' => 'amount', 'placeholder' => 'Amount', 'oninput'=>'checkForm()', 'min' => 1, 'required' => true]) !!}
										<div class="pandiv d-none">
											<b>PAN:</b> 
											 <i class="fas fa-info-circle text-info pointer" data-bs-toggle="tooltip" title="As the donation amount is more than Rs.20,000 you need to mention PAN No.*"></i>
											
												{!! Form::text('donation[pan][]', '', ['class' => 'pan border border-danger sm','placeholder' => 'Enter PAN No.', 'pattern' => '[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}']) !!} 
												
											
										</div>
									</td>
									<td style="min-width: 60px; text-align: center;">
									
										<i class="fas fa-plus-circle text-primary mr-2" title="New Bill" onclick="addNewRow();checkForm();"></i>
										<i class="fas fa-times-circle text-danger" title="Delete Bill" onclick="removeRow(this);checkForm();"></i>
								
									</td>
									
									
								</tr>
							</tbody>
						</thead>
					</table>
				</div>
				</div>
				
					
					
				

			</div>

	<div class="card card-body mx-3 mt-1">
		<h6><u>Summary:</u></h6>
		<div class="d-flex pt-2 pb-3">
			<div class="me-5"><b>Total Donation: </b> <span id="idTotal">0</span></div>
			<div><b>Total Donors: </b> <span id="idCount">0</span></div>
		</div>
		<div class="pb-3 d-none" id="idPan">
			<div class="text-danger"></div>
			<div id="idPanInput">
				
			</div>
		</div>
		<div>
			<button type="submit" id="submit" class="btn btn-success mr-2"><i class="fas fa-spinner fa-spin d-none"></i> Confirm & Save</button>				
			<a class="btn btn-outline-success" href="{{ route('donation.select') }}"> Back</a>
		</div>
	</div>
			
		{!! Form::close() !!}
	<script>
		function checkForm() {
			var amount = 0, count = 0;
			var panNames = [];
			var panVals = [];
			$('.amount').each(function(){
				var v = parseFloat($(this).val());
				if (v >= 20000){
					$(this).parent().find('.pandiv').removeClass('d-none');
					$(this).parent().find('.pan').attr('required', true);
				} else {
					$(this).parent().find('.pandiv').addClass('d-none');
					$(this).parent().find('.pan').attr('required', false);					
				}
				amount += v ? v : 0;
				count++;
			});
			$('#idTotal').html(amount);
			$('#idCount').html(count);
			
		}
	
		function autofill(){
			for(var i in donation_record) {
				if (i == 'district' || i == 'amount') {
					continue;
				}
				var c = document.getElementsByClassName(i);
				if (c.length == 1) {
					c[0].value = donation_record[i];
					if(i == 'state') {
						$(c[0]).trigger("change");
						
						var d = document.getElementsByClassName('district');
						d[0].value = donation_record['district'];
					}
				}
			}
		}
	</script>
@endsection
