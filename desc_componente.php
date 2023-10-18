<?php
  //connessione
  include("connect.php");
  //Avvio la sessione
  session_start();
  if(isset($_GET['tipo']) && isset($_GET['id'])){
    $titolo=2;
    $brand=3;
    $descrizione=4;
    $quantita=11;
    $prezzo=6;
    $link=8;
    $type=$_GET['tipo'];
    $id=$_GET['id'];
    $query = "SELECT * FROM componente JOIN $type ON componente.id = $type.cod_comp WHERE $type.cod_comp = $id";
    $ret=pg_query($dbconn,$query);
    $output='';
    //Caratteristiche per ogni tipologia di componente
    $output_left='';
    //Dati delle caratteristiche
    $output_right='';
    while($row = pg_fetch_row($ret)){
      $output=$row;
    };
    switch ($type){
      case 'Cpu':
        $output_left='<p class="spex left">Generazione</p>
                      <p class="spex left">Socket</p>
                      <p class="spex left">Core</p>
                      <p class="spex left">Thread</p>
                      <p class="spex left">Frequenza Base</p>
                      <p class="spex left">Frequenza Max</p>
                      <p class="spex left">Tipologia Ram Supportata</p>
                      <p class="spex left">Quantitá Ram Supportata</p>
                      <p class="spex left">TDP</p>';
        $output_right="<p class='spex right'>$output[14]</p>
                      <p class='spex right'>$output[15]</p>
                      <p class='spex right'>$output[16]</p>
                      <p class='spex right'>$output[17]</p>
                      <p class='spex right'>$output[19] GHz</p>
                      <p class='spex right'>$output[18] GHz</p>
                      <p class='spex right'>$output[20]</p>
                      <p class='spex right'>$output[21]</p>
                      <p class='spex right'>$output[7] W </p>";
        break;
      case 'Gpu':
        $output_left='<p class="spex left">Serie</p>
                      <p class="spex left">Grandezza Vram</p>
                      <p class="spex left">Tipo Vram</p>
                      <p class="spex left">Frequenza media del core</p>
                      <p class="spex left">Frequenza media della ram</p>
                      <p class="spex left">Consumo</p>';
        $output_right="<p class='spex right'>$output[14]</p>
                      <p class='spex right'>$output[15]</p>
                      <p class='spex right'>$output[16]</p>
                      <p class='spex right'>$output[17]</p>
                      <p class='spex right'>$output[18]</p>
                      <p class='spex right'>$output[7] W </p>";
        break;
      case 'Mobo':
        $output_left='<p class="spex left">Grandezza Scheda</p>
                      <p class="spex left">Tipo Scheda</p>
                      <p class="spex left">Modello Socket</p>
                      <p class="spex left">Numero di banchi di ram</p>
                      <p class="spex left">Frequenza messima di ram supportata</p>
                      <p class="spex left">Numero di slot M2</p>
                      <p class="spex left">Numero di slot PCIe</p>
                      <p class="spex left">Numero di slot Sata</p>
                      <p class="spex left">Wi-Fi</p>';
        $output_right="<p class='spex right'>$output[13]</p>
                      <p class='spex right'>$output[14]</p>
                      <p class='spex right'>$output[15]</p>
                      <p class='spex right'>$output[16]</p>
                      <p class='spex right'>$output[17]</p>
                      <p class='spex right'>$output[18]</p>
                      <p class='spex right'>$output[19]</p>
                      <p class='spex right'>$output[20]</p>
                      <p class='spex right'>$output[21]</p>";
        break;
      case 'Ram':
        $output_left='<p class="spex left">Tipo</p>
                      <p class="spex left">Frequenza</p>
                      <p class="spex left">Dimensione totale</p>
                      <p class="spex left">Quantita di banchi</p>';
        $output_right="<p class='spex right'>$output[13]</p>
                      <p class='spex right'>$output[14]</p>
                      <p class='spex right'>$output[15]</p>
                      <p class='spex right'>$output[16]</p>";
        break;
      case 'Hdd':
        $output_left='<p class="spex left">Formato</p>
                      <p class="spex left">Capacitá</p>
                      <p class="spex left">Velocitá</p>
                      <p class="spex left">Interfaccia</p>';
        $output_right="<p class='spex right'>$output[13]</p>
                      <p class='spex right'>$output[14]</p>
                      <p class='spex right'>$output[15]</p>
                      <p class='spex right'>$output[16]</p>";
        break;
      case 'Ssd':
        $output_left='<p class="spex left">Formato</p>
                      <p class="spex left">Capacitá</p>
                      <p class="spex left">Velocitá Lettura - Scrittura</p>
                      <p class="spex left">Interfaccia</p>';
        $output_right="<p class='spex right'>$output[13]</p>
                      <p class='spex right'>$output[14]</p>
                      <p class='spex right'>$output[15]</p>
                      <p class='spex right'>$output[16]</p>";
        break;
      case 'Chassis':
        $output_left='<p class="spex left">Grandezza</p>
                      <p class="spex left">Dimesione Massima MotherBard</p>
                      <p class="spex left">Dimensioni</p>';
        $output_right="<p class='spex right'>$output[13]</p>
                      <p class='spex right'>$output[14]</p>
                      <p class='spex right'>$output[15]</p>";
        break;
      case 'Psu':
        $output_left='<p class="spex left">Tipologia</p>
                      <p class="spex left">Potenza</p>';
        $output_right="<p class='spex right'>$output[13]</p>
                        <p class='spex right'>$output[7] W</p>";
      break;
      case 'Cooler':
        $output_left='<p class="spex left">Tipologia</p>
                      <p class="spex left">Dimensione</p>
                      <p class="spex left">Socket</p>';
        $output_right="<p class='spex right'>$output[13]</p>
                      <p class='spex right'>$output[14]mm</p>
                      <p class='spex right'>$output[15]</p>";
      break;
    }
  }
  else{
    $errore="NON POTRESTI ESSERE QUI! Torna alla home";
  }
    
?>

<html>
<head>
  <title>Pc Zone Descrizione Componente</title>
  <meta name="viewport" content="width-device-width, initial-scale=1"/>

  <!--Link per gli stili compreso bootstrap-->
  
  <link rel="stylesheet" type="text/css" href= "./Css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="./Css/style.css" />
  <link rel="stylesheet" type="text/css" href="./Css/desc.css" />
  <link rel="stylesheet" href="./fontawesome-free-5.13.0-web/css/all.css">
  
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  
  <script src="./Js/carrello.js"> </script>
  
  <script> 
    function disabled(){
      document.getElementById("add_to_cart").disabled = true;
      document.getElementById("add_to_cart").setAttribute("title", "ARTICOLO ESAURITO!");
    }
  </script>
</head>
<body class="body_t">       <!--DESCRZIONE COMPONENTE-->
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
                <a class="navbar-brand nav-brd" href="carrello.php" title="Vai al carrello"><i class="fas fa-shopping-cart fa-1x"></i> Carrello <input type="button" id="total_items" class="total_items" value="<?php if(isset($_SESSION["n_ogg_carr"])){ echo($_SESSION["n_ogg_carr"]);}?>"></a>
              </div>
            </nav>
          </div>
        </div>
      </header>
      <!--Fine header-->

      <div class="container middle">
        <div class="box-container-mtb">
          <div class="row row-cntr background-card">
            <div class="row row-cntr" style="padding: 0 1%;">
              <!--DIV PER L'IMAMGINE-->
              <div class="col-4 item-photo">
                <img style="max-width:100%; max-height: 425px" src="<?php if(isset($output)){ echo($output[5]);}?>" />
              </div>
              <!-- TITOLO E ALTRI DATI DEL COMPONENTE -->
              <div class="col-7">
                <h3 class="title-name"><?php if(isset($output)){ echo($output[$titolo]);}?></h3>
                <h1 style='color:red'> 
                  <?php
                    if(isset($errore)){
                      echo($errore);
                      header("refresh:1.5; url=home.php");
                    }
                  ?>
                </h1>
                <!--DESCRIZIONE-->
                <p class="title desc">Descrizione:</p>
                <span class="title desc text"><?php if(isset($output)){ echo($output[$descrizione]);}?></span>
                
                <!--BRAND-->
                <p class="title brand">Brand: <span class="title brand text"><?php if(isset($output)){ echo($output[$brand]);}?></span></p>
                <!--DISPONIBILTA-->
                <?php
                  if(isset($output)){
                    if($output[$quantita]>0){
                      echo '<p class="title quantita">Disponibilitá: <span class="title quantita text">In Stock</span></p>';
                    }
                    else
                    echo '<p class="title quantita">Non disponibile</p>';
                  }
                ?>  
                <!--<p class="title quantita">Quantita' Disponibile: <span class="title quantita text"><?php if(isset($output)){ echo($output[$quantita]);}?> </span></p> -->
                <!-- PREZZO -->
                <p class="title price">Prezzo: <span class="title price text"><?php if(isset($output)){ echo($output[$prezzo]);}?> €</span></p>
                <!-- BOTTONE AGGIUNGI AL CARRELLO -->
                <div class="section">
                  <button class="glow-on-hover3 btn btn-block" id="add_to_cart" title="Aggiungi al carrello" data-id="<?php if(isset($output)){ echo($output[0]);}?>"><i class="fas fa-shopping-cart" style="margin-right: 5px;"></i> AGGIUNGI AL CARRELLO</button>
                </div>
                <!--Se la quantita é 0, il bottone di aggiungi al carrello non é disponibile-->
                <?php
                  if(isset($output)){
                    if($output[$quantita]==0){
                      echo "<script language='JavaScript'> disabled() </script>";
                    }
                  }
                ?>                                        
              </div>
            </div>                            
            <!-- DESCRIZIONE DEL PRODOTTO E SPECIFICHE-->
            <div class="row row-cntr desc-spec" >
              <div class="row row-cntr">
                <ul class="menu-items">
                  <li class="attivo">Specifiche</li>
                  <a href='<?php if(isset($output)){ echo($output[$link]);}?>' style="color: gold;">
                    <li class="disattivo">Sito Produttore</li>
                  </a>
                </ul>
              </div>
              <div class="row row-cntr spec" >
                <div class="col-4 table-text">
                  <?php if(isset($output_left)){ echo($output_left);}?>
                </div>
                <div class="col-7">
                  <?php if(isset($output_right)){ echo($output_right);}?>
                </div>
              </div>
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