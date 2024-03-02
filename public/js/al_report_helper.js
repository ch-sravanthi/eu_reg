var prevRow;
var warningList = new Array();
_checkForm();
function _checkForm()
{
    warningList = new Array();
	
    checkLimit('class', 'warning');
    checkLimit('basic', 'warning');
    checkLimit('literacy', 'warning');
    checkLimit('health', 'warning'); 
    checkLimit('economic', 'warning'); 
    checkLimit('social', 'warning'); 
    checkLimit('achieved', 'warning'); 
    checkLimit('pit_plegdged', 'warning'); 
	showErrors();
}

/**
 *
 * Checks wether field has exceeded targetKey value
 * field value is taken from the form, 
 * Target value is taken targets using targetKey
 * @param string field Form entry Value
 * @param string type Error type(warning/error)
 * @param string targetKey Target Field
 */
function checkLimit(field, type, targetKey)
{
    var val = 0;
    
	// mostly field and target will be same
	// but it may differ some time
	// eg: New Life should not exceed Dicision Made
	
    if (!(typeof targetKey !== 'undefined')) {
        targetKey = field;
    }
   
    for (var key in terms) {
        var obj = document.getElementById(key+"["+field+"]");
        objVal = intval(obj.value);
		val+= objVal;
       //alert(objVal);
        if (val > targets[targetKey][key] 
			&& isActiveTerm(key) 
			&& objVal>0) {
            setErrors(key, obj, type);
        }  else {
			removeAnyError(obj);
		}
    }
	 
	if(targetKey != 'basic' && isActiveTerm('REPORT03') && val == 0 || val > targets[targetKey][key] ) {
        setErrors('REPORT03', obj, 'warning');
    }
}
/**
*
*In 3rd term,  if all 3terms total Value =0 then it will show error 
If it is not reached to target then it will show warning 
*/

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

function updateSummary(obj, disableCheckform)
{
	var tr = obj.parentNode.parentNode;
    var inp = tr.getElementsByTagName("input");
    inp[3].value = intval(inp[0].value) + intval(inp[1].value) + intval(inp[2].value) ;	
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