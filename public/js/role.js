var roleFields = new Array('program', 'zone', 'state', 'departments');
		function updateRolesForm(resetForm) {
			var roleObj = document.getElementById('role');
			var programObj = document.getElementById('program');
			var zoneObj = document.getElementById('zone');
			var stateObj = document.getElementById('state');
			var departmentsObj = document.getElementById('departments');
			
			var role = roleObj.options[roleObj.selectedIndex].value;
			var fieldsToDisable = getFieldsToDisable(role);
			
			for (var i = 0; i < roleFields.length; i++) {
				var obj = document.getElementById(roleFields[i]);
				if (resetForm) {
					obj.selectedIndex = -1;
				}
				if (fieldsToDisable.indexOf(roleFields[i]) != -1) {
					obj.disabled = true;
				} else {
					obj.disabled = false;					
				}
			}
			
			
		}
		
		function getFieldsToDisable(role) {
			var fieldsToDisable = new Array();
			var roleFirst = role.split('_', 1);
			if (role == 'am' || role == 'aam' || role == 'spc' || role == 'pdc' || role == 'zoe' || role == 'zo_accountant') {
				fieldsToDisable.push('program', 'state', 'departments');
			} else if (role == 'sc' || role == 'dc') {
				fieldsToDisable.push('program', 'departments');
			} else if (role == 'nm' || role == 'hod' || role == 'ho' || role == 'second_inline') {
				fieldsToDisable.push('zone', 'state', 'departments');
			} else if (roleFirst == 'ad'){
				fieldsToDisable.push('program', 'zone', 'state');
			} else {
				fieldsToDisable = roleFields;
			}
			return fieldsToDisable;
		}
		