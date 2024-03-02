
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<fieldset class="section">	
	<legend class="w-auto">Project Bill </legend>									
	
		<table  class="projecttable";>
			
				<tr>
					<th>Project Code</th>
					<td>{!!  EasyForm::input('project_code', '', old('project_code', '')) !!}</td>
					<td></td><td></td>
				</tr>
				<tr>	
					<th>{{ $project_partner_bill->label('ta_amount')}}</th>
					<td>{!! EasyForm::input('ta_amount', '', old('ta_amount', ''),['name'=>'amount', 'id'=>'input1', 'type' => 'number', 'onchange'=>'add()']) !!}	</td>
					<td>{!! EasyForm::file('ta_attachment',  '', old('ta_attachment', ''))!!}</td>
					<td></td>
				</tr>
				<tr>		
					<th>{{ $project_partner_bill->label('hep_p_amount')}}</th>
					<td>{!! EasyForm::input('hep_p_amount', '', old('hep_p_amount', ''),['name'=>'amount', 'id'=>'input2', 'type' => 'number', 'onchange'=>'add()']) !!}	</td>
					<td>{!! EasyForm::file('hep_p_attachment',  '', old('hep_p_attachment', ''))!!}	</td>
					<td></td>
				</tr>
				<tr>	
					<th>{{ $project_partner_bill->label('hep_amount')}}</th>
					<td>{!! EasyForm::input('hep_amount', '', old('hep_amount', ''),['name'=>'amount', 'id'=>'input3', 'type' => 'number', 'onchange'=>'add()']) !!}</td>
					<td>{!! EasyForm::file('hep_attachment',  '', old('hep_attachment', ''))!!}</td>
					<td></td>
				</tr>
				<tr>	
					<th>{{ $project_partner_bill->label('shtp_amount')}}</th>
					<td>{!! EasyForm::input('shtp_amount','', old('shtp_amount', ''),['name'=>'amount', 'id'=>'input4', 'type' => 'number', 'onchange'=>'add()']) !!}	</td>
					<td>{!! EasyForm::file('shtp_attachment',  '', old('shtp_attachment', ''))!!}	</td>
					<td></td>
				</tr>
				<tr>	
					<th>{{ $project_partner_bill->label('val_amount')}}</th>				
					<td>{!! EasyForm::input('val_amount', '', old('val_amount', ''),['name'=>'amount', 'id'=>'input5', 'type' => 'number', 'onchange'=>'add()']) !!}	</td>
					<td>{!! EasyForm::file('val_attachment',  '', old('val_attachment', ''))!!}	</td>
					<td></td>
				</tr>
				<tr>	
					<th>{{ $project_partner_bill->label('travel_amount')}}</th>
					<td>{!! EasyForm::input('travel_amount','', old('travel_amount', ''),['name'=>'amount', 'id'=>'input6', 'type' => 'number', 'onchange'=>'add()']) !!}	</td>
					<td>{!! EasyForm::file('travel_attachment',  '', old('travel_attachment', ''))!!}	</td>
					<td></td>
				</tr>
				<tr>
					<th>{{ $project_partner_bill->label('total_amount')}}</th>
					<td>{!!  EasyForm::input('total_amount', '', old('total_amount', ''), ['readonly' => 'true', 'name'=>'total_amount', 'id'=>'total']) !!}</td>
					<td></td>
					<td></td>
				</tr>
				</table>
				<table  class="projecttable";>
					<tr>
						<th>{{ $project_partner_bill->label('full_name')}}</th>
						<td style="width:300px">{!!  EasyForm::input('full_name', '', old('full_name', '')) !!}</td>
						<th>{{ $project_partner_bill->label('phone')}}</th>
						<td style="width:300px">{!!  EasyForm::input('phone', '', old('phone', '')) !!}</td>
					
						<th>{{ $project_partner_bill->label('email')}}</th>
						<td style="width:300px">{!!  EasyForm::input('email', '', old('email', '')) !!}</td>
						
					</tr>			
			</table>
		
</fieldset> 							


<style>

table.projecttable td {
    	padding: 5px 15px;
    }
	
</style>


<script type="text/javascript">
	function add() 
	{		
		var amount = 0;
		for(var i=1; i<=6; i++){
		  var val = parseFloat(document.getElementById("input"+i).value);
		  if (!isNaN(val)) {			
				amount+= val;  
		  }
		}		
	   document.getElementById("total").value = amount;

	}
  </script>