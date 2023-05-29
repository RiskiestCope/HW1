<?php
    // Avvia la sessione
    session_start();
    // Verifica se l'utente è loggato
    if(!isset($_SESSION['username']))
    {
        // Vai alla login
        header("Location: login.php");
        exit;
    }
	$flag=0; 
	$titolo="Titolo";
	$conn = mysqli_connect("localhost", "root", "", "spotiapi") or die("Errore NELLA CONNESSIONE");
	mysqli_query($conn, "SET CHARACTER SET UTF8");
	$query = "select Titolo from raccolte where nomeutente like'".$_SESSION['username']."'";
	$res = mysqli_query($conn, $query) or die("ERRORE NELLA QUERY: " . mysqli_error($conn));
	while ($row = mysqli_fetch_assoc($res)) { 
		$array[]=$row;
	}	
	$res_num = mysqli_num_rows($res);
	if($res_num >0){
		$flag=1;
		$dati = array_values($array);
	}
?>

<html >
<head> 
    <title>Cerca Canzone!!</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/homebase.css" />
	<link rel="stylesheet" href="css/ricerca.css" />
		<link rel="stylesheet" href="css/controlli.css" />
	<script src='js/cerca.js' defer></script>
</head>
<body>
	<div class="main">
		<div class="header">
			<div class="logo">
				<div>Spoti<span>Api</span></div>
			</div>
			<div class="utente" ><?php echo $_SESSION['username'];?></div>
		</div>
		<div class="content">
			<div class="col1">
				<div class="registrati"> 
					<input type="button" onclick="location.href='home.php'" value="HOME"/>
					<input type="button" onclick="location.href='Account.php'" value="PROFILO"/>
					<input type="button" onclick="location.href='search.php'" value="RICERCA"/>
					<input type="button" onclick="location.href='raccolte.php'" value="GESTIONE RACCOLTE"/>
					<input type="button" onclick="location.href='logout.php'" value="LOG OUT"/>
				</div>
			</div>

		<div class="col2">
		       <div class="Aggiungi">
			<?php 
			 if ($flag==1){	
				echo "<select id='raccolta' class='sel' name='scelta' size='1'>";
							for($i=0; $i<$res_num; $i++ ) {
								echo"<option value='";
								print_r($dati[$i][$titolo]);
								echo"'>";
								print_r($dati[$i][$titolo]);
								echo"</option>";
							}
							echo"</select>";	  
			 }							
              if($flag==0)
				  echo "<h1 class='Gestione'> Nessuna raccolte presente</h1>";
			?>			   
				<input type='hidden' id='user' name='user' value='<?php echo $_SESSION['username'];?>'>
				<input type="text" id="TextArea" placeholder="Cerca canzone" name="name">			   
				<input type="button" data-pulsante="uno" value="Aggiungi"/>
			   </div>
	    <div class="GestioneRisultati">
		  <div> 
			<h1></h1>
		  </div>		
		</div>
		<div class="grid" id="Tabella"> 
		  <div class="grid" id="sottotab"></div>
		</div>
</body>	
</html>	