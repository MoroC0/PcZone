<?php
  //connessione
  include("connect.php");
  //Avvio la sessione
	session_start();
	
	if(isset($_SESSION['user']) && $_SESSION['user']=="admin"){
    $output="";
    $user = $_SESSION['user'];
    $_SESSION['ticket_id']=0;
    
    //eseguire una query per vedere tutti i ticket crati
    
	  $q1 = "SELECT Ticket.id, Ticket.data_ticket, Ticket.stato, Ticket.Titolo, Ticket.testo, Utente.nickname
           FROM Ticket Join Utente on Ticket.cod_utente = Utente.id "; 
    $ret=(pg_query($dbconn, $q1));
    
		while($row = pg_fetch_row($ret)){
      $output.="<div class='row ticket-row'>
                  <div class='col-20 ticket-row-text num'>
                    <span class='ticket-table-row-text'>$row[0]</span>
                  </div>
                  <div class='col-20 ticket-row-text'>
                    <span class='ticket-table-row-text' id='$row[2]'>$row[2]</span>
                  </div>
                  <div class='col-20 ticket-row-text'>
                    <span class='ticket-table-row-text'>$row[5]</span>
                  </div>
                  <div class='col-20 ticket-row-text ogg'>
                    <span class='ticket-table-row-text'>$row[3]</span>
                  </div>
                  <div class='col-20 ticket-row-text'>
                  <a id='invia-$row[0]' ><button class='glow-on-hover3 btn btn-block mt-12px' title='Modifica ticket' onclick='Apri_pagina($row[0])'><i class='fas fa-solid fa-pen'></i> MODIFICA TICKET</button></a>
                  </div>
                </div>"; 
    }
  }
  else{
		$errore="NON POTRESTI ESSERE QUI! Torna alla home";
	}
?>

<html>
<head>
  <title>Pc Zone Tutti Ticket</title>
  <meta name="viewport" content="width-device-width, initial-scale=1"/>

  <!--Link per gli stili compreso bootstrap-->
  
  <link rel="stylesheet" type="text/css" href= "./Css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="./Css/style.css" />
  <link rel="stylesheet" href="./fontawesome-free-5.13.0-web/css/all.css">

  <link rel="stylesheet" type="text/css" href= "./Css/ticket.css" />

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
  <script src="./Js/all_ticket.js" type="text/javascript"></script>

</head>
<body class="body_t">       
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
                            <a class="glow-on-hover btn btn" href="registrazione.html" >Registrati</a>
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
                <a class="navbar-brand nav-brd" href="carrello.php" title="Vai al carrello">
                  <i class="fas fa-shopping-cart fa-1x"></i> Carrello 
                  <input type="button" id="total_items" class="total_items" value="<?php if(isset($_SESSION["n_ogg_carr"])){ echo($_SESSION["n_ogg_carr"]);}?>">
                </a>
              </div>
            </nav>
          </div>
        </div>
      </header>
      <!--Fine header-->    
                        
    
      <!--Div per la parte centrale-->
      <div class="container middle">
        <!--<div class="h1_config">
          <h1 class='text-middle-top'>I tuoi ordini</h1>
          <h1 style="color: red; text-align:center"> 
            <?php 
              if(isset($errore)){
                echo($errore);
                header("refresh:1.5; url=home.php");
              }
            ?>
          </h1>
        </div>-->
        <div class="select_title_form">
          <h2 class="text-middle-bottom">Tutti ticket</h2>
        </div>
        <div class="select_form"> 
          <div class="row ticket-table">
            <div class="col-20 ticket-table-name num">
              <span class="ticket-table-title"># ticket</span>
            </div>
            <div class="col-20 ticket-table-name">
              <span class="ticket-table-title">Stato</span>
            </div>
            <div class="col-20 ticket-table-name">
              <span class="ticket-table-title">Nickname cliente</span>
            </div>
            <div class="col-20 ticket-table-name ogg">
              <span class="ticket-table-title">Oggetto</span>
            </div>
            <div class="col-20 ticket-table-name">
              <span class="ticket-table-title">Aggiorna</span>
            </div>
          </div>
          <div class="ris">
            <?php
              if(isset($output)){
                echo($output);
              }
            ?>
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