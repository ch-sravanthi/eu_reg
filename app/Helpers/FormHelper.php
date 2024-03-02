<?php
namespace App\Helpers;

class FormHelper 
{
	
   public static function dependentScript($name, $value, $options, $parent, $emptyValue = null) {		
		return "<script>
				if (typeof dependencies === 'undefined') {
					var dependencies = [];
					
				}
				if (typeof dependencies['$parent'] === 'undefined') {
					dependencies['$parent'] = [];
					
				}
				dependencies['$parent']['$name'] = ".json_encode($options).";
				
				updateDependent('$parent', '$name', '$value', '$emptyValue');
				document.getElementById('$parent').onchange = function() {
					updateDependencies('$parent', '$emptyValue');
				}
				
		function dependent(obj) {
			var child = obj.parentNode.getElementsByTagName('select')[1];
			updateDependentNew(obj, child);
		}
				
		function dependentAll(obj, className) {//alert(className);
			var childs = document.getElementsByClassName(className);
			for(var child of  childs){
				updateDependentNew(obj, child);
			}
		}
		
		function updateDependentNew(parentElement, dependentElement, value)
		{			
			var parentValue = parentElement.options[parentElement.selectedIndex].value;
			var parentId = parentElement.getAttribute('select-id');
			var dependentId = dependentElement.getAttribute('select-id');
			removeOptions(dependentElement);
			dependentElement.innerHTML ='<option></option>';
			for (var k in dependencies[parentId][dependentId][parentValue]) {
				addOption(dependentElement, k, dependencies[parentId][dependentId][parentValue][k], (value == k));
			}
		}
			</script>";
	}
}
