<?php
	session_start();
	unset($_SESSION["user"]);
	unset($_SESSION["carrello"]);
	$output="DISCONNESSIONE IN CORSO...";
	header("refresh:1.5; url=home.php");
?>

<html>
	<head>
		<meta charset = "utf-8">
		<title></title>
		<link rel="stylesheet" href="./Css/loading.css">
	</head>

	<body>
	<div style='margin-top:150px'>
			<h1 style="text-align:center; color: #2ecc71"><?php echo($output);?></h1>
		</div>
		<div class="middle">
			<div class="bar bar1"></div>
			<div class="bar bar2"></div>
			<div class="bar bar3"></div>
			<div class="bar bar4"></div>
			<div class="bar bar5"></div>
			<div class="bar bar6"></div>
			<div class="bar bar7"></div>
			<div class="bar bar8"></div>
		</div>
	</body>
</html>
