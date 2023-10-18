    
/*function filter_data(){
    $('#ris').html('<div class="loading"></div>');
    tipo = get_filter('tipo');
    var tipo = new array();
    alert(typeof(tipo));
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            $('#ris').html(this.responseText);
        }
    };
    //invio i dati al php per la query
    xmlhttp.open("POST","q-sel-comp.php?tipo=" + tipo, true); tipo stringa
    alert(typeof(tipo));
    xmlhttp.send();
}*/

function sleep(milliseconds) {
  const date = Date.now();
  let currentDate = null;
  do {
    currentDate = Date.now();
  } while (currentDate - date < milliseconds);
}

//mi richiama la funzione get_filter e poi passa i valori al php
function filter_data(){
    var tipo = get_filter('tipo');
    var stile = get_filter('stile');
    var order = $('#ordina_per').val();
    $.ajax({
        url: 'q-sel-comp.php',
        method: "POST",
        data:{tipo:tipo, stile:stile, order:order},
        success:function(data){
          $('#ris').html(data);
        }
    })
}

//seleziona tutti i filtri applicabili
function sel_tutto(){
    $('.checkbox').each(function(){
      var ischeck = $(this);
      if(!ischeck.is(":checked")){
        ischeck.prop('checked', true);
      }
    });
  mostra_nascondi_stile();
  filter_data();
}

//deseleziona tutti i filtri
function deseleziona(){
    $('.checkbox').each(function(){
      var ischeck = $(this);
      if(ischeck.is(":checked")){
        ischeck.prop('checked', false);
      }
  });
  mostra_nascondi_stile();
  filter_data();
}

//controlla ogni checkbox e ritorna quelle selezionate
function get_filter(class_name){
    var filter = new Array();
    $('.'+class_name+':checked').each(function(){
        filter.push($(this).val());
    });
    return filter;
}

//mostra gli stili dei componenti
function mostra_nascondi_stile(){
  $('.tipo').each(function(){
    var ischeck = $(this);
    //prendo il parent del checkbox quindi li
    var padre = ischeck.parent();
    //prendo il figlio di padre quindi ul nascosta 
    var figlio = padre.children(".stile-list");
    if(ischeck.is(":checked")){
      //la mostro con show display block
      figlio.show();
    }
    else{
      //se gia mostrata la nascondo
      figlio.hide();
    }
  })
}


$(document).ready(function(){

    $('.checkbox').change(function(){
      mostra_nascondi_stile();
      filter_data();
    })
    $('.form-control').change(function(){
        filter_data();
    })
});
