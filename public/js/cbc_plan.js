function updateTotalChildren() {
	var no_of_children = document.getElementById("no_of_children");
	var total_programs = document.getElementById("total_programs");
	var total_children_planned_no = document.getElementById("total_children_planned_no");
	
	var v1 = no_of_children.options[no_of_children.selectedIndex].value;
	var v2 = total_programs.value;
	
	if (v1 !== "" && v2 !== "") {
		total_children_planned_no.value = parseInt(v1) * v2;
	} else {
		total_children_planned_no = "";
	}
}