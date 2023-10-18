<?php
  //connessione
  include('connect.php');
  //sessione
  session_start();
  
  if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];

    //faccio la query per prendermi l'id dell'utente
    $q1 = "SELECT id from Utente where nickname='$user'";
    $row1 = pg_fetch_row(pg_query($dbconn, $q1));

    //Faccio la query per l'inserimento nel DB del ticket
    $q2="INSERT INTO Ticket(stato, titolo, testo, cod_utente, tipologia) VALUES ($1, $2, $3, $4, $5)";
    $stato='Creato';
    $subject =$_POST["titolo"];
    $testo = $_POST["testo"];
    $tipologia = $_POST["tipologia"];
    $utente=$row1[0];
    $result=pg_prepare($dbconn, "qins", $q2);
    if($result==false){
      $errore="ERRORE!!";
      header("refresh:2.0; url=home.php");
    }
    $result = pg_execute($dbconn, "qins", array($stato, $subject, $testo, $utente, $tipologia));
    //$res = pg_query($dbconn, $q2);
    if(!$result){
      $errore = 'ERRORE!';
    }

    //Prendo le informazioni riguardo al ticket creato
    $q3 = "SELECT Utente.nome, Utente.email, Ticket.id, Ticket.data_ticket, Ticket.stato, Ticket.testo 
              FROM Utente join Ticket on Utente.id = Ticket.cod_utente
              WHERE Utente.nickname = '$user'";
    
    $ret=(pg_query($dbconn, $q3));
    
		while($row = pg_fetch_row($ret)){
      $ultimo_ris = $row;
    }
    
    //destinatario
    $receiver = $ultimo_ris[1];

    //data
    $date= date_create($ultimo_ris[3]);
    
    //Struttura del messaggio genereto automaticamente
    $body = '<html><body style="font-size=17px; font-family: Poppins, sans-serif;">';
    $body .= 'Mail genereta automaticamente per la richiesta di supporto. Riepilogo delle informazioni: ';
    $body .= '<table rules="all" style="border-color: gold;" cellpadding="10">';
    $body .= "<tr><td><strong>Nome: </strong></td><td>" . $ultimo_ris[0] . "</td></tr>";
    $body .= "<tr><td><strong>Numero ticket: </strong></td><td>" . $ultimo_ris[2] . "</td></tr>";
    $body .= "<tr><td><strong>Tipologia: </strong></td><td>" . $tipologia . "</td></tr>";
    $body .= "<tr><td><strong>Data: </strong></td><td>" . date_format($date, 'd-m-Y H:i:s') . "</td></tr>";
    $body .= "<tr><td><strong>Status: </strong></td><td>" . $ultimo_ris[4] . "</td></tr>";
    $body .= "<tr><td><strong>Testo: </strong></td><td>" . $ultimo_ris[5] . "</td></tr>";
    $body .= "</table>";
    $body .= "</body></html>";

    // To send HTML mail, the Content-type header must be set
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';

    // Additional headers
    $headers[] = "From: tappe96@hotmail.com";

    if(mail($receiver, $subject, $body, implode("\r\n", $headers))){
      $output="Email inviata con successo a $receiver";
    }
    else{
      $errore="Errore nell'invio della mail!!";
    }
  }
  //controllo se provi ad accedere alla pagina
  else{
    $output='Non potresti essere qui! torna alla home!';
  }
?>
<html>
	<head>
		<meta charset = "utf-8">
		<title></title>
		<link rel="stylesheet" href="./Css/loading.css">
	</head>

	<body>
	<div style='margin-top:150px'>
			<h1 style="text-align:center; color: #2ecc71">
      <?php
          echo($output);
          header("refresh:2.5; url=home.php");
      ?>
      </h1>
      <h1 style='font-size: 40px; color: red'>
        <?php 
          if(isset($errore)){
            echo($errore);
            header("refresh:1.5; url=home.php");
          }
        ?>
      </h1>
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