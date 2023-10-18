<?php
	//connessione
	include("connect.php");
	//Avvio la sessione
	session_start();

	if(isset($_SESSION['user'])){

  	$old_nick = $_SESSION['user'];
    
		$nome = $_POST['editNome'];
		$cogn = $_POST['editCogn'];
		$nick = $_POST['editNick'];
		$email = $_POST['editEmail'];
		$cell = $_POST['editCell'];
		$indi = $_POST['editIndi'];
		$pass = md5($_POST['editPass']);
		$confpass = md5($_POST['editConfPass']);

		$qold_pass = "SELECT pass FROM Utente WHERE '$old_nick' = Utente.nickname";
		$rowold_pass = pg_fetch_row(pg_query($dbconn, $qold_pass));


		if($pass == ""){ //Se la password inserita è vuota aggiorno tutti gli altri campi
			$q1 = "UPDATE utente 
					SET nome = '$nome',
					cognome = '$cogn',
					nickname = '$nick',
					email = '$email',
					telefono = '$cell',
					indirizzo = '$indi'
					WHERE nickname = '$old_nick'";
		}

		else{ //Se la password non è vuota la modifico
			$q1 = "UPDATE utente 
					SET nome = '$nome',
					cognome = '$cogn',
					nickname = '$nick',
					email = '$email',
					telefono = '$cell',
					indirizzo = '$indi',
					pass = '$pass'
					WHERE nickname = '$old_nick'";
		}    
		pg_query($dbconn, $q1); //Invio la query al database

	$_SESSION['user'] = $nick; //Salvo il nuovo nick dell'utente in sessione
	header("Location: user.php"); //Rimando l'utente alla pagina user modificata con i nuovi campi
	}
	else{
		echo("NON POTRESTI ESSERE QUI! Torna alla home");
		header("refresh:1; url=home.php");
	}
?>