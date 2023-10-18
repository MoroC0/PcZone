//Script per il carrelo che controlla se le componenti sono presenti in magazzino
//aggiunge gli elemnti nel carrello 

$(document).ready(function(){

  $('#add_to_cart_conf').click(function(){
    //mi salvo tutti i valori degli id dentro id_comp e li aggiungo al carrello con lo stesso php
    var id_comp=[];
    var action = "aggiungi";
		var value = 0;
    id_comp.push($(this).data('cpu'));
    id_comp.push($(this).data('mobo'));
    id_comp.push($(this).data('ram'));
    id_comp.push($(this).data('gpu'));
    id_comp.push($(this).data('ssd'));
    id_comp.push($(this).data('cooler'));
    id_comp.push($(this).data('psu'));
    id_comp.push($(this).data('case'));
    value=8;
    $.ajax({
      type:'post',
      url:'store_items.php',
      data:{
        valore:value,
        id_component:id_comp,
        azione:action
      },
      success:function(data){
        document.getElementById("total_items").value=data;
        alert("Configurazione aggiunta al carrello!");
      }
     });
  });

  //qui quando clicco mi salvo l'id e le passo al php che fa aggiungi rimuovi o svuota 
 
  $('#add_to_cart').click(function(){ 
    var id_comp=[];
    var action = "aggiungi";
    id_comp.push($(this).data('id'));
    var value = 1;
    $.ajax({
      type:'post',
      url:'store_items.php',   //mi salva i valori dentro una variabile session che poi servira' il carrello 
      data:{
        valore:value,
        id_component:id_comp, 
        azione:action
      },
      success:function(data){
        document.getElementById("total_items").value=data;
        alert("Componente aggiunga al carrello!");
      }
    });
  });

  $('.cancella').click(function(){
   var id_comp = $(this).attr("id");
   var action = 'cancella';
    $.ajax({
      url:"store_items.php",
      type:'post',
      data:{
        id_component:id_comp, 
        azione:action
      },
      success:function(){
        //ricarico la pagina per vedere e modifiche che vengono fatte
        window.location.reload();
      }
    })
  });
 
  $('#svuota').click(function(){
    //svuoto il carrello
    var action = 'svuota';
    $.ajax({
      url:"store_items.php",
      type:'post',
      data:{
        azione:action
      },
      success:function(){
        //ricarico la pagina per vedere e modifiche che vengono fatte 
        window.location.reload();
      }
   });
  });
     
 });


 function nascondi_user(){
  document.getElementById("checkout").disabled = true;
  document.getElementById("checkout").setAttribute("title","Accedi per il checkout");
}
function mostra(){
  document.getElementById("checkout").disabled = false;
  document.getElementById("checkout").setAttribute("title","Continua con il checkout");
}
function nascondi_carr(){
  document.getElementById("checkout").disabled = true;
  document.getElementById("checkout").setAttribute("title","Il carrello e' vuoto!");
}
function nascondi_svuota(){
  document.getElementById("svuota").disabled = true;
  document.getElementById("svuota").setAttribute("title","Il carrello e' gia vuoto!");
}
function mostra_svuota(){
  document.getElementById("svuota").disabled = false;
  document.getElementById("svuota").setAttribute("title","Svuota il carrello!");
}