<?php
$flag=0;
$nome=$_POST['nome'];
$cognome=$_POST['cognome'];
$email = $_POST['email'];
$username =$_POST['nick'];
$pass1=$_POST['password'];
$pass2=$_POST['cpassword'];
if (!$nome || !$cognome || !$email || !$email || !$username || !$pass1 || !$pass2) {
  echo 'Tutti i campi del modulo sono obbligatori!';    
  $flag=1;
}
// verifica che il nome non contenga caratteri nocivi
elseif (!preg_match('/^[A-Za-z \'-]+$/i',$nome)) {
  echo 'Il nome contiene caratteri non ammessi'; 
  $flag=1;  
}
// verifica che il cognome non contenga caratteri nocivi
elseif (!preg_match('/^[A-Za-z \'-]+$/i',$cognome)) {
  echo 'Il cognome contiene caratteri non ammessi';
  $flag=1;  
}
// verifica se un indirizzo email è valido
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo 'Indirizzo email non corretto';
  $flag=1;
}else if (strcmp($pass1, $pass2) != 0) {
     $flag=1;
} 

 if($flag==1){
	echo " Inserimento FALLITO... ";
	exit;
}
$conn = mysqli_connect("localhost", "root", "", "spotiapi") or die("Errore NELLA CONNESSIONE");
$hash = md5($pass1);
$nome	 =	mysqli_real_escape_string($conn,$_POST['nome']);
$cognome = 	mysqli_real_escape_string($conn,$_POST['cognome']);
$email 	 = 	mysqli_real_escape_string($conn,$_POST['email']);
$username =	mysqli_real_escape_string($conn,$_POST['nick']);
$pass1	 =	mysqli_real_escape_string($conn,$_POST['password']);
$conn 	 = 	mysqli_connect("localhost", "root", "", "spotiapi") or die("Errore NELLA CONNESSIONE");

mysqli_query($conn, "SET CHARACTER SET UTF8");
$query ="INSERT INTO utenti(nome,cognome,email,nomeut,password) values ('$nome','$cognome','$email','$username','$hash');";
echo " $query" ;
$res = mysqli_query($conn, $query) or die("Errore SQL !!" . mysqli_error($conn));
mysqli_close($conn);
header("Location: login.php");
exit;
?>