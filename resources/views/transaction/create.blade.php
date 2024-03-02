@extends('layouts.apppartner')

@section('title')
	{{ strtoupper($title) }}
@endsection

@section('navs')

@endsection

@section('content')
	@include ('common.flash')
	@include ('common.errors')
	
	<div class="form my-0 py-0"> <?php //var_dump($promotion->name()); die();?>
		{!! Form::open(['url' => route('transaction.save', [$transaction->name(), $donation_name, $title]), 'files' => true, 'id' => 'myform']) !!}
			{!! EasyForm::setErrors($errors) !!}
			{!! Form::hidden('previous_url', old('previous_url',URL::previous())) !!}
				
			<div class="row">
				<div class="col col-12 col-md-6 col-lg-3">											
					{!! Form::select('mode_of_payment', ['' =>'Select Transaction Type']+AppHelper::options('transaction_types'), $transaction->mode_of_payment, ['required' => true, 'onchange' => 'trPattern(this)']) !!}														
				</div>
				<div class="col col-12 col-md-6 col-lg-3">	
					{!! Form::text('transaction_no', $transaction->transaction_no, ['placeholder' => 'Transaction No.',  'pattern' => '[a-zA-Z0-9]+', 'required' => true]) !!}														
				</div>
				<div class="col col-12 col-md-6 col-lg-3">	
					{!! Form::date('transaction_date', 'Transaction Date', ['placeholder' => 'Transaction Date', 'max' => date('Y-m-d'), 'required' => true]) !!}														
				</div>
				<div class="col col-12 col-md-6 col-lg-3">	
					{!!  Form::select('state', ['' =>'Select State']+AppHelper::options('states'), null,  ['select-id' => 'state', 'required' => true, 'class'=>'flex-fill', 'onchange' => 'dependentAll(this, "district")']) !!}
				</div>
				
				<div class="col col-12 col-md-6 col-lg-3">
					<div class="file d-flex">			
						<div class="flex-fill">
							<div>
								<input type="file" name="attachment" title="Choose bill" onchange="pressed(this)" accept="image/png, image/jpeg" required=true></input>
								<label onclick="this.parentNode.getElementsByTagName('input')[0].click()">Upload Image (jpg,png)</label>
							</div>
						</div>
						<div class="file-button">
							<i class="fas fa-trash" onclick="removeAttachment(this)"></i>
						</div>
					</div>
				</div>
				<div class="col col-12 col-md-6 col-lg-3">	
					{!!  Form::textarea('remarks', '',['placeholder' => 'Remarks', 'rows' => 2, 'cols' => 25]) !!}
				</div>
			</div>
			<div class="py-3">			
				<div class="row bill">						
					<table class="table table-bordered table-stripped table-sm" id="idRequirementsTable",>
						<thead class="bg-theme-light">
							<tr>
								<th>S.no.</th>
								<th>Title</th>
								<th>Name</th>
								<th>Phone</th>
								<th>Email</th>
								<th>Address</th>
								<th>District</th>
								<th>Pin</th>
								<th>Donation</th>
								@if($donation_name=='magazine')
									<th>Preferred Reading Language</th>				
								@endif
								@if(in_array($donation_name,['magazine', 'sb_sunday', 'coin_box', 'donation']))
									<th>Staff who inspired/contacted you</th>
								@endif
								<th></th>
							</tr>
						
							<tbody>
								<tr>
									<td>
										1
									</td>
									<td>
										{!!  Form::select('title[]', ['' =>'']+AppHelper::options('titles'), null,  ['id' => 'title', 'required' => true]) !!}
									</td>
									<td>
										{!!  Form::text('name[]', '',['placeholder' => 'Name', 'pattern' => '[a-zA-Z. ]+','required' => true]) !!}
									</td>
									<td>
										{!!  Form::text('phone[]',old('phone', ''),['placeholder' => 'Phone', 'pattern'=>'[6789][0-9]{9}', 'required' => true]) !!}
									</td>
									<td>
										{!!  Form::email('email[]', '',['placeholder' => 'Email',  'required' => true]) !!}
									</td>
									<td>
										{!!  Form::text('address[]', '',['placeholder' => 'Address', 'required' => true, 'rows' => 2, 'cols' => 25]) !!}
									</td>
									<td>
										{!!  Form::select('district[]', ['' =>'-District-'], null, ['required' => true, 'select-id' => 'district', 'class'=>'flex-fill district']) !!}
										{!! FormHelper::dependentScript('district', old('district', ''), AppHelper::options('districts'), 'state', '') !!}		
									</td>
									<td>
										{!!  Form::text('pin[]', '',['placeholder' => 'Pin', 'pattern' => '[1-9][0-9]{5}', 'required' => true]) !!}
									</td>
									<td>
										{!! Form::number('amount[]', '',['placeholder' => 'Amount', 'onchange'=>'add(); checkForm();', 'min' => 1, 'required' => true]) !!}
									</td>
									@if($donation_name=='magazine')	
										<td>
											{!!  Form::select('language[]', ['' =>'Preferred Reading Language']+AppHelper::options('our_languages'), null,  ['id' => 'language', 'required' => true]) !!}
										</td>
									@endif
									@if(in_array($donation_name,['magazine', 'sb_sunday', 'coin_box', 'donation']))
										<td>
											{!!  Form::text('staff_name[]', '',['placeholder' => 'Staff/Contact',  'required' => true]) !!}
										</td>
									@endif
									<td style="min-width: 60px">
									
										<i class="fas fa-plus-circle text-primary mr-2" title="New Bill" onclick="addNewRow()"></i>
										<i class="fas fa-times-circle text-danger" title="Delete Bill" onclick="removeAttachment(this)"></i>
								
									</td>
									
									
								</tr>
							</tbody>
						</thead>
					</table>
				</div>
				</div>
				
					
					
				

			</div>

			<div class="bordered">
				<h6 class="text-primary"><u>Summary</u></h6>
				
				<div class="d-flex py-3">
					<div class="mr-5"><b>Total Donation: </b> <span>0</span></div>
					<div><b>Total Donors: </b> <span>0</span></div>
				</div>
				<button id="submit" class="btn btn-success mr-2" disabled><i class="fas fa-spinner fa-spin d-none"></i> Save</button>				
				<a class="btn btn-theme" href="{{ route('field_staff_report.donation_sub_menu') }}"> Back</a>
				
				<div class="p-2">Note: Please enter all receipts to enable save button</div>
			</div>
			
		{!! Form::close() !!}
	<script>
		function checkForm() {
			var trVal = $('#transaction_amount').val();
			var totVal = $('#total').val();
			
			if (trVal != totVal) $('#submit').prop( "disabled", true );
			else $('#submit').prop( "disabled", false );
		}
	
	</script>
@endsection
