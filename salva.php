<?php
	//connessione
  include("connect.php");
  //Avvio la sessione
  session_start();
	
	if(isset($_POST['id_cpu']) && isset($_POST['id_mobo']) && isset($_POST['id_ram']) && isset($_POST['id_gpu']) && isset($_POST['id_ssd']) && isset($_POST['id_cooler']) && isset($_POST['id_psu']) && isset($_POST['id_case']) && isset($_POST['prezzo'])){
		$vcpu = $_POST['id_cpu']; //Prendo dall'ajax l'id cpu
		$vmobo = $_POST['id_mobo']; //Prendo dall'ajax l'id mobo
		$vram = $_POST['id_ram']; //Prendo dall'ajax l'id ram
		$vgpu = $_POST['id_gpu']; //Prendo dall'ajax l'id gpu
		$vssd = $_POST['id_ssd']; //Prendo dall'ajax l'id ssd
		$vcooler = $_POST['id_cooler']; //Prendo dall'ajax l'id cooler
		$vpsu = $_POST['id_psu']; //Prendo dall'ajax l'id psu
		$vcase = $_POST['id_case']; //Prendo dall'ajax l'id case
		$prezzo = $_POST['prezzo']; //Prendo dall'ajax l'id prezzo
		
		$user = $_SESSION['user'];//Salvo l'utente in sessione

	  $q1 = "SELECT * FROM utente WHERE utente.nickname = '$user'";//Prendo l'id dell'utente in sessione
	  $row1 = pg_fetch_row(pg_query($dbconn, $q1)); //Invio la query per prendere l'id dell'utente
		//$row1[0] contiene l'id dell'utente

		$q2 = "INSERT INTO configurazione(cod_utente, prezzo)
						VALUES ($row1[0], $prezzo)";
		pg_query($dbconn, $q2); //Invio la query per inserire configurazione collegata all'utente nel DB

		$q3 = "SELECT id FROM configurazione WHERE configurazione.cod_utente = $row1[0]"; //Prendo l'id della configurazione dell'utente in sessione
		 //Invio la query per prendere l'id della configurazione dell'utente in sessione
		$ret = pg_query($dbconn, $q3);
		while($row = pg_fetch_row($ret)){
			$ris = $row[0];
		}

		//$row2[0] contiene l'id della configurazione

		//Query per l'inserimento della cpu
		$qins = "INSERT INTO conf_comp(cod_conf, cod_comp, quantita)
							VALUES 	($ris, $vcpu, 1),
											($ris, $vmobo, 1),
											($ris, $vram, 1),
											($ris, $vgpu, 1),
											($ris, $vssd, 1),
											($ris, $vcooler, 1),
											($ris, $vpsu, 1),
											($ris, $vcase, 1);";
		 
		//Query per l'inserimento dei componenti in conf_comp
		$ret=pg_query($dbconn, $qins); //Invio la query per inserire configurazione collegata all'utente nel DB
	}
	else{
		echo("NON POTRESTI ESSERE QUI! Torna alla home");
		header("refresh:1; url=home.php");
	}
?>