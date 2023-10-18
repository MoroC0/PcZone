<html>
<head>
  <title>Pc Zone Registrati</title>
  <meta name="viewport" content="width=device−width , initial−scale=1"/>
  
  <link rel="stylesheet" type="text/css" href= "./Css/bootstrap.min.css" />
  <link rel="stylesheet" href="./Css/style.css" />
  <link rel="stylesheet" href="./fontawesome-free-5.13.0-web/css/all.css">
  <link rel="stylesheet" href="./Css/floating-labels.css" />
  <link rel="stylesheet" href="./Css/reg.css" />
  

  <!--SCRIPT-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="./Js/reg-login.js"></script>

</head>
<body class="body" style="display: block;">
  <div class="page" id="blur">
    
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
    <!--<div class="py-4 text-center" style="margin-top: 2%;">
      <img class="d-block mx-auto" src="./Images/Logo.png" alt="" height="100px" width="300px">
    </div>-->

    <!-- VECCHIO FORM REGISTRAZIONE --> 
    <!--
    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span style="color: white;">Regole per la registrazione: </span>
        </h4>
        <div class="mb-4" style="height: 50px; border-bottom: 1px solid white;">
          <div style="padding-top: 12px; text-align: center; color: lime;"> 
            Inserirsci solo lettere nel nome e cognome
          </div> 
        </div>
        <div class="mb-4" style="height: 50px; border-bottom: 1px solid  white;">
          <div style="padding-top: 12px; text-align: center; color: lime;"> 
            Non mettere caratteri speciali nel Nickname.
          </div>
        </div>
        <div class="mb-4" style="height: 50px; border-bottom: 1px solid  white;">
          <div style="padding-top: 12px; text-align: center; color: lime;"> 
            Inserirsci una @ e un .  nella email.
          </div> 
        </div>
        <div class="mb-4" style="height: 50px; border-bottom: 1px solid  white;">
          <div style="padding-top: 12px; text-align: center; color: lime;"> 
            Inserisci il telefono per ricevere informazioni
          </div> 
        </div>
        <div class="mb-4" style="height: 50px; border-bottom: 1px solid  white;">
          <div style="padding-top: 12px; text-align: center; color: lime;"> 
            Inserisci una Regione ed una citta con il cap
          </div> 
        </div>
        <div class="mb-4" style="height: 50px; border-bottom: 1px solid  white;">
          <div style="padding-top: 12px; text-align: center; color: lime;"> 
            Password: Tra i 6 e i 12 caratteri
          </div> 
        </div>
      </div>
      <div class="col-md-7 order-md-1">
        <h4 class="mb-3" style="color: honeydew;">Registrati</h4>
        <form id="form" class="needs-validation" novalidate method="POST">
          <div class="row">
            <div class="col-md-6 mb-4">
              <div class="form-label-group margin-label">
                <input type="text" name="reg_nome" id="reg_nome" class="form-control" placeholder="Nome" onkeyup="controllo_nome(), valida_bottone()"/>
                <label for="reg_nome">Nome</label>
                <div id="inv_nome" class="invalid-feedback">
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="form-label-group margin-label">
                <input type="text" name="reg_cognome" id="reg_cognome" class="form-control" placeholder="Cognome" onkeyup="controllo_cognome(), valida_bottone()"/>
                <label for="reg_cognome">Cognome</label>
                <div id="inv_cogn" class="invalid-feedback">
                </div>
              </div>
            </div>
          </div>
          <div class="mb-4">
            <div class="form-label-group">
              <input type="text" name="reg_nick" id="reg_nick" class="form-control" placeholder="Nickname" onkeyup="controllo_nick(), valida_bottone()"/>
              <label for="reg_nick">Nickname</label>
              <div id="inv_nick" class="invalid-feedback">
              </div>
            </div>
          </div>

          <div class="mb-4">
            <div class="form-label-group">
              <input type="email" name="reg_email" id="reg_email" class="form-control" placeholder="Email" onkeyup="controllo_email(), valida_bottone()"/>
              <label for="reg_email">Email</label>
              <div id="inv_email" class="invalid-feedback">
              </div>
            </div>
          </div>

          <div class="mb-4">
            <div class="form-label-group">
              <input type="text" name="reg_tel" id="reg_tel" class="form-control" placeholder="Telefono" onkeyup="controllo_telefono(), valida_bottone()"/>
              <label for="reg_tel">Telefono</label>
              <div id="inv_tel" class="invalid-feedback">
              </div>
            </div>
          </div>
              
            <div class="row">
              <div class="col-md-5 mb-4">
                <div class="form-label-group margin-label">
                  <input type="text" name="reg_reg" id="reg_reg" class="form-control" placeholder="Regione" onkeyup="controllo_regione(), valida_bottone()"/>
                  <label for="reg_reg">Regione</label>
                  <div id="inv_reg" class="invalid-feedback">
                  </div>
                </div>
              </div>
              <div class="col-md-5 mb-4">
                <div class="form-label-group margin-label">
                  <input type="text" name="reg_citta" id="reg_citta" class="form-control" placeholder="Citta" onkeyup="controllo_citta(), valida_bottone()"/>
                  <label for="reg_citta">Citta</label>
                  <div id="inv_citta" class="invalid-feedback">
                  </div>
                </div>
              </div>
              <div class="col-md-2 mb-4">
                <div class="form-label-group margin-label">
                  <input type="text" name="reg_cap" id="reg_cap" class="form-control" placeholder="Cap" onkeyup="controllo_cap(), valida_bottone()"/>
                  <label for="reg_cap">CAP</label>
                  <div id="inv_cap" class="invalid-feedback">
                  </div>
                </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-3 mb-4">
              <div class="form-label-group margin-label">
                <select class="form-control" id="reg_pref" name="reg_pref" style="height: 3.125rem;" onchange="controllo_prefisso(), valida_bottone()" required>
                  <option value="">Prefisso</option>
                  <option value="via">Via</option>
                  <option value="viale">Viale</option>
                  <option value="piazza">Piazza</option>
                  <option value="piazzale">Piazzale</option>
                </select>
                <div id="inv_pref" class="invalid-feedback">
                </div>
              </div>
            </div>

            <div class="col-md-7 mb-4">
              <div class="form-label-group margin-label">
                <input type="text" name="reg_indi" id="reg_indi" class="form-control" placeholder="Indirizzo" onkeyup="controllo_indi(), valida_bottone()"/>
                <label for="reg_indi">Indirizzo</label>
                <div id="inv_indi" class="invalid-feedback">
                </div>
              </div>
            </div>
            <div class="col-md-2 mb-4">
              <div class="form-label-group margin-label">
                <input type="text" name="reg_civ" id="reg_civ" class="form-control" placeholder="Civico" onkeyup="controllo_civ(), valida_bottone()"/>
                <label for="reg_civ">Civico</label>
                <div id="inv_civ" class="invalid-feedback">
                </div>
              </div>
            </div>
          </div>
              
          <div class="row">
            <div class="col-md-6 ">
              <div class="form-label-group">
                <input type="password" name="reg_pass" id="reg_pass" class="form-control pass" placeholder="Password" onkeyup="controllo_pass(), valida_bottone()"/>
                <span id="r_pass" class="eye">
                  <i id="hide1" class="fas fa-eye"></i>
                </span>
                <label for="reg_pass">Password</label>
                <div id="inv_pass" class="invalid-feedback">
                </div>
              </div>
            </div>
            <div class="col-md-6 ">
              <div class="form-label-group">
                <input type="password" name="reg_confpass" id="reg_confpass" class="form-control pass" placeholder="Conferma Password" onkeyup="controllo_conf(), valida_bottone()"/>
                <span id="r_c_pass" class="eye">
                  <i id="hide2" class="fas fa-eye"></i>
                </span>
                <label for="reg_confpass">Conferma Password</label>
                <div id="inv_cpass" class="invalid-feedback">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6"> 
            <div id="err_pass" class="invalid-feedback">
            </div>
          </div>
          <hr class="mt-1" style="border-top: 1px solid white;">
            <button id="reg_btn" class="btn btn-lg btn-warning btn-block" type="button" onclick="valida_form()">Registrati</button>
        </form>
      </div>
    </div>
    
    <br>
    <br>
    <br>
    <br>-->
    
    <!-- FORM REGISTRAZIONE MK-1 --> 
    <div class="row justify-content-center">
      <div class="col-3">
        <h2 class="reg-title">Registrazione</h2>
      </div>
    </div>
    <div class="row col-border2 m-auto">
      <div class="col order-md-1 col-padding">
        <form id="form" class="needs-validation" novalidate method="POST">
          <div class="mb-3">
            <div class="form-label-group margin-label">
              <input type="text" name="reg_nome" id="reg_nome" class="form-control" placeholder="Nome" onkeyup="controllo_nome(), valida_bottone()"/>
              <label for="reg_nome">Nome</label>
              <div id="inv_nome" class="invalid-feedback">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="form-label-group margin-label">
              <input type="text" name="reg_cognome" id="reg_cognome" class="form-control" placeholder="Cognome" onkeyup="controllo_cognome(), valida_bottone()"/>
              <label for="reg_cognome">Cognome</label>
              <div id="inv_cogn" class="invalid-feedback">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="form-label-group">
              <input type="text" name="reg_nick" id="reg_nick" class="form-control" placeholder="Nickname" onkeyup="controllo_nick(), valida_bottone()"/>
              <label for="reg_nick">Nickname</label>
              <div id="inv_nick" class="invalid-feedback">
              </div>
            </div>
          </div>

          <div class="mb-3">
            <div class="form-label-group">
              <input type="email" name="reg_email" id="reg_email" class="form-control" placeholder="Email" onkeyup="controllo_email(), valida_bottone()"/>
              <label for="reg_email">Email</label>
              <div id="inv_email" class="invalid-feedback">
              </div>
            </div>
          </div>

          <div class="mb-3">
            <div class="form-label-group">
              <input type="text" name="reg_tel" id="reg_tel" class="form-control" placeholder="Telefono" onkeyup="controllo_telefono(), valida_bottone()"/>
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
              
          <!--<div class="row">-->
          <div class="mb-3">
            <div class="form-label-group">
              <input type="password" name="reg_pass" id="reg_pass" class="form-control pass" placeholder="Password" onkeyup="controllo_pass(), valida_bottone()"/>
              <span id="r_pass" class="eye">
                <i id="hide1" class="fas fa-eye icon-white"></i>
              </span>
              <label for="reg_pass">Password</label>
              <div id="inv_pass" class="invalid-feedback">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="form-label-group">
              <input type="password" name="reg_confpass" id="reg_confpass" class="form-control pass" placeholder="Conferma Password" onkeyup="controllo_conf(), valida_bottone()"/>
              <span id="r_c_pass" class="eye">
                <i id="hide2" class="fas fa-eye icon-white"></i>
              </span>
              <label for="reg_confpass">Conferma Password</label>
              <div id="inv_cpass" class="invalid-feedback">
              </div>
            </div>
          </div>
          <!--</div>-->
          <div class="col-md-6"> 
            <div id="err_pass" class="invalid-feedback">
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <button class="btn btn-lg btn-dark btn-block" type="button" onclick="toggle()">Istruzioni per la modifica credenziali</button>
            </div>
            <div class="col-6">
              <button id="reg_btn" class="btn btn-lg btn-success btn-block" type="button" onclick="valida_form()">REGISTRATI</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <!-- FORM REGISTRAZIONE MK-2 --> 
    <!--<div class="row justify-content-center">
      <div class="col-3">
        <h2 class="reg-title">Registrati</h2>
      </div>
    </div>
    <div class="row col-border">
      <div class="col-md-5 order-md-2 col-rules">
        <h4 class="d-flex justify-content-center align-items-center mb-4 h4-reg-title">
          <span class="reg-title2" >Regole per la registrazione: </span>
        </h4>
        <div class="mb-4 text-rules-box">
          <div class="text-rules"> 
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
          <div class="text-rules"> 
            Inserisci una Regione ed una citta con il cap
          </div> 
        </div>
        <div class="mb-4 text-rules-box">
          <div class="text-rules"> 
            Password: Tra i 6 e i 12 caratteri
          </div> 
        </div>
      </div>
      <div class="col-md-7 order-md-1">
        <form id="form" class="needs-validation" novalidate method="POST">
          <div class="row">
            <div class="col-md-6 mb-4">
              <div class="form-label-group margin-label">
                <input type="text" name="reg_nome" id="reg_nome" class="form-control" placeholder="Nome" onkeyup="controllo_nome(), valida_bottone()"/>
                <label for="reg_nome">Nome</label>
                <div id="inv_nome" class="invalid-feedback">
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="form-label-group margin-label">
                <input type="text" name="reg_cognome" id="reg_cognome" class="form-control" placeholder="Cognome" onkeyup="controllo_cognome(), valida_bottone()"/>
                <label for="reg_cognome">Cognome</label>
                <div id="inv_cogn" class="invalid-feedback">
                </div>
              </div>
            </div>
          </div>
            
          <div class="row">
            <div class="col-md-6 mb-4">
              <div class="form-label-group margin-label">
                <input type="text" name="reg_nick" id="reg_nick" class="form-control" placeholder="Nickname" onkeyup="controllo_nick(), valida_bottone()"/>
                <label for="reg_nick">Nickname</label>
                <div id="inv_nick" class="invalid-feedback">
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="form-label-group margin-label">
                <input type="email" name="reg_email" id="reg_email" class="form-control" placeholder="Email" onkeyup="controllo_email(), valida_bottone()"/>
                <label for="reg_email">Email</label>
                <div id="inv_email" class="invalid-feedback">
                </div>
              </div>
            </div>
          </div>

          <div class="mb-4">
            <div class="form-label-group">
              <input type="text" name="reg_tel" id="reg_tel" class="form-control" placeholder="Telefono" onkeyup="controllo_telefono(), valida_bottone()"/>
              <label for="reg_tel">Telefono</label>
              <div id="inv_tel" class="invalid-feedback">
              </div>
            </div>
          </div>
              
            <div class="row">
              <div class="col-md-3 mb-4">
                <div class="form-label-group margin-label">
                  <input type="text" name="reg_reg" id="reg_reg" class="form-control" placeholder="Regione" onkeyup="controllo_regione(), valida_bottone()"/>
                  <label for="reg_reg">Regione</label>
                  <div id="inv_reg" class="invalid-feedback">
                  </div>
                </div>
              </div>
              <div class="col-md-7 mb-4">
                <div class="form-label-group margin-label">
                  <input type="text" name="reg_citta" id="reg_citta" class="form-control" placeholder="Citta" onkeyup="controllo_citta(), valida_bottone()"/>
                  <label for="reg_citta">Citta</label>
                  <div id="inv_citta" class="invalid-feedback">
                  </div>
                </div>
              </div>
              <div class="col-md-2 mb-4">
                <div class="form-label-group margin-label">
                  <input type="text" name="reg_cap" id="reg_cap" class="form-control" placeholder="Cap" onkeyup="controllo_cap(), valida_bottone()"/>
                  <label for="reg_cap">CAP</label>
                  <div id="inv_cap" class="invalid-feedback">
                  </div>
                </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-3 mb-4">
              <div class="form-label-group margin-label">
                <select class="form-control" id="reg_pref" name="reg_pref" style="height: 3.125rem;" onchange="controllo_prefisso(), valida_bottone()" required>
                  <option value="">Prefisso</option>
                  <option value="via">Via</option>
                  <option value="viale">Viale</option>
                  <option value="piazza">Piazza</option>
                  <option value="piazzale">Piazzale</option>
                </select>
                <div id="inv_pref" class="invalid-feedback">
                </div>
              </div>
            </div>

            <div class="col-md-7 mb-4">
              <div class="form-label-group margin-label">
                <input type="text" name="reg_indi" id="reg_indi" class="form-control" placeholder="Indirizzo" onkeyup="controllo_indi(), valida_bottone()"/>
                <label for="reg_indi">Indirizzo</label>
                <div id="inv_indi" class="invalid-feedback">
                </div>
              </div>
            </div>
            <div class="col-md-2 mb-4">
              <div class="form-label-group margin-label">
                <input type="text" name="reg_civ" id="reg_civ" class="form-control" placeholder="Civico" onkeyup="controllo_civ(), valida_bottone()"/>
                <label for="reg_civ">Civico</label>
                <div id="inv_civ" class="invalid-feedback">
                </div>
              </div>
            </div>
          </div>
              
          <div class="row">
            <div class="col-md-6 mb-4">
              <div class="form-label-group margin-label">
                <input type="password" name="reg_pass" id="reg_pass" class="form-control pass" placeholder="Password" onkeyup="controllo_pass(), valida_bottone()"/>
                <span id="r_pass" class="eye">
                  <i id="hide1" class="fas fa-eye"></i>
                </span>
                <label for="reg_pass">Password</label>
                <div id="inv_pass" class="invalid-feedback">
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="form-label-group margin-label">
                <input type="password" name="reg_confpass" id="reg_confpass" class="form-control pass" placeholder="Conferma Password" onkeyup="controllo_conf(), valida_bottone()"/>
                <span id="r_c_pass" class="eye">
                  <i id="hide2" class="fas fa-eye"></i>
                </span>
                <label for="reg_confpass">Conferma Password</label>
                <div id="inv_cpass" class="invalid-feedback">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6"> 
            <div id="err_pass" class="invalid-feedback">
            </div>
          </div>
          <button id="reg_btn" class="btn btn-lg btn-success btn-block" type="button" onclick="valida_form()">Registrati</button>
        </form>
      </div>
    </div>-->
    </div>
  </div>
  <!--POPUP-->
  <div class="col-md-6 col-rules" id="popup">
    <!--<div class="mb-4 empty">
      <div class="text-rules"> 
      </div> 
    </div>-->
    <div class="profile-img2">
      <i class="fas fa-user-plus fa-10x"></i>
    </div>
    <h4 class="d-flex justify-content-center align-items-center mb-4 h4-reg-title">
      <span class="reg-title2" >REGOLE PER LA REGISTRAZIONE</span>
    </h4>
    <!--<div class="mb-4 empty">
      <div class="text-rules"> 
      </div> 
    </div>-->

    <div class="mb-3 text-rules-box">
      <div class="text-rules"> 
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
      <div class="text-rules"> 
        Inserisci una Regione ed una citta con il cap
      </div> 
    </div>
    <div class="mb-3 text-rules-box-last">
      <div class="text-rules"> 
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