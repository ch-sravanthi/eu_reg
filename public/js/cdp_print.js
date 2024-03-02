
					function addNewRow() {
						var table = document.getElementById("idRequirementsTable");
						var sampleRow = document.getElementById("idSampleRow");
						//alert(table);die();
						var tbody = table.tBodies[0];
						var firstRow = tbody.rows[0];
						var tr = document.createElement("tr");
						tr.innerHTML = firstRow.innerHTML;
						resetElements(tr);
						tbody.appendChild(tr);
					}
					
					function resetElements(parent) {
						// reset input
						var inputs = parent.getElementsByTagName("input");
						for (var i = 0; i < inputs.length; i++) {
							inputs[i].value = null;
						}
						
						// reset select
						var selects = parent.getElementsByTagName("select");
						for (var i = 0; i < selects.length; i++) {
							selects[i].selectedIndex = 0;
						}
						
						var inp_text = parent.getElementsByTagName("textarea");
							for (var i=0; i<inp_text.length;i++) {
								inp_text[i].value = ""; 
								inp_text[i].readOnly = false;	
							}
						
					}
					
					function removeRow(obj) {
						
						var tr = obj.parentNode.parentNode;
						var rowIndex = tr.rowIndex;
						if (rowIndex <= 1) return;
						var table = tr.parentNode.parentNode;
						table.deleteRow(rowIndex);
					}
					
					function printRequestForward(parent) {
						if (confirm('Are you Sure?')) {
							var status = document.getElementById("status");
							status.value = "forwarded";
							document.getElementById("idForm").submit();
						}
					}
