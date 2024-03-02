		 $( function() {
		$( ".dob" ).datepicker({
			
			changeMonth: true, 
			changeYear: true, 
			dateFormat: "yy-mm-dd",
			yearRange: "-90:+00"
		});
	  } );
	  
	  
	  $( function() {
		  setDatePicker();
	  } );
	  
	  function setDatePicker() {
		  
		$( ".datepicker" ).datepicker({
			
			changeMonth: true, 
			changeYear: true, 
			dateFormat: "yy-mm-dd",
			yearRange: "-30:+30"
		});
	  }
		$(document).ready(function(){
		  $('[data-toggle="tooltip"]').tooltip();   
		});
		
		$(document).ready(function() {
			$(document).on('click', '.submit', function(event){
				var form = $(this).closest("form");
				if (form.attr('id')) {
					var isValid = document.getElementById(form.attr('id')).reportValidity();
					if (!isValid) {
						return;
					}					
				}
				
				$(this).find('*').removeClass('d-none');		
				$(this).attr('disabled','disabled');
				form.submit();
			});
		});		
		
		function updateDependencies(parentId)
		{
			for (var dependentId in dependencies[parentId]) {
				updateDependent(parentId, dependentId, '');
			}
		}
		
		function updateDependent(parentId, dependentId, value)
		{			
			var parentElement = document.getElementById(parentId);
			var dependentElement = document.getElementById(dependentId);
			var parentValue = parentElement.options[parentElement.selectedIndex].value;
			
			removeOptions(dependentElement);
			dependentElement.innerHTML = "<option></option>";
			for (var k in dependencies[parentId][dependentId][parentValue]) {
				addOption(dependentElement, k, dependencies[parentId][dependentId][parentValue][k], (value == k));
				
			}
		}	
		function updateAutoComplete(objId, v, type) {
			 var obj = document.getElementById(objId);
			 var field = obj.parentNode.getElementsByTagName("input")[1];
			 var display = obj.parentNode.getElementsByTagName("div")[0];
			 var arr =(field.value == "") ? new Array() : (field.value).split( /,\s*/ );
			 if (v != "") {
				arr.push(v);
			 }

			 vals = new Array();
			 for (var i in arr) {
				 for (var j in autoItems[type]) {
					if ( autoItems[type][j].key == arr[i]) {
						vals.push(autoItems[type][j].value);
						break;
					}
				 }
			 }

			 valsHTML = "";
			 for (var i in vals) {
				valsHTML+= "<div class='alert alert-warning alert-dismissible fade show multi-select-block'>"
						  + vals[i]
						  + "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' onclick='removeAutoCompleteValue(\""+objId+"\", \""+arr[i]+"\", \""+type+"\")'>"
						  + "</button>"
						  + "</div>";
			 }
			 display.innerHTML = valsHTML;
			 field.value = arr.join(',');
		}
		function removeAutoCompleteValue(objId, v, type) {		
			 var obj = document.getElementById(objId);
			 var field = obj.parentNode.getElementsByTagName("input")[1];
			 var arr =(field.value == "") ? new Array() : (field.value).split( /,\s*/ );
			 for (var i in arr) {
				 if (arr[i] == v) {
					 arr.splice(i, 1);
				 }
			 }
			 
			 field.value = arr.join(',');	 
		}
  
		function addOption(selectElement, key, value, selected)
		{
			var option = document.createElement("option");
			option.value = key;
			option.text = value;
			selectElement.add(option);
			if (selected) {
				option.selected = 'selected';
			}
		}
		
		function removeOptions(selectElement)
		{
			var i;
			for(i = selectElement.options.length - 1 ; i >= 0 ; i--)
			{
				selectElement.remove(i);
			}
		}
		
		function deleteFile(obj)
		{
			var childs = obj.parentNode.childNodes;
			for (var i=0; i<childs.length; i++) {
				if(childs[i].type && childs[i].type == "file") {
					childs[i].classList.remove("d-none");
				} else if(childs[i].type && childs[i].type == "hidden") {
					childs[i].value = "";
				} else if(childs[i].classList) {					
					childs[i].classList.add("d-none");
				}
			}
		}
		
		function confirmAndSubmitForm(formId) {
			var form = document.getElementById(formId);
			if (confirm("Are you sure?")) {
				form.submit();
			}
		}
		
		function submitFormByUrl(formId, url) {
			if (formId === null) {
				var form = document.getElementById("globalform");
			} else {
				var form = document.getElementById(formId);
			}
			form.action = url;
			form.submit();
		}
		
		function submitFormByUrlWithConfirm(formId, url) {
			if (formId === null) {
				var form = document.getElementById("globalform");
			} else {
				var form = document.getElementById(formId);
			}
			
			if (confirm("Are you sure?")) {
				form.action = url;
				form.submit();
			}
		}
			
		function toggleAllCheckboxes(obj) {
			var objs = document.getElementsByTagName("input");
			var isChecked = obj.checked;
			for (var i=1; i<objs.length; i++) {
				if (objs[i].type == "checkbox") {
					objs[i].checked = isChecked;
				}
			}
		}
		
		function toggleCheckboxesInRow(obj) {
			var objs = obj.parentNode.parentNode.getElementsByTagName("input");
			var isChecked = obj.checked;
			for (var i=1; i<objs.length; i++) {
				if (objs[i].type == "checkbox") {
					objs[i].checked = isChecked;
				}
			}
		}
		

				
		function clearForm(myFormElement) {

			  var elements = myFormElement.elements;

			  myFormElement.reset();

			  for(i=0; i<elements.length; i++) {

			  field_type = elements[i].type.toLowerCase();
			  switch(field_type) {

				case "text":
				case "date":
				case "password":
				case "textarea":
					  //case "hidden":

				  elements[i].value = "";
				  break;

				case "radio":
				case "checkbox":
					if (elements[i].checked) {
					  elements[i].checked = false;
				  }
				  break;

				case "select-one":
				case "select-multiple":
							elements[i].selectedIndex = -1;
				  break;

				default:
				  break;
			  }
			}
		}
	/***  
		Rigt click block in promotions donor display  
	****/	
	function toggleExpandTable(obj) {
		var table = document.getElementsByClassName("table-total")[0];
		var trs = table.getElementsByClassName("row-value");
		for (var i in trs) {
			if (trs[i].classList.contains("d-none")) {
				trs[i].classList.remove("d-none")
			//	obj.innerHTML = 'Collapse';
			} else {
				trs[i].classList.add("d-none")		
			//	obj.innerHTML = 'Expand';	
			}
		}
	}

	function toggleViewChild(obj) {
		
		//var loader = obj.getElementsByTagName("i")[0];
		//loader.classList.remove("d-none");
		var parent = obj.parentNode.parentNode;
		var tr = obj.parentNode;
		var trs = parent.getElementsByTagName("tr");
		try {
			for (var i in trs) {
				if (tr == trs[i]) {
					continue;
				}
				
				if (trs[i].classList.contains("d-none")) {
					trs[i].classList.remove("d-none")
				} else {
					trs[i].classList.add("d-none")	
				}
			}
		} catch (e) {
			
		}
		//loader.classList.add("d-none");
	}
	
	function updateSummary(obj)
	{
		var tr = obj.parentNode.parentNode;
		var inp = tr.getElementsByTagName("input");
		inp[3].value = intval(inp[0].value) + intval(inp[1].value) + intval(inp[2].value) ;	
	}
	
	function intval(v)
	{
		if (v === '') return 0;
		else return parseInt(v);
	}

	$(function() {
		$('.promotion').bind('contextmenu', function(e) {
			return false;
		}); 
		
	});
	
	function updateTotal(obj, disableCheckform)
	{
		var tr = obj.parentNode.parentNode;
		var inp = tr.getElementsByTagName("input");
		inp[3].value = intval(inp[0].value) + intval(inp[1].value) + intval(inp[2].value);
	
	}
	
	function updateRowTotal(obj)
	{
		var tr = obj.parentNode.parentNode;
		var inp = tr.getElementsByTagName("input");
		var val = 0;
		var len = inp.length;
		for (var i=0; i< len - 2; i++) {
			val+= parseInt(inp[i].value);
		}
		inp[len-1].value = val;
	
	}
	
	function updateRowTotalNew(obj)
	{
		var tr = obj.parentNode.parentNode;
		var inp = tr.getElementsByTagName("input");
		var val = 0;
		var len = inp.length;
		for (var i=0; i< len - 1; i++) {
			val+= parseInt(inp[i].value);
		}
	//	alert(len-1);
		inp[len-1].value = val;
	
	}
