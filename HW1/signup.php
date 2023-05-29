<html>
<head>

  <meta charset="UTF-8">

  <title>Registrazione...</title>
  <link rel="stylesheet" href="css/registrazione.css" />
  <script src='js/registrazione.js' defer></script>
  </head>

<body>
  <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>Spoti<span>Api</span></div>
		</div>
		<br>
		<div class="error"><p></p></div>
		<form name="registrazione" method="post" action="inserimento.php">
			<div class="login">
			    <input type="text" placeholder="Nome" name="nome">
				<input type="text" placeholder="Cognome" name="cognome"><br>
				<input type="text" placeholder="E-mail" name="email"><br>
				<input type="text" placeholder="Username" name="nick">
				<input type="password" placeholder="Password" name="password">
				<input type="password" placeholder="Ripeti-Password" name="cpassword">
				<input type="submit"  value="Registrati"/>
		</div>
        </form>

</body>
</html>