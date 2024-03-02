<style>
	input, select{
		width: 100%;
	}
	input[type=file]{
		width: 100%;
	}
	.row{
		border: 1px solid #ccc;
		border-radius: 3px;
		background-color: #eee;
		position: relative;
		padding: 1rem 2rem;
	}
	.col{
		margin: 0.5rem 0rem;
	}
	.buttons{
		position: absolute;
		right: 3px;
		top: 0px;
		font-size: 1.1rem;
		cursor: pointer;
	}
	.bill{
		padding: 1.25rem 0.5rem 0.5rem 0.5rem!important;
		margin-bottom: 0.5rem;
	}
	.file{
		border: 1px solid #555;
		border-radius: 3px;
		padding1:0;
		margin-bottom: 0.5rem;
	}
	.file .file-buttons{
		min-width: 50px;
	}
	.file i{
		cursor: pointer;
		padding: 0px 5px;
		margin:0;
		position:relative;
	}
	input[type=file]{
		position: absolute;
		width: 1px;
	}
	.file label{
		background-color: #e0ebf7;
		min-height: 24px;
		margin:0;
		padding: 0px 5px;
		width:100%
	}
</style>
<script src="{{ asset('js/cdp_print.js?v=1.2') }}"></script>
<?php //$arr = explode('_',trim($project->name()));?>
	
<div class="row">

		<div class="col col-12 col-md-6 col-lg-3">											
			{!! Form::select('mode_of_payment', ['' =>'Select Transaction Type']+AppHelper::options('transaction_types'), $transaction->mode_of_payment, ['required' => true, 'onchange' => 'trPattern(this)']) !!}														
		</div>
		<div class="col col-12 col-md-6 col-lg-3">	
			{!! Form::text('transaction_no', $transaction->transaction_no, ['placeholder' => 'Transaction No.',  'required' => true]) !!}														
		</div>
		<div class="col col-12 col-md-6 col-lg-3">	
			{!! Form::text('transaction_amount', '', ['placeholder' => 'Transaction Amount',  'required' => true]) !!}														
		</div>
		<div class="col col-12 col-md-6 col-lg-3">
			{!!  Form::text('total_amount',  old('total_amount', ''), ['placeholder' => 'Total Amount', 'readonly' => 'true', 'id'=>'total']) !!}
		</div>
		<div class="col col-12 col-md-6 col-lg-3">	
			{!! Form::date('transaction_date', 'Transaction Date', ['placeholder' => 'Transaction Date',  'required' => true]) !!}														
		</div>
		<div class="col col-12 col-md-6 col-lg-3">
			<div class="file d-flex">			
				<div class="flex-fill">
					<div>
						<input type="file" name="attachment" title="Choose bill" onchange="pressed(this)" required=true></input>
						<label onclick="this.parentNode.getElementsByTagName('input')[0].click()">Upload Image</label>
					</div>
				</div>
				<div class="file-button">
					<i class="fas fa-trash" onclick="removeAttachment(this)"></i>
				</div>
			</div>
		</div>
	
</div>
<div class="py-3">
	<div class="row bill">
		<div class="col col-12 col-md-6 col-lg-3">
			{!!  Form::text('name[]', '',['placeholder' => 'Name', 'required' => true]) !!}
		</div>
		<div class="col col-12 col-md-6 col-lg-3">
			{!!  Form::text('phone[]',old('phone', ''),['placeholder' => 'Phone', 'pattern'=>'[6789][0-9]{9}', 'required' => true]) !!}
		</div>	
		<div class="col col-12 col-md-6 col-lg-3">
			{!!  Form::email('email[]', '',['placeholder' => 'Email',  'required' => true]) !!}
		</div>
		<div class="col col-12 col-md-6 col-lg-3">
			{!!  Form::textarea('address[]', '',['placeholder' => 'Address', 'required' => true, 'rows' => 2, 'cols' => 25]) !!}
		</div>

		<div class="col col-12 col-md-6 col-lg-6 d-flex">
			{!!  Form::select('state[]', ['' =>'Select State']+AppHelper::options('states'), null,  ['select-id' => 'state', 'required' => true, 'class'=>'flex-fill', 'onchange' => 'dependent(this)']) !!}
			{!!  Form::select('district[]', ['' =>'Select District'], null, ['select-id' => 'district', 'required' => true, 'class'=>'flex-fill']) !!}
			{!! FormHelper::dependentScript('district', old('district', ''), AppHelper::options('districts'), 'state', '') !!}			
		</div>	

		<div class="col col-12 col-md-6 col-lg-3">
			{!!  Form::number('pin[]', '',['placeholder' => 'Pin', 'required' => true]) !!}
		</div>	
		<div class="col col-12 col-md-6 col-lg-3">	
			{!! Form::number('amount[]', '',['placeholder' => 'Donation Amount', 'onchange'=>'add()', 'required' => true]) !!}											
		</div>
		@if($donation_name=='magazine')
			<div class="col col-12 col-md-6 col-lg-3">
				{!!  Form::select('language[]', ['' =>'Preferred Reading Language']+AppHelper::options('our_languages'), null,  ['id' => 'language', 'required' => true]) !!}
			</div>
		@endif
		@if($donation_name!='magazine')
			<div class="col col-12 col-md-6 col-lg-3">
				{!!  Form::textarea('remarks', old('remarks', ''), ['placeholder' => $donation->label('remarks'), 'rows' => 2, 'cols' => 25]) !!}
			</div>
		@endif
		<div class="buttons">
			<i class="fas fa-plus-circle text-primary mr-2" title="New Bill" onclick="addNewMultiAttachment(this)"></i>
			<i class="fas fa-times-circle text-danger" title="Delete Bill" onclick="removeAttachment(this)"></i>
		</div>
	</div>
</div>

<div class="row">
	<div class="col col-12">
		<button id="submit" class="btn btn-success mr-2"><i class="fas fa-spinner fa-spin d-none"></i> Save</button>				
		<a class="btn btn-theme" href="{{ route('field_staff_report.donation_sub_menu') }}"> Back</a>
	</div>
	
</div>
<div>
<div>
<script type="text/javascript">
	
  </script>