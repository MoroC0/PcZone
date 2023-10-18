<?php
  //connessione
  include("connect.php");
  //Avvio la sessione
  session_start();

  //Resetto la variabile di sessione dell'utente old_index
  unset($_SESSION['old_index']);
  $_SESSION['old_index']='';

  //$componente tiene traccia dello step del configuratore
  $componente = 'Cpu';

  //Salvo l'id dei componenti selezionati
  $_SESSION['arrayid'] = '';
?>

<html>
<head></head>
  <title>PC Zone Configuratore</title>

  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  
  <link rel="stylesheet" type="text/css" href= "./Css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="./Css/style.css" />
  <link rel="stylesheet" type="text/css" href= "./Css/config.css" />
  <link rel="stylesheet" href="./fontawesome-free-5.13.0-web/css/all.css">
  
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
  <script src="./Js/configuratore.js" type="text/javascript"></script>
</head>
<body class="body_t">	<!--CONFIGURATORE-->
  <div style="min-height: 100vh; position: relative;">
  
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
                <a class="navbar-brand nav-brd" href="carrello.php" title="Vai al carrello"><i class="fas fa-shopping-cart fa-1x"></i> Carrello <input type="button" id="total_items" class="total_items" value="<?php if(isset($_SESSION["n_ogg_carr"])){ echo($_SESSION["n_ogg_carr"]);}?>"></a>
              </div>
            </nav>
          </div>
        </div>
      </header>
      <!--Fine header-->

    <!--Div per la parte centrale-->
    <div class="container middle">
      <div class="title-center">
        <h2 class="text-middle-top">Configuratore</h2>
      </div>
      <div class="main-container">
        <div class="timeline"> <!--Div che contiene la timeline che tiene conto degli step-->
          <div class="white_timeline"></div> <!--Timeline bianca-->
          <div class="color_timeline" id="color_timeline"></div> <!--Timeline colorata che viene incrementata a ogni passo-->
          <div class="timeline_colored_circle" id="circle-0" style="margin-left: 0px;"> <!--Cerchio che contiene le immagini dei vari tipi di componenti-->
            <img src="./icone/chip.png" >
          </div>
          <div class="timeline_circle" id="circle-1">
            <img src="./icone/motherboard.png" >
          </div>
          <div class="timeline_circle" id="circle-2">
            <img src="./icone/ram.png" >
          </div>
          <div class="timeline_circle" id="circle-3">
            <img src="./icone/graphics-card.png">
          </div>
          <div class="timeline_circle" id="circle-4">
            <img src="./icone/ssd-card.png">
          </div>
          <div class="timeline_circle" id="circle-5">
            <img src="./icone/cooling-fan.png">
          </div>
          <div class="timeline_circle" id="circle-6">
            <img src="./icone/power-supply.png">
          </div>
          <div class="timeline_circle" id="circle-7" style="margin-right: 0px;">
            <img src="./icone/computer-case.png" >
          </div>
        </div>
        
        <form class="select_form_config">
          <!--<div class="select_title_form">
            <span> Scegli un componente </span>
          </div> -->
          
          <!--Div creato da ajax per mostrare i vari componenti del passo corrispondente-->
          <section id="ris" class="select_component">
            <!-- risultati della query -->
          </section>
        </form>

        <!--Div per il tasto assembly-->
        <div class="assembly_form">
          <div class="row">
            <div class="col"></div>
            <div class="col">
              <a id="link-pagina" >
                <button class="btn btn-lg btn-warning btn-block glow-on-hover" id="assemblyBtn" type="submit" style="display:none;" onclick="assembly()" disabled> Assembla </button> 
              </a>
            </div>
            <div class="col"></div>
          </div>

          <br clear="all">
        </div>
      </div>
      <!--<footer class="footer"> <!--Div per footer
        <div class="container">
          <span class="text-muted">HTML Project</span>
          <br>
          <span class="text-muted">Created by Fabio Sestito & Leonardo Morocutti</span>
        </div>
      </footer>-->
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