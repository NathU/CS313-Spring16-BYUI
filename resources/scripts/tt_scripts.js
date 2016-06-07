// TempleTracker Scripts
function menuClick(){
	if( document.getElementById('sidebar').style.width != "0px") {
		document.getElementById('tinting').style.visibility = "hidden";
		document.getElementById('sidebar').style.width = "0px";
	} else {
		document.getElementById('tinting').style.visibility = "visible";
		document.getElementById('sidebar').style.width = "70%";
	} 
}

function personButtonClick (gender) {
	if (gender == "male") {
		document.getElementById('whoIsDead').style.backgroundImage = "url('./resources/images/man_woman/best/little_blue_man.png')";
		newVisit();
	} else if (gender == "female"){
		document.getElementById('whoIsDead').style.backgroundImage = "url('./resources/images/man_woman/best/little_orng_woman.png')";
		newVisit();
	} else {
		document.getElementById('whoIsDead').style.backgroundImage = "none";
	}
	
}

function newVisit(){
	document.getElementById('visit_dialogue').style.visibility = "visible";
	fill_dateContainer();
}

function fill_dateContainer() {
	today = new Date();
	today_str = "";
	if (today.getMonth() <10)
		today_str += "0";
	today_str += (today.getMonth()+1) + "/";
	if (today.getDate() <10)
		today_str += "0";
	today_str += today.getDate() + "/"
	yr = today.getFullYear();
	today_str += (yr.toString()).slice(2); 
	document.getElementById('summaryDate').innerHTML = today_str;
	update_date(); // throws the above value into an invisible input field
}

function update_date() {
	document.getElementById('date_container').value = document.getElementById('summaryDate').innerHTML;
}
//********************************************************************************

function setBackgroundImage_login() {
	document.getElementById('content').style.backgroundImage = "url('./resources/images/splash_screen/splashScreen03.jpg')";
	document.getElementById('content').style.backgroundPosition = "right bottom";
	document.getElementById('content').style.backgroundColor = "#c1bebf";
}

function setBackgroundImage_register() {
	document.getElementById('content').style.backgroundImage = "url('./resources/images/splash_screen/timp02.jpg')";
	document.getElementById('content').style.backgroundPosition = "90% bottom";
}

//********************************************************************************
   function checkReturn(e){
      enableSubmit();
      if (e.keyCode == 13) {
         beforeYouClick();
      } else {
         enableSubmit();
      }
   }
	
   function identical() {
      pass1 = document.getElementById('pass_input1').value;
      pass2 = document.getElementById('pass_input2').value;
      if (pass1 == pass2) {
         document.getElementById('p1div').innerHTML = "";
         document.getElementById('p2div').innerHTML = "";
         document.getElementById('err_msg1').innerHTML = "";
         return true;
      } else {
         document.getElementById('p1div').innerHTML = "*";
         document.getElementById('p2div').innerHTML = "*";
         document.getElementById('err_msg1').innerHTML = "these must match";
         return false;
      }
   }
	
   function format_good() {
      pass1 = document.getElementById('pass_input1').value;
      pass2 = document.getElementById('pass_input2').value;
		if (pass1.search(/\d+/) > -1 && pass1.length > 6 && 
			pass2.search(/\d+/) > -1 && pass2.length > 6)  {
		 document.getElementById('p1div').innerHTML = "";
         document.getElementById('p2div').innerHTML = "";
         document.getElementById('err_msg1').innerHTML = "";
         return true;
      } else {
		 document.getElementById('p1div').innerHTML = "*";
         document.getElementById('p2div').innerHTML = "*";
         document.getElementById('err_msg1').innerHTML = "password must be at least 7 characters long and contain at least one digit";
         return false;
      }
   }
	
   function beforeYouClick() {
      if (identical() && format_good()) {
          // let it play...
      } else {
         document.getElementById('create_account_button').disabled = "true";
      }
   }
	
   function enableSubmit() {
      document.getElementById('create_account_button').disabled = false;
   }
//********************************************************************************
// event handler for image/radio buttons
function picClick(id_name) {
	document.getElementById(id_name).checked = true;
	images = document.getElementsByTagName("img");
	for (i = 0; i <	images.length; i++) {
		images[i].style.backgroundColor = "transparent";
	}
	document.getElementById(id_name + "-image").style.backgroundColor = "#34abfa";
	ordinance_type = document.getElementById(id_name).value;
	document.getElementById('summaryText').innerHTML = ordinance_type;
	setHeadCount();
	document.getElementById('summaryDate').style.visibility = "visible";
}

function setHeadCount(){
	headCount = document.getElementById('headCount').value;
	summaryString = document.getElementById('summaryText').innerHTML;
	replace_i = summaryString.indexOf(" for ");
	if (replace_i > -1){
		summaryString = summaryString.substring(0, replace_i);
	}
	summaryString += " for " + headCount + " on ";
	document.getElementById('summaryText').innerHTML = summaryString;
}

// event handler for "clear"
function resetForm() {
	images = document.getElementsByTagName("img");
	for (i = 0; i <	images.length; i++) {
		images[i].style.backgroundColor = "transparent";
	}
	radios = document.getElementsByTagName("input");
	for (i = 0; i <	radios.length; i++) {
		radios[i].checked = false;
	}
	document.getElementById('note').value="";
	document.getElementById('note').style.visibility = "hidden";
	document.getElementById('headCount').value=1;
	document.getElementById('summaryText').innerHTML = "";
	document.getElementById('summaryDate').style.visibility = "hidden";
	document.getElementById('visit_dialogue').style.visibility = "hidden";
	document.getElementById('whoIsDead').style.backgroundImage = "none";
}

function addNoteClick() {
	hide = false;
	if (document.getElementById('note').style.visibility == "visible") {
		hide = true;
	}
	if (hide) {
		document.getElementById('note').style.visibility = "hidden";
		document.getElementById('add_note_button').innerHTML = "Add a Note";
	} else {
		document.getElementById('note').style.visibility = "visible";
		document.getElementById('add_note_button').innerHTML = "Done";
	}
	
}


//******************************************************************************** 
var visit_data;
var visit_data_by_ordinance;
var visit_data_by_date;
var visit_data_by_quantity;
var visit_data_by_note;

function logView_onload() {
	
	visit_data = "";
	visit_data_by_ordinance = '{';
	visit_data_by_date = '{';
	visit_data_by_quantity = '{';
	visit_data_by_note = '{';
	
	visit_data = JSON.parse(document.getElementById('visit_data').innerHTML);

	var end_i = (visit_data.visits).length;
	for (i=0;i<end_i;i++){
		row = visit_data.visits[i];
		
		// fill each array...
		visit_data_by_ordinance += '\"'+row.id+'\" : \"'+row.ordinance+'\"';
		visit_data_by_date += '\"'+row.date+'\" : \"'+row.id+'\"';
		visit_data_by_quantity += '\"'+row.id+'\" : \"'+row.quantity+'\"';
		visit_data_by_note += '\"'+row.id+'\" : \"'+row.note+'\"';
		if (1 < (end_i-1)) {
			visit_data_by_ordinance += ', ';
			visit_data_by_date += ', ';
			visit_data_by_quantity += ', ';
			visit_data_by_note += ', ';
		}
	}

	//build_logTable_by('date');
	build_logTable();
	build_summaryGraph();
	showLogActivity('summary');
}

function build_logTable() {
	log_table = '<br><table id="logTable"> <tr>';
	log_table += ' <th id="dateHeader" onclick="sort_by(\'date\')">Date</th> ';
	log_table += ' <th id="ordHeader" onclick="sort_by(\'ordinance\')">Ordinance</th> ';
	log_table += ' <th id="qtyHeader" onclick="sort_by(\'quantity\')">for</th>  <th id="noteHeader">Note</th>  </tr>';
	
	var end_i = (visit_data.visits).length;
	for (i=0;i<end_i;i++){
		row = visit_data.visits[i];
		
		log_table += '<tr>  <td>'+row.date+'</td>  <td>'+row.ordinance+'</td>  <td>'+row.quantity+'</td>  ';
		if (row.note != null && row.note != "") {
			log_table += '<td> <div class="note_img" onclick="view_note(\''+row.note+'\')"></div> </td>  ';
		} else {
			log_table += '<td>  </td>  ';
		}
		log_table += '</tr>';
	}
	
	log_table += '</table> <br>';
	document.getElementById("log_body").innerHTML = log_table;
}

function build_summaryGraph() {
	graph = '<br><table id="logTable">';
	count = JSON.parse('{"Baptism": 0, "Confirmation": 0, "Initiatory": 0, "Endowment": 0, "Child\'s Sealing": 0, "Spousal Sealing": 0, "Washing & Anointing":0}'); 
	total = 0;
	
	for (i=0;i<(visit_data.visits).length;i++){
		row = visit_data.visits[i];
		count[row.ordinance] += row.quantity;
		total += row.quantity;
	}
	
	p = (count["Baptism"]/total)*100; r = "#cc0000";
	c = (count["Confirmation"]/total)*100; o = "#ffa31a";
	i = (count["Initiatory"]/total)*100;y = "#cccc00";
	e = (count["Endowment"]/total)*100;g = "#009900";
	cs= (count["Child\'s Sealing"]/total)*100;b = "#0040ff";
	ss= (count["Spousal Sealing"]/total)*100;v = "#b300b3";
	
	m = 1; //multiplier makes the graphs look nicer... nvm.
	
	/*alert("b = " + p.toString() +"\n"+"c = " + c.toString() +"\n"+"i = " + i.toString() +"\n"+"e = " + e.toString() +"\n"+"cs= " +cs.toString() +"\n"+"ss= " +ss.toString());*/
	
	graph += '<tr> <div class="stats_container"> <div class="graph_bar" style="width:'+p*m +'%;background-color:'+r+';"> </div>';
	graph += '<div class="stats_text"> Baptisms: <div class="stats_text_number">'+count["Baptism"]+'</div></div></div> </tr>';
	
	graph += '<tr> <div class="stats_container"> <div class="graph_bar" style="width:'+c*m +'%;background-color:'+y+';"> </div>';
	graph += '<div class="stats_text"> Confirmations: <div class="stats_text_number">'+count["Confirmation"]+'</div></div></div> </tr>';
	
	graph += '<tr> <div class="stats_container"> <div class="graph_bar" style="width:'+i*m +'%;background-color:'+o+';"> </div>';
	graph += '<div class="stats_text"> Initiatories: <div class="stats_text_number">'+count["Initiatory"]+  '</div></div></div> </tr>';
	
	graph += '<tr> <div class="stats_container"> <div class="graph_bar" style="width:'+e*m +'%;background-color:'+g+';"> </div>';
	graph += '<div class="stats_text"> Endowments: <div class="stats_text_number">'+count["Endowment"]+'</div> </div></div> </tr>';
	
	graph += '<tr> <div class="stats_container"> <div class="graph_bar" style="width:'+cs*m+'%;background-color:'+b+';"> </div>';
	graph +='<div class="stats_text"> Child\'s Sealings: <div class="stats_text_number">'+count["Child\'s Sealing"]+'</div> </div></div>  </tr>';
	
	graph += '<tr> <div class="stats_container"> <div class="graph_bar" style="width:'+ss*m+'%;background-color:'+v+';"> </div>';
	graph += '<div class="stats_text"> Spousal Sealings: <div class="stats_text_number">'+count["Spousal Sealing"]+'</div> </div></div> </tr>';
	
	graph += '</table>';
	document.getElementById("summary_body").innerHTML = graph;
}


function sort_by(thing) {
	/*if (thing == "date") {
		alert("3\n"+JSON.stringify(visit_data));
	}*/
	
}

function view_note(note_text) {
	document.getElementById('noteView').value = note_text;
	noteView_popup();
}

function noteView_popup() {
	if (document.getElementById('note_pop-up_container').style.visibility == "visible") {
		document.getElementById('note_pop-up_container').style.visibility = "hidden";
	} else {
		document.getElementById('note_pop-up_container').style.visibility = "visible";
	}
}

function showLogActivity(activity) {
	activities = JSON.parse('{"0":"summary", "1":"log", "2":"stats"}');
	for (i = 0; i < 3; i++) {
		document.getElementById(activities[i] + "_tab").style.backgroundColor = "black";
		document.getElementById(activities[i] + "_tab").style.color = "white";
		document.getElementById(activities[i] + "_tab").style.border = "solid .5px #d9d9d9";
		document.getElementById(activities[i] + "_body").style.visibility = "hidden";
	}
	document.getElementById(activity + "_tab").style.backgroundColor = "#34abfa";
	document.getElementById(activity + "_tab").style.color = "#14181f";
	document.getElementById(activity + "_tab").style.border = "solid 2px #34abfa";
	
	document.getElementById(activity + "_body").style.visibility = "visible";
	document.getElementById(activity + "_body").style.border = "solid 2px #34abfa";
	document.getElementById(activity + "_body").style.borderStyle = "solid none none none";
	
	
}































/*

function build_logTable_by(param) {
	log_table = '<br><table id="logTable"> <tr>';
	log_table += ' <th id="dateHeader" onclick="build_logTable_by(\'date\')">Date</th> ';
	log_table += ' <th id="ordHeader" onclick="build_logTable_by(\'ordinance\')">Ordinance</th> ';
	//log_table += ' <th id="qtyHeader" onclick="build_logTable_by(\'quantity\')">for</th>  <th id="noteHeader">Note</th>  </tr>';
	log_table += ' <th id="qtyHeader" >for</th>  <th id="noteHeader">Note</th>  </tr>';
	
	var sort_topic;
	switch(param) {
		case("date"):
			//sort_topic = JSON.parse(visit_data_by_date);
			sort_topic = visit_data_by_date;
		break;
		case("ordinance"):
			//sort_topic = JSON.parse(visit_data_by_ordinance);
			sort_topic = visit_data_by_ordinance;
		break;

	}
	alert("sort topic = \n" + sort_topic);
	sort_topic.sort();
	alert("SORTED sort topic = \n" + sort_topic);
	
	var end_i = (sort_topic).length;
	for (i=0;i<end_i;i++){
		row = sort_topic[i];
		
		log_table += '<tr>  <td>'+row[0]+'</td>  <td>'+visit_data_by_ordinance[row[1]]+'</td>  <td>'+visit_data_by_quantity[row[1]]+'</td>  ';
		if (visit_data_by_note[row[1]] != null && visit_data_by_note[row[1]] != "") {
			log_table += '<td> <div class="note_img" onclick="view_note(\''+visit_data_by_note[row[1]]+'\')"></div> </td>  ';
		} else {
			log_table += '<td>  </td>  ';
		}
		log_table += '</tr>';
	}
	
	log_table += '</table> <br>';
	document.getElementById("log_body").innerHTML = log_table;
}

*/

