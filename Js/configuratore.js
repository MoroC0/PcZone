
var y = 0; //Tiene conto dei passi fatti per i form di selezione dei componenti (Inizia da 0)
// // Mostra il form di selezione del componente corrente


var componenti = new Array("Cpu", "Mobo", "Ram", "Gpu", "Storage", "Cooler", "Psu", "Chassis");
var index =  0;

//quando clicchi su un elemento, metto il suo id in un array
//la funzione assembly passa i dati ad un altra pagina php che contiene la configurazione

//contiene gli indici dei componenti selezionati e ci accedo tramite I 
var array_index = new Array(); 

function showComp() {
	// Questa funzione mostrerà il form di selezione del componente corrente
	// Modifica il tasto avanti e indietro
	if (i == 0) {
		document.getElementById("prevBtn").style.display = "none";
		document.getElementById("assemblyBtn").style.display = "none";
	} 
	else if (i>0 && i<componenti.length - 1) {
		  document.getElementById("prevBtn").style.display = "inline";
		  
			document.getElementById("assemblyBtn").style.display = "none";
	}
	else if (i == (componenti.length - 1)) { //Quando arrivo alla fine 
		document.getElementById("assemblyBtn").disabled = true;
		document.getElementById("assemblyBtn").style.display = "inline";
		document.getElementById("nextBtn").style.display = "none";
		document.getElementById("prevBtn").style.display = "inline";
	}
}


function nextPrev(n) {
	// Questa funzione seleziona quale form di selezione componente visualizzare
	var z = document.getElementsByClassName("select_component");
	index++;
	y = y + n;
}

var larg_corrente = 0;
var count = 0;
function move_timeline(p) {
	if(p==1){
		count++;
		var next_lungh = count*13.5;
		var elem = document.getElementById("color_timeline");
		var circle = document.getElementById("circle-"+count);
		var id = setInterval(frame1, 20);
		function frame1() {
	  		if (larg_corrente >= next_lungh) {
				clearInterval(id);
			} 
			else {
				larg_corrente++; 
				elem.style.width = larg_corrente + '%'; //Aumenta la width della timeline di larg_corrente%
				circle.style.backgroundColor = "lime";
	  	}
	  }
	}	
	else{
		var circle = document.getElementById("circle-"+(count));
		count--;
		var next_lungh = count*13.5;
		var elem = document.getElementById("color_timeline");
		var id = setInterval(frame2, 20);
		function frame2() {
	  	if (larg_corrente <= next_lungh) {
				clearInterval(id);
			} 
			else {
				larg_corrente--;
				elem.style.width = larg_corrente + '%'; //Diminuisce la width della timeline di larg_corrente%
				circle.style.backgroundColor = "white";
	  	}
	  }
	}
}


var comp_cnt = 0;
function add_comp(){
	var btn = document.getElementBy
	var btn = document.getElementById("nextBtn");
	if(comp_cnt == 0){
		btn.disabled = true
		comp_cnt++;
	}
	else if(comp_count == 1){	
	}	
}


function assembly(){
  document.getElementById("link-pagina").setAttribute("href", 'config_compl.php?cpu='+array_index[0]+'&mobo='+array_index[1]+'&ram='+array_index[2]+'&gpu='+array_index[3]+'&ssd='+array_index[4]+'&cooler='+array_index[5]+'&psu='+array_index[6]+'&case='+array_index[7]);
}

old_id = '';
//funzione per cambiare il colore delle immagini
function select_comp(str){
	var button = document.getElementById("nextBtn");
	var comp = document.getElementById(str);
	if(old_id == comp){
		comp.classList.remove("select");
		button.disabled = true;
		old_id = '';
		document.getElementById("assemblyBtn").disabled = true;
  }
  else{
    if(!comp.classList.contains('select')){
      if(old_id != ''){ //se è già stato premuto un altro elemento
        old_id.classList.remove("select");//rimuovo il colore da quell'elemento
        comp.classList.add("select");//e coloro quello nuovo
				array_index[i] = str;
				document.getElementById("assemblyBtn").disabled = false;
      }
      
      else{
        comp.classList.add("select");
        button.disabled = false;
				array_index[i] = str;
				document.getElementById("assemblyBtn").disabled = false;
      }
      old_id = comp;
    }
    else{
      old_id.classList.remove("select");
      comp.classList.add("select");
			array_index[i] = str;
			document.getElementById("assemblyBtn").disabled = false;
    }
  }
}


//Script che controlla quale componente è stato selezionato e sblocca il tasto avanti
var i=0;
//funzione ajax per i risultati dei div
function mostra_ris(x){
	i= i + x;
	array_index[i]='undefined';
  $('#ris').html('<div class="loading"></div>');
  var index = i;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if(this.readyState == 4 && this.status == 200){
			$('#ris').html(this.responseText);
			showComp();
			old_id='';
    }
  };
  //invio i dati al php per la query
	xmlhttp.open("GET",'selezione_configuratore.php?index='+index+'&cpu='+array_index[0]+'&mobo='+array_index[1]+'&ram='+array_index[2]+'&gpu='+array_index[3]+'&ssd='+array_index[4]+'&cooler='+array_index[5]+'&psu='+array_index[6]+'&case='+array_index[7], true);
	xmlhttp.send();
	
}

$(document).ready(function(){
	mostra_ris(0);

})

