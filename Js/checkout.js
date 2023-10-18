//file js per il controllo del checkout 
//uso yes per fare il controllo on key dopo aver premuto il bottone
var yes=false;

  function controllo_int(){
    var int = document.getElementById('check_int');
    var int_exp=/^([a-zA-Z])/;
  
    if(yes){
      if(int.classList.contains('valid')){
        int.classList.remove('valid');
      }
      if ((int.value == "") || (int.value == "undefined")) {
        //aggiungo la classe di errore, e mostro il messaggio
        int.classList.add('invalid');
        document.getElementById("inv_int").innerHTML = "Intestatario richiesto.";
        document.getElementById("inv_int").setAttribute("style", "display: block;");
        return false;
      }
      else{
        if(!int_exp.test(int.value)){
          int.classList.add('invalid');
          document.getElementById("inv_int").innerHTML = "Intestatario non valido.";
          document.getElementById("inv_int").setAttribute("style", "display: block;");
          return false;
        }
        else{
          if(int.classList.contains('invalid')){
            int.classList.remove('invalid');
          }
          int.classList.add('valid');
          document.getElementById("inv_int").setAttribute("style", "display: none;");
          return true;
        }
      }
    }
  }

  function controllo_num(){
    var num = document.getElementById('check_num');
  
    if(yes){
      if(num.classList.contains('valid')){
        num.classList.remove('valid');
      }
      if ((num.value == "") || (num.value == "undefined")) {
        //aggiungo la classe di errore, e mostro il messaggio
        num.classList.add('invalid');
        document.getElementById("inv_num").innerHTML = "Numero di carta richiesto.";
        document.getElementById("inv_num").setAttribute("style", "display: block;");
        return false;
      }
      else{
        if(num.value.length<13){
          num.classList.add('invalid');
          document.getElementById("inv_num").innerHTML = "Numero di carta troppo corto.";
          document.getElementById("inv_num").setAttribute("style", "display: block;");
          return false;
        }
        else{
          if(num.value.length>16){
            num.classList.add('invalid');
            document.getElementById("inv_num").innerHTML = "Numero di carta troppo lungo.";
            document.getElementById("inv_num").setAttribute("style", "display: block;");
            return false;
          }
          else{
            if(isNaN(num.value)){
              num.classList.add('invalid');
              document.getElementById("inv_num").innerHTML = "Numero di carta non valido.";
              document.getElementById("inv_num").setAttribute("style", "display: block;");
              return false;
            }
            else{
              if(num.classList.contains('invalid')){
                num.classList.remove('invalid');
              }
              num.classList.add('valid');
              document.getElementById("inv_num").setAttribute("style", "display: none;");
              return true;
            }
          }
        }
      }
    }
  }

  function controllo_scad(){
    var scad = document.getElementById('check_scad');
    var scad_exp=/(^\d{2}\/\d{2}$)/;
  
    if(yes){
      if(scad.classList.contains('valid')){
        scad.classList.remove('valid');
      }
      if ((scad.value == "") || (scad.value == "undefined")) {
        //aggiungo la classe di errore, e mostro il messaggio
        scad.classList.add('invalid');
        document.getElementById("inv_scad").innerHTML = "Scadenza richiesta.";
        document.getElementById("inv_scad").setAttribute("style", "display: block;");
        return false;
      }
      else{
        if(!scad_exp.test(scad.value)){
          scad.classList.add('invalid');
          document.getElementById("inv_scad").innerHTML = "Scadenza non valida.";
          document.getElementById("inv_scad").setAttribute("style", "display: block;");
          return false;
        }
        else{
          if(scad.classList.contains('invalid')){
            scad.classList.remove('invalid');
          }
          scad.classList.add('valid');
          document.getElementById("inv_scad").setAttribute("style", "display: none;");
          return true;
        }
      }
    }
  }

  function controllo_cvv(){
    var cvv = document.getElementById('check_cvv');
    var cvv_exp=/^([0-9])/;
  
    if(yes){
      if(cvv.classList.contains('valid')){
        cvv.classList.remove('valid');
      }
      if ((cvv.value == "") || (cvv.value == "undefined")) {
        //aggiungo la classe di errore, e mostro il messaggio
        cvv.classList.add('invalid');
        document.getElementById("inv_cvv").innerHTML = "CVV richiesto.";
        document.getElementById("inv_cvv").setAttribute("style", "display: block;");
        return false;
      }
      else{
        if(cvv.value.length<3){
          cvv.classList.add('invalid');
          document.getElementById("inv_cvv").innerHTML = "CVV troppo corto.";
          document.getElementById("inv_cvv").setAttribute("style", "display: block;");
          return false;
        }
        else{
          if(cvv.value.length>3){
            cvv.classList.add('invalid');
            document.getElementById("inv_cvv").innerHTML = "CVV troppo lungo.";
            document.getElementById("inv_cvv").setAttribute("style", "display: block;");
            return false;
          }
          else{
            if(!cvv_exp.test(cvv.value)){
              cvv.classList.add('invalid');
              document.getElementById("inv_cvv").innerHTML = "CVV non valido.";
              document.getElementById("inv_cvv").setAttribute("style", "display: block;");
              return false;
            }
            else{
              if(cvv.classList.contains('invalid')){
                cvv.classList.remove('invalid');
              }
              cvv.classList.add('valid');
              document.getElementById("inv_cvv").setAttribute("style", "display: none;");
              return true;
            }
          }
        }
      }
    }
  }


function valida_form(){
    yes = true;
    controllo_int();
    controllo_num();
    controllo_scad();
    controllo_cvv();
    if(valida_bottone()){
      //se e' tutto giusto, invio i dati ad una pagina php per fare l'ordine
      var int = document.getElementById('check_int').value;
      var cvv = document.getElementById('check_cvv').value;
      var scad = document.getElementById('check_scad').value;
      var num = document.getElementById('check_num').value;
      var pagamento = int+', '+num+', '+scad+', '+cvv;
      var value = document.getElementById('conf_ordi').getAttribute('name');
      $.ajax({
        type:'post',
        url:'ordine.php',
        data:{
          prezzo:value,
          pagamento:pagamento
        },
        success:function(data){
          alert('Ordine confermato');
          window.location = "home.php";
        }
      })
    }
}

function valida_bottone(){
  //se tutti i campi sono true, modifica il bottone per inviare i dati al php 
  var int = controllo_int();
  var num = controllo_num();
  var scad = controllo_scad();
  var cvv = controllo_cvv();
  if(int && num && scad && cvv){
    return true;
  }
}

function toggle(){
  var blur = document.getElementById("blur");
  blur.classList.toggle('active');
  var popup = document.getElementById('popup');
  popup.classList.toggle('active');
}