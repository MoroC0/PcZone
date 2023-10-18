<?php
  //connessione
  include("connect.php");
  //prendo i campi

  $nome = $_POST['reg_nome'];
  $cognome = $_POST['reg_cognome'];
  $nick = $_POST['reg_nick'];
  $email = $_POST['reg_email'];
  $cell = $_POST['reg_tel'];
  $reg = $_POST['reg_reg'];
  $citta = $_POST['reg_citta'];
  $cap = $_POST['reg_cap'];
  $pref = $_POST['reg_pref'];
  $ind = $_POST['reg_indi'];
  $civ = $_POST['reg_civ'];
  $pass = md5($_POST['reg_pass']);
  $output='';

  $indirizzo = '';
  //inserirsco tutti i campi relativi all'indirizzo dentro un unica stringa separandoli con una ,
  //nel database ho solo una stringa che contiene l'indirizzo
  $indirizzo .= "$reg, $citta, $cap, $pref $ind, $civ";
  
  //query controllo
  $q1 = "SELECT * FROM utente WHERE email = $1";
  //Uso pg prepare per evitare SQL INJECTION
	$result=pg_prepare($dbconn, "qmail", $q1);
	if($result==false){
		$output="Errore !!";
    header("refresh:2.0; url=home.php");
  }
	//eseguita con pg_execute
	$result=pg_execute($dbconn, "qmail", array($email)); 
	//$ret = pg_query_params($dbconn, $q1, array($email));

	if ($line=pg_fetch_row($result)){
    $output = 'Utente giá registrato!';
    header("refresh:1.0; url=registrazione.html");
  }
  else{
    $q2 = "SELECT * FROM utente WHERE nickname = $1";
    //Uso pg prepare per evitare SQL INJECTION
    $result=pg_prepare($dbconn, "qnick", $q2);
    if($result==false){
      $output="Errore !!";
      header("refresh:2.0; url=home.php");
    }
    //eseguita con pg_execute
    $result=pg_execute($dbconn, "qnick", array($nick));
    //$ret = pg_query_params($dbconn, $q2, array($nick));
    if ($line=pg_fetch_row($result)){
      $output = 'Nickane giá utilizzato!';
      header("refresh:1.0; url=registrazione.html");
    }
    else{
      //query inserimento tramite pg_prepare
      $q3="INSERT INTO utente(nome, cognome, indirizzo, telefono, nickname, email, pass) 
          VALUES ($1, $2, $3, $4, $5, $6, $7) ";
      $result=pg_prepare($dbconn, "qins", $q3);
      //$query = "INSERT INTO utente(nome, cognome, indirizzo, telefono, nickname, email, pass) 
      //VALUES('$nome', '$cognome', '$indirizzo', '$cell', '$nick', '$email', '$pass')";
      //$res = pg_query($dbconn, $query);
      if($result==false){
        $output="Errore !!";
        header("refresh:2.0; url=home.php");
      }
      $result=pg_execute($dbconn, "qins", array($nome, $cognome, $indirizzo, $cell, $nick, $email, $pass));
      if(!$result){
        $output = 'ERRORE!';
        header("refresh:2.0; url=registrazione.html");
      }
      else{
        $output = 'Registrazione avvenuta con successo!';
        header("refresh:2.0; url=home.php");
      }
    }
  }
  pg_close($dbconn);   
?>
<html>
	<head>
		<meta charset = "utf-8">
		<title></title>
		<link rel="stylesheet" href="./Css/loading.css">
	</head>

	<body>
	<div style='margin-top:150px'>
			<h1 style="text-align:center; color: #2ecc71"><?php echo($output);?></h1>
		</div>
		<div class="middle">
			<div class="bar bar1"></div>
			<div class="bar bar2"></div>
			<div class="bar bar3"></div>
			<div class="bar bar4"></div>
			<div class="bar bar5"></div>
			<div class="bar bar6"></div>
			<div class="bar bar7"></div>
			<div class="bar bar8"></div>
		</div>
	</body>
</html>
