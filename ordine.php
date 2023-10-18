<?php

  //connessione
  include('connect.php');
  //sessione
  session_start();

  //post di pagamento e di prezzo
  $pag = $_POST['pagamento'];
  $prezzo = $_POST['prezzo'];
  //data del pagamento/ordine
  $data = date("d/m/Y");

  //Prendo l'id dell'utente in sessione
  $user = $_SESSION['user'];
  $query = "SELECT id FROM Utente WHERE Utente.nickname = '$user'";
  $row = pg_fetch_row(pg_query($dbconn, $query));

  //creo la tupla per l'ordine
  //aggiungere pagamento pagamento, $pag

  $q_ordine="INSERT INTO ordine(data_ord, prezzo, pagamento, cod_utente, stato)
        VALUES ($1, $2, $3, $4, $5)";
  $result=pg_prepare($dbconn, "qord", $q_ordine);
  if($result==false){
    $output="Errore !!";
  }
  $result=pg_execute($dbconn, "qins", array($data, $prezzo, $pag, $row[0], 'Accettato'));
  if(!$result){
    $output = 'ERRORE!';
  }
  else{
    $output = 'ordine confermato!';
  }

  
  $query1 = "INSERT INTO ordine(data_ord, prezzo, pagamento, cod_utente, stato)
             VALUES ('$data', $prezzo, '$pag', $row[0], 'Accettato')";
  pg_query($dbconn,$query1);

  //Prendo l'id dell'ordine dell'utente in sessione
  $query2 = "SELECT id FROM ordine WHERE ordine.cod_utente = $row[0]"; 

  //prendo l'ultimo ordine
  $ret = pg_query($dbconn, $query2);
  while($row = pg_fetch_row($ret)){
    $ris = $row[0];
  }

  //prendo i prodotti nel carrello solo con l'id
  $carrello = $_SESSION['carrello'];
  foreach($_SESSION["carrello"] as $keys => $values){
    $prod = $values['id_comp'];
    $quant = $values['quantita'];
    //prendiamo l'id dei prodotti nel carrello .$values["id_comp"].
    $query3 = "INSERT INTO ord_comp(cod_ord, cod_comp, quantita)
                VALUES ($ris, $prod , $quant)";
    pg_query($dbconn,$query3);
    
    //devo decrementare la quantita disponibile dei componenti
    $query4='UPDATE componente 
              SET disponibilita = disponibilita - $quant
              WHERE id = $prod';
    pg_query($dbconn, $query4);
  }

  unset($_SESSION['carrello']);
  $_SESSION["n_ogg_carr"]=0;


  /*function loginUser ($username, $pas, $hpas){
    $result = controllo_email($username);
    if ($result === false) {
      $errore = "Utente non registrato!";
    }
    else{
      $pass = $_POST["password"];
      if (password_verify($hpas , $pass)){
        $output = 'ACCESSO IN CORSO...';        
        session_start ();
        $_SESSION["user"] = $username; 
        header("refresh:1.5; url= home.php");
      }
      else{
        $output = 'PASSWORD SBAGLIATA!';
        header("refresh:1; url=login.php");
      }
    }
    exit ();
  }*/
?>