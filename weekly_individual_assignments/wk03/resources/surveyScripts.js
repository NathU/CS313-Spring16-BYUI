// event handler for image/radio buttons
function picClick(id_name) {
	document.getElementById(id_name).checked = true;
	images = document.getElementsByTagName("img");
	for (i = 0; i <	images.length; i++) {
		images[i].border = 0;
	}
	document.getElementById(id_name + "-image").border = 2;
	ordinance_type = document.getElementById(id_name).value;
	document.getElementById('visit_summary').innerHTML = "Performed "+ordinance_type+" for:";
	document.getElementById("Log_it").disabled = false;
}

// event handler for "clear"
function resetForm() {
	images = document.getElementsByTagName("img");
	for (i = 0; i <	images.length; i++) {
		images[i].border = 0;
	}
	radios = document.getElementsByTagName("input");
	for (i = 0; i <	radios.length; i++) {
		radios[i].checked = false;
	}
	document.getElementById('note').value="";
	document.getElementById('headCount').value=1;
	document.getElementById('visit_summary').innerHTML = "Performed ____________ for:";
	document.getElementById('popupDateField').value="date";

}

function fillDate() {
	document.getElementById('date_container').value = document.getElementById('popupDateField').value;
}
/*
function validateForm() {
	// make sure there's at least one Ordinance radio button clicked
	radios = document.getElementsByTagName("input");
	ordinance_selected = false;
	for (i = 0; i <	radios.length; i++)
		if (radios[i].checked == true) {
			ordinance_selected = true;
			break;
		}
	
	// and the HeadCount is > 0
	headCount_selected = false;
	if (document.getElementById('headCount').value > 0)
		headCount_selected = true;
	
	// and a date is selected
	date_selected = false;
	if (document.getElementById('date_container').value != "")
		date_selected = true;
	
	// if not, don't let it log
	// TODO - decide on this... onmouseover="validateForm()"
}
*/

























