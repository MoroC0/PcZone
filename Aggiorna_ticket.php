<?php
  //connessione
  include('connect.php');
  //sessione
  session_start();
  
  if(isset($_SESSION['user']) && $_SESSION['user']=="admin"){
    //prendo l'id del ticket 
    if(isset($_GET['Ticket_id'])){
      $ticket_id=$_GET['Ticket_id'];
      //faccio la query per prendermi i dati del ticket e dell'utente
      $query="SELECT Ticket.titolo, Ticket.id, Utente.nome, Utente.cognome, Utente.nickname, Utente.email, Utente.telefono, Utente.indirizzo, Ticket.data_ticket, Ticket.tipologia 
              FROM Ticket JOIN Utente ON Ticket.cod_utente = Utente.id 
              WHERE Ticket.id = $ticket_id";
      $row = pg_fetch_row(pg_query($dbconn, $query));
      $data= date_format(date_create($row[8]), 'd-m-Y');
    }
  }
  //controllo se provi ad accedere alla pagina senza essere admin
  else{
    $output='Non hai i diritti per essere qui! torna alla home!';
  }
?>

<html>
<head>
  <title>Pc Zone Aggiorna Ticket</title>

  <meta name="viewport" content="width=device−width , initial−scale=1"/>
  
  <link rel="stylesheet" type="text/css" href= "./Css/bootstrap.min.css" />
  <link rel="stylesheet" href="./fontawesome-free-5.13.0-web/css/all.css">
  <link rel="stylesheet" href="./Css/style.css" />

  <link rel="stylesheet" href="./Css/aggiorna_ticket.css" />

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="http://code.jquery.com/jquery-latest.js"></script>

  <link rel="stylesheet" href="./Css/dett_ticket.css" />
  <script>
    function invia(id){
      document.getElementById("reply-form").setAttribute("action", 'reply_email.php?Ticket_id='+id);
    }; 
  </script>
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
      <div class="container middle">
        <!-- h1 per Errore  -->
        <h1 style='font-size: 40px; color: red'>
          <?php 
            if(isset($errore)){
              echo($errore);
              header("refresh:1.5; url=home.php");
            }
          ?>
        </h1>
        <div class="select_title_form">
          <h2 class="text-middle-bottom">Dettagli ticket</h2>
        </div>
        <div class="cont-info background-card">
          <div class='row spazio'> 
            <div class='col-md-4 to-left'> 
              <p class="title-ord">TICKET #<span><?php if(isset($row)){ echo($row[1]);}?></span></p>
            </div>
            <div class='col-md-8 to-right'> 
              <p class="title-ord">Nickname utente: <span><?php if(isset($row)){ echo($row[4]);}?></span></p>
            </div>
          </div>
          <div class="row info">
            <div class="col-7 brd" style="margin-right: 49px;">
              <h3 class="mb-3" style="text-align: left;">
                <span class="ticket-information">Informazioni ticket</span>
              </h3>
              <form id="request-form" class="needs-validation">
                <div class="mb-4 pdlf-10px">
                  <h4 class="riep-title ticket">Data creazione: 
                    <span  class="riep-text ticket"> <?php if(isset($data)){ echo $data;} ?> </span>
                  </h4>
                </div>
                <div class="mb-4 pdlf-10px">
                  <h4 class="riep-title ticket">Tipologia: 
                    <span  class="riep-text ticket"> <?php if(isset($row)){ echo $row[9];} ?> </span>
                  </h4>
                </div>
                <div class="mb-4 pdlf-10px">
                  <div class="form-label-group margin-label">
                    <h4 class="riep-title ticket">Oggetto: 
                      <span  class="riep-text ticket"><?php if(isset($row)){ echo($row[0]);}?></span>
                    </h4>
                  </div>
                </div>
                <form id="reply-form" class="needs-validation" method="POST">
                  <div class="mb-12px pdlf-10px">
                    <div class="form-label-group">
                      <h4 class="riep-title ticket">Risposta: </h4>
                        <textarea id="testo" name="testo" class="form-control input-lg" style="height: 100px;">
                        </textarea>
                    </div>
                  </div>
                  <div class="mb-4 pdlf-10px">
                    <h4 class="title">Stato</h4>
                    <div class="d-flex">
                      <label for="Accettato" class="radio"><input type="radio" id="Accettato" name="stato" value="Accettato"><span> Accettato </span></label>
                      <label for="Completato" class="radio"><input type="radio" id="Completato" name="stato" value="Completato"><span> Completato </span></label>
                    </div>
                  </div>
                  <a id='invia'><button class="glow-on-hover3 btn btn-block mt-12px" title='Invia risposta' onclick='invia(<?php if(isset($row)){ echo($row[1]);}?>)'><i class='fas fa-solid fa-pen'></i> Invia risposta</button>
                </form>
              </form>
            </div>
            <div class="brd">
              <h3 class="mb-3" style="text-align: center;">
                <span style="color: gold; text-transform:uppercase;">Informazioni del cliente</span>
              </h3>
              <div class="riep">
                <p class="riep-title">Nome: 
                  <span class="riep-text"><?php if(isset($row)){ echo($row[2]);}?></span>
                </p>
              </div>
              <div class="riep">
                <p class="riep-title">Cognome: 
                  <span class="riep-text"><?php if(isset($row)){ echo($row[3]);}?></span>
                </p>
              </div>
              <div class="riep">
                <p class="riep-title">E-mail: 
                  <span class="riep-text"><?php if(isset($row)){ echo($row[5]);}?></span>
                </p>
              </div>
              <div class="riep">
                <p class="riep-title">Telefono: 
                  <span class="riep-text"><?php if(isset($row)){ echo($row[6]);}?></span>
                </p>
              </div>
              <div class="riep">
                <p class="riep-title">Indirizzo: 
                  <span class="riep-text"><?php if(isset($row)){ echo($row[7]);}?></span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class="container row" style="margin: auto;">
        <div class="col-md-4 footer-block">
          <h6 class="footer-title ptb_20">Informazioni</h6>
          <ul>
            <li><a href="#">Su di noi</a></li>
            <li><a href="#">Informazioni di consegna</a></li>
            <li><a href="#">Privacy policy</a></li>
            <li><a href="#">Termini &amp; Condizioni</a></li>
          </ul>
        </div>
        <div class="col-md-4 footer-block">
          <h6 class="footer-title ptb_20">Servizi</h6>
          <ul>
            <li><a href="#">Il mio account</a></li>
            <li><a href="#">Cronologia ordini</a></li>
            <li><a href="#">Configurazioni salvate</a></li>
            <li><a href="#">Cronologia ticket</a></li>
          </ul>
        </div>
        <div class="col-md-4 footer-block">
          <h6 class="footer-title ptb_20">Contatti</h6>
          <ul>
            <li>Ecommerce &amp; configuratore,</li>
            <li>(+039) 06 86 666 888</li>
            <li>pczone@pczone.com</li>
            <li><a href="#">www.pczone.it</a></li>
          </ul>
        </div>
      </div>
    </footer> 
  </div>
</body>
</html>