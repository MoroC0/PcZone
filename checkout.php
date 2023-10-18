
<?php
  //connessione
  include('connect.php');
  //sessione
  session_start();
  
  if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    if(isset($_GET['prezzo'])){
      $prezzo = $_GET['prezzo'];

      //Prendo l'id dell'utente in sessione
      $query1 = "SELECT nome, cognome, indirizzo FROM Utente WHERE Utente.nickname = '$user'";
      $utente = pg_fetch_row(pg_query($dbconn, $query1));
      $output = '';
      if(isset($_SESSION["carrello"])){
        foreach($_SESSION["carrello"] as $keys => $values){
          $query2 = 'SELECT * FROM componente WHERE id = '.$values["id_comp"].'';
          $row = pg_fetch_row(pg_query($dbconn, $query2));
          $output .= '<div class="row row-mg0 justify-content-between">
                        <div class="col-auto col-md-7">
                          <div class="media flex-column flex-sm-row">
                            <div class="col-3 m-auto">
                              <img class="img-fluid" src='.$row[5].' width="100%" style="object-fit: contain;">
                            </div>
                            <div class="media-body  my-auto">
                              <div class="desc-item">
                                <div class="col-auto">
                                  <p class="comp-title mb-0">'.$row[1].'</p>
                                  <small class="comp-desc">'.$row[2].'</small>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto my-auto"><p class="boxed-1">'.$values["quantita"].'</p></div>
                        <div class="col-auto my-auto prezzo"><p>'.(number_format($row[6], 2)).'€</p></div>
                      </div>
                      <hr class="my-2">';
        }
      }
    }
    else{
      $prezzo=0;
    }
  }
  //controllo se provi ad accedere alla pagina senza essere un utente loggato
  else{
    $output='Non potresti essere qui! torna alla home!';
  }
?>
<html>
  <head>
    <title>Pc Zone Checkout</title>
    <link rel="stylesheet" type="text/css" href= "./Css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="./Css/style.css" />
    <link rel="stylesheet" href="./Css/checkout.css" />
    <link rel="stylesheet" href="./fontawesome-free-5.13.0-web/css/all.css">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>

    <script src="./Js/checkout.js"></script>
</head>
<body>
  <div class="page page-container" id="blur">
		<div class="content-wrap">
      <div class="container middle">
        <div class="row justify-content-center">
          <div class="col">
            <div class="card shadow-lg black">
              <div class="row justify-content-between mx-auto">
                <div class="col" style="padding: 0;">
                  <div class="row justify-content-start ">
                    <div class="col">
                      <img class="irc_mi img-fluid cursor-pointer " src="./Images/Logo7.png" >
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mx-auto justify-content-center text-center">
                <div class="col-12 mt-3 ">
                  <nav aria-label="breadcrumb" class="second ">
                    <ol class="breadcrumb indigo lighten-6 first  ">
                      <li class="breadcrumb-item font-weight-bold"><a class="wht-txt text-uppercase " href="componente.php"><span class="mr-md-3 mr-1">Shop</span></a><i class="fa fa-angle-double-right " aria-hidden="true"></i></li>
                      <li class="breadcrumb-item font-weight-bold"><a class="wht-txt text-uppercase" href="carrello.php"><span class="mr-md-3 mr-1">Carrello</span></a><i class="fa fa-angle-double-right text-uppercase " aria-hidden="true"></i></li>
                      <li class="breadcrumb-item font-weight-bold"><a class="wht-txt text-uppercase active-2" href="#"><span class="mr-md-3 mr-1">Checkout</span></a></li>
                    </ol>
                  </nav>
                </div>
              </div>
              <div class="row justify-content-around">
                <div class="col-6">
                  <div class="card border-0">
                    <div class="card-header pb-0">
                      <h2 class="card-title">Checkout</h2>
                      <h6 class="text-title mt-4">Dettagli spedizione</h6>
                    </div>
                    <div class="card-body">
                      <div class="">
                        <div class="col-auto riepilo-inf">
                          <p class="riep-title">Nome: 
                            <span class="riep-text"><?php if(isset($utente)){ echo($utente[0]);}?></span>
                          </p>
                        </div>
                        <div class="col-auto riepilo-inf">
                          <p class="riep-title">Cognome: 
                            <span class="riep-text"><?php if(isset($utente)){ echo($utente[1]);}?></span>
                          </p>
                        </div>
                        <div class="col-auto riepilo-inf">
                          <p class="riep-title">Indirizzo: 
                            <span class="riep-text"><?php if(isset($utente)){ echo($utente[2]);}?></span>
                          </p>
                        </div>
                      </div>
                      <div class="row mt-20px">
                        <div class="col">
                          <h6 class="text-title">Metodo di pagamento</h6>
                        </div>
                      </div>
                      <div style="padding-left: 10px;">
                        <div class="form-group">
                          <label for="Nome" class="text-muted mb-1 pag">Intestatario</label>
                          <input type="text" name="check_int" id="check_int" class="form-control input-lg" placeholder="Mario Rossi" onkeyup="controllo_num(), valida_bottone()">
                          <div id="inv_int" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                          <label for="Numero carta" class="text-muted mb-1 pag">Numero carta</label>
                          <input type="text" name="check_num" id="check_num" class="form-control input-lg" placeholder="4534 5555 5555 5555 "onkeyup="controllo_num(), valida_bottone()">
                          <div id="inv_num" class="invalid-feedback"></div>
                        </div>
                        <div class="row no-gutters">
                          <div class="col-sm-6 pr-sm-2">
                            <div class="form-group">
                              <label for="Scadenza" class="text-muted mb-1 pag">Scadenza</label>
                              <input type="text" name="check_scad" id="check_scad" class="form-control input-lg" placeholder="06/21" onkeyup="controllo_scad(), valida_bottone()">
                              <div id="inv_scad" class="invalid-feedback"></div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="Codice cvv" class="text-muted mb-1 pag">Codice CVV</label>
                              <input type="text" name="check_cvv" id="check_cvv" class="form-control input-lg" placeholder="183" onkeyup="controllo_cvv(), valida_bottone()">
                              <div id="inv_cvv" class="invalid-feedback"></div>
                            </div>
                          </div>
                        </div>
                        <div class="row mb-20px" style="margin-top: 13px;">
                          <div class="col-md-4">
                            <button class="glow-on-hover2 btn btn-block" type="button" id="annulla" onclick="history.go(-1);return true;"><i class="far fa-times-circle"></i> Annulla</button>
                          </div>
                          <div class="col-md-8">
                            <button  class="glow-on-hover3 btn btn-block" type="button" id="conf_ordi" onclick="toggle()" name="<?php if(isset($prezzo)){ echo($prezzo);}?>"><i class="far fa-check-circle"></i> Conferma ordine </button>
                          </div>
                        </div>
                      </div>  
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="card border-0 ">
                    <div class="card-header card-2">
                      <h6 class="text-title" style="margin-top: 39px;">Il mio ordine</h6>
                    </div>
                    <div class="card-body pt-0">
                      <?php
                      if(isset($output))
                        echo ($output);
                      ?>
                      <div class="row ">
                        <div class="col">
                          <div class="row row-mg0 justify-content-between">
                            <div class="col-4 tot"><p class="tot">Totale</p></div>
                            <div class="flex-sm-col col-auto"><p class="mb-1 tot"><?php if(isset($prezzo)){ echo(number_format($prezzo, 2));}?> €</p></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 order-md-2 col-rules" id="popup">
    <div class="row no-gutters">
      <div class="col">
        <div class="form-group">
          <label for="Scadenza" class="text-muted mb-1 pag" style="font-size: 23px;">Inserisci la password di accesso:</label>
          <input type="password" class="form-control input-lg">
        </div>
      </div>
    </div>
    <div class="mb-3">
    <button  class="glow-on-hover3 btn btn-block" type="button" id="conf_ordi" onclick="toggle()"><i class="far fa-check-circle"></i> Conferma</button>
    </div>
  </div>
</body>
</html>