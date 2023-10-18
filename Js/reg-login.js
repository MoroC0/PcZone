$(document).ready(function() {

  //funzione per mostrare la password e cambiare l'occhio 
  function mostra_pass(pass, eye){
    if($(pass).attr("type") == "text"){
      $(pass).attr('type', 'password');
      $(eye).addClass("fa-eye");
      $(eye).removeClass("fa-eye-slash");
    }
    else{
      $(pass).attr('type', 'text');
      $(eye).removeClass( "fa-eye");
      $(eye).addClass("fa-eye-slash");
    }
  }
  //evento che attiva la funzione per modifcare la password
  $('.eye').click(function(){
    if($(this).attr("id")=="r_pass"){
      mostra_pass('#reg_pass', '#hide1');
    }
    else if($(this).attr("id")=="r_c_pass"){
      mostra_pass('#reg_confpass','#hide2');
    }
    else if($(this).attr("id")=="l_pass"){
      mostra_pass('#logPassword','#hide1');
    }
  })
});

// per la modifica on change piuttosto che on clinck
var yes = false;

function controllo_nome(){

  var nome = document.getElementById('reg_nome');
  var lett_exp=/^([a-zA-Z])/;
  
  if(yes){
    if(nome.classList.contains('valid')){
      nome.classList.remove('valid');
    }
    //aggiungo la classe di errore, e mostro il messaggio
    if ((nome.value == "") || (nome.value == "undefined")) {
      nome.classList.add('invalid');
      document.getElementById("inv_nome").innerHTML= "Nome richiesto.";
      document.getElementById("inv_nome").setAttribute("style", "display: block;"); 
      return false; 
    }
    else{
      if(!lett_exp.test(nome.value)){
        nome.classList.add('invalid');
        document.getElementById("inv_nome").innerHTML= "Nome non valido.";
        document.getElementById("inv_nome").setAttribute("style", "display: block;");
        return false;
      }
      else{
        if(nome.classList.contains('invalid')){
          nome.classList.remove('invalid');
        }
        nome.classList.add('valid');
        document.getElementById("inv_nome").setAttribute("style", "display: none;");
        return true;
      }
    }
  }
  
}

function controllo_cognome(){
  var cognome = document.getElementById('reg_cognome');
  var lett_exp=/^([a-zA-Z])/;
  if(yes){
      //aggiungo la classe di errore, e mostro il messaggio
    if(cognome.classList.contains('valid')){
      cognome.classList.remove('valid');
    }
    if ((cognome.value == "") || (cognome.value == "undefined")) {
      cognome.classList.add('invalid');
      document.getElementById("inv_cogn").innerHTML = "Cognome richiesto.";
      document.getElementById("inv_cogn").setAttribute("style", "display: block;");
      return false;
    }
    else{
      if(!lett_exp.test(cognome.value)){
        cognome.classList.add('invalid');
        document.getElementById("inv_cogn").innerHTML = "Cognome non valido";
        document.getElementById("inv_cogn").setAttribute("style", "display: block;");
        return false;
      }
      else{
        if(cognome.classList.contains('invalid')){
          cognome.classList.remove('invalid');
        }
        cognome.classList.add('valid');
        document.getElementById("inv_cogn").setAttribute("style", "display: none;");
        return true;
      }
    }
  } 
}

function controllo_nick(){
  var nick = document.getElementById('reg_nick');
  var nick_exp=/^([a-zA-Z0-9_.-])+$/;
  if(yes){
    //aggiungo la classe di errore, e mostro il messaggio
    if(nick.classList.contains('valid')){
      nick.classList.remove('valid');
    }
    if ((nick.value == "") || (nick.value == "undefined")) {
      nick.classList.add('invalid');
      document.getElementById("inv_nick").innerHTML = "Nickname richiesto.";
      document.getElementById("inv_nick").setAttribute("style", "display: block;");
      return false;
    }
    else{
      if(!nick_exp.test(nick.value)){
        nick.classList.add('invalid');
        document.getElementById("inv_nick").innerHTML = "Nickname non valido.";
        document.getElementById("inv_nick").setAttribute("style", "display: block;");
        return false;
      }
      else{
        if(nick.classList.contains('invalid')){
          nick.classList.remove('invalid');
        }
        nick.classList.add('valid');
        document.getElementById("inv_nick").setAttribute("style", "display: none;");
        return true;
      }
    }
  }
}

function controllo_email(){
  var email = document.getElementById('reg_email');
  var email_reg_exp = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/;

  if(yes){
    if(email.classList.contains('valid')){
      email.classList.remove('valid');
    }
    if ((email.value == "") || (email.value == "undefined")) {
      //aggiungo la classe di errore, e mostro il messaggio
      email.classList.add('invalid');
      document.getElementById("inv_email").innerHTML = "Email richiesta."
      document.getElementById("inv_email").setAttribute("style", "display: block;");
      return false;
    }
    else{
      if(!email_reg_exp.test(email.value)){
        email.classList.add('invalid');
        document.getElementById("inv_email").innerHTML = "Email non valida.";
        document.getElementById("inv_email").setAttribute("style", "display: block;");
        return false;
      }
      else{
        if(email.classList.contains('invalid')){
          email.classList.remove('invalid');
        }
        email.classList.add('valid');
        document.getElementById("inv_email").setAttribute("style", "display: none;");
        return true;
      }
    }
  }
}

function controllo_telefono(){
  var tel = document.getElementById('reg_tel');
  var tel_exp =/^([0-9])+$/;

  if(yes){
    if(tel.classList.contains('valid')){
      tel.classList.remove('valid');
    }
    if ((tel.value == "") || (tel.value == "undefined")) {
      //aggiungo la classe di errore, e mostro il messaggio
      tel.classList.add('invalid');
      document.getElementById("inv_tel").innerHTML="Telefono richiesto.";
      document.getElementById("inv_tel").setAttribute("style", "display: block;");
      return false;
    }
    else{
      if(tel.value.length<10){
        tel.classList.add('invalid');
        document.getElementById("inv_tel").innerHTML="Telefono troppo corto.";
        document.getElementById("inv_tel").setAttribute("style", "display: block;");
        return false;
      }
      else{
        if(!tel_exp.test(tel.value)){
          tel.classList.add('invalid');
          document.getElementById("inv_tel").innerHTML = "Telefono non valido.";
          document.getElementById("inv_tel").setAttribute("style", "display: block;");
          return false;
        }
        else{
          if(tel.classList.contains('invalid')){
            tel.classList.remove('invalid');
          }
          tel.classList.add('valid');
          document.getElementById("inv_tel").setAttribute("style", "display: none;");
          return true;
        }
      }
    }
  }
}

function controllo_regione(){
  var reg = document.getElementById('reg_reg');
  var reg_exp=/^([a-zA-Z])/;

  if(yes){
    if(reg.classList.contains('valid')){
    reg.classList.remove('valid');
    }
    if ((reg.value == "") || (reg.value == "undefined")) {
      //aggiungo la classe di errore, e mostro il messaggio
      reg.classList.add('invalid');
      document.getElementById("inv_reg").innerHTML = "Regione richiesta.";
      document.getElementById("inv_reg").setAttribute("style", "display: block;");
      return false;
    }
    else{
      if(!reg_exp.test(reg.value)){
        ind.classList.add('invalid');
        document.getElementById("inv_reg").innerHTML = "Regione non valida";
        document.getElementById("inv_reg").setAttribute("style", "display: block;");
        return false;
      }
      else{
        if(reg.classList.contains('invalid')){
          reg.classList.remove('invalid');
        }
        reg.classList.add('valid');
        document.getElementById("inv_reg").setAttribute("style", "display: none;");
        return true;
      }
    }
  }
}

function controllo_citta(){
  var citta = document.getElementById('reg_citta');
  var citta_exp=/^([a-zA-Z])/;

  if(yes){
    if(citta.classList.contains('valid')){
    citta.classList.remove('valid');
    }
    if ((citta.value == "") || (citta.value == "undefined")) {
      //aggiungo la classe di errore, e mostro il messaggio
      citta.classList.add('invalid');
      document.getElementById("inv_citta").innerHTML = "Citta richiesta.";
      document.getElementById("inv_citta").setAttribute("style", "display: block;");
      return false;
    }
    else{
      if(!citta_exp.test(citta.value)){
        citta.classList.add('invalid');
        document.getElementById("inv_citta").innerHTML = "Citta non valida";
        document.getElementById("inv_citta").setAttribute("style", "display: block;");
        return false;
      }
      else{
        if(citta.classList.contains('invalid')){
          citta.classList.remove('invalid');
        }
        citta.classList.add('valid');
        document.getElementById("inv_citta").setAttribute("style", "display: none;");
        return true;
      }
    }
  }
}

function controllo_cap(){
  var cap = document.getElementById('reg_cap');
  var cap_exp=/^([0-9])/;

  if(yes){
    if(cap.classList.contains('valid')){
      cap.classList.remove('valid');
    }
    if ((cap.value == "") || (cap.value == "undefined")) {
      //aggiungo la classe di errore, e mostro il messaggio
      cap.classList.add('invalid');
      document.getElementById("inv_cap").innerHTML = "CAP richiesto.";
      document.getElementById("inv_cap").setAttribute("style", "display: block;");
      return false;
    }
    else{
      if(!cap_exp.test(cap.value)){
        ind.classList.add('invalid');
        document.getElementById("inv_cap").innerHTML = "CAP non valido.";
        document.getElementById("inv_cap").setAttribute("style", "display: block;");
        return false;
      }
      else{
        if(cap.classList.contains('invalid')){
          cap.classList.remove('invalid');
        }
        cap.classList.add('valid');
        document.getElementById("inv_cap").setAttribute("style", "display: none;");
        return true;
      }
    }
  }
}

function controllo_civ(){
  var civ = document.getElementById('reg_civ');
  var civ_exp=/^([0-9])/;

  if(yes){
    if(civ.classList.contains('valid')){
      civ.classList.remove('valid');
    }
    if ((civ.value == "") || (civ.value == "undefined")) {
      //aggiungo la classe di errore, e mostro il messaggio
      civ.classList.add('invalid');
      document.getElementById("inv_civ").innerHTML = "Civico richiesto.";
      document.getElementById("inv_civ").setAttribute("style", "display: block;");
      return false;
    }
    else{
      if(!civ_exp.test(civ.value)){
        ind.classList.add('invalid');
        document.getElementById("inv_civ").innerHTML = "Civico non valido.";
        document.getElementById("inv_civ").setAttribute("style", "display: block;");
        return false;
      }
      else{
        if(civ.classList.contains('invalid')){
          civ.classList.remove('invalid');
        }
        civ.classList.add('valid');
        document.getElementById("inv_civ").setAttribute("style", "display: none;");
        return true;
      }
    }
  }
}


function controllo_indi(){
  var ind = document.getElementById('reg_indi');
  var ind_exp=/^([a-zA-Z])/;

  if(yes){
    if(ind.classList.contains('valid')){
    ind.classList.remove('valid');
    }
    if ((ind.value == "") || (ind.value == "undefined")) {
      //aggiungo la classe di errore, e mostro il messaggio
      ind.classList.add('invalid');
      document.getElementById("inv_indi").innerHTML = "Indirizzo richiesto.";
      document.getElementById("inv_indi").setAttribute("style", "display: block;");
      return false;
    }
    else{
      if(!ind_exp.test(ind.value)){
        ind.classList.add('invalid');
        document.getElementById("inv_indi").innerHTML = "Indirizzo non valido.";
        document.getElementById("inv_indi").setAttribute("style", "display: block;");
        return false;
      }
      else{
        if(ind.classList.contains('invalid')){
          ind.classList.remove('invalid');
        }
        ind.classList.add('valid');
        document.getElementById("inv_indi").setAttribute("style", "display: none;");
        return true;
      }
    }
  }
}

function controllo_prefisso(){
  var pref = document.getElementById('reg_pref');

  if(yes){
    if(pref.classList.contains('valid-pref')){
      pref.classList.remove('valid-pref');
    }
    if ((pref.value == "") || (pref.value == "undefined")) {
      //aggiungo la classe di errore, e mostro il messaggio
      pref.classList.add('invalid-pref');
      document.getElementById("inv_pref").innerHTML = "Prefisso richiesto.";
      document.getElementById("inv_pref").setAttribute("style", "display: block;");
      return false;
    }
    else{
      if(pref.classList.contains('invalid-pref')){
        pref.classList.remove('invalid-pref');
      }
      pref.classList.add('valid-pref');
      document.getElementById("inv_pref").setAttribute("style", "display: none;");
      return true;
    }
  }
}

function controllo_pass(){
  var pass = document.getElementById('reg_pass');
  var pass_exp=/^([a-zA-Z0-9_.-])+$/;
  
  if(yes){
    if(pass.classList.contains('valid-pass')){
      pass.classList.remove('valid-pass');
    }
    if ((pass.value == "") || (pass.value == "undefined")) {
      //aggiungo la classe di errore, e mostro il messaggio
      pass.classList.add('invalid-pass');
      document.getElementById("inv_pass").innerHTML ="Password richiesta."
      document.getElementById("inv_pass").setAttribute("style", "display: block;");
      return false;
    }
    else{
      if(pass.value.length<6){
        pass.classList.add('invalid-pass');
        document.getElementById("inv_pass").innerHTML = "Password troppo corta!"
        document.getElementById("inv_pass").setAttribute("style", "display: block;");
        return false;
      }
      else{
        if(pass.value.length>12){
          pass.classList.add('invalid-pass');
          document.getElementById("inv_pass").innerHTML = "Password troppo lunga!"
          document.getElementById("inv_pass").setAttribute("style", "display: block;");
          return false;
        }
        else{
          if(!pass_exp.test(pass.value)){
            pass.classList.add('invalid-pass');
            document.getElementById("inv_pass").innerHTML ="Password non valida."
            document.getElementById("inv_pass").setAttribute("style", "display: block;");
            return false;
          }
          else{
            if(pass.classList.contains('invalid-pass')){
              pass.classList.remove('invalid-pass');
            }
            pass.classList.add('valid-pass');
            document.getElementById("inv_pass").setAttribute("style", "display: none;");
            return true;
          }
        }
      }
    }
  }  
}

function controllo_conf(){
  var conf = document.getElementById('reg_confpass');
  var pass_exp=/^([a-zA-Z0-9_.-])+$/;

  if(yes){
    //aggiungo la classe di errore, e mostro il messaggio
    if(conf.classList.contains('valid-pass')){
      conf.classList.remove('valid-pass');
    }
    if ((conf.value == "") || (conf.value == "undefined")) {
      conf.classList.add('invalid-pass');
      document.getElementById("inv_cpass").innerHTML = "Conferma richiesta.";
      document.getElementById("inv_cpass").setAttribute("style", "display: block;");
      return false;
    }
    else{
      if(conf.value.length<6){
        conf.classList.add('invalid-pass');
        document.getElementById("inv_cpass").innerHTML = "Conferma troppo corta!"
        document.getElementById("inv_cpass").setAttribute("style", "display: block;");
        return false;
      }
      else{
        if(conf.value.length>12){
          conf.classList.add('invalid-pass');
          document.getElementById("inv_cpass").innerHTML = "Conferma troppo lunga!"
          document.getElementById("inv_cpass").setAttribute("style", "display: block;");
          return false;
        }
        else{
          if(!pass_exp.test(conf.value)){
            conf.classList.add('invalid-pass');
            document.getElementById("inv_cpass").innerHTML = "Conferma non valida."
            document.getElementById("inv_cpass").setAttribute("style", "display: block;");
            return false;
          }
          else{
            if(conf.classList.contains('invalid-pass')){
              conf.classList.remove('invalid-pass');
            }
            conf.classList.add('valid-pass');
            document.getElementById("inv_cpass").setAttribute("style", "display: none;");
            return true;
          }
        }
      }
    }
  }  
}

function pass_uguali(){
  var outpas =document.getElementById("err_pass");
  var conf = document.getElementById('reg_confpass');
  var pass = document.getElementById('reg_pass');

  if (pass.value == conf.value && (pass.value != "") && (conf.value != "") ) {
    outpas.setAttribute("style", "display: block; color: green;");
    outpas.innerHTML= "Password corrette!";
    conf.classList.add('valid-pass');
    document.getElementById("inv_cpass").setAttribute("style", "display: none;");
    return true;
  }
  else {
      outpas.setAttribute("style", "display: block;");
      outpas.innerHTML= "Le password non coincidono!";
      if(conf.classList.contains('valid-pass')){
        conf.classList.remove('valid-pass');
      }
      conf.classList.add('invalid-pass');
      document.getElementById("inv_cpass").innerHTML = "";
      document.getElementById("inv_cpass").setAttribute("style", "display: block;");
      if(pass.classList.contains('valid-pass')){
        pass.classList.remove('valid-pass');
      }
      pass.classList.add('invalid-pass');
      document.getElementById("inv_pass").innerHTML = "";
      document.getElementById("inv_pass").setAttribute("style", "display: block;");
      return false;
  }
}

function valida_form(){
  var form = document.getElementById("form");
  //setta i controlli onkeyup
    yes = true;
    controllo_nome();
    controllo_cognome();
    controllo_nick();
    controllo_email();
    controllo_telefono();
    controllo_regione();
    controllo_citta()
    controllo_cap();
    controllo_indi();
    controllo_civ();
    controllo_prefisso();
    var pass = controllo_pass();
    var conf = controllo_conf();
    //se la pass e la conf ripettano tutti i vincoli, mi dice se sono uguali
    if(pass && conf){
      pass_uguali();
    }
    if(valida_bottone()){
      document.getElementById("reg_btn").type = "submit";
      form.action="ver_registrazione.php";
      form.submit();
    };
}

function valida_bottone(){
  //se tutti i campi sono true, modifica il bottone per iviare i dati al php 
  var nome = controllo_nome();
  var cog = controllo_cognome();
  var nick = controllo_nick();
  var mail = controllo_email();
  var cel = controllo_telefono();
  var reg = controllo_regione();
  var citta = controllo_citta();
  var cap = controllo_cap();
  var indi = controllo_indi();
  var civ = controllo_civ();
  var pref = controllo_prefisso();
  var pass = controllo_pass();
  var conf = controllo_conf();
  if(pass && conf){
    var same = pass_uguali();
  }
  if(nome && cog && nick && mail && cel && reg && citta && cap && indi && pref && civ && pass && conf && same){
    return true;
  }
}

function toggle(){
  var blur = document.getElementById("blur");
  blur.classList.toggle('active');
  var popup = document.getElementById('popup');
  popup.classList.toggle('active');
}