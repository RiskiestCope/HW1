<?php

    // Avvia la sessione
    session_start();
    // Verifica se l'utente è loggato
    if(!isset($_SESSION['username']))
    {
        // Va al login
        header("Location: login.php");
        exit;
    }
$conn = mysqli_connect("localhost", "root", "", "spotiapi") or die("Errore NELLA CONNESSIONE");
mysqli_query($conn, "SET CHARACTER SET UTF8");
$query = "SELECT nome,cognome,email FROM Utenti WHERE nomeut like'".$_SESSION['username']."'";
$res = mysqli_query($conn, $query) or die("ERRORE NELLA QUERY: " . mysqli_error($conn));
$array = array();
while ($row = mysqli_fetch_assoc($res)) { 
    $array[]=$row;
}
$nome="nome";
$cognome="cognome";
$email="email";
$dati = array_values($array);
?>


<html>
<head> 
    <title>Homepage</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/homebase.css" />
	<link rel="stylesheet" href="css/account.css" />
	<script src='js/update.js' defer></script>
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
			<h1 class="titolo">Il Tuo Profilo:</h1><p class="windowerror"></p>
			<div class="contenitore"> 
			<form name="modifica" method="post" action="modifica_info.php">
				<div class="formaccount">
				    <label>Nome: </label>
				    <input type="text"  name="nome" value="<?php print_r($dati[0][$nome]);?>">
					<label>Cognome: </label>
					<input type="text" name="cognome" value="<?php print_r($dati[0][$cognome]);?>">
					<label> E-mail: </label>
					<input type="text"  name="email" value="<?php print_r($dati[0][$email]);?>" >
					<label>Username: </label>
					<input type="text" value="<?php echo $_SESSION['username'] ; ?>"; readonly="readonly" onclick= "alert('Username non modificabile in questa fase');" name="nick">
					<label>Password: </label>
					<input type="password"  name="password">
					<label>Conferma-Password: </label>
					<input type="password"  name="cpassword">
					<input type="submit"  value="Update"/>
				</div>
        </form>
	    </div>
</body>
</html>

			