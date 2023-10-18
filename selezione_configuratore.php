<?php
  //connessione
  include('connect.php');

	session_start();
	
	$array_val = array("Cpu", "Mobo", "Ram", "Gpu", "Storage", "Cooler", "Psu", "Chassis");

	$titolo = 1;
	$nome = 2;
	$immagine = 5;
  $categoria = 9;

	if(isset($_GET['index'])){
		
		$index = $_GET['index'];
    
   	if(($_GET['cpu'])=='undefined'){ //Primo passo cpu non selezionata
			$query = "SELECT * FROM componente WHERE categoria = '$array_val[$index]'";
		}
		
		if(($_GET['mobo'])=='undefined' && ($_GET['cpu'])!='undefined'){ //Sono al passo della mobo, significa che 'cpu' è già stata selezionata
			//array_val[$index] sarà uguale a 'mobo' in questo passo
			$cpu = $_GET['cpu']; //Prendo l'id della cpu selezionata
			$q1 = "SELECT socket FROM Cpu WHERE Cpu.cod_comp = '$cpu'"; //Prendo il socket della cpu selezionata
			$row = pg_fetch_row(pg_query($dbconn, $q1)); //Invio la query 
			$query = "SELECT * FROM componente JOIN $array_val[$index] ON componente.id = $array_val[$index].cod_comp WHERE $array_val[$index].socket = '$row[0]'"; //Filtro leMobo in base al socket
		}
		
		
		if(($_GET['ram'])=='undefined' && ($_GET['mobo'])!='undefined'){ //Sono al passo della ram, significa che 'mobo' è già stata selezionata
			//array_val[$index] sarà uguale a 'ram' in questo passo
			$cpu = $_GET['cpu']; //Prendo l'id della cpu selezionata
			$mobo = $_GET['mobo']; //Prendo l'id della mobo selezionata
			$q1 = "SELECT tipo_ram, max_ram FROM Cpu WHERE Cpu.cod_comp = $cpu"; //Prendo tipo_ram e max_ram della cpu selezionata
			$q2 = "SELECT n_b_ram, freq_ram FROM Mobo WHERE Mobo.cod_comp = $mobo"; //Prendo n_b_ram e freq_max della mobo selezionata
			$row1 = pg_fetch_row(pg_query($dbconn, $q1)); //Invio la query per prendere i tipo_ram e max_ram corrispondenti
			$row2 = pg_fetch_row(pg_query($dbconn, $q2)); //Invio la query per prendere i n_b_ram e freq_ram corrispondenti
			//$row1[0] ho il tipo_ram Cpu
			//$row1[1] ho il max_ram Cpu
			//$row2[0] ho il n_b_ram Mobo
			//$row2[1] ho il freq_ram Mobo
			$row3 = explode("-", $row1[0]);
			//$row3[0] ho lo stile (DDR4)
			//$row3[1] ho la frequenza (2666)		
			$query = "SELECT * FROM componente JOIN $array_val[$index] ON componente.id =  $array_val[$index].cod_comp
								WHERE $array_val[$index].stile = '$row3[0]'
									AND $row3[1] <= $array_val[$index].frequenza /*Controllo che che la freq_max della mobo sia maggiore della freq della ram */
									AND '$row2[1]' > $array_val[$index].frequenza /*Controllo che la freq_max della ram sia supportata dalla cpu*/
									AND '$row2[0]' >= $array_val[$index].banchi"; /*Controllo che i banchi di ram siano minor o uguali rispetto agli slot della mobo*/
		}
	

		if(($_GET['gpu'])=='undefined' && ($_GET['ram'])!='undefined'){ //Sono al passo della gpu, significa che 'ram' è già stata selezionata
			//array_val$index] sarà uguale a 'gpu' in questo passo
			//Nessun controllo necessario
			$query = "SELECT * FROM componente WHERE categoria = '$array_val[$index]'";
		}

		
		
		if(($_GET['ssd'])=='undefined' && ($_GET['gpu'])!='undefined'){ //Sono al passo dello storage, significa che 'gpu' è già stata selezionata
			//array_val[$index] sarà uguale a 'storage' in questo passo
			if($array_val[$index] == 'Storage'){
				$query = "SELECT * FROM componente WHERE categoria = 'Ssd' OR categoria = 'Hdd'";
			}
			else{ 
				$query = "SELECT * FROM componente WHERE categoria = '$array_val[$index]'";
			}
		}		
		

		if(($_GET['cooler'])=='undefined' && ($_GET['ssd'])!='undefined'){ //Sono al passo della cooler, significa che 'cpu' è già stata selezionata
			//array_val[$index] sarà uguale a 'cooler' in questo passo
			$cpu = $_GET['cpu']; //Prendo l'id della cpu selezionata
			$q1 = "SELECT socket FROM Cpu WHERE Cpu.cod_comp = '$cpu'"; //Prendo il socket della cpu selezionata
			$row = pg_fetch_row(pg_query($dbconn, $q1)); //Invio la query
			if($row[0] == 'LGA1151' || $row[0] == 'AM4' || $row[0] == 'LGA2066'){
				$query = "SELECT * FROM componente JOIN $array_val[$index] ON componente.id = $array_val[$index].cod_comp WHERE $array_val[$index].socket = 'Tutti'";//Filtro leMobo in base al socket
			}
			else{
				$query = "SELECT * FROM componente JOIN $array_val[$index] ON componente.id = $array_val[$index].cod_comp WHERE $array_val[$index].socket = 'TRX4'";//Filtro leMobo in base al socket
			}
		}

		if(($_GET['psu'])=='undefined' && ($_GET['cooler'])!='undefined'){ //Sono al passo della psu, significa che 'cpu' è già stata selezionata
			//array_val[$index] sarà uguale a 'psu'
			$cpu = $_GET['cpu'];
			$mobo = $_GET['mobo'];
			$ram = $_GET['ram'];
			$gpu = $_GET['gpu'];
			$ssd = $_GET['ssd'];
			$cooler = $_GET['cooler'];
			
			$qcpu = "SELECT wattaggio FROM componente WHERE  componente.id= '$cpu'"; //Prendo i watt della cpu selezionata
			$rowcpu = pg_fetch_row(pg_query($dbconn, $qcpu)); //Invio la query
			
			$qmobo = "SELECT wattaggio FROM componente WHERE componente.id = '$mobo'"; //Prendo i watt della mobo selezionata
			$rowmobo = pg_fetch_row(pg_query($dbconn, $qmobo)); //Invio la query
			
			$qram = "SELECT wattaggio FROM componente WHERE componente.id = '$ram'"; //Prendo i watt della ram selezionata
			$rowram = pg_fetch_row(pg_query($dbconn, $qram)); //Invio la query
			
			$qgpu = "SELECT wattaggio FROM componente WHERE componente.id = '$gpu'"; //Prendo i watt della gpu selezionata
			$rowgpu = pg_fetch_row(pg_query($dbconn, $qgpu)); //Invio la query
			
			$qssd = "SELECT wattaggio FROM componente WHERE componente.id = '$ssd'"; //Prendo i watt della ssd selezionata
			$rowssd = pg_fetch_row(pg_query($dbconn, $qssd)); //Invio la query
			
			$qcooler = "SELECT wattaggio FROM componente WHERE componente.id = '$cooler'"; //Prendo i watt della cooler selezionata
			$rowcooler = pg_fetch_row(pg_query($dbconn, $qcooler)); //Invio la query

			$max_watt = $rowcpu[0] + $rowmobo[0] + $rowram[0] + $rowgpu[0] + $rowssd[0] + $rowcooler[0]; //Sommo tutti i watt

			$query = "SELECT * FROM componente WHERE componente.wattaggio >= $max_watt AND categoria = '$array_val[$index]'"; //Filtro i psu in base ai watt dei componenti
		}

		if(($_GET['case'])=='undefined' && ($_GET['psu'])!='undefined'){ //Sono al passo della psu, significa che 'cpu' è già stata selezionata
			//array_val[$index] sarà uguale a 'chassis'
			$mobo = $_GET['mobo']; //Prendo la mobo selezionata
			$q1 = "SELECT stile FROM Mobo WHERE Mobo.cod_comp = $mobo"; //Prendo il socket della cpu selezionata
			$row = pg_fetch_row(pg_query($dbconn, $q1)); //Invio la query
			
			if($row[0] == 'MINI-ITX'){
				$query = "SELECT * FROM componente JOIN $array_val[$index] ON componente.id = $array_val[$index].cod_comp";//Filtro i case in base alla dim delle mobo
			}
			else{
				if($row[0] == 'MICRO-ATX'){
					$query = "SELECT * FROM componente JOIN $array_val[$index] ON componente.id = $array_val[$index].cod_comp WHERE $array_val[$index].dim_mobo != 'MINI-ITX'";//Filtro i case in base alla dim delle mobo
				}
	
				else{ //Sono solo ATX
					$query = "SELECT * FROM componente JOIN $array_val[$index] ON componente.id = $array_val[$index].cod_comp WHERE $array_val[$index].dim_mobo != 'MINI-ITX' AND $array_val[$index].dim_mobo != 'MICRO-ATX' ";//Filtro i case in base alla dim delle mobo
				}	
			}
		}

		
		

    $ret = pg_query($dbconn, $query);
    /*$output = "<label for='select_cpu' style='color: lime'> Scegli $array_val[$index] </label>	<!--div per le CPU -->
                <div class='container-componenti'>";*/
		$output = "	<div class='select_title_form'>
									<span class='text_title_form' for='select_cpu'> Seleziona $array_val[$index] </span>
								</div>
								<!--<label for='select_cpu'> Scegli $array_val[$index] </label>	div per le CPU -->
                <div class='container container-product'>
								<div class='row row-conf'>"; 
    while($row = pg_fetch_row($ret)){
      $img = $row[$immagine];
      $nom = $row[$nome];
      $tit = $row[$titolo];
      $id = $row[0];
			$prezzo = $row[6];
  
			/*$output .="
								<div id='$id' class='col-componenti' onclick='select_comp(this.id)'>
									<div class='comp'>
										<div class='build-image'>
											<img class='img-comp' src='$img'>
										</div>
										<div class='text-comp'>$tit</div>
										</div>
									</div>";
    */
			$output .="
			<div id='$id' class='col-3 card-elem col-config' onclick='select_comp(this.id)'>
				<div class='card'>
					<div class='row'>
						<img class='img card-img-top' src='$img'>
						<div class='card-body'>
							<h6 class='title-obj pt-1'>$nom</h6>
						</div>
					</div>
					<div class='row row-text'>
						<div class='text-prezzo'>".number_format($prezzo, 2)." € </div>
					</div>
				</div>
			</div>";
		}
    
    $output .= "
								</div>
                </div>
                <div class='select_button_form'>
                  <div class='row'>
                    <div class='col mt-4'>
                      <button class='btn btn-xl btn-warning btn-block glow-on-hover' id='prevBtn' type='button' style='display:inline;' onclick='nextPrev(-1), move_timeline(-1), mostra_ris(-1)'> Indietro </button>
                    </div>
                    <div class='col'></div>
                    <div class='col mt-4'>
                      <button class='btn btn-xl btn-warning btn-block glow-on-hover' id='nextBtn' type='button' style='float:left;' onclick='nextPrev(+1), move_timeline(+1), mostra_ris(+1)' disabled='true'> Avanti </button>
                    </div>
                  </div>
                </div>";

  }

  echo($output);
?>