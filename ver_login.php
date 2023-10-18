<?php
	//connessione
	include("connect.php");
	//Avvio la sessione
	session_start();
	$connesso = 0;
	$output ='';
	$email = $_POST['logEmail']; //Prendo l'email 
	$q1 = "SELECT * FROM utente WHERE email = $1";
	//Uso pg prepare per evitare SQL INJECTION
	//mi permette di controllare la corretta semantica della query
	$result=pg_prepare($dbconn, "qmail", $q1);
	if($result==false){
		$output="Errore !!";
		header("refresh:2.0; url=home.php");
	}
	//eseguita con pg_execute
	$result=pg_execute($dbconn, "qmail", array($email));
	//$res = pg_query_params($dbconn, $q1, array($email));
	$line=pg_fetch_row($result);
	if(!$line){
		$output = "Non sei un utente registrato, per favore registrati";
		header("refresh:2.0; url=registrazione.html");
	}
	else{
		$password = md5($_POST['logPassword']);
		//$password = $_POST['logPassword'];
		$q2 = "SELECT nickname FROM utente WHERE email = $1 AND pass =  $2";
		//anche qui uso prepare per evitare SQL INJECTION
		$result=pg_prepare($dbconn, "qacc", $q2);
		if($result==false){
			$output="Errore!";
			header("refresh:2.0; url=home.php");
		}
		//$res = pg_query_params($dbconn, $q2, array($email, $password));
		$result=pg_execute($dbconn, "qacc", array($email, $password));
		$line = pg_fetch_row($result);
		if(!$line){
			$output = 'PASSWORD SBAGLIATA!';
			header("refresh:1; url=login.php");
		}
		else{
			$output = 'ACCESSO IN CORSO...';
			$_SESSION["user"] = $line[0]; //Prendo il nickname per ricordarmi la sessione
			header("refresh:1.5; url= home.php");
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
