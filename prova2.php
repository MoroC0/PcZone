<?php
  //connessione
  include("connect.php");
  //Avvio la sessione
  session_start();
?>

<html>
<head>
	<title>PC Zone Selettore Componenti</title>
	<meta name="viewport" content="width-device-width, initial-scale=1"/>

	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

	<link rel="stylesheet" type="text/css" href= "./Css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="./Css/style.css" />
	<link rel="stylesheet" type="text/css" href="./Css/sel-comp.css" />

	<link rel="stylesheet" href="./fontawesome-free-5.13.0-web/css/all.css">

	<script src="http://code.jquery.com/jquery-latest.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body class="body_t"><!--SELEZIONI COMPONENTI-->

  <div class="page-container">
		<div class="content-wrap">
			<!--Div per la parte superiore-->
      <div class="header">
        <div class="top" style="padding: 0;">
          <nav class="navbar navbar-expand-lg navbar-light">
            <!-- Logo -->
            <div class="d-flex col-3" style="padding-left: 2%;">
              <img class="image" src="Images/Logo.png" height="50px" width="200px" >
            </div>
            <!-- Menu -->
            <div class="d-flex col-6 brd-btnn">
              <div class="container ctnr">
              <a class="navbar-brand nav-brd" href="home.php" title="Vai alla Home" >Home</a>
                  <a class="navbar-brand nav-brd" href="sel_componente.php" title="Vai ai componenti">Shop</a>
                  <a class="navbar-brand nav-brd" href="configuratore.php" title="Vai al Configuratore">Configuratore</a>
                  <a class="navbar-brand nav-brd" href="supporto.php" title="Via al Supporto">Supporto</a>
                <a class="navbar-brand nav-brd" href="carrello.php" title="Vai al carrello"><i class="fas fa-shopping-cart fa-1x"></i> Carrello <input type="button" id="total_items" class="total_items" value="<?php if(isset($_SESSION["n_ogg_carr"])){ echo($_SESSION["n_ogg_carr"]);}?>"></a>
              </div>
            </div>
            <!-- Accesso -->
            <div class="d-flex col-3"  style="padding-right: 2%;">
              <div class="container cont-btn-nick">  
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">
                    <?php
                      if(!isset($_SESSION["user"])){
                        echo '
                        <form class="form-inline m-auto">
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
          </nav>
        </div>
      </div>
      <!--Fine header--> 
			<div class="middle">
				<h2 class="text-middle-top">Risultati</h2>
        <div>
          <?php
            //aggiungere estenzione query nel controllo maiuscole, ergo prima maiuscola, tutto maiuscolo, tutto minuscolo.
            //vedere sul manuale php per specifiche comandi
            $safe_value = pg_escape_string($_POST['cerca']);
            $query= "SELECT * FROM Componente WHERE Componente.titolo LIKE '%$safe_value%'";
            $result = pg_query($dbconn, $query);
             while ($row = pg_fetch_row($result)) {
            echo "<div id='link' onClick='addText(\"".$row[2]."\");'>" . $row[2] . "</div>";  
             }
          ?>
        </div>
      </div>
    </div>
  </div>
	<footer class="footer" style="position: relative;">
    <div class="container">
      <span class="text-muted">HTML Project</span>
      <br>
      <span class="text-muted">Created by Fabio Sestito & Leonardo Morocutti</span>
    </div>
  </footer>
	<script src="./js/animazione.js"></script>
</body>
</html>