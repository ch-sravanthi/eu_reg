var prevRow;
var warningList = new Array();
_checkForm();
function _checkForm()
{
    warningList = new Array();
	
  
    checkLiterature();
	showErrors();
}

/**
 *
 * Literature has no term wise targets
 * so directly checks consolidate value
 * In 2nd term total vlaue =0 then it will show warning
 * In 3rd term total vlaue =0 then it will show error
 */
function checkLiterature()
{
    var val = 0;
	var totals = new Array();
	for (var key in terms) {
		totals[key] = 0;
		for (var litKey in targets['tot_literature']) {
			var obj = document.getElementById(key+"["+litKey+"]");
			totals[key]+= intval(obj.value);//alert(intval(obj.value));
		}
			
		var totObj = document.getElementById(key+"[total_literature_distributed]");
		totObj.value = totals[key];
		
	}
	var litObj = document.getElementById(key+"[total_literature_distributed]");
	//alert(litObj);
	updateTotal(litObj, true);
	
    for (var key in targets['literature']) { 
		var obj = document.getElementById(key);
        val = intval(obj.value); //alert(val);
		if(isActiveTerm('REPORT02')){
			var termobj = document.getElementById('REPORT02['+key+']');
			if (val == 0){
				setErrors('REPORT02' , termobj, 'warning');
			}else {
				removeAnyError(termobj);
			}	
		}
		
		if(isActiveTerm('REPORT03')){
			if (val == 0 || val > targets['literature'][key] ) {
				setErrors('REPORT03', obj, 'error');
			}else if(val !=targets['literature'][key]){
				setErrors('REPORT03', obj, 'warning');
			} else {
				removeAnyError(obj);
			}
		}
    }
	
	
}



/**
 *
 * Set error/warnings
 */
function setErrors(key, field, type)
{	
	if (!warningList.hasOwnProperty(key)){
		warningList[key] = new Array();
	}	
	
	if (type != "") {		
		warningList[key][field.id] = type;
	}
}

/**
 *
 * removes error/warning class
 */
function removeAnyError(obj)
{
	obj.className = '';
}

/**
 *
 * show errors and warnings
 */
function showErrors()
{
	var error = false;
	for (key in warningList) {
		for (field in warningList[key]) {
			type = warningList[key][field];
			document.getElementById(field).className = type;
		}
	}
}

/**
 *
 * Checks wether term has  atleaset one warning
 */
 function isTermHasWarnings(term) {
	if (warningList.hasOwnProperty(term)) {
		for (field in warningList[term]) {
			if (warningList[term][field] == 'warning') {
				return true;
			}
		}
	}
	return false;
}

/**
 *
 * Checks wether term has  atleaset one warning
 */
 function hasWarnings() {
	for (term in terms) {
		for (field in warningList[term]) {
			if (warningList[term][field] == 'warning') {
				return true;
			}
		}
	}
	return false;
}

/**
 *
 * Checks wether term has  atleaset one error
 */
 function hasErrors() {
	for (term in terms) {
		for (field in warningList[term]) {
			if (warningList[term][field] == 'error') {
				return true;
			}
		}
	}
	return false;
}

/**
 *
 * Submit form
 * if warning exists, it ask for confirmation
 */
function submitForm()
{
    _checkForm();
    if (hasErrors()) {
		alert('Errors found, Form cannot be submitted');
    } else if (hasWarnings()) {
        if (confirm('Warnings found\n\n Are you sure you want to save')) {
            idForm.submit();
        }
    } else {
		idForm.submit();
	}
}

function updateTotal(obj, disableCheckform)
{
	var tr = obj.parentNode.parentNode;
    var inp = tr.getElementsByTagName("input");
    inp[10].value = intval(inp[0].value) + intval(inp[1].value) + intval(inp[2].value) +intval(inp[3].value)+intval(inp[4].value)+intval(inp[5].value)+intval(inp[6].value)+intval(inp[7].value)+intval(inp[8].value)intval(inp[9].value)intval(inp[10].value);
	
}

function isActiveTerm(term)
{
	for (i=0; i< active_terms.length; i++) {
		if (active_terms[i] == term) {
			return true;
		}
	}
	return false;
}

function isTermHasAnEntry(term)
{
	var v = 0;
	var ele = document.querySelectorAll("input[name^='"+term+"[']")
	for (var i=0; i<ele.length; i++) {
		if (ele[i].value != 0 && ele[i].value != "") {
			return true;
		}
	}
	return false;
}

function setFocus(obj)
{    
    var tr = obj.parentNode.parentNode;
    try {
        prevRow.className = "";
    } catch(e) {}
    tr.className = "highlightrow";
    prevRow = tr;
}

function intval(v)
{
    if (v === '') return 0;
    else return parseInt(v);
}