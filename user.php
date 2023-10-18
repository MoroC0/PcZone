<?php
	//connessione
	include("connect.php");
	//Avvio la sessione
	session_start();

	if(isset($_SESSION['user'])){
		$nick = $_SESSION['user'];
	
		$q1 = "SELECT * FROM utente WHERE nickname = '$nick'";
		$res = pg_query($dbconn, $q1);
		$line = pg_fetch_array($res, null, PGSQL_ASSOC);

		$nome = $line['nome'];
		$cong = $line['cognome'];
		$email = $line['email'];
		$cell = $line['telefono'];
		$indi = $line['indirizzo'];
	}
	else{
		$errore="NON POTRESTI ESSERE QUI! Torna alla home";
	}
	
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pc Zone Profilo</title>
  <meta name="viewport" content="width=device−width , initial−scale=1"/>
	<!--STILI-->
	<link rel="stylesheet" type="text/css" href= "css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<link rel="stylesheet" type="text/css" href="./css/user.css">
  <link rel="stylesheet" href="./fontawesome-free-5.13.0-web/css/all.css">

	<!--SCRIPT-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
	<body class="body">
		<div class="page-container">
			<div class="content-wrap">
				<div class="header" style="margin-top: 2%;">
					<div class="top">
						<div class="text-center"></div>
						<h2 style="text-align: center; color: gold">Il Tuo Profilo</h2>
					</div>
				</div>
				<div class="middle">
					<!--<div class="container profile-card">
						<form method="post">
							<div class="row">
								<div class="col-md-4">
									<div class="profile-img">
										<i class="fas fa-user fa-10x"></i>
									</div>
								</div>
								<div class="col-md-6">
									<div class="profile-title">
										<h1 style="color: gold; text-transform: uppercase;">
											<?php //Stampo il nick
												if(isset($nick)){ echo($nick);}
											?>
											<h1> 
											<?php
												if(isset($errore)){ echo($errore);}
											?>
											</h1>
										</h1>
									</div>
								</div>
								<div class="col-md-2">
									
								</div>
							</div>
							
							<div class="row" style="margin-top: 3%;">
								<div class="col-md-4 text-center">
									<!--<div style="padding-left: 18%;">
										<a class="btn glow-on-hover5" href="edit_user.php" style="width: 180px;">Modifica Profilo</a>
										<br><br>
										<a class="btn glow-on-hover5" href="mie_ordini.php" style="width: 180px;">I miei ordini</a>   
										<br><br>
										<a class="btn glow-on-hover5" href="mie_config.php" style="width: 180px;">Le tue configurazioni</a>
										<br><br>
										<?php
										if($nick=="admin")
											echo "<a class='btn glow-on-hover5' href='all_ticket.php' style='width: 180px;'>Tutti i ticket</a>";
										else
											echo "<a class='btn glow-on-hover5' href='my_ticket.php' style='width: 180px;'>I miei ticket</a>";
										?>
										<br>
										<br>
										<a class="btn glow-on-hover5" href="logout.php" style="width:180px;">Logout</a>
										
									<!--</div>
								</div>
								<div class="col-md-8" style="font-size:28px">
									<div class="tab-content profile-tab" id="myTabContent">
										<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
											<div class="row">
												<div class="col-md-5" >
													<p class="text-desc">Nome</p>
												</div>
												<div class="col-md-7">
													<p><?php if(isset($nome)){ echo($nome);}?></p>
												</div>
											</div>
											<div class="row">
												<div class="col-md-5" >
													<p class="text-desc">Cognome</p>
												</div>
												<div class="col-md-7" >
													<p><?php if(isset($cong)){ echo($cong);}?></p>
												</div>
											</div>
											<div class="row">
												<div class="col-md-5" >
													<p class="text-desc">Email</p>
												</div>
												<div class="col-md-7">
													<p><?php if(isset($email)){ echo($email);}?></p>
												</div>
											</div>
											<div class="row">
												<div class="col-md-5" >
													<p class="text-desc">Telefono</p>
												</div>
												<div class="col-md-7">
													<p><?php if(isset($cell)){ echo($cell);}?></p>
												</div>
											</div>
											<div class="row">
												<div class="col-md-5" >
													<p class="text-desc">Indirizzo</p>
												</div>
												<div class="col-md-7">
													<p><?php if(isset($indi)){ echo($indi);}?></p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class='col' style="padding-right:2.2%">
									
								</div>
							</div>
						</form>
					</div>
					<div class="under_titles" style="font-size: 20px">
						<span>
							<a href="home.php" style="color: gold;"> Home </a>
						</span>
						<span> | </span>
						<span>
							<a href="configuratore.php" style="color: gold;"> Configuratore </a>
						</span>
						<span> | </span>
						<span>
							<a href="sel_componente.php" style="color: gold;"> Shop </a>
						</span>
					</div>
				</div>-->

				<div class="container middle user-card-width">
					<div class="container profile-card2">
						<form method="post">
							<div class="row user-card-padd justify-content-around">
								<div class="col-md-4 text-center">
									<!--<div class="col">-->
										<div class="profile-img2">
											<div class="fas fa-user fa-10x"></div>
										</div>
										<div class="profile-title mt-2">
											<h1 class="user-title">
												<?php //Stampo il nick
													if(isset($nick)){ echo($nick);}
												?>
												<h1> 
												<?php
													if(isset($errore)){ echo($errore);}
												?>
												</h1>
											</h1>
										</div>
										<a class="btn btn-lg glow-on-hover5 btn-block" href="mie_ordini.php">I miei ordini</a>   
										<a class="btn btn-lg glow-on-hover5 btn-block" href="mie_config.php">Le tue configurazioni</a>
										<?php
										if($nick=="admin")
											echo "<a class='btn btn-lg glow-on-hover5 btn-block' href='all_ticket.php'>Tutti i ticket</a>";
										else
											echo "<a class='btn btn-lg glow-on-hover5 btn-block' href='my_ticket.php'>I miei ticket</a>";
										?>
										<!--<br>
										<br>-->
										
									<!--</div>-->
								</div>

								<div class="col-md-7" style="font-size:28px">
									<div class="row">
										<div class="col">
											<div class="tab-content profile-tab" id="myTabContent">
												<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
													<div class="row mb-3 pt-3">
														<div class="col-md-6 pb-3 align-self-center text-rules-box" >
															<div class="bold">Nome</div>
														</div>
														<div class="col-md-6 pb-3 align-self-center text-rules-box">
															<div><?php if(isset($nome)){ echo($nome);}?></div>
														</div>
													</div>
													<div class="row mb-3">
														<div class="col-md-6 pb-3 align-self-center text-rules-box" >
															<div class="bold">Cognome</div>
														</div>
														<div class="col-md-6 pb-3 align-self-center text-rules-box" >
															<div><?php if(isset($cong)){ echo($cong);}?></div>
														</div>
													</div>
													<div class="row mb-3">
														<div class="col-md-6 pb-3 align-self-center text-rules-box" >
															<div class="bold">Email</div>
														</div>
														<div class="col-md-6 pb-3 align-self-center text-rules-box">
															<div><?php if(isset($email)){ echo($email);}?></div>
														</div>
													</div>
													<div class="row mb-3">
														<div class="col-md-6 pb-3 align-self-center text-rules-box" >
															<div class="bold">Telefono</div>
														</div>
														<div class="col-md-6 pb-3 align-self-center text-rules-box">
															<div><?php if(isset($cell)){ echo($cell);}?></div>
														</div>
													</div>
													<div class="row mb-3">
														<div class="col-md-6 align-self-center text-rules-box-last" >
															<div class="bold">Indirizzo</div>
														</div>
														<div class="col-md-6 align-self-center text-rules-box-last">
															<div><?php if(isset($indi)){ echo($indi);}?></div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="w-100"></div>
										<div class="col">
										</div>
									</div>
										
										
								</div>
							</div>
						</form>
					</div>
					<div class="row">
						<div class="col-md-6">
							<a class="btn btn-danger btn-lg  btn-block" href="logout.php">LOGOUT</a>
						</div>
						<div class="col-md-6">
							<a class="btn btn-success btn-lg  btn-block" href="edit_user.php">MODIFICA PROFILO</a>
						</div>
					</div>
					<!--<div class="under_titles" style="font-size: 20px">
						<span>
							<a href="home.php" style="color: gold;"> Home </a>
						</span>
						<span> | </span>
						<span>
							<a href="configuratore.php" style="color: gold;"> Configuratore </a>
						</span>
						<span> | </span>
						<span>
							<a href="sel_componente.php" style="color: gold;"> Shop </a>
						</span>
					</div>-->
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