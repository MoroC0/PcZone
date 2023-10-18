<?php
  //connessione
  include('connect.php');
  //sessione
  session_start();
  
  if(isset($_SESSION['user']) && $_SESSION['user']=="admin"){
    if(isset($_GET['Ticket_id'])){
      $ticket_id=$_GET['Ticket_id'];

      //faccio la query per prendermi i dati del ticket 
      $q1="SELECT Ticket.id 
              FROM Ticket JOIN Utente ON Ticket.cod_utente = Utente.id 
              WHERE Ticket.id = $ticket_id";
      $row = pg_fetch_row(pg_query($dbconn, $q1));

      //aggiorno i dati del ticket
      $testo=$_POST["testo"];
      $stato = $_POST["stato"];
      $q2 = "UPDATE Ticket 
              SET testo = '$testo', stato = '$stato'
              WHERE id = $row[0];";

      $tet=(pg_query($dbconn, $q2));
      
      //faccio la query per prendere i valori del ticket aggiornati 
      $q3 = "SELECT Utente.nome, Utente.email, Ticket.id, Ticket.data_ticket, Ticket.stato, Ticket.testo, Ticket.titolo
              FROM Utente join Ticket on Utente.id = Ticket.cod_utente
              WHERE Ticket.id = $ticket_id";

      $ret = pg_fetch_row(pg_query($dbconn, $q3));

      //Salvo i valori per la mail
      $receiver = $ret[1];
      $subject = $ret[6];
      //Struttura del messaggio genereto automaticamente
      $body = '<html><body>';
      $body .= 'Mail genereta automaticamente per risposta alla richiesta. Riepilogo delle informazioni: ';
      $body .= '<table rules="all" style="border-color: green;" cellpadding="10">';
      $body .= "<tr><td><strong>Nome:</strong> </td><td>" . $ret[0] . "</td></tr>";
      $body .= "<tr><td><strong>Numero ticket:</strong> </td><td>" . $ret[2] . "</td></tr>";
      $body .= "<tr><td><strong>Data :</strong> </td><td>" . $ret[3] . "</td></tr>";
      $body .= "<tr><td><strong>Status :</strong> </td><td>" . $ret[4] . "</td></tr>";
      $body .= "<tr><td><strong>Testo :</strong> </td><td>" . $ret[5] . "</td></tr>";
      $body .= "</table>";
      $body .= "</body></html>";
      
      // To send HTML mail, the Content-type header must be set
      $headers[] = 'MIME-Version: 1.0';
      $headers[] = 'Content-type: text/html; charset=iso-8859-1';

      // Additional headers
      $headers[] = "From: tappe96@hotmail.com";

      if(mail($receiver, $subject, $body, implode("\r\n", $headers))){
        $output="Email inviata con successo a $receiver";
        header("refresh:2.5; url=all_ticket.php");
      }
      else{
        $output="Errore nell'invio della mail!!";
        header("refresh:2.5; url=home.php");
      }
      
    }

  }
  //controllo se provi ad accedere alla pagina senza essere un utente loggato
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