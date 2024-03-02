<div class="row">
	<div class="col col-12 col-md-6 col-lg-3"> 
		{!!  Form::number('project_code', old('project_code', ''), ['placeholder' => 'Project Code (serial no. only)', 'min'=>'1000', 'max' => '40000', 'required' => true]) !!}
	</div>
	<div class="col col-12 col-md-6 col-lg-3">
		{!!  Form::text('name', old('name', ''), ['placeholder' => $ministry_donation->label('name'), 'pattern' => '[a-zA-Z. ]+', 'required' => true]) !!}
	</div>
	<div class="col col-12 col-md-6 col-lg-3">
		{!!  Form::text('phone', old('phone', ''), ['placeholder' => 'Phone No.',  'pattern'=>'[6789][0-9]{9}', 'required' => true]) !!}
	</div>	
	<div class="col col-12 col-md-6 col-lg-3">
		{!!  Form::email('email', old('email', ''), ['placeholder' => 'Email',  'required' => true]) !!}
	</div>	
	<div class="col col-12 col-md-6 col-lg-3">
		{!!  Form::textarea('address', old('address', ''), ['placeholder' => $ministry_donation->label('address'), 'required' => true, 'rows' => 2, 'cols' => 25]) !!}
	</div>

	<div class="col col-12 col-md-6 col-lg-6 d-flex">
		{!!  Form::select('state', ['' =>'Select State']+AppHelper::options('states'), null,  ['select-id' => 'state', 'required' => true, 'class'=>'flex-fill', 'onchange' => 'dependent(this)']) !!}
		{!!  Form::select('district', ['' =>'Select District'], null, ['select-id' => 'district', 'required' => true, 'class'=>'flex-fill']) !!}
		{!! FormHelper::dependentScript('district', old('district', ''), AppHelper::options('districts'), 'state', '') !!}			
	</div>	

	<div class="col col-12 col-md-6 col-lg-3">
		{!!  Form::text('pin', old('pin', ''),['placeholder' => $ministry_donation->label('pin'), 'pattern' => '[1-9][0-9]{5}', 'required' => true]) !!}
	</div>
		
</div>
<div class="py-3">
	<div class="row bill">
		<div class="col col-12 col-md-6 col-lg-3">																										
			{!! Form::select('transaction_type[]', ['' =>'Select Transaction Type']+AppHelper::options('transaction_types'), $ministry_donation->transaction_type, ['required' => true, 'onchange' => 'trPattern(this)']) !!}														
		</div>
		<div class="col col-12 col-md-6 col-lg-3">	
			{!! Form::text('transaction_no[]', $ministry_donation->transaction_no, ['placeholder' => 'Transaction No.',  'pattern' => '[a-zA-Z0-9]+', 'required' => true]) !!}	
			
			{!!Form::hidden('term[]','books')!!}			
		</div>
		<div class="col col-12 col-md-6 col-lg-3">	
			{!! Form::date('transaction_date[]', 'Transaction Date', ['placeholder' => 'Transaction Date', 'max' => date('Y-m-d'), 'required' => true]) !!}														
		</div>
		<div class="col col-12 col-md-6 col-lg-3">	
			{!! Form::number('amount[]', $ministry_donation->amount, ['placeholder' => 'Amount', 'onchange'=>'add()', 'min' => 1, 'required' => true]) !!}														
		</div>
		<div class="col col-12 col-md-6 col-lg-3">
			<div class="file d-flex">			
				<div class="flex-fill">
					<!--{!! Form::file('attachment[]',  ['required' => true]) !!}-->
					<div>
						<input type="file" name="attachment[]" title="Choose bill" onchange="pressed(this)" accept="image/png, image/jpeg" required=true>
						<label onclick="this.parentNode.getElementsByTagName('input')[0].click()">Upload Image (jpg,png)</label>
					</div>
				</div>
				<div class="file-button">
					<!--<i class="fas fa-plus" onclick="addNewAttachment(this)"></i>-->
					<i class="fas fa-trash" onclick="removeAttachment(this)"></i>
				</div>
			</div>
		</div>
		<!--
		<div class="buttons">
			<i class="fas fa-plus-circle text-primary mr-2" title="New Bill" onclick="addNewAttachment(this)"></i>
			<i class="fas fa-times-circle text-danger" title="Delete Bill" onclick="removeAttachment(this)"></i>
		</div>
		-->
	</div>
</div>

<div class="row">
	<div class="col col-12">
		{!!  Form::text('total_amount',  old('total_amount', ''), ['placeholder' => 'Total Amount', 'readonly' => 'true', 'id'=>'total']) !!}
	</div>
	<div class="col col-12">
		<button id="submit" class="btn btn-success mr-2"><i class="fas fa-spinner fa-spin d-none"></i> Save</button>		
		<a class="btn btn-theme" href="{{ route('field_staff_report.donation_sub_menu') }}"> Back</a>
	</div>
	
</div>