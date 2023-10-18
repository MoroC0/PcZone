<?php
  //script che mi permette di modificare il carello a seconda dell'azione che gli passo
  session_start();

  if(isset($_POST["azione"])){
    if($_POST["azione"] == "aggiungi"){
      $id_comp = $_POST["id_component"];
      $_SESSION["n_ogg_carr"]+=$_POST["valore"];
      for($i = 0; $i < sizeof($id_comp); $i++){
        //mi salvo le 'chiavi' dell'array di sessione che contiene il carrello e le confronto 
        //per vedere se é gia stato inserito l'elemento
        //se nella variabile di sessione del carrello non ce nulla, ci metto la  chiave
        //altrimenti controllo
        if(!isset($_SESSION["carrello"])){
          $comp_array = array( 'id_comp' => $id_comp[$i], 'quantita' => 1);
          $_SESSION["carrello"][$id_comp[$i]] = $comp_array;
        }
        else{
          $cart_product_id = array_keys($_SESSION["carrello"]);
          if(in_array($id_comp[$i], $cart_product_id)){
            $_SESSION["carrello"][$id_comp[$i]]['quantita']++;  //se e'gia stato inserito aumenta la quantita
          }
          else{
            $comp_array = array( 'id_comp' => $id_comp[$i], 'quantita' => 1);
            $_SESSION["carrello"][$id_comp[$i]] = $comp_array;  //altrimento mettilo dentro la variabile di sessione   
          }
        }
    }
    echo $_SESSION["n_ogg_carr"];
  }

  //se l'azione e' cancella, elimino l'elemento corrispondende all'id
  if($_POST["azione"] == 'cancella'){
    //mi cerco l'elemento a cui devo decrementare la quantita
    if($_SESSION["carrello"][$_POST["id_component"]]['quantita'] > 1){
      $_SESSION["carrello"][$_POST["id_component"]]['quantita']--;
    }
    else
      unset($_SESSION["carrello"][$_POST["id_component"]]);
    $_SESSION["n_ogg_carr"]--;
    
    //se elimino tutto i componenti, svuoto il carrello
    if(sizeof($_SESSION["carrello"])==0){
      $_SESSION["n_ogg_carr"]=0;
      unset($_SESSION["carrello"]);
    }
    echo $_SESSION["n_ogg_carr"]-1;
  }

  //se svuoto, cacello il carrello
  if($_POST["azione"] == 'svuota'){
    $_SESSION["n_ogg_carr"]=0;
    unset($_SESSION["carrello"]);
  }
}

?>