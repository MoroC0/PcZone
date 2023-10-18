<?php
  //connessione
  include("connect.php");
  //Avvio la sessione
  /*devo usare la session che viene settata a vuoto da sel_componente
    dentro typer ci metto la session che viene in caso modificato dagli script successivi
    devo spacchettare la session in caso ci fossero piu filtri quando torno indietro*/
  session_start();
  //prendo i valori da get e li metto dentro session solo se e'vuota
  //altrimento ci ho gia' inseirito i valori della query 
  $app_tipo='';
  $app_stile='';
  //se accedo da sel_componete ho il valore di GET tipo
  //altrimenti GET tipo é vuoto.
  //quindi se ho volare, faccio il classico
  //altrimenti, non faccio niente
  if(isset($_GET['tipo'])){
    if($_SESSION['tipo']==''){
      //se il get e' storage, metti dentro tipo ssd e hdd
      if($_GET['tipo']=='Storage'){
        //dentro la session ci metto hdd e ssd e poi metto dentro app tipo
        $_SESSION['tipo']='Hdd,Ssd';
        $app_tipo=$_SESSION['tipo'];
      }
      else{
        $_SESSION['tipo']=$_GET['tipo'];
        $app_tipo=$_SESSION['tipo'];
      }
    }
    else{
      foreach ($_SESSION['tipo'] as $value){
        $app_tipo .= "$value,";
      }
    }
  }
  else{
    $_SESSION["cerca"]=$_POST["cerca"];
  }
  //stile dei componenti
  //se gli passo lo stile, lo prendo e lo metto dentro alla varibile di sessione apposita ed un variabile di appoggio
  /*if($_SESSION['stile']=='' && isset($_GET['stile'])){
      $_SESSION['stile']=$_GET['stile'];
      $app_stile=$_SESSION['stile'];
  }*/

?>

<html>
<head>
  <title>PC Zone Componenti</title>
  <meta name="viewport" content="width-device-width, initial-scale=1"/>

  <link rel="stylesheet" type="text/css" href= "css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="./Css/style.css" />
	<link rel="stylesheet" type="text/css" href="./Css/comp.css" />
  <link rel="stylesheet" href="./fontawesome-free-5.13.0-web/css/all.css">

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  
  <script src="./Js/mostra.js"></script>

	<script>
		$(document).ready(function() {
			//in output_tipo ho le variabili della categoria Cpu,Mobo
      var output_tipo="<?php echo $app_tipo ?>";
      //in style ho le varibiali di stile amd,intel 
			var style="<?php echo $app_stile ?>";
			//le divido con la virgola
      var type = output_tipo.split(',');
			var c_tipo='';
				//per tutta la lunghezza di type, seleziono i chekbox
				for(i=0;i<type.length;i++){
					$('.tipo').each(function(){
						var cor = $(this);
						if(cor.val() == type[i]){
							cor.prop('checked', true);
							mostra_nascondi_stile();
							$('#'+type[i]+' .stile').each(function(){
							var now = $(this);
							if(now.val() == style){
								now.prop('checked', true);
							}
						});
					}
        });
			}
      filter_data();
		});
	</script>
	
</head>
<body>	<!--COMPONENTI-->
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
      
			<!--Div per la parte centrale-->
      <div class="container middle">
        <div class="content py-md-0 py-3">
          <section id="sidebar">
            <div>
              <div class="d-flex">
                <h1 class="text-middle-top">Componenti</h1>
              </div>
              <!-- Filtri-->
              <div class="filtri">
                <h5 class="font-weight-bold filtr-clr title">Filtri</h5>
                <ul class="list-group">
                  <li class="select-list-action align-items-center category select-list"><input class="checkbox tipo" id="l_cpu" type="checkbox" value="Cpu"><label class="label-check" for="l_cpu"> Processore</label>
                    <ul class="stile-list menu-ver">
                      <li><input class="checkbox stile" id="intel" type="checkbox" value="intel"><label class="label-stile" for="intel">INTEL</label></li>
                      <li><input class="checkbox stile" id="cpu_amd" type="checkbox" value="amd"><label class="label-stile" for="cpu_amd">AMD</label></li>
                    </ul>
                  </li>
                  <li class="select-list-action align-items-center category select-list"><input class="checkbox tipo" id="l_mobo" type="checkbox" value="Mobo"><label class="label-check" for="l_mobo"> Sheda Madre</label>
                    <ul class="stile-list menu-ver">
                      <li><input class="checkbox stile" id="atx" type="checkbox" value="ATX"><label class="label-stile" for="atx">ATX</label></li>
                      <li><input class="checkbox stile" id="mobo_micro-atx" type="checkbox" value="MICRO-ATX"><label class="label-stile" for="mobo_micro-atx">micro-atx</label></li>
                      <li><input class="checkbox stile" id="mobo_mini-itx" type="checkbox" value="MINI-ITX"><label class="label-stile" for="mobo_mini-itx">mini-itx</label></li>
                    </ul>  
                  </li>
                  <li class="select-list-action align-items-center category select-list"><input class="checkbox tipo" id="l_ram" type="checkbox" value="Ram"><label class="label-check" for="l_ram"> RAM</label>
                    <ul class="stile-list menu-ver">
                      <li><input class="checkbox stile" id="ddr4" type="checkbox" value="DDR4"><label class="label-stile" for="ddr4">DDR4</label></li>
                    </ul>
                  </li>
                  <li class="select-list-action align-items-center category select-list"><input class="checkbox tipo" id="l_gpu" type="checkbox" value="Gpu"><label class="label-check" for="l_gpu"> Scheda Video</label>
                    <ul class="stile-list menu-ver">
                      <li><input class="checkbox stile" id="nvidia" type="checkbox" value="nvidia"><label class="label-stile" for="nvidia">nvidia</label></li>
                      <li><input class="checkbox stile" id="gpu_amd" type="checkbox" value="gamd"><label for="gpu_amd">AMD</label></li>
                    </ul>
                  </li>
                  <li class="select-list-action align-items-center category select-list"><input class="checkbox tipo" id="l_hdd" type="checkbox" value="Hdd"><label class="label-check" for="l_hdd"> Hard-Disk</label>
                    <ul class="stile-list menu-ver">
                      <li><input class="checkbox stile" id="h_2.5" type="checkbox" value="h2.5"><label class="label-stile" for="h_2.5">2.5</label></li>
                      <li><input class="checkbox stile" id="h_3.5" type="checkbox" value="3.5"><label for="h_3.5">3.5</label></li>
                    </ul>
                  </li>
                  <li class="select-list-action align-items-center category select-list"><input class="checkbox tipo" id="l_ssd" type="checkbox" value="Ssd"><label class="label-check" for="l_ssd"> SSD</label>
                    <ul class="stile-list menu-ver">
                      <li><input class="checkbox stile" id="s_2.5" type="checkbox" value="2.5"><label class="label-stile" for="s_2.5">2.5</label></li>
                      <li><input class="checkbox stile" id="s_nvme" type="checkbox" value="NVMe"><label for="s_nvme">NVMe</label></li>
                    </ul>
                  </li>
                  <li class="select-list-action align-items-center category select-list"><input class="checkbox tipo" id="l_cooler" type="checkbox" value="Cooler"><label class="label-check" for="l_cooler"> Dissipatori </label>
                    <ul class="stile-list menu-ver">
                      <li><input class="checkbox stile" id="aria" type="checkbox" value="aria"><label class="label-stile" for="aria">aria</label></li>
                      <li><input class="checkbox stile" id="liquido" type="checkbox" value="liquido"><label class="label-stile" for="liquido">liquido</label></li>
                    </ul>
                  </li>
                  <li class="select-list-action align-items-center category select-list"><input class="checkbox tipo" id="l_psu" type="checkbox" value="Psu"><label class="label-check" for="l_psu"> Alimentatori </label>
                    <ul class="stile-list menu-ver">
                      <li><input class="checkbox stile" id="modulare" type="checkbox" value="modulare"><label class="label-stile" for="modulare">modulare</label>
                      <li><input class="checkbox stile" id="semi-modulare" type="checkbox" value="semi-modulare"><label class="label-stile" for="semi-modulare">semi-modulare</label></li>
                      <li><input class="checkbox stile" id="non-modulare" type="checkbox" value="non-modulare"><label class="label-stile" for="non-modulare">non-modulare</label></li>
                    </ul>
                  </li>
                  <li class="select-list-action align-items-center category select-list"><input class="checkbox tipo" id="l_case" type="checkbox" value="Chassis"><label class="label-check" for="l_chassis"> Case </label>
                    <ul class="stile-list menu-ver">
                      <li><input class="checkbox stile" id="super-tower" type="checkbox" value="super-tower"><label class="label-stile" for="super-tower">super-tower</label></li>
                      <li><input class="checkbox stile" id="full-tower" type="checkbox" value="full-tower"><label class="label-stile" for="full-tower">full-tower</label></li>
                      <li><input class="checkbox stile" id="mid-tower" type="checkbox" value="mid-tower"><label class="label-stile" for="mid-tower">mid-tower</label></li>
                      <li><input class="checkbox stile" id="case_micro-atx" type="checkbox" value="micro-atx"><label class="label-stile" for="case_micro-atx">micro-atx</label></li>
                      <li><input class="checkbox stile" id="case_mini-itx" type="checkbox" value="mini-itx"><label class="label-stile" for="case_mini-itx">mini-itx</label></li>
                    </ul>
                  </li>
                </ul>
                <div class="form-group ctn-ordine">
                <div class='row'>
                  <div class='col-sm' style="padding-bottom: 1rem;">
                    <label class="label-select" for="ordina_per">Ordina per:</label>
                    <select class="form-control ordina" id="ordina_per">
                      <option value="categoria">Categoria</option>
                      <option value="titolo">Nome</option>
                      <option value="prezzo ASC">Prezzo Crescente</option>
                      <option value="prezzo DESC">Prezzo Decrescente</option>
                    </select>
                  </div>
                </div>
                <!-- div per i bottoni <div class='row'>
                  <div class="col">
                    <button type="button" class="glow-on-hover2 btn btn-md btnn" onclick="deseleziona()">Deseleziona tutto</button>
                  </div>
                  <div class="col">
                    <button type="button" class="glow-on-hover2 btn btn-md btnn" onclick="sel_tutto()">Seleziona tutto</button>
                  </div>
                </div>-->
              </div>
            </div>
          </section>
        </div>
        <section id="products">
          <div class="container container-product">
            <div class="row" id="ris" style="margin:auto;">
              <!-- risultati della query -->
            </div>
          </div>
        </section>      
        <br clear="all">
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
