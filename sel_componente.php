<?php
  //connessione
  include("connect.php");
  //Avvio la sessione
  session_start();
  //categoria
  $_SESSION['tipo']='';
  //tipologia
  $_SESSION['stile']='';
?>

<html>
<head>
	<title>PC Zone Selettore Componenti</title>
	<meta name="viewport" content="width-device-width, initial-scale=1"/>

	<link rel="stylesheet" type="text/css" href= "./Css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="./Css/style.css" />
	<link rel="stylesheet" href="./fontawesome-free-5.13.0-web/css/all.css">
	
  <link rel="stylesheet" type="text/css" href="./Css/sel-comp.css" />

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  
  <!--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>-->
</head>
<body class="body_t"><!--SELEZIONI COMPONENTI-->

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
				<div id="comp" class="select_form">
					<div class="row selettore">
            <div class='col-lg-3 icon-text'>
              <div class='card'> 
                <a href="componente.php?tipo=Cpu" class="text-sel-comp">
                  <img class='imgg card-img-top' src="Images/componenti/cpu/amd/7-3700x.png">
                  <div class='card-body'>
                    <h4 class='title-obj pt-1'>PROCESSORE</h4>
                  </div>
                </a>
              </div>
            </div>
						<!-- <div id="cpu" class="icon-text col-lg-3">
              <div class="card">
                <div class="icon">
                  <div class="fit-icons" > <!-- @mouseover="mostracpu = true" @mouseleave="mostracpu = false"-->
                    <!--<a href="componente.php?tipo=Cpu" class="text-sel-comp"> 
                      <img class="imgg card-img-top" src="./icone/cpu.png" width="100px" height="100px">
                      <div class="text-comp" >
                        CPU
                      </div>
                    </a>
                    <div class="onmouse-text">
                      <ul class="ul-class" > <!-- v-if="mostracpu"-->
                        <!--<ul class="ul-class"><a href="componente.php?tipo=Cpu&stile=intel" class="text-sel-comp">INTEL</a></ul> 
                        <ul class="ul-class"><a href="componente.php?tipo=Cpu&stile=amd" class="text-sel-comp">AMD</a></ul>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
						</div> -->
            <div class='col-lg-3 icon-text'>
              <div class='card'> 
                <a href="componente.php?tipo=Mobo" class="text-sel-comp">
                  <img class='imgg card-img-top' src="Images/componenti/mobo/atx/msi-b450-gaming-plus-max-am4.png">
                  <div class='card-body'>
                    <h4 class='title-obj pt-1'>SCHEDA MADRE</h4>
                  </div>
                </a>
              </div>
            </div>
						 <!-- <div id="mobo" class="icon-text col-lg-3">
              <div class="card">
							  <div class="icon">
                <div class="fit-icons"> <!-- @mouseover="mostramobo = true" @mouseleave="mostramobo = false"-->
                  <!--<a href="componente.php?tipo=Mobo" class="text-sel-comp">
                    <img class="imgg card-img-top" src="./icone/mobo.png" width="100px" height="100px">
                    <div class="text-comp">
                      MOTHERBOARD
                    </div>
                  </a>
									<div class="onmouse-text" >
										<ul class="ul-class"  > <!-- v-if="mostramobo"-->
											<!--<ul class="ul-class"><a href="componente.php?tipo=Mobo&stile=ATX" class="text-sel-comp">ATX</a></ul>
											<ul class="ul-class"><a href="componente.php?tipo=Mobo&stile=MICRO-ATX" class="text-sel-comp">MICRO-ATX</a></ul>
											<ul class="ul-class"><a href="componente.php?tipo=Mobo&stile=MINI-ITX" class="text-sel-comp">MINI-ITX</a></ul>
										</ul>
									</div>
								</div>
						  	</div>
              </div>
						</div> -->
            <div class='col-lg-3 icon-text'>
              <div class='card'> 
                <a href="componente.php?tipo=Ram" class="text-sel-comp">
                  <img class='imgg card-img-top' src="Images/componenti/ram/gskill-tridentz-3200MHz-2x8.png">
                  <div class='card-body'>
                    <h4 class='title-obj pt-1'>MEMORIA RAM</h4>
                  </div>
                </a>
              </div>
            </div>
            <!-- <div id="ram" class="icon-text col-lg-3">
              <div class="card">
                <div class="icon">
                  <div class="fit-icons" > <!-- @mouseover="mostraram = true" @mouseleave="mostraram = false" -->
                    <!--<a href="componente.php?tipo=Ram" class="text-sel-comp">
                      <img class="imgg card-img-top" src="./icone/Ram-icon.png" width="100px" height="100px">
                      <div class="text-comp">
                        RAM
                      </div>
                    </a>
                    <div class="onmouse-text" >
                      <ul class="ul-class" > <!-- v-if="mostraram" -->
                        <!--<ul class="ul-class"><a href="componente.php?tipo=Ram&stile=DDR4" class="text-sel-comp">DDR4</a></ul>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
						</div> -->
            <div class='col-lg-3 icon-text'>
              <div class='card'> 
                <a href="componente.php?tipo=Gpu" class="text-sel-comp">
                  <img class='imgg card-img-top' src="Images/componenti/gpu/nvidia/gigabyte-1080-8g.png">
                  <div class='card-body'>
                    <h4 class='title-obj pt-1'>SCHEDA VIDEO</h4>
                  </div>
                </a>
              </div>
            </div>
						<!-- <div id="gpu" class="icon-text col-lg-3">
              <div class="card">
                <div class="icon">
                  <div class="fit-icons" > <!-- @mouseover="mostragpu = true" @mouseleave="mostragpu = false" -->
                    <!--<a href="componente.php?tipo=Gpu" class="text-sel-comp">
                      <img class="imgg card-img-top" src="./icone/gpu.png" width="150px" height="100px">
                      <div class="text-comp">
                        SCHEDA VIDEO
                      </div>
                    </a>
                    <div class="onmouse-text" >
                      <ul class="ul-class" > <!-- v-if="mostragpu"-->
                        <!--<ul class="ul-class"><a href="componente.php?tipo=Gpu&stile=nvidia" class="text-sel-comp">nvidia</a></ul>
                        <ul class="ul-class"><a href="componente.php?tipo=Gpu&stile=amd" class="text-sel-comp">AMD</a></ul>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
						</div>-->
				  </div>
				  <div class="row selettore">
            <div class='col-lg-3 icon-text'>
              <div class='card'> 
                <a href="componente.php?tipo=Storage" class="text-sel-comp">
                  <img class='imgg card-img-top' src="Images/componenti/ssd/M2/sabrent-rocket-1tb.png">
                  <div class='card-body'>
                    <h4 class='title-obj pt-1'>ARCHIVIAZIONE</h4>
                  </div>
                </a>
              </div>
            </div>
					<!-- <div id="storage" class="icon-text col-lg-3">
            <div class="card">  
              <div class="icon">
                <div class="fit-icons" @mouseover="mostrastorage = true" @mouseleave="mostrastorage = false">
                  <a href="componente.php?tipo=Storage" class="text-sel-comp">
                    <img class="imgg card-img-top" src="./icone/storage.png" width="100px" height="100px">
                    <div class="text-comp">
                      STORAGE
                    </div>
                  </a>
                  <div class="onmouse-text" >
                    <ul class="ul-class" v-if="mostrastorage">
                      <ul class="ul-class"><a href="componente.php?tipo=Hdd" class="text-sel-comp">hdd</a></ul>
                      <ul class="ul-class"><a href="componente.php?tipo=Sdd" class="text-sel-comp">ssd</a></ul>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>-->
            <div class='col-lg-3 icon-text'>
              <div class='card'> 
                <a href="componente.php?tipo=Cooler" class="text-sel-comp">
                  <img class='imgg card-img-top' src="Images/componenti/dissipatori/Liquido/Aaus-rog-strix-LC-240-240mm.png">
                  <div class='card-body'>
                    <h4 class='title-obj pt-1'>DISSIPATORE</h4>
                  </div>
                </a>
              </div>
            </div>            
					<!--<div id="cooling" class="icon-text col-lg-3">
            <div class="card">
              <div class="icon">
                <div class="fit-icons" @mouseover="mostracooling = true" @mouseleave="mostracooling = false">
                  <a href="componente.php?tipo=Cooler" class="text-sel-comp">
                    <img class="imgg card-img-top" src="./icone/fan.png" width="100px" height="100px">
                    <div class="text-comp">
                      DISSIPATORE
                    </div>
                  </a>
                    <div class="onmouse-text" >
                      <ul class="ul-class" v-if="mostracooling">
                        <ul class="ul-class"><a href="componente.php?tipo=Cooler&$stile=aria" class="text-sel-comp">aria</a></ul>
                        <ul class="ul-class"><a href="componente.php?tipo=Cooler&stile=liquido" class="text-sel-comp">liquido</a></ul>
                      </ul>
                    </div>
                </div>
              </div>
            </div>
          </div>-->
            <div class='col-lg-3 icon-text'>
              <div class='card'> 
                <a href="componente.php?tipo=Psu" class="text-sel-comp">
                  <img class='imgg card-img-top' src="Images/componenti/psu/cooler-master-masterwatt-650-semimod-650Watt.png">
                  <div class='card-body'>
                    <h4 class='title-obj pt-1'>ALIMENTATORE</h4>
                  </div>
                </a>
              </div>
            </div>
          <!--<div id="psu" class="icon-text col-lg-3">
            <div class="card">
							<div class="icon">
                <div class="fit-icons" @mouseover="mostrapsu = true" @mouseleave="mostrapsu = false">
                  <a href="componente.php?tipo=Psu" class="text-sel-comp">
                    <img class="imgg card-img-top" src="./icone/psu.png" width="100px" height="100px">
                    <div class="text-comp">
                      ALIMENTATORE
                    </div>
                  </a>
                    <div class="onmouse-text" >
                      <ul class="ul-class" v-if="mostrapsu">
                        <ul class="ul-class"><a href="componente.php?tipo=Psu&stile=modulare" class="text-sel-comp">modualare</a></ul>
                        <ul class="ul-class"><a href="componente.php?tipo=Psu&stile=semi-modualare" class="text-sel-comp">semi-modulare</a></ul>
                        <ul class="ul-class"><a href="componente.php?tipo=Psu&stile=non-modulare" class="text-sel-comp">non modulare</a></ul>
                      </ul>
                    </div>
                </div>
              </div>
            </div>
          </div>-->
            <div class='col-lg-3 icon-text'>
              <div class='card'> 
                <a href="componente.php?tipo=Chassis" class="text-sel-comp">
                  <img class='imgg card-img-top' src="Images/componenti/case/Corsair/Mid-tower/465X.png">
                  <div class='card-body'>
                    <h4 class='title-obj pt-1'>CASE</h4>
                  </div>
                </a>
              </div>
            </div>
					<!--<div id="case" class="icon-text col-lg-3">
            <div class="card">
              <div class="icon">
                <div class="fit-icons" @mouseover="mostracase = true" @mouseleave="mostracase = false">
                  <a href="componente.php?tipo=Chassis" class="text-sel-comp">
                    <img class="imgg card-img-top" src="./icone/case.png" width="100px" height="100px">
                    <div class="text-comp">
                      CASE
                    </div>
                  </a>
                    <div class="onmouse-text" >
                      <ul class="ul-class" v-if="mostracase">
                        <ul class="ul-class"><a href="componente.php?tipo=Chassis&stile=super-tower" class="text-sel-comp">super-tower</a></ul>
                        <ul class="ul-class"><a href="componente.php?tipo=Chassis&stile=full-tower" class="text-sel-comp">full-tower</a></ul>
                        <ul class="ul-class"><a href="componente.php?tipo=Chassis&stile=mid-tower" class="text-sel-comp">mid-tower</a></ul>
                        <ul class="ul-class"><a href="componente.php?tipo=Chassis&stile=micro-atx" class="text-sel-comp">micro-atx</a></ul>
                        <ul class="ul-class"><a href="componente.php?tipo=Chassis&stile=mini-itx" class="text-sel-comp">mini-itx</a></ul>
                      </ul>
                    </div>
                </div>
              </div>
            </div>
          </div>-->
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
	<script src="./js/animazione.js"></script>
</body>
</html>