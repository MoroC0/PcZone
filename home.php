<?php
  //connessione
  include("connect.php");
  //Avvio la sessione
  session_start();

  //Query per prendere l'id e il prezzo dalle configurazioni
  $query = "SELECT id, prezzo FROM configurazione";
  $titolo='';
  $img='';
  $link='';
  $i = 7;
  $output= '';
  if(!isset($_SESSION["n_ogg_carr"]))
    $_SESSION["n_ogg_carr"]=0;

  //Invio la query per prendere le configurazioni dell'utente
  $ret=(pg_query($dbconn, $query));
    
  //While per creare i div delle configurazioni da mostrare nella pagina home
  while(($row = pg_fetch_row($ret)) && $i>=0 ){
    $titolo='';
    $img='';
    $link='';
    $prezzo = $row[1];

    //Query per prendere le informazioni dei componenti della configurazione
    $q3 = "SELECT componente.titolo, componente.immagine, componente.id FROM (configurazione JOIN conf_comp ON configurazione.id = conf_comp.cod_conf AND Configurazione.id = $row[0])
    JOIN componente on componente.id=conf_comp.cod_comp";
    $ret2 = pg_query($dbconn, $q3); 
    $n=0;
    while($row3 = pg_fetch_row($ret2)){
      if($n == 0 || $n == 2 || $n == 3){
        $titolo .= "$row3[0] - ";
      }
      else{
        if( $n == 4){
          $titolo .= "$row3[0] ...";
        }
      }
      $link .= "$row3[2],";
      if($n == 1){
        $img = $row3[1];
      }
      $n++;
    }
    $id = explode(',', $link);
    $output.= " <div class='owl-item'>
                    <div class='card'>
                      <a href='config_compl.php?cpu=$id[0]&mobo=$id[7]&ram=$id[3]&gpu=$id[4]&ssd=$id[2]&cooler=$id[5]&psu=$id[6]&case=$id[1]'>
                        <img class='imgg card-img-top' src='$img'>
                        <div class='card-body conf'>
                          <div class='text-nome conf'> $titolo </div>
                        </div>
                        <div class='pt-3'>
                          <div class='text-prezzo'> $prezzo €</div>
                        </div>
                      </a>
                    </div>
                  </div>";
    $i--;

  }
?>

<html>
<head>
  <title>Pc Zone Home</title>
  <meta name="viewport" content="width-device-width, initial-scale=1"/>
  
  <link rel="stylesheet" type="text/css" href= "./Css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="./Css/style.css" />
  <link rel="stylesheet" type="text/css" href="./Css/home.css" />
  <link rel="stylesheet" href="./fontawesome-free-5.13.0-web/css/all.css">

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="http://code.jquery.com/jquery-latest.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>
  
  <script src="./Js/home.js"> </script>
</head>
<body>       <!--HOME-->
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
                            <a class="glow-on-hover btn" href="registrazione.php" >Registrati</a>
                            <a class="glow-on-hover btn" href="login.php">Accedi</a>
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

      <!-- Div per le news -->
      <div class="container mt-40px">
        <div id="mycarousel" class="carousel slide" data-ride="carousel" data-interval="10000">
          <ol class="carousel-indicators mb-0">
            <li data-target="#mycarousel" data-slide-to="0"  class="active"></li>
            <li data-target="#mycarousel" data-slide-to="1"></li>
            <li data-target="#mycarousel" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner brd-rd">
            <div class="carousel-item active">
              <img src="Images/intel_13gen2.jpg" class="d-block">
              <div class="carousel-caption desc-carousel">
                <h5>Intel</h5>
                <p>Nuovi processori intel di 13th generazione</p>
              </div>
              <div style="position: absolute; right: 50px; bottom: 20px; z-index: 20;">
                <a class="glow-on-hover btn btn" href="">Compra ora</a>
                <a class="glow-on-hover btn btn" href="">Configura</a>
              </div>
            </div>
            <div class="carousel-item">
              <img src="Images/nvidia-rtx40-2.jpg" class="d-block">
              <div class="carousel-caption desc-carousel">
                <h5>Nvidia</h5>
                <p>Nuove schede video NVidia serie 40</p> 
              </div>
              <div style="position: absolute; right: 50px; bottom: 20px; z-index: 20;">
                <a class="glow-on-hover btn btn" href="">Compra ora</a>
                <a class="glow-on-hover btn btn" href="">Configura</a>
              </div>
            </div>
            <div class="carousel-item">
              <img src="Images/rtx2.jpg" class="d-block">
              <div class="carousel-caption desc-carousel">
                <h5>Nvidia</h5>
                <p>Nuove schede video NVidia serie 30</p> 
              </div>
              <div style="position: absolute; right: 50px; bottom: 20px; z-index: 20;">
                <a class="glow-on-hover btn btn" href="">Compra ora</a>
                <a class="glow-on-hover btn btn" href="">Configura</a>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#mycarousel" role="button" data-slide="prev">
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#mycarousel" role="button" data-slide="next">
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>

      <!--Div per la parte centrale-->
      <div class="container middle mt-40px">
        <div class="select_form">
          <!--div per i piu acquistati-->
          <div class="row">
            <div class="col">
              <div class="title-div"> I PIÚ ACQUISTATI: </div>
              <div class="left-icon-prev prev1 banner-icons"><i class="fas fa-angle-double-left"></i></div>
              <div class="right-icon-next next1 banner-icons"><i class="fas fa-angle-double-right"></i></div>
              <div class="container-slaider">
                <div class="owl-carousel owl-theme item_viewed_slider1"> 
                  <div class="owl-item">
                    <div class="card">
                      <a href="desc_componente.php?id=20&tipo=Cpu">
                        <img class="imgg card-img-top" src="Images/componenti/cpu/amd/7-3700x.png">
                        <div class="card-body">
                          <div class="text-nome">Ryzen 7 3700x </div>
                        </div>
                        <div class="pt-3">
                          <div class="text-prezzo"> 316.98 €</div>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="owl-item">
                    <div class="card">
                      <a href="desc_componente.php?id=54&tipo=Ssd">
                        <img class="imgg card-img-top" src="Images/componenti/ssd/2.5/crucial-mx500-500g.png">
                        <div class="card-body">
                          <div class="text-nome">SSD MX 500 500GB </div>
                        </div>
                        <div class="pt-3">
                          <div class="text-prezzo"> 70.97 €</div>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="owl-item">
                    <div class="card">
                      <a href="desc_componente.php?id=69&tipo=Ram">
                        <img class="imgg card-img-top" src="Images/componenti/ram/corsair-dominator-platinum-3200MHz-2x16.png">
                        <div class="card-body">
                          <div class="text-nome">Dominator Platinum 2x16GB </div>
                        </div>
                        <div class="pt-3">
                          <div class="text-prezzo"> 247.24 €</div>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="owl-item">
                    <div class="card">
                      <a href="desc_componente.php?id=78&tipo=Gpu">
                        <img class="imgg card-img-top" src="Images/componenti/gpu/nvidia/msi-1060-6g.png">
                        <div class="card-body">
                          <div class="text-nome">Nvidia GTX 1060 </div>
                        </div>
                        <div class="pt-3">
                          <div class="text-prezzo"> 279.99 €</div>
                        </div>
                      </a>
                    </div>
                  </div>    
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="select_form">
          <!--div per le configurazioni-->
          <div class="row">
            <div class="col">
              <div class="title-div">MIGLIORI CONFIGURAZIONI: </div>
              <div class="left-icon-prev prev2 banner-icons"><i class="fas fa-angle-double-left"></i></div>
              <div class="right-icon-next next2 banner-icons"><i class="fas fa-angle-double-right"></i></div>
              <div class="container-slaider">
                <div class="owl-carousel owl-theme item_viewed_slider2"> 
                  <?php 
                    echo($output);
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <div class="container row newsletters">
        <div class="col-sm-6">
          <div class="news-head pull-left">
            <h2>Iscrivi per i nuovi arrivi!</h2>
            <div class="new-desc">Iscriviti alla newsletter per ricevere le ultime novità e molto altro!</div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="news-form pull-right">
            <form onsubmit="return validatemail();" method="post">
              <div class="form-group required">
                <input name="email" id="email" placeholder="Inserisci la tua Email" class="form-control input-lg email" required="" type="email">
                <button type="submit" class="glow-on-hover4 btn btn-email"><i class="fas fa-paper-plane" ></i> Iscriviti</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="container row icone">
        <div class="col-3">
          <div class="feature-i-left ptb_30 cms-icon">
            <div class="icon-right Shipping"></div>
            <h6>Spedizione gratuita</h6>
          </div>
        </div>
        <div class="col-3">
          <div class="feature-i-left ptb_30 cms-icon">
            <div class="icon-right Order"></div>
            <h6>Supporto h24</h6>
          </div>
        </div>
        <div class="col-3">
          <div class="feature-i-left ptb_30 cms-icon">
            <div class="icon-right Save"></div>
            <h6>Compra e risparmia</h6>
          </div>
        </div>
        <div class="col-3">
          <div class="feature-i-left ptb_30 cms-icon">
            <div class="icon-right Safe"></div>
            <h6>Shopping sicuro</h6>
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