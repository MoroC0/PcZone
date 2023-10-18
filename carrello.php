<?php
  //pagina per vedere il contenuto effettivo del carrello

    //connessione
    include('connect.php');
    //sessione
    session_start();
    $total_price = 0;
    $n_ogg = $_SESSION["n_ogg_carr"];
    $output = '';
    //se carrelo non e' vuoto, prendo le componenti 
    if(isset($_SESSION["carrello"])){
      foreach($_SESSION["carrello"] as $keys => $values){
        $query = 'SELECT * FROM componente WHERE id = '.$values["id_comp"].'';
        $row = pg_fetch_row(pg_query($dbconn, $query));
        $output .= '
        <div class="ibox-content">
          <div class="table-responsive">
            <table class="table shoping-cart-table">
              <tbody>
                <tr>
                  <td width="150">
                    <div class="img">
                      <img src='.$row[5].' class="card-img-top imgg">
                    </div>
                  </td>
                  <td class="desc">
                    <a href="desc_componente.php?id='.$row[0].'&tipo='.$row[9].'" class="text-navy">
                      <!--titolo-->
                      '.$row[1].'
                    </a>
                    <p class="frst-maius">
                      <!--nome-->
                      '.$row[2].' 
                    </p>
                    <div class="m-t-sm">
                      <button class="btn btn-white cancella" id="'.$row[0].'"><i class="fas fa-trash cancl"></i> Rimuovi dal carrello</button>
                    </div>
                  </td>
                  <!--<td>-->
                  <!--prezzo-->
                    <!--'.$row[6].'€
                  </td>-->
                  <td width="65">
                      <p class="form-control box-quantita">'.$values["quantita"].' </p>
                  </td>
                  <td>
                    <h4 class="prezzo">
                    <!--prezzo per quantita-->
                      '.number_format($values["quantita"] * $row[6], 2).'€
                    </h4>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>';
        $total_price = $total_price + ($values["quantita"] * $row[6]);
      }
    }
    //altrimenti il carrello e' vuoto
    else{
      $output .= "
              <div class='col ml-4'>
                <h1> IL CARRELLO É VUOTO</h1>
              </div>";
    }
?>

<html>
<head>
  <title>Pc Zone Carrello</title>
  <link rel="stylesheet" href="./Css/bootstrap.min.css" />
  <link rel="stylesheet" href="./Css/style.css" />
  <link rel="stylesheet" href="./Css/carrello.css" />
  <link rel="stylesheet" href="./fontawesome-free-5.13.0-web/css/all.css">

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  
  <script src="./Js/carrello.js"> </script>
</head>
  <body><!--CARRELLO-->
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

        <div class="container middle">
          <!--<div class="title"><h1 class="text-middle-top">Carrello</h1></div>-->
          <div class="wrapper">
            <div class="row">
              <div class="col-md-9">
                <div class="ibox">
                  <div class="ibox-title">
                    <h5 class="cart-title">Componenti nel carrello (<?php echo($n_ogg)?>)</h5>
                  </div>
                  <?php echo($output)?>
                  <div class="ibox-content btn-riep">
                    <a href="sel_componente.php"><button class="btn btn-white"><i class="fas fa-arrow-left"></i> Torna allo shopping</button></a>
                    <button class="btn btn-white" id='svuota' style="float:right"><i class="fa fa-times-circle cancl"></i> Svuota carrello</button>    
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="ibox">
                  <div class="ibox-title">
                    <h5 class="tlt-riep">Riepilogo</h5>
                  </div>
                  <div class="ibox-content btn-riep">
                    <h3 class="text-navy tot">Totale</h3>
                    <h2 class="font-bold" style="font-size: 35px;"><?php echo($total_price);?> €</h2>
                    <hr style="border-top: 1px solid white;">
                    <div class="m-t-sm">
                      <div class="btn-group">
                        <a href="checkout.php?prezzo=<?php echo($total_price)?>"> <button class="glow-on-hover3 btn btn-block" id="checkout"><i class="fas fa-shopping-cart"></i> Checkout</button></a>
                      </div>
                      <?php
                        if(isset($_SESSION['user'])){
                          echo "<script language='JavaScript'> mostra(); </script>"; 
                        }
                        else{
                          echo "<script language='JavaScript'> nascondi_user(); </script>";
                        }
                        if(isset($_SESSION['carrello'])){
                          echo "<script language='JavaScript'> mostra_svuota(); </script>";
                        }
                        else{
                          echo "<script language='JavaScript'> nascondi_carr(); </script>"; 
                          echo "<script language='JavaScript'> nascondi_svuota(); </script>"; 
                        }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>