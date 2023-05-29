<?php
 $raccolta = $_POST['raccolta'];
 $contenuto= $_POST['contenuto'];
 $username = $_POST['username'];
echo $username; 	
echo $raccolta;


if (! $raccolta || !$contenuto){
 	echo " Impossibile inserire i dati";
	exit;
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

function rimozione($raccolta,$contenuto){
	$conn = mysqli_connect("localhost", "root", "", "spotiapi") or die("Errore NELLA CONNESSIONE");
    mysqli_query($conn, "SET CHARACTER SET UTF8");
    $query =" DELETE FROM lega WHERE raccolta like '$raccolta' and contenuto like '$contenuto'; ";
	$res = mysqli_query($conn, $query) or die("Non è stato possibile cancellare la raccolta" . mysqli_error($conn));
	echo "Riferimenti cancellati";
	header("Location: home.php");
    exit;
}

$idk=idraccolta($username,$raccolta);
$idc=trovoidcontenuto($raccolta,$contenuto);
rimozione($idk,$idc);
header("Location: home.php");

?>