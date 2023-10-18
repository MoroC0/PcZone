<?php
  //connessione
  include('connect.php');
  //sessione
  session_start();
  
  if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    //Prendo l'id dell'utente in sessione
    $query = "SELECT * FROM Utente WHERE Utente.nickname = '$user'";
    $row = pg_fetch_row(pg_query($dbconn, $query));
  }
  //controllo se provi ad accedere alla pagina senza essere un utente loggato
  else{
    $output='Non potresti essere qui! torna alla home!';
  }
?>

<html>
<head>
  <title>Pc Zone Supporto</title>
  <meta name="viewport" content="width=device−width , initial−scale=1"/>
  
  <link rel="stylesheet" type="text/css" href= "./Css/bootstrap.min.css" />
  <link rel="stylesheet" href="./fontawesome-free-5.13.0-web/css/all.css">
  <link rel="stylesheet" href="./Css/style.css" />

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="http://code.jquery.com/jquery-latest.js"></script>

  <link rel="stylesheet" href="./Css/supp.css" />
</head>
<body>
  <div class="page-container">
		<div class="content-wrap">
      <!--Div per la parte superiore-->
      <header>
        <div class="header">
          <div class="container">
            <div class="row">
              <!-- Search bar -->
              <div class="col-4">
                <form class="main-search" action="componente.php" method="POST">
                 <input type="text" id="cerca" name="cerca" placeholder="Cerca qui" class="form-control input-lg" autocomplete="off" >
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-default btn-lg"><i class="fa fa-search" style="color: white;"></i></button>
                  </span> 
                </form> 
              </div>
              <!-- Logo -->
              <div class="navbar-header col-4" style="text-align:center">
                <a href="home.php" class="navbar-brand img-ctr">
                  <img src="Images/logo7.png">
                </a>
              </div>
              <!-- Account -->
              <div class="col-4">
                <div class="cont-btn-nick"> 
                  <div class="navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                      <?php
                        if(!isset($_SESSION["user"])){
                          echo '
                          <form class="form-inline mb-0">
                            <a class="glow-on-hover btn btn" href="registrazione.html">Registrati</a>
                            <a class="glow-on-hover btn btn" href="login.php">Accedi</a>
                          </form>
                          ';
                        }
                        else{
                          $user=$_SESSION['user'];
                          echo " 
                          <li class='nav-item dropdown'>
                            <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' style='color:gold;'>
                              $user
                            </a>
                            <div class='dropdown-menu dropdown-menu-right animate slideIn' aria-labelledby='navbarDropdown'>
                              <a class='dropdown-item' href='user.php'>Il mio account</a>
                              <a class='dropdown-item' href='mie_config.php'>Le mie configurazioni</a>
                              <a class='dropdown-item' href='mie_ordini.php'>I miei ordini</a>
                              <a class='dropdown-item' href='my_ticket.php'>I miei ticket</a>
                              <div class='dropdown-divider'></div>
                              <a class='dropdown-item' href='logout.php'>Disconnetti</a>
                            </div>
                          </li>
                          ";
                        }
                      ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!-- Menu -->
            <nav class="navbar navbar-expand-lg navbar-light brd-btnn">
              <div class="container ctnr">
                <a class="navbar-brand nav-brd" href="home.php" title="Vai alla Home" >Home</a>
                <a class="navbar-brand nav-brd" href="sel_componente.php" title="Vai ai componenti">Shop</a>
                <a class="navbar-brand nav-brd" href="configuratore.php" title="Vai al Configuratore">Configuratore</a>
                <a class="navbar-brand nav-brd" href="supporto.php" title="Via al Supporto">Supporto</a>
                <a class="navbar-brand nav-brd" href="carrello.php" title="Vai al carrello"><i class="fas fa-shopping-cart fa-1x"></i> Carrello <input type="button" id="total_items" class="total_items" value="<?php if(isset($_SESSION["n_ogg_carr"])){ echo($_SESSION["n_ogg_carr"]);}?>"></a>
              </div>
            </nav>
          </div>
        </div>
      </header>
      <!--Fine header-->
      <!-- Inzio parte centrale -->
      <div class="container middle">
        <!-- h1 per Errore  -->
        <h1 style='font-size: 40px; color: red'>
          <?php 
            if(isset($output)){
              echo($output);
              header("refresh:1.5; url=home.php");
            }
          ?>
        </h1>
        <div class="title-centr">
          <h2 class="text-middle-top">Contattaci</h2>
          <p class="text-help">Se hai bisogno di aiuto per creare la tua configurazione o ti serve assistenza, non esitare a contattarci </p>
        </div>
        <div class="row cont-info">
          <div class="col background-card">
            <h3 class="mb-3" style="color: white; text-transform:uppercase; font-size:33px;">Compila i seguenti campi: </h3>
            <form id="request-form" class="needs-validation" action="send_email.php" method="POST">
              <div class="mb-4 pdlf-10px">
                <h4 class="title">Tipologia</h4>
                <div class="d-flex">
                  <label for="configuratore" class="radio"><input type="radio" id="configuratore" name="tipologia" value="configuratore"><span> Configuratore </span></label>
                  <label for="ordine" class="radio"><input type="radio" id="ordine" name="tipologia" value="ordine"><span> Ordine </span></label>
                  <label for="generale" class="radio"><input type="radio" id="generale" name="tipologia" value="generale"> <span>Generale </span></label>
                </div>
              </div>
              <div class="mb-4 pdlf-10px">
                <div class="form-label-group margin-label">
                  <h4 class="title">Oggetto </h4>
                  <input type="text" id="titolo" name="titolo" class="form-control input-lg">
                </div>
              </div>
              <div class="mb-12px pdlf-10px">
                <div class="form-label-group">
                  <h4 class="title">Testo </h4>
                    <textarea id="testo" name="testo" class="form-control input-lg">
                    </textarea>
                </div>
              </div>
              <button type="submit" class="glow-on-hover3 btn btn-block mt-12px" ><i class="fa fa-envelope-open"></i> Invia richiesta</button>
            </form>
          </div>
          <!--<div class="col">
            <img src="icone/support.png" alt="IMG" style="width: 100%; padding-top:103px;">	
          </div>-->
          <div class="col-riep background-card">
            <h3 class="d-flex mb-3">
              <span style="color: gold; text-transform:uppercase;">Riepilogo informazioni </span>
            </h3>
            <div class="riep">
              <p class="riep-title">Nome: 
                <span class="riep-text"><?php if(isset($row)){ echo($row[1]);}?></span>
              </p>
            </div>
            <div class="riep">
              <p class="riep-title">Cognome: 
                <span class="riep-text"><?php if(isset($row)){ echo($row[2]);}?></span>
              </p>
            </div>
            <div class="riep">
              <p class="riep-title">E-mail: 
                <span class="riep-text"><?php if(isset($row)){ echo($row[6]);}?></span>
              </p>
            </div>
            <div class="riep">
              <p class="riep-title">Telefono: 
                <span class="riep-text"><?php if(isset($row)){ echo($row[4]);}?></span>
              </p>
            </div>
            <div class="riep">
              <p class="riep-title">Indirizzo: 
                <span class="riep-text"><?php if(isset($row)){ echo($row[3]);}?></span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>