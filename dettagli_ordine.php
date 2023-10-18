<?php
  //connessione
  include("connect.php");
  //Avvio la sessione
	session_start();
	
	if(isset($_SESSION['user'])){
    $output="";
    $user = $_SESSION['user'];	
        
    //devo prendere con get numero l'id dell'ordine e poi eseguo la query per prendermi i dati 
    if(isset($_GET['numero'])){
      $numero = $_GET['numero'];

      $query1 = "SELECT prezzo, pagamento, stato FROM ordine WHERE id=$numero";
      $row1 = pg_fetch_row(pg_query($dbconn, $query1));

      $totale = $row1[0];
      $pagamento = $row1[1];
      $stato = $row1[2];

      $query2 = "SELECT componente.nome, componente.immagine, componente.id, componente.categoria, componente.prezzo FROM (ordine JOIN ord_comp ON ordine.id = ord_comp.cod_ord AND ordine.id = $numero)
                  JOIN componente on componente.id = ord_comp.cod_comp";

      $ret = pg_query($dbconn, $query2);

      while($row2 = pg_fetch_row($ret)){
        $output.= "<div class='row col-container cont-comp'>
                      <div class='col-3 text-center'>
                        <a href='desc_componente.php?id=$row2[2]&tipo=$row2[3]'>
                          <img src='$row2[1]' style='max-width: 100%; max-height: 100px; padding-right:60px;'>
                        </a>
                      </div>
                      <div class='col-6' style='align-self: center; text-align:center;'>
                        <a href='desc_componente.php?id=$row2[2]&tipo=$row2[3]' class='text-comp'> $row2[0]</a>
                      </div>
                      <div class='col-3' style='text-align:right; align-self:center; padding-right:42px;'>
                        <span class='text-comp'> ".number_format($row2[4], 2)." €</span>
                      </div>
                    </div>";
      }
    }
  }
  else{
		$errore="NON POTRESTI ESSERE QUI! Torna alla home";
	}
?>

<html>
<head>
  <title>Pc Zone Ordini</title>
  <meta name="viewport" content="width-device-width, initial-scale=1"/>

  <!--Link per gli stili compreso bootstrap-->
  
	<link rel="stylesheet" type="text/css" href= "./Css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="./Css/style.css" />
  <link rel="stylesheet" href="./fontawesome-free-5.13.0-web/css/all.css">
  <link rel="stylesheet" type="text/css" href= "./Css/dett_ordine.css" />

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

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
                            <a class="glow-on-hover btn" href="registrazione.html" >Registrati</a>
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
          <h2 class="text-middle-bottom">Dettagli ordine</h2>
        </div>
        <div class="select_form"> 
          <div class='row spazio'> 
            <div class='col-md-4 to-left'> 
              <p class="title-ord">ORDINE #<span><?php if(isset($numero)){ echo($numero);}?></span></p>
            </div>
            <div class='col-md-8 to-right'> 
              <p class="title-ord">STATO: <span id='<?php if(isset($stato)){ echo($stato);}?>'><?php if(isset($stato)){ echo($stato);}?></span></p>
            </div>
          </div>
          <div class="row postit">
            <?php
              if(isset($output)){
                echo($output);
              }
            ?>
          </div>
          <div class="row pagamento">
            <div class='col-6'> 
              <p class="linked paga">Pagamento: <span class="linked-text"><?php if(isset($pagamento)){ echo($pagamento);}?></span></p>
            </div>
            <div class='col-6'>
              <p class="linked prezzo" style="text-align: right;">Totale: <?php if(isset($totale)){ echo($totale);}?> €</p>
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