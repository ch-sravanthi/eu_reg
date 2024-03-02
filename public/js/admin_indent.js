function toggleAdminCategory(obj) {
	var disabled = obj.options[obj.selectedIndex].value != 'budget_category';
	document.getElementById("category_id").disabled = disabled;
}

function toggleAdminRecordType(obj) {
	var disabled = obj.options[obj.selectedIndex].value != 'reimbursement';
	document.getElementById("advance_id").disabled = disabled;
	//document.getElementById("payment_to").disabled = !disabled;
}

function lessAdvanceChanged() {
	var advanceId = document.getElementsByName("advance_id")[0].value;
	var disabled = advanceId != "";
	document.getElementById("payment_to").disabled = disabled;
}

function updateRules(obj) {
	var val = obj.options[obj.selectedIndex].value;
	for (var key in rules[val]) {
		var disabled = rules[val][key] != 'yes';
		document.getElementById(key).disabled = disabled;
	}
}