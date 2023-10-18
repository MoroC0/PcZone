<?php
  //connessione
  include("connect.php");
  //Avvio la sessione
	session_start();
  
	if(isset($_SESSION['user'])){
    $output="";
    $user = $_SESSION['user'];	
        
	  $q1 = "SELECT id FROM Utente WHERE Utente.nickname = '$user'";//Prendo l'id dell'utente in sessione
    $row1 = pg_fetch_row(pg_query($dbconn, $q1)); //Invio la query per prendere l'id dell'utente
    
	  $q2 = "SELECT * FROM Configurazione WHERE Configurazione.cod_utente = $row1[0]"; //Prendo le configurazioni dell'utente in sessione	
    $ret=(pg_query($dbconn, $q2)); //Invio la query per prendere le configurazioni dell'utente
    
		$n=1;
		while($row = pg_fetch_row($ret)){
      $link='';
      //Alla prima chiamata del while in row[0] ho il codice della prima configurazione dell'utente in sessione

      $output.= " <div class='select_form'>
                    <div class='row spazio'>
                      <div class='col-md-4 to-left'>
                        <p class='title-ord'>CONFIGURAZIONE #$n</p>
                      </div>
                      <div class='col-md-8 to-right'>
                        <p class='title-ord'>TOTALE: $row[2]€</p>
                      </div>
                    </div>
                    <div class='row postit'>";

			$q3 = "SELECT Componente.nome, Componente.immagine, Componente.id, Componente.categoria, Componente.prezzo FROM (Configurazione JOIN conf_comp ON Configurazione.id = conf_comp.cod_conf AND Configurazione.id = $row[0])
							JOIN Componente on Componente.id = conf_comp.cod_comp
							WHERE Configurazione.cod_utente = $row1[0]";
			$ret2 = pg_query($dbconn, $q3); //Invio la query per prendere tutte le informazioni delle configurazioni
			
			while($row3 = pg_fetch_row($ret2)){
        //Alla prima chiamata del while in row3[0] dovrei avere la cpu
        $link .= "$row3[2],";
      	$output .= "
                      <div class='row col-container cont-comp'>
                        <div class='col-2 align-self-center col-img-left'>
                        <a href='desc_componente.php?id=$row3[2]&tipo=$row3[3]'>
                          <img src='$row3[1]' height='100px' width='100px' style='object-fit:contain'>
                        </a>
                        </div>
                        <div class='col-8 align-self-center' style='text-align:center'>
                          <a href='desc_componente.php?id=$row3[2]&tipo=$row3[3]' class='linked'> $row3[0]</a>
                        </div>
                        <div class='col-2 align-self-center col-price-right' style='text-align:right;'>
                          <span class='text-comp'> ".number_format($row3[4], 2)." €</span>
                        </div>
                      </div>
                    ";
      }
      $id = explode(',', $link);
      $output .= "</div>
                  <div class='row link'>
                    <div class='col-6'>
                      <a class='linked page' href='config_compl.php?cpu=$id[0]&mobo=$id[7]&ram=$id[3]&gpu=$id[4]&ssd=$id[2]&cooler=$id[5]&psu=$id[6]&case=$id[1]'> Clicca qui per visualizzarla </a>
                    </div>
                  </div>";
      $output .= "</div>";
      $n++;
    }
  }
  else{
		$errore="NON POTRESTI ESSERE QUI! Torna alla home";
	}
?>

<html>
<head>
  <title>Pc Zone Configurazioni</title>
  <meta name="viewport" content="width-device-width, initial-scale=1"/>

	<link rel="stylesheet" type="text/css" href= "./Css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="./Css/style.css" />
  <link rel="stylesheet" href="./fontawesome-free-5.13.0-web/css/all.css">
  <link rel="stylesheet" type="text/css" href= "./Css/mie_confing.css" />
  
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body class="body_t">       <!--HOME-->
  <div name="PAGINA">

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
        <h1 class='text-middle-top'> Elenco configurazioni</h1>
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
        <h2 class="text-middle-bottom">Le tue configurazioni</h2>
      </div>
      <!--<div class="select_form">
        <div class="row spazio">
          <!--<div class="select_component" style="display:block;">-->
          <?php
            if(isset($output)){
              echo($output);
            }
          ?>
          <!--</div>-->
        <!--</div>
        
      </div>-->
    </div>
  </div>

  <footer class="footer">
      <div class="container">
        <span class="text-muted">HTML Project</span>
          <br>
        <span class="text-muted">Created by Fabio Sestito & Leonardo Morocutti</span>
      </div>
    </footer>	
</body>
</html>