$(document).ready(function(){

  //si prende tutti gli attribbuti data del bottone, e li manda al php tramite ajax per fare il salvataggio della configurazione
  $('#salva').click(function(){
		
    var id_Cpu = ($(this).data('cpu'));
    var id_Mobo = ($(this).data('mobo'));
    var id_Ram = ($(this).data('ram'));
    var id_Gpu = ($(this).data('gpu'));
    var id_Ssd = ($(this).data('ssd'));
    var id_Cooler = ($(this).data('cooler'));
    var id_Psu = ($(this).data('psu'));
    var id_Case = ($(this).data('case'));
    var Prezzo = ($(this).data('prezzo'));
    $.ajax({
      type:'post',
      url:'salva.php',
      data:{
        id_cpu:id_Cpu,
        id_mobo:id_Mobo,
        id_ram:id_Ram,
        id_gpu:id_Gpu,
        id_ssd:id_Ssd,
        id_cooler:id_Cooler,
        id_psu:id_Psu,
        id_case:id_Case,
        prezzo:Prezzo
      },
      success:function(data){
        alert("Configurazione salvata!");
        document.getElementById("total_items").value=data;
      }
    });
  })
})

function mostra_btn(){
  document.getElementById("salva").disabled = false;
  document.getElementById("salva").setAttribute("title", "Salva la configurazione");
}
function nascondi_btn(){
  document.getElementById("salva").disabled = true;
  document.getElementById('salva').setAttribute("title", "Accedi per salvare la configurazione!");
}