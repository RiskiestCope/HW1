<?php

$conn = mysqli_connect("localhost", "root", "", "spotiapi") or die("Errore NELLA CONNESSIONE");
mysqli_query($conn, "SET CHARACTER SET UTF8");
$query = "SELECT nome,cognome,email FROM Utenti WHERE nomeutente like'".$_GET['key']."'";
$res = mysqli_query($conn, $query) or die("ERRORE NELLA QUERY: " . mysqli_error($conn));
$array = array();
while ($row = mysqli_fetch_assoc($res)) { 
    print_r($row);
    $array[]=$row;
}
$nome="nome";
$dati = array_values($array);

print_r($dati[0][$nome]);

mysqli_free_result($res);
mysqli_close($conn);
?>