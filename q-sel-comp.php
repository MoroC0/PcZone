<?php
  //connessione
  include('connect.php');
  //avvio la sessione
  session_start();
 
  if(isset($_POST["tipo"])){
    //setto la variabile di sessione in modo da contenermi i valori
    $_SESSION['tipo']=$_POST["tipo"];
    $cnt=0;
    //metto tutti i valori che gli vengono passati dentro tot e poi li divido con explode 
    $tot_tipo = "";
    foreach ($_POST["tipo"] as $value){
      $tot_tipo .= ",$value";
    }
    $type = explode(",", $tot_tipo);
    //query base
    $query = "SELECT * FROM componente WHERE disponibilita > 1 AND (";

    $dim_tipo = sizeof($type);
    //il primo filtro viene selezionato per forza poiche' ci accedi tramite la pagine di sel comp
    //parantesi cosi posso fare piu' query
    $query .= "( categoria = '$type[1]' ";
    //prende gli stili di ogni componente in base al tipo
    //devo controllare se gli stili che passo sono vuoti
    if(isset($_POST['stile'])){
      //mi salvo gli stili
      $_SESSION['stile']=$_POST['stile'];
      
      //divido stile
      $tot_stile='';
      foreach ($_POST['stile'] as $valore){
        $tot_stile .= "$valore,";
      }
      //style contiene quello passato come parametro
      $style = explode(",", $tot_stile);

      //query per gli stili della tabella selezionata
      $qs = "SELECT distinct stile FROM $type[1]" ;
      $rit = pg_query($dbconn, $qs);
      $val_tot_style ='';
      while($row = pg_fetch_row($rit)){
        $val_tot_style .= ",$row[0]";
      }
      //ho gli stili in un array val_style
      $val_style = explode(",", $val_tot_style); 
      //confronto se sono del tipo selezione e faccio la query oppurtuna 
      //se stile contiene piu elementi, li devo mettere in or
      //faccio interserct 
      $int_style=array_intersect($style, $val_style);
      //se ha dimensione 1, lo stile non e' della tipologia

      if(sizeof($int_style)>0){
        for($j=0;$j<sizeof($int_style)-1;$j++){
          if(in_array($int_style[$j], $val_style)){
            if($j==0){
              $query .= "AND (stile = '$int_style[$j]' ";
            }
            else{
              $query .= "OR stile = '$int_style[$j]' ";
            }
          }
          $cnt++;
        }
        if(sizeof($int_style)!= 1)
          $query .=")";
      }
    }
    $query .=")";
    
    //ciclo se metto piu filtri
    for($i=2;$i<$dim_tipo;$i++){
      //metto in or i filtri rimanenti
      $query .= " OR ( categoria = '$type[$i]' ";
      if(isset($_POST['stile'])){
        //mi salvo gli stili
        $_SESSION['stile']=$_POST['stile'];
        
        //divido stile
        $tot_stile='';
        foreach ($_POST['stile'] as $valore){
          $tot_stile .= "$valore,";
        }

        $style = explode(",", $tot_stile);

        $qs = "SELECT distinct stile FROM $type[$i]" ;
        $rit = pg_query($dbconn, $qs);
        $val_tot_style ='';
        while($row = pg_fetch_row($rit)){
          $val_tot_style .= ",$row[0]";
        }
        $val_style = explode(",", $val_tot_style); 

        $int_style=array_intersect($style, $val_style);
        //se ha dimensione 1, lo stile non e' della tipologia
        if(sizeof($int_style)>1){
          for($j=$cnt;$j<sizeof($int_style)+$cnt-1;$j++){
            if(in_array($int_style[$j], $val_style)){
              if($j==$cnt){
                $query .= "AND (stile = '$int_style[$j]' ";
              }
              else{
                $query .= "OR stile = '$int_style[$j]' ";
              }
            }  
          }
          $cnt=$j;
          $query .=")";
        }
      }
      $query .=")";
    }
    //finiti i tipo chiudo le parentesi
    //ordino per valore
    $query .=")";
    if(isset($_POST['order'])){
      $order=$_POST['order'];
      $query .= " ORDER BY $order";
    }
    $ret = pg_query($dbconn, $query);
    $output = '';

    while($row = pg_fetch_row($ret)){
      $titolo=$row[1];
      $id=$row[0];
      $img=$row[5];
      $cat=$row[9];
      $prezzo=$row[6];  
      $output .= "<div class='col-lg-3 col-md-6 col-sm-10 offset-md-0 offset-sm-1 card-elem'>
                    <div class='card'> 
                      <a class='a-link' href='desc_componente.php?id=$id&tipo=$cat' style='text-decoration: none;color: gold;'>
                        <img class='imgg card-img-top' src='$img'>
                        <div class='card-body'>
                          <h6 class='title-obj pt-1'>$titolo</h6>
                        </div>
                        <div class='pt-3'>
                          <div class='row row-text'>
                            <div class='text-prezzo'>".number_format($prezzo, 2)." € </div>
                            <div class='text-quantita'><span class='quantita'> In stock </span></div>
                          </div>
                        </div>
                      </a>
                    </div>
                </div>";
      }
  }

  else{
    //Vedo se é stata effettuata una ricerca 
    if(isset($_SESSION['cerca'])){
      //aggiungere estenzione query nel controllo maiuscole, ergo prima maiuscola, tutto maiuscolo, tutto minuscolo.
      //vedere sul manuale php per specifiche comandi
      //query controllo
      $safe_value = '%'.pg_escape_string($_SESSION['cerca']).'%';
      $query_ricerca= "SELECT * FROM Componente WHERE Componente.titolo LIKE $1";
      //Uso pg prepare per evitare SQL INJECTION
      $result=pg_prepare($dbconn, "qmail", $query_ricerca);
      if($result==false){
        $output="Errore !!";
        header("refresh:2.0; url=home.php");
      }
      //eseguita con pg_execute
      $result=pg_execute($dbconn, "qmail", array($safe_value)); 
      $output ="";
      while($row = pg_fetch_row($result)){
        $titolo=$row[1];
        $id=$row[0];
        $img=$row[5];
        $cat=$row[9];
        $prezzo=$row[6]; 
        if($row[11]>0) 
          $quantita='In Stock';
        else
          $quantita='Esaurito';
        $output .= "<div class='col-lg-3 col-md-6 col-sm-10 offset-md-0 offset-sm-1 card-elem'>
                      <div class='card'> 
                        <a class='a-link' href='desc_componente.php?id=$id&tipo=$cat' style='text-decoration: none;color: gold;'>
                          <img class='imgg card-img-top' src='$img'>
                          <div class='card-body'>
                            <h6 class='title-obj pt-1'>$titolo</h6>
                          </div>
                          <div class='pt-3'>
                            <div class='row row-text'>
                              <div class='text-prezzo'>".number_format($prezzo, 2)." € </div>
                              <div class='text-quantita'><span class='quantita'> $quantita </span></div>
                            </div>
                          </div>
                        </a>
                      </div>
                  </div>";
        }
      unset($_SESSION['cerca']);
    }
    else{
      //altrimenti non ho nessun filtri e nessuna ricerca
      $query= "SELECT * FROM Componente";
      $result = pg_query($dbconn, $query);
      $output ="";
      while($row = pg_fetch_row($result)){
        $titolo=$row[1];
        $id=$row[0];
        $img=$row[5];
        $cat=$row[9];
        $prezzo=$row[6];  
        $output .= "<div class='col-lg-3 col-md-6 col-sm-10 offset-md-0 offset-sm-1 card-elem'>
                      <div class='card'> 
                        <a class='a-link' href='desc_componente.php?id=$id&tipo=$cat' style='text-decoration: none;color: gold;'>
                          <img class='imgg card-img-top' src='$img'>
                          <div class='card-body'>
                            <h6 class='title-obj pt-1'>$titolo</h6>
                          </div>
                          <div class='pt-3'>
                            <div class='row row-text'>
                              <div class='text-prezzo'>".number_format($prezzo, 2)." € </div>
                              <div class='text-quantita'><span class='quantita'> In stock </span></div>
                            </div>
                          </div>
                        </a>
                      </div>
                  </div>";
        }
    }
  }
  echo $output;

  pg_close($dbconn);
?>