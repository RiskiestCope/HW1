<?php
 $contenutijson = $_POST['content'];
 $username = $_POST['username'];
 $raccolta = $_POST['raccolta'];
 $ris1;
 $ris2;
 if (! $raccolta || !$username){
 	echo " Impossibile inserire i dati";
	exit;
}
 
 function controllouno($usernam){
	$num=0;
	$conn = mysqli_connect("localhost", "root", "", "spotiapi") or die("Errore NELLA CONNESSIONE");
    mysqli_query($conn, "SET CHARACTER SET UTF8");
	$query = "SELECT *  FROM Utenti WHERE nomeut like'".$usernam."'";
	$res = mysqli_query($conn, $query) or die("ERRORE NELLA QUERY:1 " . mysqli_error($conn));
	if(mysqli_num_rows($res)) {  
	$num = mysqli_num_rows($res); 
	}
	return $num ;
}

function controllodue ($usernam,$raccolt){
	$num=0;
	$conn = mysqli_connect("localhost", "root", "", "spotiapi") or die("Errore NELLA CONNESSIONE");
    mysqli_query($conn, "SET CHARACTER SET UTF8");
	$query = "SELECT * FROM Raccolte WHERE nomeutente like'".$usernam."' and titolo like'". $raccolt."'";
    $res = mysqli_query($conn, $query) or die("ERRORE NELLA QUERY:2 " . mysqli_error($conn));
    if(mysqli_num_rows($res)) {  
	$num = mysqli_num_rows($res); }
	return $num ;
}

function controllotre($contenutijso){
	$num=0;
	$numero="numero";
	$conn = mysqli_connect("localhost", "root", "", "spotiapi") or die("Errore NELLA CONNESSIONE");
    mysqli_query($conn, "SET CHARACTER SET UTF8");
	$query = "select *  from contenuti where contenuto like '".$contenutijso."'";
	$res = mysqli_query($conn, $query) or die("Non è stato possibile aggiungere la canzone, riprova 3" . mysqli_error($conn));
    if(mysqli_num_rows($res)) 
	$num = mysqli_num_rows($res); 
	return $num;
}
    	
function inserimentocontenuti($contenutijso){
	$conn = mysqli_connect("localhost", "root", "", "spotiapi") or die("Errore NELLA CONNESSIONE");
    mysqli_query($conn, "SET CHARACTER SET UTF8");
	$query = "insert into contenuti (contenuto) values ('$contenutijso')";
	$res = mysqli_query($conn, $query) or die("Non è stato possibile aggiungere la canzone, riprova 4 " . mysqli_error($conn));
	return 1;
}

function trovoidcontenuto($raccolt,$contenutijso){
	$i=0;
	$conn = mysqli_connect("localhost", "root", "", "spotiapi") or die("Errore NELLA CONNESSIONE");
    mysqli_query($conn, "SET CHARACTER SET UTF8");
	$query = "select id from contenuti where contenuto like'".$contenutijso."'";
	$res = mysqli_query($conn, $query) or die("Non è stato possibile aggiungere la canzone, riprova 5 " . mysqli_error($conn));
	//while ($row = mysqli_fetch_assoc($res)) { 
           $row = mysqli_fetch_assoc($res);
		   $array[]=$row;
    //}
	$nome="id";
    $dati = array_values($array);
    return $dati[0][$nome];
}

function idraccolta($utent,$scelta){
	$num=0;
	$numero="numero";
	$conn = mysqli_connect("localhost", "root", "", "spotiapi") or die("Errore NELLA CONNESSIONE");
    mysqli_query($conn, "SET CHARACTER SET UTF8");
	$query = "select idk FROM raccolte WHERE nomeutente like '$utent' and titolo like '$scelta'; "; 
	$res = mysqli_query($conn, $query) or die("Non è stato possibile aggiungere la canzone, riprova 5 " . mysqli_error($conn));
	//while ($row = mysqli_fetch_assoc($res)) { 
           $row = mysqli_fetch_assoc($res);
		   $array[]=$row;
    //}
	$nome="idk";
    $dati = array_values($array);
    return $dati[0][$nome];
}

function inserimento($raccolt,$ris){
	$i=0;
	$conn = mysqli_connect("localhost", "root", "", "spotiapi") or die("Errore NELLA CONNESSIONE");
    mysqli_query($conn, "SET CHARACTER SET UTF8");
	$query = "insert into  lega (raccolta,contenuto) values ('$raccolt','$ris')";
	$res = mysqli_query($conn, $query) or die("Non è stato possibile aggiungere la canzone, riprova 6 " . mysqli_error($conn));
	echo "Canzone Aggiunta Con Successo!" ;
	return 1;
}

$return=0;
$ris1=controllouno($username);
$ris2=controllodue($username,$raccolta);
if($ris1> 0 && $ris2 > 0){
	$ris3=controllotre($contenutijson);
}
if($ris3==0){
    $return=inserimentocontenuti($contenutijson);
	if($return==1){
		$ris4=trovoidcontenuto($raccolta,$contenutijson);
		$idrac=idraccolta($username,$raccolta);
        inserimento($idrac,$ris4);
	}
}else {
		$ris4=trovoidcontenuto($raccolta,$contenutijson);
		$idrac=idraccolta($username,$raccolta);
        inserimento($idrac,$ris4);
}
?>