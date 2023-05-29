<?php
$nomeraccolta=$_POST['name'];
$utente=$_POST['user'];
if (!$nomeraccolta || !$utente){
 	echo " Modifica FALLITA!!! ";
	exit;
}
$conn = mysqli_connect("localhost", "root", "", "spotiapi") or die("Errore NELLA CONNESSIONE");
$nomeraccolta=mysqli_real_escape_string($conn,$_POST['name']);
$utente=mysqli_real_escape_string($conn,$_POST['user']);
mysqli_query($conn, "SET CHARACTER SET UTF8");
$query ="Insert into Raccolte(nomeutente,titolo,copertina) values('$utente','$nomeraccolta','NULL')";
$res = mysqli_query($conn, $query) or die("Errore SQL !!" . mysqli_error($conn));
mysqli_close($conn);
header("Location: raccolte.php");
?>