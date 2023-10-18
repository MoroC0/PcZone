<?php
  //connessione
  include("connect.php");
  //Avvio la sessione
  session_start();

  //Prendo i vari id dei componenti scelti nel configuratore dall'utente in sessione
  //Faccio le query in questo modo posso tenere tutte le informazioni di ogni componente dentro una variabile
  if(isset($_GET['cpu'])){
    $vcpu = $_GET['cpu'];
    //query cpu
    $qcpu = "SELECT * FROM componente WHERE (componente.id = $vcpu)";
    $ret=pg_query($dbconn,$qcpu);
    while($row = pg_fetch_row($ret)){
      $cpu = $row;
    }
  }
  if(isset($_GET['mobo'])){
    $vmobo = $_GET['mobo'];
    //query mobo
    $qmobo = "SELECT * FROM componente WHERE (componente.id = $vmobo)";
    $ret=pg_query($dbconn,$qmobo);
    while($row = pg_fetch_row($ret)){
      $mobo = $row;
    }
  }
  if(isset($_GET['ram'])){
    $vram = $_GET['ram'];
    //query ram
    $qram = "SELECT * FROM componente WHERE (componente.id = $vram)";
    $ret=pg_query($dbconn,$qram);
    while($row = pg_fetch_row($ret)){
      $ram = $row;
    }
  }
  if(isset($_GET['gpu'])){
    $vgpu = $_GET['gpu'];
    //query gpu
    $qgpu = "SELECT * FROM componente WHERE (componente.id = $vgpu)";
    $ret=pg_query($dbconn,$qgpu);
    while($row = pg_fetch_row($ret)){
      $gpu = $row;
    }
  }
  if(isset($_GET['ssd'])){
    $vssd = $_GET['ssd'];
    //query storage
    $qssd = "SELECT * FROM componente WHERE (componente.id = $vssd)";
    $ret=pg_query($dbconn,$qssd);
    while($row = pg_fetch_row($ret)){
      $ssd = $row;
    }
  }
  if(isset($_GET['cooler'])){
    $vcooler = $_GET['cooler'];
    //query cooler
    $qcooler = "SELECT * FROM componente WHERE (componente.id = $vcooler)";
    $ret=pg_query($dbconn,$qcooler);
    while($row = pg_fetch_row($ret)){
      $cooler = $row;
    }
  }
  if(isset($_GET['psu'])){
    $vpsu = $_GET['psu'];
    //query psu
    $qpsu = "SELECT * FROM componente WHERE (componente.id = $vpsu)";
    $ret=pg_query($dbconn,$qpsu);
    while($row = pg_fetch_row($ret)){
      $psu = $row;
    }
  }
  if(isset($_GET['case'])){
    $vcase = $_GET['case'];
    //query case
    $qcase = "SELECT * FROM componente WHERE (componente.id = $vcase)";
    $ret=pg_query($dbconn,$qcase);
    while($row = pg_fetch_row($ret)){
      $case = $row;
    }
  }
  if((isset($cpu)) && (isset($mobo)) && (isset($ram)) && (isset($gpu)) && (isset($ssd)) && (isset($cooler)) && (isset($psu)) && (isset($case))){
    $prezzo_tot = $cpu[6]+$mobo[6]+$ram[6]+$gpu[6]+$ssd[6]+$cooler[6]+$psu[6]+$case[6];
  }
  
?>

<html>
<head>
  <title>PC Zone Configurazione</title>

  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  
  <link rel="stylesheet" type="text/css" href= "./Css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="./Css/style.css" />
  <link rel="stylesheet" type="text/css" href= "./Css/conf-comp.css" />
  <link rel="stylesheet" href="./fontawesome-free-5.13.0-web/css/all.css">

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script src="./Js/salva_config.js"></script>
  <script src="./Js/carrello.js"> </script>

</head>
<body class="body_t">       <!--CONFIGURAZIONE-->
<div class="page-container">

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

    <!--Vecchia Versione-->
    <!--<div class="container middle">
        <div class="container-desc">
          <!--<div class="row">
            <div class="row row-desc">
                <!--DIV PER L'IMAMGINE
                <div class="col-4 item-photo">
                  <div id="carouselExampleIndicators" style="width: 400px" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="item-img"  src="<?php if(isset($cpu)){ echo($cpu[5]);} ?>" alt="First slide">
                      </div>
                      <div class="carousel-item">
                        <img class="item-img"  src="<?php if(isset($mobo)){ echo($mobo[5]);}?>" alt="Second slide">
                      </div>
                      <div class="carousel-item">
                        <img class="item-img" src="<?php if(isset($ram)){ echo($ram[5]);}?>" alt="Third slide">
                      </div>
                      <div class="carousel-item">
                        <img class="item-img" src="<?php if(isset($gpu)){ echo($gpu[5]);}?>" alt="Third slide">
                      </div>
                      <div class="carousel-item">
                        <img class="item-img" src="<?php if(isset($ssd)){ echo($ssd[5]);}?>" alt="Third slide">
                      </div>
                      <div class="carousel-item">
                        <img class="item-img" src="<?php if(isset($cooler)){ echo($cooler[5]);}?>" alt="Third slide">
                      </div>
                      <div class="carousel-item">
                        <img class="item-img" src="<?php if(isset($psu)){ echo($psu[5]);}?>" alt="Third slide">
                      </div>
                      <div class="carousel-item">
                        <img class="item-img" src="<?php if(isset($case)){ echo($case[5]);}?>" alt="Third slide">
                      </div>

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                </div>
                <!-- TITOLO E ALTRI DATI DEL COMPONENTE  <i class="fas fa-euro-sign"></i>
                <div class="col-8">
                  <h3 class="title-name">Riepilogo Configurazione</h3>
                  <!--CPU
                  <div class="row mb-1 sub">
                    <div class="col-2">
                      <div class="title2">CPU:</div>
                    </div>
                    <div class="col">
                      <span class="title name2"><?php if(isset($cpu)){ echo($cpu[1]);}?> </span> 
                    </div>
                    <div class="col-2">
                      <!--<span class="title"><!--| Prezzo:
                        <div class="title name2 prezzo-euro"> <?php if(isset($cpu)){ echo(number_format($cpu[6],2));}?> €
                        </div>
                      <!--</span>
                    </div>
                  </div>
                  <!--<a href="desc_componente.php?id=<?php if(isset($cpu)){ echo($cpu[0]);}?>&tipo=Cpu"><span class="link">Link alle specifiche</span></a>
                  
                  <!--MOBO-->
                  <!--MOBO vecchia struttura
                  <p class="title">MOTHERBOARD: 
                    <span class="title name"><?php if(isset($mobo)){ echo($mobo[2]);}?></span>
                    <span class="title">| Prezzo: 
                      <span class="title name"><?php if(isset($mobo)){ echo($mobo[6]);}?> €
                      </span>
                  </span>
                  </p>
                  <a href="desc_componente.php?id=<?php if(isset($mobo)){ echo($mobo[0]);}?>&tipo=Mobo"><span class="link">Link alle specifiche</span></a>
                      -->
                  <!--MOBO nuova struttura
                  <div class="row mb-1 sub">
                    <div class="col-2">
                      <div class="title2">MOTHERBOARD:</div>
                    </div>
                    <div class="col">
                      <span class="title name2"><?php if(isset($mobo)){ echo($mobo[1]);}?> </span> 
                    </div>
                    <div class="col-2">
                      <!--<span class="title"> <!--| Prezzo:
                        <div class="title name2 prezzo-euro"> <?php if(isset($mobo)){ echo(number_format($mobo[6],2));}?> €
                        </div>
                      <!--</span>
                    </div>
                  </div>
                  <!--<a href="desc_componente.php?id=<?php if(isset($mobo)){ echo($mobo[0]);}?>&tipo=Mobo"><span class="link">Link alle specifiche</span></a>

                  <!--RAM-->
                  <!--RAM vecchi struttura
                  <p class="title">RAM: 
                    <span class="title name"><?php if(isset($ram)){ echo($ram[2]);}?>
                    </span>
                    <span class="title">| Prezzo: 
                      <span class="title name"><?php if(isset($ram)){ echo($ram[6]);}?> €
                      </span>
                    </span>
                  </p>
                  <a href="desc_componente.php?id=<?php if(isset($ram)){ echo($ram[0]);}?>&tipo=Ram"><span class="link">Link alle specifiche</span></a>
                  -->
                  <!--RAM nuova struttura
                  <div class="row mb-1 sub">
                    <div class="col-2">
                      <div class="title2">RAM:</div>
                    </div>
                    <div class="col">
                      <span class="title name2"><?php if(isset($ram)){ echo($ram[1]);}?> </span> 
                    </div>
                    <div class="col-2">
                      <!--<span class="title"><!--| Prezzo: 
                        <div class="title name2 prezzo-euro"> <?php if(isset($ram)){ echo(number_format($ram[6],2));}?> €
                        </div>
                      <!--</span>
                    </div>
                  </div>
                  <!--<a href="desc_componente.php?id=<?php if(isset($ram)){ echo($ram[0]);}?>&tipo=Ram"><span class="link">Link alle specifiche</span></a>
                  
                  <!-- GPU -->
                  <!-- GPU vecchia
                  <p class="title">GPU: <span class="title name"><?php if(isset($gpu)){ echo($gpu[2]);}?></span><span class="title">| Prezzo: <span class="title name"><?php if(isset($gpu)){ echo($gpu[6]);}?> €</span></span></p>
                  <a href="desc_componente.php?id=<?php if(isset($gpu)){ echo($gpu[0]);}?>&tipo=Gpu"><span class="link">Link alle specifiche</span></a>
                      -->
                  <!-- GPU nuova
                  <div class="row mb-1 sub">
                    <div class="col-2">
                      <div class="title2">GPU:</div>
                    </div>
                    <div class="col">
                      <span class="title name2"><?php if(isset($gpu)){ echo($gpu[1]);}?> </span> 
                    </div>
                    <div class="col-2">
                      <!--<span class="title"><!--| Prezzo:
                        <div class="title name2 prezzo-euro"> <?php if(isset($gpu)){ echo(number_format($gpu[6],2));}?> €
                        </div>
                      <!--</span>
                    </div>
                  </div>
                  <!--<a href="desc_componente.php?id=<?php if(isset($gpu)){ echo($gpu[0]);}?>&tipo=Gpu"><span class="link">Link alle specifiche</span></a>
                  
                  <!-- STORAGE -->
                  <!-- STORAGE vecchia
                  <p class="title">STORAGE: <span class="title name"><?php if(isset($ssd)){ echo($ssd[2]);}?></span><span class="title">| Prezzo: <span class="title name"><?php if(isset($ssd)){ echo($ssd[6]);}?> €</span></span></p>
                  <a href="desc_componente.php?id=<?php if(isset($ssd)){ echo($ssd[0]);}?>&tipo=Ssd"><span class="link">Link alle specifiche</span></a>
                      -->
                  <!-- STORAGE nuova
                  <div class="row mb-1 sub">
                    <div class="col-2">
                      <div class="title2">STORAGE:</div>
                    </div>
                    <div class="col">
                      <span class="title name2"><?php if(isset($ssd)){ echo($ssd[1]);}?> </span> 
                    </div>
                    <div class="col-2">
                      <!--<span class="title"><!--| Prezzo:
                        <div class="title name2 prezzo-euro"> <?php if(isset($ssd)){ echo(number_format($ssd[6],2));}?> €
                        </div>
                      <!--</span
                    </div>
                  </div>
                  <!--<a href="desc_componente.php?id=<?php if(isset($ssd)){ echo($ssd[0]);}?>&tipo=Ssd"><span class="link">Link alle specifiche</span></a>

                  <!-- COOLER -->
                  <!-- COOLER vecchia
                  <p class="title">DISSIPATORE: <span class="title name"><?php if(isset($cooler)){ echo($cooler[2]);}?></span><span class="title">| Prezzo: <span class="title name"><?php if(isset($cooler)){ echo($cooler[6]);}?> €</span></span></p>
                  <a href="desc_componente.php?id=<?php if(isset($cooler)){ echo($cooler[0]);}?>&tipo=Cooler"><span class="link">Link alle specifiche</span></a>
                      -->
                  <!-- COOLER nuova
                  <div class="row mb-1 sub">
                    <div class="col-2">
                      <div class="title2">DISSIPATORE:</div>
                    </div>
                    <div class="col">
                      <span class="title name2"><?php if(isset($cooler)){ echo($cooler[1]);}?> </span> 
                    </div>
                    <div class="col-2">
                      <!--<span class="title"><!--| Prezzo:
                        <div class="title name2 prezzo-euro"> <?php if(isset($cooler)){ echo(number_format($cooler[6],2));}?> €
                        </div>
                      <!--</span>
                    </div>
                  </div>
                  <!--<a href="desc_componente.php?id=<?php if(isset($cooler)){ echo($cooler[0]);}?>&tipo=Cooler"><span class="link">Link alle specifiche</span></a>
                  
                  <!-- PSU -->
                  <!-- PSU vecchia
                  <p class="title">ALIMENTATORE: <span class="title name"><?php if(isset($psu)){ echo($psu[2]);}?></span><span class="title">| Prezzo: <span class="title name"><?php if(isset($psu)){ echo($psu[6]);}?> €</span></span></p>
                  <a href="desc_componente.php?id=<?php if(isset($psu)){ echo($psu[0]);}?>&tipo=Psu"><span class="link">Link alle specifiche</span></a>
                      -->
                  <!-- PSU nuova
                  <div class="row mb-1 sub">
                    <div class="col-2">
                      <div class="title2">ALIMENTATORE:</div>
                    </div>
                    <div class="col">
                      <span class="title name2"><?php if(isset($psu)){ echo($psu[1]);}?> </span> 
                    </div>
                    <div class="col-2">
                      <!--<span class="title"><!--| Prezzo:
                        <div class="title name2 prezzo-euro"> <?php if(isset($psu)){ echo(number_format($psu[6],2));}?> €
                        </div>
                      <!--</span>
                    </div>
                  </div>
                  <!--<a href="desc_componente.php?id=<?php if(isset($psu)){ echo($psu[0]);}?>&tipo=Psu"><span class="link">Link alle specifiche</span></a>
                  
                  <!-- CASE -->
                  <!-- CASE vecchia
                  <p class="title">CASE: <span class="title name"><?php if(isset($case)){ echo($case[2]);}?></span><span class="title">| Prezzo: <span class="title name"><?php if(isset($case)){ echo($case[6]);}?> €</span></span></p>
                  <a href="desc_componente.php?id=<?php if(isset($case)){ echo($case[0]);}?>&tipo=Chassis"><span class="link">Link alle specifiche</span></a>
                      -->
                  <!-- CASE nuova
                  <div class="row mb-1 sub">
                    <div class="col-2">
                      <div class="title2">CASE:</div>
                    </div>
                    <div class="col">
                      <span class="title name2"><?php if(isset($case)){ echo($case[1]);}?> </span> 
                    </div>
                    <div class="col-2">
                      <!--<span class="title"><!--| Prezzo:
                        <div class="title name2 prezzo-euro"> <?php if(isset($case)){ echo(number_format($case[6],2));}?> €
                        </div>
                      <!--</span>
                    </div>
                  </div>
                  <!--<a href="desc_componente.php?id=<?php if(isset($case)){ echo($case[0]);}?>&tipo=Chassis"><span class="link">Link alle specifiche</span></a>
                      
                  <div class="row mb-1">
                    <!-- PREZZO TOTALE 
                    <div class="col-5">
                      <p class="title2" style="margin-top: 20px;">PREZZO TOTALE: 
                      <span class="title name2"><?php if(isset($prezzo_tot)){ echo($prezzo_tot);}?> €</span></p>
                    </div>
                    <div class="col"></div>
                    <div class="col-6">
                      <!-- BOTTONE AGGIUNGI AL CARRELLO 
                      <div class="section">
                        <button class="btn btn-success" id="add_to_cart_conf" title="Aggiungi al carrello" data-cpu="<?php if(isset($vcpu)){ echo($vcpu);}?>" data-mobo="<?php if(isset($vmobo)){ echo($vmobo);}?>" data-ram="<?php if(isset($vram)){ echo($vram);}?>" data-gpu="<?php if(isset($vgpu)){ echo($vgpu);}?>" data-ssd="<?php if(isset($vssd)){ echo($vssd);}?>" data-cooler="<?php if(isset($vcooler)){ echo($vcooler);}?>" data-psu="<?php if(isset($vpsu)){ echo($vpsu);}?>" data-case="<?php if(isset($vcase)){ echo($vcase);}?>"><i class="fas fa-shopping-cart" style="margin-right: 5px;" ></i> AGGIUNGI AL CARRELLO</button>
                      </div>
                    </div>                                    
                  </div>
                  
                </div>                             
            </div>
          <!--</div>
          <div class="row row-assembly">
            <div class="col-6">
              <div class="section-left">
                <a href="configuratore.php"><button class="btn btn-danger" style="width: 250px;"><i class="fas fa-undo-alt" style="margin-right: 5px;"></i> ANNULLA</button></a>
              </div>
            </div>
            <div class="col-6">
              <div class="section-right">
                <button class="btn btn-success" id="salva" style="width: 250px;" data-cpu="<?php if(isset($vcpu)){ echo($vcpu);}?>" data-mobo="<?php if(isset($vmobo)){ echo($vmobo);}?>" data-ram="<?php if(isset($vram)){ echo($vram);}?>" data-gpu="<?php if(isset($vgpu)){ echo($vgpu);}?>" data-ssd="<?php if(isset($vssd)){ echo($vssd);}?>" data-cooler="<?php if(isset($vcooler)){ echo($vcooler);}?>" data-psu="<?php if(isset($vpsu)){ echo($vpsu);}?>" data-case="<?php if(isset($vcase)){ echo($vcase);}?>" data-prezzo="<?php if(isset($prezzo_tot)){ echo($prezzo_tot);}?>"><i class="far fa-save" style="margin-right: 5px;"></i> SALVA</button>
                    <?php
                    if(!isset($_SESSION["user"])){
                      echo "<script language='JavaScript'> nascondi_btn(); </script>";
                    }
                    else{
                      echo "<script language='JavaScript'> mostra_btn(); </script>";
                    }
                    ?>
              </div>
            </div>
          </div>
      </div>        
    
    </div>

    <!--Versione MK2 -->
    <div class="container middle">
    <h3 class="title-name">Riepilogo Configurazione</h3>
      <div class="container-desc">
        <!--<div class="row">-->
          <div class="row row-desc">
              <!--DIV PER L'IMAMGINE-->
              <div class="col-4 item-photo">
                <div id="carouselExampleIndicators" style="width: 400px" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="item-img"  src="<?php if(isset($cpu)){ echo($cpu[5]);} ?>" alt="First slide">
                    </div>
                    <div class="carousel-item">
                      <img class="item-img"  src="<?php if(isset($mobo)){ echo($mobo[5]);}?>" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                      <img class="item-img" src="<?php if(isset($ram)){ echo($ram[5]);}?>" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                      <img class="item-img" src="<?php if(isset($gpu)){ echo($gpu[5]);}?>" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                      <img class="item-img" src="<?php if(isset($ssd)){ echo($ssd[5]);}?>" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                      <img class="item-img" src="<?php if(isset($cooler)){ echo($cooler[5]);}?>" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                      <img class="item-img" src="<?php if(isset($psu)){ echo($psu[5]);}?>" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                      <img class="item-img" src="<?php if(isset($case)){ echo($case[5]);}?>" alt="Third slide">
                    </div>

                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>
              <!-- TITOLO E ALTRI DATI DEL COMPONENTE  <i class="fas fa-euro-sign"></i> -->
              <div class="col-8 col-desc-padding">
                <!--CPU-->
                <div class="row mb-1 sub">
                  <div class="col-3 align-self-center">
                    <div class="title">CPU:</div>
                  </div>
                  <div class="col">
                    <span class="title name"><?php if(isset($cpu)){ echo($cpu[1]);}?> </span> 
                  </div>
                  <div class="col-3">
                    <!--<span class="title"><!--| Prezzo: -->
                      <div class="title name prezzo-euro"> <?php if(isset($cpu)){ echo(number_format($cpu[6],2));}?> €
                      </div>
                    <!--</span>-->
                  </div>
                </div>
                <!--<a href="desc_componente.php?id=<?php if(isset($cpu)){ echo($cpu[0]);}?>&tipo=Cpu"><span class="link">Link alle specifiche</span></a>
                
                <!--MOBO-->
                <!--MOBO vecchia struttura
                <p class="title">MOTHERBOARD: 
                  <span class="title name"><?php if(isset($mobo)){ echo($mobo[2]);}?></span>
                  <span class="title">| Prezzo: 
                    <span class="title name"><?php if(isset($mobo)){ echo($mobo[6]);}?> €
                    </span>
                </span>
                </p>
                <a href="desc_componente.php?id=<?php if(isset($mobo)){ echo($mobo[0]);}?>&tipo=Mobo"><span class="link">Link alle specifiche</span></a>
                    -->
                <!--MOBO nuova struttura-->
                <div class="row mb-1 sub">
                  <div class="col-3 align-self-center">
                    <div class="title">MOTHERBOARD:</div>
                  </div>
                  <div class="col align-self-center">
                    <span class="title name"><?php if(isset($mobo)){ echo($mobo[1]);}?> </span> 
                  </div>
                  <div class="col-3 align-self-center">
                    <!--<span class="title"> <!--| Prezzo: -->
                      <div class="title name prezzo-euro"> <?php if(isset($mobo)){ echo(number_format($mobo[6],2));}?> €
                      </div>
                    <!--</span>-->
                  </div>
                </div>
                <!--<a href="desc_componente.php?id=<?php if(isset($mobo)){ echo($mobo[0]);}?>&tipo=Mobo"><span class="link">Link alle specifiche</span></a>

                <!--RAM-->
                <!--RAM vecchi struttura
                <p class="title">RAM: 
                  <span class="title name"><?php if(isset($ram)){ echo($ram[2]);}?>
                  </span>
                  <span class="title">| Prezzo: 
                    <span class="title name"><?php if(isset($ram)){ echo($ram[6]);}?> €
                    </span>
                  </span>
                </p>
                <a href="desc_componente.php?id=<?php if(isset($ram)){ echo($ram[0]);}?>&tipo=Ram"><span class="link">Link alle specifiche</span></a>
                -->
                <!--RAM nuova struttura-->
                <div class="row mb-1 sub">
                  <div class="col-3 align-self-center">
                    <div class="title">RAM:</div>
                  </div>
                  <div class="col align-self-center">
                    <span class="title name"><?php if(isset($ram)){ echo($ram[1]);}?> </span> 
                  </div>
                  <div class="col-3 align-self-center">
                    <!--<span class="title"><!--| Prezzo: -->
                      <div class="title name prezzo-euro"> <?php if(isset($ram)){ echo(number_format($ram[6],2));}?> €
                      </div>
                    <!--</span>-->
                  </div>
                </div>
                <!--<a href="desc_componente.php?id=<?php if(isset($ram)){ echo($ram[0]);}?>&tipo=Ram"><span class="link">Link alle specifiche</span></a>
                
                <!-- GPU -->
                <!-- GPU vecchia
                <p class="title">GPU: <span class="title name"><?php if(isset($gpu)){ echo($gpu[2]);}?></span><span class="title">| Prezzo: <span class="title name"><?php if(isset($gpu)){ echo($gpu[6]);}?> €</span></span></p>
                <a href="desc_componente.php?id=<?php if(isset($gpu)){ echo($gpu[0]);}?>&tipo=Gpu"><span class="link">Link alle specifiche</span></a>
                    -->
                <!-- GPU nuova-->
                <div class="row mb-1 sub">
                  <div class="col-3 align-self-center">
                    <div class="title">GPU:</div>
                  </div>
                  <div class="col align-self-center">
                    <span class="title name"><?php if(isset($gpu)){ echo($gpu[1]);}?> </span> 
                  </div>
                  <div class="col-3 align-self-center">
                    <!--<span class="title"><!--| Prezzo: -->
                      <div class="title name prezzo-euro"> <?php if(isset($gpu)){ echo(number_format($gpu[6],2));}?> €
                      </div>
                    <!--</span>-->
                  </div>
                </div>
                <!--<a href="desc_componente.php?id=<?php if(isset($gpu)){ echo($gpu[0]);}?>&tipo=Gpu"><span class="link">Link alle specifiche</span></a>
                
                <!-- STORAGE -->
                <!-- STORAGE vecchia
                <p class="title">STORAGE: <span class="title name"><?php if(isset($ssd)){ echo($ssd[2]);}?></span><span class="title">| Prezzo: <span class="title name"><?php if(isset($ssd)){ echo($ssd[6]);}?> €</span></span></p>
                <a href="desc_componente.php?id=<?php if(isset($ssd)){ echo($ssd[0]);}?>&tipo=Ssd"><span class="link">Link alle specifiche</span></a>
                    -->
                <!-- STORAGE nuova-->
                <div class="row mb-1 sub">
                  <div class="col-3 align-self-center">
                    <div class="title">STORAGE:</div>
                  </div>
                  <div class="col align-self-center">
                    <span class="title name"><?php if(isset($ssd)){ echo($ssd[1]);}?> </span> 
                  </div>
                  <div class="col-3 align-self-center">
                    <!--<span class="title"><!--| Prezzo: -->
                      <div class="title name prezzo-euro"> <?php if(isset($ssd)){ echo(number_format($ssd[6],2));}?> €
                      </div>
                    <!--</span>-->
                  </div>
                </div>
                <!--<a href="desc_componente.php?id=<?php if(isset($ssd)){ echo($ssd[0]);}?>&tipo=Ssd"><span class="link">Link alle specifiche</span></a>

                <!-- COOLER -->
                <!-- COOLER vecchia
                <p class="title">DISSIPATORE: <span class="title name"><?php if(isset($cooler)){ echo($cooler[2]);}?></span><span class="title">| Prezzo: <span class="title name"><?php if(isset($cooler)){ echo($cooler[6]);}?> €</span></span></p>
                <a href="desc_componente.php?id=<?php if(isset($cooler)){ echo($cooler[0]);}?>&tipo=Cooler"><span class="link">Link alle specifiche</span></a>
                    -->
                <!-- COOLER nuova-->
                <div class="row mb-1 sub">
                  <div class="col-3 align-self-center">
                    <div class="title">DISSIPATORE:</div>
                  </div>
                  <div class="col align-self-center">
                    <span class="title name"><?php if(isset($cooler)){ echo($cooler[1]);}?> </span> 
                  </div>
                  <div class="col-3 align-self-center">
                    <!--<span class="title"><!--| Prezzo: -->
                      <div class="title name prezzo-euro"> <?php if(isset($cooler)){ echo(number_format($cooler[6],2));}?> €
                      </div>
                    <!--</span>-->
                  </div>
                </div>
                <!--<a href="desc_componente.php?id=<?php if(isset($cooler)){ echo($cooler[0]);}?>&tipo=Cooler"><span class="link">Link alle specifiche</span></a>
                
                <!-- PSU -->
                <!-- PSU vecchia
                <p class="title">ALIMENTATORE: <span class="title name"><?php if(isset($psu)){ echo($psu[2]);}?></span><span class="title">| Prezzo: <span class="title name"><?php if(isset($psu)){ echo($psu[6]);}?> €</span></span></p>
                <a href="desc_componente.php?id=<?php if(isset($psu)){ echo($psu[0]);}?>&tipo=Psu"><span class="link">Link alle specifiche</span></a>
                    -->
                <!-- PSU nuova-->
                <div class="row mb-1 sub">
                  <div class="col-3 align-self-center">
                    <div class="title">ALIMENTATORE:</div>
                  </div>
                  <div class="col align-self-center">
                    <span class="title name"><?php if(isset($psu)){ echo($psu[1]);}?> </span> 
                  </div>
                  <div class="col-3 align-self-center">
                    <!--<span class="title"><!--| Prezzo: -->
                      <div class="title name prezzo-euro"> <?php if(isset($psu)){ echo(number_format($psu[6],2));}?> €
                      </div>
                    <!--</span>-->
                  </div>
                </div>
                <!--<a href="desc_componente.php?id=<?php if(isset($psu)){ echo($psu[0]);}?>&tipo=Psu"><span class="link">Link alle specifiche</span></a>
                
                <!-- CASE -->
                <!-- CASE vecchia
                <p class="title">CASE: <span class="title name"><?php if(isset($case)){ echo($case[2]);}?></span><span class="title">| Prezzo: <span class="title name"><?php if(isset($case)){ echo($case[6]);}?> €</span></span></p>
                <a href="desc_componente.php?id=<?php if(isset($case)){ echo($case[0]);}?>&tipo=Chassis"><span class="link">Link alle specifiche</span></a>
                    -->
                <!-- CASE nuova-->
                <div class="row mb-1 sub-last">
                  <div class="col-3 align-self-center">
                    <div class="title">CASE:</div>
                  </div>
                  <div class="col align-self-center">
                    <span class="title name"><?php if(isset($case)){ echo($case[1]);}?> </span> 
                  </div>
                  <div class="col-3 align-self-center">
                    <!--<span class="title"><!--| Prezzo: -->
                      <div class="title name prezzo-euro"> <?php if(isset($case)){ echo(number_format($case[6],2));}?> €
                      </div>
                    <!--</span>-->
                  </div>
                </div>
                <!--<a href="desc_componente.php?id=<?php if(isset($case)){ echo($case[0]);}?>&tipo=Chassis"><span class="link">Link alle specifiche</span></a>
                    -->
                <div class="row mb-1 sub-last">
                  <!-- PREZZO TOTALE -->
                  <div class="col-6 align-self-center">
                    <p class="title-box">TOTALE: </p>
                  </div>
                  <div class="col-6 align-self-center">
                    <div class="title name prezzo-euro-final"><?php if(isset($prezzo_tot)){ echo($prezzo_tot);}?> €</div>
                  </div>                                    
                </div>
                
              </div>                             
          </div>
        <!--</div>-->
        <div class="row row-assembly justify-content-end">
          <div class="col-3 align-self-center">
            <!--<div class="section-left">-->
              <a href="configuratore.php"><button class="btn btn-lg btn-danger" style="width: 250px;"><i class="fas fa-undo-alt" style="margin-right: 5px;"></i> ANNULLA</button></a>
            <!--</div>-->
          </div>
          <div class="col-3 align-self-center">
            <!--<div class="section-right">-->
              <button class="btn btn-lg btn-warning" id="salva" style="width: 250px; float:left;" data-cpu="<?php if(isset($vcpu)){ echo($vcpu);}?>" data-mobo="<?php if(isset($vmobo)){ echo($vmobo);}?>" data-ram="<?php if(isset($vram)){ echo($vram);}?>" data-gpu="<?php if(isset($vgpu)){ echo($vgpu);}?>" data-ssd="<?php if(isset($vssd)){ echo($vssd);}?>" data-cooler="<?php if(isset($vcooler)){ echo($vcooler);}?>" data-psu="<?php if(isset($vpsu)){ echo($vpsu);}?>" data-case="<?php if(isset($vcase)){ echo($vcase);}?>" data-prezzo="<?php if(isset($prezzo_tot)){ echo($prezzo_tot);}?>"><i class="far fa-save" style="margin-right: 5px;"></i> SALVA</button>
                  <?php
                  if(!isset($_SESSION["user"])){
                    echo "<script language='JavaScript'> nascondi_btn(); </script>";
                  }
                  else{
                    echo "<script language='JavaScript'> mostra_btn(); </script>";
                  }
                  ?>
            <!--</div>-->
          </div>
          <div class="col-6 align-items-center">
            <!-- BOTTONE AGGIUNGI AL CARRELLO -->
            <!--<div class="section">-->
              <button class="btn btn-lg btn-success btn-block" style="float:right;" id="add_to_cart_conf" title="Aggiungi al carrello" data-cpu="<?php if(isset($vcpu)){ echo($vcpu);}?>" data-mobo="<?php if(isset($vmobo)){ echo($vmobo);}?>" data-ram="<?php if(isset($vram)){ echo($vram);}?>" data-gpu="<?php if(isset($vgpu)){ echo($vgpu);}?>" data-ssd="<?php if(isset($vssd)){ echo($vssd);}?>" data-cooler="<?php if(isset($vcooler)){ echo($vcooler);}?>" data-psu="<?php if(isset($vpsu)){ echo($vpsu);}?>" data-case="<?php if(isset($vcase)){ echo($vcase);}?>"><i class="fas fa-shopping-cart" style="margin-right: 5px;" ></i> AGGIUNGI AL CARRELLO</button>
            <!--</div>-->
          </div>
        </div>
      </div>        
    </div>


    <footer class="footer" style="position:relative">
      <div class="container">
        <span class="text-muted">HTML Project</span>
        <br>
        <span class="text-muted">Created by Fabio Sestito & Leonardo Morocutti</span>
    </div>
  </footer>
</div>
</body>
</html>