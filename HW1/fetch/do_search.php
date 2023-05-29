<?php
header('Content-Type: text/html; charset=utf8');
$cerca=$_GET['Cerca'];

    // App key
    $client_id = "1931eea833a94e7bb3446391ae2cc4a6";
    $client_secret = "090850ba7f0342499f5e1bd5b44ce05f";

    // Richiesta token
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://accounts.spotify.com/api/token");
    curl_setopt($curl, CURLOPT_POST, TRUE);
    curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    $headers = array("Authorization: Basic ".base64_encode($client_id.":".$client_secret));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
   // echo $result;
    curl_close($curl);
    
    // Utilizzo
    $token = json_decode($result)->access_token;
    $data = http_build_query(array("q" => "$cerca", "type" => "track","limit" => "20"));
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/search?".$data);
    $headers = array("Authorization: Bearer ".$token);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    //echo "<pre>";
    print_r(($result));
    //echo "</pre>";
    curl_close($curl);

?>