//Script che controlla i campi della pagina dell'edit_user come password e conferma password

$(document).ready(function() {

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

  $('.eye').click(function(){
    if($(this).attr("id")=="r_pass"){
      mostra_pass('#editPass', '#hide1');
    }
    else if($(this).attr("id")=="r_c_pass"){
      mostra_pass('#editConfPass','#hide2');
    }
  })
});
  

//Funzione per controllare il nome
function valida_nome(){

  //Prendo il nome e creo l'espressione regolare
  var nome = document.getElementById("editNome");
  var lett_exp=/^([a-zA-Z])/;

  if(nome.classList.contains('valid')){
    nome.classList.remove('valid');
  }
  //Se il nome è vuoto aggiungo invalid
  if ((nome.value == "") || (nome.value == "undefined")) {
    nome.classList.add('invalid');
    return false; 
  }
  else{
    //Se il nome non rispetta l'espressione regolare aggiungo invalid
    if(!lett_exp.test(nome.value)){
      nome.classList.add('invalid');
      return false;
    }
    else{
      if(nome.classList.contains('invalid')){
        nome.classList.remove('invalid');
      }
      nome.classList.add('valid');
      return true;
    }
  }
}

//Funzione per controllare cognome
function valida_cognome(){
  var cognome = document.getElementById("editCogn");
  var lett_exp=/^([a-zA-Z])/;
    //aggiungo la classe di errore, e mostro il messaggio
  if(cognome.classList.contains('valid')){
    cognome.classList.remove('valid');
  }
  if ((cognome.value == "") || (cognome.value == "undefined")) {
    cognome.classList.add('invalid');
    return false;
  }
  else{
    if(!lett_exp.test(cognome.value)){
      cognome.classList.add('invalid');
      return false;
    }
    else{
      if(cognome.classList.contains('invalid')){
        cognome.classList.remove('invalid');
      }
      cognome.classList.add('valid');
      return true;
    }
  }
}

//Funzione per controllare il nickname
function valida_nick(){
  var nick = document.getElementById("editNick");
  var nick_exp=/^([a-zA-Z0-9_.-])+$/;

  //aggiungo la classe di errore, e mostro il messaggio
  if(nick.classList.contains('valid')){
    nick.classList.remove('valid');
  }
  if ((nick.value == "") || (nick.value == "undefined")) {
    nick.classList.add('invalid');
    return false;
  }
  else{
    if(!nick_exp.test(nick.value)){
      nick.classList.add('invalid');
      return false;
    }
    else{
      if(nick.classList.contains('invalid')){
        nick.classList.remove('invalid');
      }
      nick.classList.add('valid');
      return true;
    }
  }
}

//Funzione per controllare l'email
function valida_email(){
  var email = document.getElementById('editEmail');
  var email_reg_exp = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/;

  if(email.classList.contains('valid')){
    email.classList.remove('valid');
  }
  if ((email.value == "") || (email.value == "undefined")) {
    //aggiungo la classe di errore, e mostro il messaggio
    email.classList.add('invalid');
    return false;
  }
  else{
    if(!email_reg_exp.test(email.value)){
      email.classList.add('invalid');
      return false;
    }
    else{
      if(email.classList.contains('invalid')){
        email.classList.remove('invalid');
      }
      email.classList.add('valid');
      return true;
    }
  }
}

//Funzione per controllare il telefono
function valida_telefono(){
  var tel = document.getElementById("editCell");
  var tel_exp =/^([0-9])+$/;

  if(tel.classList.contains('valid')){
    tel.classList.remove('valid');
  }
  if ((tel.value == "") || (tel.value == "undefined")) {
    //aggiungo la classe di errore, e mostro il messaggio
    tel.classList.add('invalid');
    return false;
  }
  else{
    if(tel.value.length<10){
      tel.classList.add('invalid');
      return false;
    }
    else{
      if(!tel_exp.test(tel.value)){
        tel.classList.add('invalid');
        return false;
      }
      else{
        if(tel.classList.contains('invalid')){
          tel.classList.remove('invalid');
        }
        tel.classList.add('valid');
        return true;
      }
    }
  }
}

//Funzione per controllare l'indirizzo
function valida_indirizzo(){
  var indi = document.getElementById("editIndi");
  if(indi.classList.contains('valid')){
    indi.classList.remove('valid');
  }
  if ((indi.value == "") || (indi.value == "undefined")) {
    //Se la pass e confpass sono entrambe vuote aggiungo la classe di valid
    // e tolgo l'invalid
    indi.classList.add('invvalid');
    return false;
  }
  else{
    indi.classList.add('valid');
    return true;
  }
}

//Funzione per controllare la password
function valida_pass(){
  
  //Prendo pass, confpass e creo l'espressione regolare
  var pass = document.getElementById("editPass");
  var confpass = document.getElementById("editConfPass");
  var pass_exp=/^([a-zA-Z0-9_.-])+$/;

  if(pass.classList.contains('valid-pass')){
    pass.classList.remove('valid-pass');
  }
  if ((pass.value == "") || (pass.value == "undefined")) {
    //Se la pass e confpass sono entrambe vuote aggiungo la classe di valid
    // e tolgo l'invalid
    pass.classList.add('valid-pass');
    confpass.classList.add('valid-pass');
    return true;
  }

  //Se entro in questo else significa che cambio pass
  else{
    //Se la lunghezza della pass è minore di 6 alloraa aggiungo invalid
    if(pass.value.length<6){
      pass.classList.add('invalid-pass');
      confpass.classList.add('invalid-pass');
      return false;
    }
    else{
      //Se la lunghezza della pass è maggiore di 12 allora aggiungo invalid
      if(pass.value.length>12){
        pass.classList.add('invalid-pass');
        confpass.classList.add('invalid-pass');
        return false;
      }

      //Se rispetto il vincolo di lunghezza allora verifico l'espressione regolare
      else{
        if(!pass_exp.test(pass.value)){
          pass.classList.add('invalid-pass');
          confpass.classList.add('invalid-pass');
          return false;
        }
        //Se rispetto tutti i vincoli allora aggiungo valid
        else{
          if(pass.classList.contains('invalid-pass')){
            pass.classList.remove('invalid-pass');
            confpass.classList.remove('invalid-pass');
          }
          pass.classList.add('valid-pass');
          confpass.classList.add('valid-pass');
          return true;
        }
      }
    }
  }
}

function pass_uguali(){
  var confpass = document.getElementById('editConfPass');
  var pass = document.getElementById('editPass');

  if (pass.value == confpass.value) {
    confpass.classList.add('valid-pass');
    return true;
  }
  else {
      if(confpass.classList.contains('valid-pass')){
        confpass.classList.remove('valid-pass');
      }
      confpass.classList.add('invalid-pass');
      if(pass.classList.contains('valid-pass')){
        pass.classList.remove('valid-pass');
      }
      pass.classList.add('invalid-pass');
      return false;
  }
}

function valida_bottone(){
  //se tutti i campi sono true, modifica il bottone per iviare i dati al php 
  var nome = valida_nome();
  var cog = valida_cognome();
  var nick = valida_nick();
  var mail = valida_email();
  var cell = valida_telefono();
  var indi = valida_indirizzo();
  var pass = valida_pass();
  if(pass){
    var same = pass_uguali();
  }
  if(nome && cog && nick && mail && indi && cell && pass && same){
    return true;
  }
}

function attiva_btn(){
  if(valida_bottone()){
    document.getElementById("conf_btn").type = "submit";
  }
}

function toggle(){
  var blur = document.getElementById("blur");
  blur.classList.toggle('active');
  var popup = document.getElementById('popup');
  popup.classList.toggle('active');
}