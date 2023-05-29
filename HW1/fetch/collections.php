<?php

 $raccolta = $_POST['raccolta'];
 
 function idraccolta($scelta){
	$num=0;
	$numero="numero";
	$conn = mysqli_connect("localhost", "root", "", "spotiapi") or die("Errore NELLA CONNESSIONE");
    mysqli_query($conn, "SET CHARACTER SET UTF8");
	$query = "select idk FROM raccolte WHERE titolo like '$scelta'; "; 
	$res = mysqli_query($conn, $query) or die("Non è stato possibile aggiungere la canzone, riprova 5 " . mysqli_error($conn));
	//while ($row = mysqli_fetch_assoc($res)){
           $row = mysqli_fetch_assoc($res);
		   $array[]=$row;
	//}
	$nome="idk";
    $dati = array_values($array);
    return $dati[0][$nome]; // ricorda di chiudere la connessione;
}

 function cercacontenuti($raccolt){
	$num=0;
	$conn = mysqli_connect("localhost", "root", "", "spotiapi") or die("Errore NELLA CONNESSIONE");
    mysqli_query($conn, "SET CHARACTER SET UTF8");
	$query = "select contenuti.contenuto as contenuto from contenuti INNER JOIN lega
     ON contenuti.id = lega.contenuto where lega.raccolta like '$raccolt'";
	$res = mysqli_query($conn, $query) or die("ERRORE NELLA QUERY: " . mysqli_error($conn));
	$array = array();
	while ($row = mysqli_fetch_assoc($res)){ 
		$array[]=$row;
    }
	echo json_encode($array);
}

$idr=idraccolta($raccolta);
cercacontenuti($idr);

?>