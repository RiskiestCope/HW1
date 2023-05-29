<?php
$scelta= $_POST['scelta'];
$utente= $_POST['user'];
$contenuto= $_POST['contenuto'];


if (!$scelta || !$utente){
 	echo " Modifica FALLITA!!!non capisco perchè non funziona post";
	exit;
}

function idraccolta($utent,$scelt){
	$num=0;
	$numero="numero";
	$conn = mysqli_connect("localhost", "root", "", "spotiapi") or die("Errore NELLA CONNESSIONE");
    mysqli_query($conn, "SET CHARACTER SET UTF8");
	$query = "select idk FROM raccolte WHERE nomeutente like '$utent' and titolo like '$scelt'; "; 
	$res = mysqli_query($conn, $query) or die("Non è stato possibile trovare id raccolta" . mysqli_error($conn));
	//while ($row = mysqli_fetch_assoc($res)) { 
           $row = mysqli_fetch_assoc($res);
		   $array[]=$row;
    //}
	$nome="idk";
    $dati = array_values($array);
    return $dati[0][$nome];
}

function cancellarecordlega($scelta){
	$num=0;
	$numero="numero";
	$conn = mysqli_connect("localhost", "root", "", "spotiapi") or die("Errore NELLA CONNESSIONE");
    mysqli_query($conn, "SET CHARACTER SET UTF8");
    $query =" DELETE FROM lega WHERE raccolta like '$scelta'; ";
	$res = mysqli_query($conn, $query) or die("Non è stato possibile cancellare la raccolta" . mysqli_error($conn));
	echo "Riferimenti cancellati";
}

function cancellarecord($scelta){
	$num=0;
	$numero="numero";
	$conn = mysqli_connect("localhost", "root", "", "spotiapi") or die("Errore NELLA CONNESSIONE");
    mysqli_query($conn, "SET CHARACTER SET UTF8");
    $query =" DELETE FROM raccolte WHERE idk ='$scelta'; ";
	$res = mysqli_query($conn, $query) or die("Non è stato possibile cancellare la raccolta" . mysqli_error($conn));
	echo "Raccolta cancellata";
}
	
$idrac=idraccolta($utente,$scelta);
cancellarecordlega($idrac);
cancellarecord($idrac);
header("Location: raccolte.php");
?>