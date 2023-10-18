<?php
	//connessione
	include("connect.php");
	//Avvio la sessione
	session_start();
	
	//Prendo il nickname dell'utente in sessione
	if(isset($_SESSION['user'])){

		
		$nick = $_SESSION['user'];

	//Prendo i campi necessari per gli input type text precompilati
	$q1 = "SELECT * FROM utente WHERE nickname = '$nick'";
	$res = pg_query($dbconn, $q1);
	$line = pg_fetch_array($res, null, PGSQL_ASSOC);

	//Prendo dal database tutte le informazioni dell'utente
	//per poi stamparle
	$nome = $line['nome'];
	$cong = $line['cognome'];
	$email = $line['email'];
	$cell = $line['telefono'];
	$indi = $line['indirizzo'];
	$pass = md5($line['pass']);
	}
	else{
		$errore="NON POTRESTI ESSERE QUI! Torna alla home";
	}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pc Zone Modifica Profilo</title>
  <meta name="viewport" content="width=device−width , initial−scale=1"/>
	
	<link rel="stylesheet" type="text/css" href= "./Css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./Css/style.css">
  <link rel="stylesheet" href="./fontawesome-free-5.13.0-web/css/all.css">
	<link rel="stylesheet" href="./Css/floating-labels.css" />
	<link rel="stylesheet" type="text/css" href="./Css/edit_user.css">
	<link rel="stylesheet" type="text/css" href="./Css/user.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="./Js/edit_user.js"></script>
</head>
<body class="body" style="display:block">
	<div class="page" id="blur">
		<!--<div class="header" style="margin-top: 2%;">
			<div class="top">
			</div>
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
			<!-- Versione Vecchia-->
			<!--<div class="container profile-card">
				<form method="post" action="ver_edit_user.php">
					<div class="row"> 
						<div class="col-md-4">
							<div class="profile-img" style='padding-right:40px'>
							<i class="fas fa-user-edit fa-10x"></i>
							</div>
						</div>
						
						<div class="col-md-8">
							<div class="profile-title">
								<h2 style="color:gold; text-align:center">Modifica profilo</h2>
								<h1 style="color: red; text-align:center"> 
								<?php 
									if(isset($errore)){
										echo($errore);
										header("refresh:1.5; url=home.php");
									}
								?>
							</h1>
							</div>
						</div>
					</div> 
					
					<div class="row">
						<div class="col-sm-4">
							<h4 class="d-flex justify-content-between align-items-center mb-3">
								<span style="color: white; margin-left: auto; margin-right: auto">Regole per la modifica: </span>
							</h4>
						
							<div class="mb-4" style="border-bottom: 1px solid white;">
								<div style=" text-align: center; color: lime;"> 
									Inserirsci solo lettere nel nome e cognome
								</div> 
							</div>
						
							<div class="mb-4" style="border-bottom: 1px solid  white;">
								<div style="text-align: center; color: lime;"> 
									Non mettere caratteri speciali nel Nickname.
								</div>
							</div>
						
							<div class="mb-4" style="border-bottom: 1px solid  white;">
								<div style="text-align: center; color: lime;"> 
									Inserirsci una @ e un .  nella email.
								</div> 
							</div>
						
							<div class="mb-4" style=" border-bottom: 1px solid  white;">
								<div style="text-align: center; color: lime;"> 
									Inserisci il telefono per ricevere informazioni
								</div>	 
							</div>
							
							<div class="mb-4" style=" border-bottom: 1px solid  white;">
								<div style=" text-align: center; color: lime;"> 
									Stile indirizzo: regione, cittá, cap, via, civico.
								</div> 
							</div>
							
							<div class="mb-4" style="border-bottom: 1px solid  white;">
								<div style=" text-align: center; color: lime;"> 
									Password: Tra i 6 e i 12 caratteri
								</div> 
							</div>
						</div>
					
						
						<div class="col-md-8"> 
							<div class="tab-content profile-tab" id="myTabContent">
								<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
										
									<div class="row" style="margin-bottom:4%">
										<div class="col-md-6">
											<div class="form-label-group">
												<input type="text" class="form-control" id="editNome" name="editNome" placeholder="Nome" value="<?php if(isset($nome)){ echo($nome);}?>" required onchange="valida_nome(), valida_bottone()">
												<label for="reg_nome">Nome</label>
												<div id="inv_nome" class="invalid-feedback">
												</div>
											</div>
										</div>
											
										<div class="col-md-6">
											<div class="form-label-group">
												<input type="text" class="form-control" id="editCogn" name="editCogn" placeholder="Cognome" value="<?php if(isset($cong)){ echo($cong);}?>" required onchange="valida_cognome(), valida_bottone()">
												<label for="reg_cognome">Cognome</label>
												<div id="inv_cogn" class="invalid-feedback">
												</div>
											</div>
										</div>
									</div>
										
									<div class="row" style="margin-bottom:4%">
										<div class="col-md-6">
											<div class="form-label-group">
												<input type="text" class="form-control" id="editNick" name="editNick" placeholder="Nickname" value="<?php if(isset($nick)){ echo($nick);}?>" required onchange="valida_nick(), valida_bottone()">
												<label for="reg_nick">Nickname</label>
												<div id="inv_nick" class="invalid-feedback">
												</div>
											</div>
										</div>
											
										<div class="col-md-6">
											<div class="form-label-group">
												<input type="email" class="form-control" id="editEmail" name="editEmail" placeholder="Email" value="<?php if(isset($email)){ echo($email);}?>" required onchange="valida_pass(), valida_bottone()">
												<label for="reg_email">Email</label>
												<div id="inv_email" class="invalid-feedback">
												</div>
											</div>	
										</div>
									</div>

									<div class="row" style="margin-bottom:4%">
										<div class="col-md-6">
											<div class="form-label-group">
												<input type="text" class="form-control" id="editCell" name="editCell" placeholder="Telefono" value="<?php if(isset($cell)){ echo($cell);}?>" required onchange="valida_telefono(), valida_bottone()">
												<label for="reg_tel">Telefono</label>
												<div id="inv_tel" class="invalid-feedback">
												</div>
											</div>
										</div>
											
										<div class="col-md-6">
											<div class="form-label-group">
												<input type="text" class="form-control" id="editIndi" name="editIndi" placeholder="Indirizzo" value="<?php if(isset($indi)){ echo($indi);}?>" required onchange="valida_indirizzo(), valida_bottone()">
												<label for="editIndi">Indirizzo</label>
												<div id="inv_indi" class="invalid-feedback">
												</div>
											</div>
										</div>
									</div>

									<div class="row" style="margin-bottom:4%">
										<div class="col-md-6">
											<div class="form-label-group">
												<input type="password" class="form-control" id="editPass" name="editPass" placeholder="Password" value="" onchange="valida_pass(), valida_bottone()">
												<span id="r_pass" class="eye">
													<i id="hide1" class="fas fa-eye"></i>
												</span>
												<label for="editPass">Password</label>
											</div>
										</div>
											
										<div class="col-md-6">
											<div class="form-label-group">
												<input type="password" class="form-control" id="editConfPass" name="editConfPass" placeholder="Conferma Password" value="" onchange="valida_pass(), valida_bottone()">
												<span id="r_c_pass" class="eye">
													<i id="hide2" class="fas fa-eye"></i>
												</span>
												<label for="editConfPass">Conferma Password</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-sm-2" style="text-align: center">
							<a class="btn btn-dark btn-md glow-on-hover" href="user.php" > Annulla </a>
						</div>
						<div class="col-md-8"></div>
						<div class="col-sm-2" style="text-align: center">
							<button class="btn btn-dark btn-md glow-on-hover" id="conf_btn" type="button" onclick="attiva_btn()"> Conferma </button>
						</div>
					</div>
				</form>
			</div>


			<!-- VERSIONE MK2 -->
			<!--<h2 class="edit-title">Modifica profilo</h2>
			<div class="container profile-card2">
				<form class="form-edit-user" method="post" action="ver_edit_user.php">
					<div class="row">
						<div class="col-md-5">
							<div class="profile-img2">
							<i class="fas fa-user-edit fa-10x"></i>
							</div>

							<h4 class="d-flex justify-content-between align-items-center mb-3">
								<span style="color: white; margin-left: auto; margin-right: auto">Regole per la modifica: </span>
							</h4>
						
							<div class="mb-4 text-rules-box">
								<div  class="text-rules"> 
									Inserirsci solo lettere nel nome e cognome
								</div> 
							</div>
						
							<div class="mb-4 text-rules-box">
								<div class="text-rules"> 
									Non mettere caratteri speciali nel Nickname.
								</div>
							</div>
						
							<div class="mb-4 text-rules-box">
								<div class="text-rules"> 
									Inserirsci una @ e un .  nella email.
								</div> 
							</div>
						
							<div class="mb-4 text-rules-box">
								<div class="text-rules"> 
									Inserisci il telefono per ricevere informazioni
								</div>	 
							</div>
							
							<div class="mb-4 text-rules-box">
								<div  class="text-rules"> 
									Stile indirizzo: regione, cittá, cap, via, civico.
								</div> 
							</div>
							
							<div class="mb-4 text-rules-box">
								<div  class="text-rules"> 
									Password: Tra i 6 e i 12 caratteri
								</div> 
							</div>
						</div>
						
						<div class="col-md-8">
							<div class="profile-title">
								<h1 style="color: red; text-align:center"> 
								<?php 
									if(isset($errore)){
										echo($errore);
										header("refresh:1.5; url=home.php");
									}
								?>
							</h1>
							</div>
						</div>
						<div class="col-md-7"> 
							<div class="tab-content-pt profile-tab" id="myTabContent"> 
								<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
										
									<div class="row" style="margin-bottom:4%">
										<div class="mb-4">
											<div class="form-label-group">
												<input type="text" class="form-control" id="editNome" name="editNome" placeholder="Nome" value="<?php if(isset($nome)){ echo($nome);}?>" required onchange="valida_nome(), valida_bottone()">
												<label for="reg_nome">Nome</label>
												<div id="inv_nome" class="invalid-feedback">
												</div>
											</div>
										</div>
											
										<div class="mb-4">
											<div class="form-label-group">
												<input type="text" class="form-control" id="editCogn" name="editCogn" placeholder="Cognome" value="<?php if(isset($cong)){ echo($cong);}?>" required onchange="valida_cognome(), valida_bottone()">
												<label for="reg_cognome">Cognome</label>
												<div id="inv_cogn" class="invalid-feedback">
												</div>
											</div>
										</div>
									</div>
										
									<div class="row" style="margin-bottom:4%">
										<div class="mb-4">
											<div class="form-label-group">
												<input type="text" class="form-control" id="editNick" name="editNick" placeholder="Nickname" value="<?php if(isset($nick)){ echo($nick);}?>" required onchange="valida_nick(), valida_bottone()">
												<label for="reg_nick">Nickname</label>
												<div id="inv_nick" class="invalid-feedback">
												</div>
											</div>
										</div>
											
										<div class="mb-4">
											<div class="form-label-group">
												<input type="email" class="form-control" id="editEmail" name="editEmail" placeholder="Email" value="<?php if(isset($email)){ echo($email);}?>" required onchange="valida_pass(), valida_bottone()">
												<label for="reg_email">Email</label>
												<div id="inv_email" class="invalid-feedback">
												</div>
											</div>	
										</div>
									</div> Chiudo row

									<div class="row" style="margin-bottom:4%">
										<div class="mb-4">
											<div class="form-label-group">
												<input type="text" class="form-control" id="editCell" name="editCell" placeholder="Telefono" value="<?php if(isset($cell)){ echo($cell);}?>" required onchange="valida_telefono(), valida_bottone()">
												<label for="reg_tel">Telefono</label>
												<div id="inv_tel" class="invalid-feedback">
												</div>
											</div>
										</div>
											
										<div class="mb-4">
											<div class="form-label-group">
												<input type="text" class="form-control" id="editIndi" name="editIndi" placeholder="Indirizzo" value="<?php if(isset($indi)){ echo($indi);}?>" required onchange="valida_indirizzo(), valida_bottone()">
												<label for="editIndi">Indirizzo</label>
												<div id="inv_indi" class="invalid-feedback">
												</div>
											</div>
										</div>
									<</div>

									<div class="row" style="margin-bottom:4%">
										<div class="mb-4">
											<div class="form-label-group">
												<input type="password" class="form-control" id="editPass" name="editPass" placeholder="Password" value="" onchange="valida_pass(), valida_bottone()">
												<span id="r_pass" class="eye">
													<i id="hide1" class="fas fa-eye"></i>
												</span>
												<label for="editPass">Password</label>
											</div>
										</div>
											
										<div class="mb-4">
											<div class="form-label-group">
												<input type="password" class="form-control" id="editConfPass" name="editConfPass" placeholder="Conferma Password" value="" onchange="valida_pass(), valida_bottone()">
												<span id="r_c_pass" class="eye">
													<i id="hide2" class="fas fa-eye"></i>
												</span>
												<label for="editConfPass">Conferma Password</label>
											</div>
										</div>
									</div
								</div> 
							</div> 
						</div> 
					</div>
					<div class="row mt-4"> 
						<div class="col-md-6" style="text-align: center">
							<a class="btn btn-lg btn-danger btn-block" href="user.php" > Annulla </a>
						</div>
						<div class="col-md-8"></div>
						<div class="col-md-6" style="text-align: center">
							<button class="btn btn-lg btn-success btn-block" id="conf_btn" type="button" onclick="attiva_btn()"> Conferma </button>
						</div>
					</div>
				</form>
			</div>

			<!-- VERSIONE MK3 -->
			<h2 class="edit-title">Modifica Profilo</h2>
			<div class="container profile-card3">
				<form class="form-edit-user" method="post" action="ver_edit_user.php"> <!--Apro form-->
					<div class="row"> <!--Apro row-->
						<!--<div class="col-md-8">
							<div class="profile-title">
								<h1 style="color: red; text-align:center"> 
								<?php 
									if(isset($errore)){
										echo($errore);
										header("refresh:1.5; url=home.php");
									}
								?>
							</h1>
							</div>
						</div>-->
						<div class="col"> <!--Apro col-md-8-->
							<div class="profile-tab" id="myTabContent"> <!--Apro tab-content-->
								<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"> <!--Apro tab-pane-->
										
									<!--<div class="row" style="margin-bottom:4%"> <!--Apro row-->
										<div class="mb-3">
											<div class="form-label-group">
												<input type="text" class="form-control" id="editNome" name="editNome" placeholder="Nome" value="<?php if(isset($nome)){ echo($nome);}?>" required onchange="valida_nome(), valida_bottone()">
												<label for="reg_nome">Nome</label>
												<div id="inv_nome" class="invalid-feedback">
												</div>
											</div>
										</div>
											
										<div class="mb-3">
											<div class="form-label-group">
												<input type="text" class="form-control" id="editCogn" name="editCogn" placeholder="Cognome" value="<?php if(isset($cong)){ echo($cong);}?>" required onchange="valida_cognome(), valida_bottone()">
												<label for="reg_cognome">Cognome</label>
												<div id="inv_cogn" class="invalid-feedback">
												</div>
											</div>
										</div>
									<!--</div> <!--Chiudo row-->
										
									<!--<div class="row" style="margin-bottom:4%"> <!--Apro row-->
										<div class="mb-3">
											<div class="form-label-group">
												<input type="text" class="form-control" id="editNick" name="editNick" placeholder="Nickname" value="<?php if(isset($nick)){ echo($nick);}?>" required onchange="valida_nick(), valida_bottone()">
												<label for="reg_nick">Nickname</label>
												<div id="inv_nick" class="invalid-feedback">
												</div>
											</div>
										</div>
											
										<div class="mb-3">
											<div class="form-label-group">
												<input type="email" class="form-control" id="editEmail" name="editEmail" placeholder="Email" value="<?php if(isset($email)){ echo($email);}?>" required onchange="valida_pass(), valida_bottone()">
												<label for="reg_email">Email</label>
												<div id="inv_email" class="invalid-feedback">
												</div>
											</div>	
										</div>
									<!--</div> <!--Chiudo row-->

									<!--<div class="row" style="margin-bottom:4%"> <!--Apro row-->
										<div class="mb-3">
											<div class="form-label-group">
												<input type="text" class="form-control" id="editCell" name="editCell" placeholder="Telefono" value="<?php if(isset($cell)){ echo($cell);}?>" required onchange="valida_telefono(), valida_bottone()">
												<label for="reg_tel">Telefono</label>
												<div id="inv_tel" class="invalid-feedback">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3 mb-3 col-padding-right">
												<div class="form-label-group margin-label">
													<input type="text" name="reg_reg" id="reg_reg" class="form-control" placeholder="Regione" onkeyup="controllo_regione(), valida_bottone()"/>
													<label for="reg_reg">Regione</label>
													<div id="inv_reg" class="invalid-feedback"></div>
												</div>
											</div>
											<div class="col-md-7 mb-3">
												<div class="form-label-group margin-label">
													<input type="text" name="reg_citta" id="reg_citta" class="form-control" placeholder="Citta" onkeyup="controllo_citta(), valida_bottone()"/>
													<label for="reg_citta">Citta</label>
													<div id="inv_citta" class="invalid-feedback">
													</div>
												</div>
											</div>
											<div class="col-md-2 mb-3 col-padding-left">
												<div class="form-label-group margin-label">
													<input type="text" name="reg_cap" id="reg_cap" class="form-control" placeholder="Cap" onkeyup="controllo_cap(), valida_bottone()"/>
													<label for="reg_cap">CAP</label>
													<div id="inv_cap" class="invalid-feedback">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3 mb-3 col-padding-right">
												<div class="form-label-group margin-label">
													<select class="form-control" id="reg_pref" name="reg_pref" style="height: 3.125rem;" onchange="controllo_prefisso(), valida_bottone()" required>
														<option value="">Prefisso</option>
														<option value="via">Via</option>
														<option value="viale">Viale</option>
														<option value="piazza">Piazza</option>
														<option value="piazzale">Piazzale</option>
													</select>
													<div id="inv_pref" class="invalid-feedback"></div>
												</div>
											</div>
											<div class="col-md-7 mb-3">
												<div class="form-label-group margin-label">
													<input type="text" name="reg_indi" id="reg_indi" class="form-control" placeholder="Indirizzo" onkeyup="controllo_indi(), valida_bottone()"/>
													<label for="reg_indi">Indirizzo</label>
													<div id="inv_indi" class="invalid-feedback">
													</div>
												</div>
											</div>
											<div class="col-md-2 mb-3 col-padding-left">
												<div class="form-label-group margin-label">
													<input type="text" name="reg_civ" id="reg_civ" class="form-control" placeholder="Civico" onkeyup="controllo_civ(), valida_bottone()"/>
													<label for="reg_civ">Civico</label>
													<div id="inv_civ" class="invalid-feedback">
													</div>
												</div>
											</div>
										</div>
										<!--<div class="mb-3">
											<div class="form-label-group">
												<input type="text" class="form-control" id="editIndi" name="editIndi" placeholder="Indirizzo" value="<?php if(isset($indi)){ echo($indi);}?>" required onchange="valida_indirizzo(), valida_bottone()">
												<label for="editIndi">Indirizzo</label>
												<div id="inv_indi" class="invalid-feedback">
												</div>
											</div>
										</div>
									<!--</div> <!--Chiudo row-->

									<!--<div class="row" style="margin-bottom:4%"> <!--Apro row-->
										<div class="mb-3">
											<div class="form-label-group">
												<input type="password" class="form-control" id="editPass" name="editPass" placeholder="Password" value="" onchange="valida_pass(), valida_bottone()">
												<span id="r_pass" class="eye">
													<i id="hide1" class="fas fa-eye icon-white"></i>
												</span>
												<label for="editPass">Password</label>
											</div>
										</div>
											
										<div class="mb-3">
											<div class="form-label-group">
												<input type="password" class="form-control" id="editConfPass" name="editConfPass" placeholder="Conferma Password" value="" onchange="valida_pass(), valida_bottone()">
												<span id="r_c_pass" class="eye">
													<i id="hide2" class="fas fa-eye icon-white"></i>
												</span>
												<label for="editConfPass">Conferma Password</label>
											</div>
										</div>
									<!--</div> <!--Chiudo row-->
								</div> <!--Chiudo tab-pane-->
							</div> <!--Chiudo tab-content-->
						</div> <!--AChiudo col-md-8-->
					</div> <!--Chiudo row-->
					<div class="row mb-3"> <!--Apro row mt-4-->
						<div class="col-md-6" style="text-align: center">
							<a class="btn btn-lg btn-danger btn-block" href="user.php" >ANNULLA</a>
						</div>
						<!--<div class="col-md-8"></div>-->
						<div class="col-md-6" style="text-align: center">
							<button class="btn btn-lg btn-success btn-block" id="conf_btn" type="button" onclick="attiva_btn()">CONFERMA</button>
						</div>
					</div> <!--Chiudo row mt-4-->
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-lg btn-dark btn-block" type="button" onclick="toggle()">Istruzioni per la modifica credenziali</button>
						</div>
					</div>
				</form> <!--Chiudo form-->
			</div>

		</div>
	</div>

	<div class="col-md-6 col-rules" id="popup">
							<div class="profile-img2">
							<i class="fas fa-user-edit fa-10x"></i>
							</div>
							<h4 class="d-flex reg-title justify-content-between align-items-center mb-3">
								<span class="reg-title2" style="color: white; margin-left: auto; margin-right: auto">REGOLE PER LA MODIFICA</span>
							</h4>
							<div class="mb-3 text-rules-box">
								<div  class="text-rules"> 
									Inserirsci solo lettere nel nome e cognome
								</div> 
							</div>
							<div class="mb-3 text-rules-box">
								<div class="text-rules"> 
									Non mettere caratteri speciali nel Nickname.
								</div>
							</div>
							<div class="mb-3 text-rules-box">
								<div class="text-rules"> 
									Inserirsci una @ e un .  nella email.
								</div> 
							</div>
							<div class="mb-3 text-rules-box">
								<div class="text-rules"> 
									Inserisci il telefono per ricevere informazioni
								</div>	 
							</div>
							<div class="mb-3 text-rules-box">
								<div  class="text-rules"> 
									Stile indirizzo: regione, cittá, cap, via, civico.
								</div> 
							</div>
							<div class="mb-3 text-rules-box-last">
								<div  class="text-rules"> 
									Password: Tra i 6 e i 12 caratteri
								</div> 
							</div>
							<div class="row justify-content-center">
								<div class="col-md-4 mb-0">
									<button class="btn btn-lg btn-dark btn-block" type="button" onclick="toggle()">CHIUDI</button>
								</div>
							</div>
						</div>
</body>
</html>