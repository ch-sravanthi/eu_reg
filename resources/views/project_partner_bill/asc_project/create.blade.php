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
<?php $arr = explode('_',trim($project->name()));?>
	
<div class="row">
	<div class="col col-12 col-md-6 col-lg-3">	
		{!!  Form::number('project_code', old('project_code', ''), ['placeholder' => 'Project Code (serial no. only)', 'min'=>'1000', 'max' => '40000', 'required' => true]) !!}
	</div>
	<div class="col col-12 col-md-6 col-lg-3">
		{!!  Form::text('name', old('name', ''), ['placeholder' => $project_partner_bill->label('name'), 'required' => true]) !!}
	</div>
	<div class="col col-12 col-md-6 col-lg-3">
		{!!  Form::text('phone', old('phone', ''), ['placeholder' => $project_partner_bill->label('phone'), 'required' => true]) !!}
	</div>	
	<div class="col col-12 col-md-6 col-lg-3">
		{!!  Form::text('email', old('email', ''), ['placeholder' => $project_partner_bill->label('email'), 'required' => true]) !!}
	</div>
</div>
<div class="py-3">
	<div class="row bill">
		<div class="col col-12 col-lg-3">											
			{!! Form::select('term[]', ['' =>'Select Purpose']+AppHelper::options($arr[0].'_indent_category_terms'), $project_partner_bill_record->term, ['required' => true, 'onchange' => 'updateAttachment(this)']) !!}														
		</div>
		<div class="col col-12 col-lg-3">	
			{!! Form::number('amount[]', $project_partner_bill_record->amount, ['placeholder' => 'Amount', 'onchange'=>'add()', 'required' => true]) !!}														
		</div>
		<div class="col col-12 col-lg-5">
			<div class="file d-flex">			
				<div class="flex-fill">
					<!--{!! Form::file('attachment[]',  ['required' => true]) !!}-->
					<div>
						<input type="file" name="attachment[]" title="Choose bill" onchange="pressed(this)" accept = "image/jpg,image/jpeg,image/png" required=true>
						<label onclick="this.parentNode.getElementsByTagName('input')[0].click()">Upload Image</label>
					</div>
				</div>
				<div class="file-buttons">
					<i class="fas fa-plus" onclick="addNewAttachment(this)"></i>
					<i class="fas fa-trash" onclick="removeAttachment(this)"></i>
				</div>
			</div>
		</div>
		<div class="buttons">
			<i class="fas fa-plus-circle text-primary mr-2" title="New Bill" onclick="addNewAttachment(this)">Add another Purpose</i>
			<i class="fas fa-times-circle text-danger" title="Delete Bill" onclick="removeAttachment(this)"></i>
		</div>
	</div>
</div>

<div class="row">
	<div class="col col-12">
		{!!  Form::text('total_amount',  old('total_amount', ''), ['placeholder' => 'Total Amount', 'readonly' => 'true', 'id'=>'total']) !!}
	</div>
	<div class="col col-12">
		<button class="btn btn-theme mr-2">Save</button>		
		<a class="btn btn-theme" href="{{ route('field_staff_report.sub_menu') }}"> Back</a>
	</div>
	
</div>

<script type="text/javascript">
	window.pressed = function(obj){
		var fileLabel = obj.parentNode.getElementsByTagName("label")[0];
		if(obj.value == "")
		{
			fileLabel.innerHTML = "Choose file";
		}
		else
		{
			var theSplit = obj.value.split('\\');
			fileLabel.innerHTML = theSplit[theSplit.length-1];
		}
	};
	function add() 
	{		   
	    var total = 0;
		var list = document.getElementsByName('amount[]');
		for (var i = 0; i < list.length; i++) { 
			if ( !isNaN(parseInt(list[i].value)) ) {
				total += parseInt(list[i].value);  
			}
		}
		document.getElementById('total').value=total;   
	}
	
	function addNewAttachment(obj) {
		var parent = obj.parentNode.parentNode.parentNode;
		var ele = parent.getElementsByTagName("div")[0].cloneNode(true);
		parent.appendChild(ele);
		ele.getElementsByTagName("input")[0].value = null;
		ele.getElementsByTagName("label")[0].innerHTML = "Choose File";
		resetElements(ele);
		setSingleNode(ele, "file");
	}
	
	function removeAttachment(obj) {	
		
		var parent = obj.parentNode.parentNode.parentNode;
		if(parent.children.length == 1) {
			alert("Oops! you cannot delete");
			return;
		}
		var node = obj.parentNode.parentNode;
		parent.removeChild(node);
	}
	
	
	function updateAttachment(obj) {	
		
		var parent = obj.parentNode.parentNode;
		var attachments = parent.getElementsByTagName("input");
		for (var i=0; i<attachments.length; i++) {
			if (attachments[i].type != 'file') continue;			
			attachments[i].setAttribute("name", "attachment["+obj.value+"][]")
			//alert(attachments[i]);
		}
	}
	
	function setSingleNode(obj, className) {
		var nodes = obj.getElementsByClassName(className);
		if (nodes.length < 1) return;
		var parent = nodes[0].parentNode;
		var node = nodes[0];
		parent.innerHTML = "";
		parent.appendChild(node);
	}

  </script>