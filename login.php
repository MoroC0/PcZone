<?php
	//connessione
	include("connect.php");
	//Avvio la sessione
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pc Zone Accedi</title>
	<meta name="viewport" content="width=device−width , initial−scale=1"/>
	
	
	<link rel="stylesheet" type="text/css" href="./Css/login.css" />
	<link rel="stylesheet" type="text/css" href= "./Css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="./Css/style.css" />
	<link rel="stylesheet" href="./Css/floating-labels.css" />
	<link rel="stylesheet" href="./fontawesome-free-5.13.0-web/css/all.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="./Js/reg-login.js"></script>
</head>
<body style="padding: 0;">
	<div class="container top">

		<!-- Vecchia Versione -->
		<!--<form class="form-signin" method="POST" action="ver_login.php"> Form con metodo POST che invia informazioni a ver_logi.php
			<div class="text-center mb-4">
				<img class="mb-4" src="Images/Logo.png" alt="" height="100px" width="300px">
				<h1 class="text-middle-top">Accedi</h1>
			</div>
	  
			<div class="form-label-group">
				<input type="email" id="logEmail" class="form-control" placeholder="Indirizzo Email" name="logEmail" required autofocus>
				<label for="logEmail">Indirizzo Email</label>
			</div>

			<div class="form-label-group" style="display: flex;">
				<input type="password" id="logPassword" class="form-control" placeholder="Password" name="logPassword" required>
				<span id="l_pass" class="eye">
					<i id="hide1" class="fas fa-eye"></i>
				</span>
				<label for="logPassword">Password</label> 
			</div>

			<button class="glow-on-hover btn btn-lg btn-primary btn-block" type="submit" style="border-radius:20px ;border-color:gold">Accedi</button>
			<br>
			<p style="text-align: center;">Non sei registrato? <a href="registrazione.html">Clicca qui per registrarti!</a></p>
		</form>-->


		<!-- FORM VERSIONE MK2 -->
		<!--<div class="text-center mb-4">
			<img class="mb-4" src="Images/Logo.png" alt="" height="100px" width="300px">
		</div>-->
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
    <div class="container middle">
  <h1 class="text-title-login">Accedi</h1>
		<div class="row justify-content-center">
		<form class="col-md-6 form-border" method="POST" action="ver_login.php"> <!--Form con metodo POST che invia informazioni a ver_logi.php-->
				<div class="form-label-group">
					<input type="email" id="logEmail" class="form-control" placeholder="Indirizzo Email" name="logEmail" required autofocus>
					<label for="logEmail">Indirizzo Email</label>
				</div>

				<div class="form-label-group" style="display: flex;">
					<input type="password" id="logPassword" class="form-control" placeholder="Password" name="logPassword" required>
					<span id="l_pass" class="eye">
						<i id="hide1" class="fas fa-eye"></i>
					</span>
					<label for="logPassword">Password</label> 
				</div>

				<button class="glow-on-hover btn btn-lg btn-succes btn-block" type="submit">Accedi</button>
				<br>
				<div class="link-label">
					<p class="text-link-reg">Non sei registrato? 
						<a class="reg-link" href="registrazione.html">Clicca qui per registrarti!</a>
					</p>
				</div>
			</form>
		</div>
  </div>
	</div>
  
</body>
</html>