<?php

    // Avvia la sessione
    session_start();
    // Verifica l'accesso
    if(isset($_SESSION["username"]))
    {
        // Va alla home
        header("Location: home.php");
        exit;
    }
    // Verifica l'esistenza di dati POST
    if(isset($_POST["username"]) && isset($_POST["password"])) {
        // Connette al database
		$hash = md5($_POST["password"]);
		$hash = substr( $hash, 0, 24 );
        $conn = mysqli_connect("localhost", "root", "", "spotiapi");
        // Cerca utenti con quelle credenziali
        $query = "SELECT * FROM utenti WHERE nomeut = '".$_POST['username']."' AND password = '".$hash."'";
        $res = mysqli_query($conn, $query);
        // Verifica la correttezza delle credenziali
        if(mysqli_num_rows($res) > 0) {
            // Imposta la variabile di sessione
            $_SESSION["username"] = $_POST["username"];
            // Va alla pagina home_db.php
            header("Location: home.php");
            exit;
        }
        else {
            // Flag di errore
            $errore = true;
        }
    }
?>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/login.css" />
		<script src='js/login.js' defer></script>
		<title>Login</title>
	</head>
   <body>
    <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>Spoti<span>Api</span></div>
		</div>
		<br>
		<div class="error"> 
		    <p class="mess"><p>
		</div>
		<div class="errorphp"> 
		   <?php
            // Verifica la presenza di errori
            if(isset($errore))
            {
                echo "Utente non trovato";
            }
		   ?>
		</div>
		</div>
		<form name="login" method='post'>
			<div class="login">
				<input type="text" placeholder="Username" name="username"><br>
				<input type="password" placeholder="Password" name="password"><br>
				<input type='submit' value="Login"/>
			</div>
        </form>
		<div class="registrati"> 
		   <input type="button" onclick="location.href='signup.php'" value="Registrati"/>
		</div>
    </body>
</html>