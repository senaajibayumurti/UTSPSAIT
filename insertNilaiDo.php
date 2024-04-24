<?php

if(isset($_POST['submit']))
{    
    $games_name = $_POST['games_name'];
    $games_description = $_POST['games_description'];
    $games_main_type = $_POST['games_main_type'];
    $games_main_genre = $_POST['games_main_genre'];
    $games_price = $_POST['games_price'];
    $games_publisher = $_POST['games_publisher'];
    $games_developer = $_POST['games_developer'];

    // Pastikan sesuai dengan alamat endpoint dari REST API di ubuntu
    $url = 'http://localhost/UTSPSAIT/nilai_mahasiswa_api.php';
    $ch = curl_init($url);
    
    // Data yang akan dikirim ke REST API, dengan format JSON
    $jsonData = array(
        'games_name' =>  $games_name,
        'games_description' =>  $games_description,
        'games_main_type' =>  $games_main_type,
        'games_main_genre' =>  $games_main_genre,
        'games_price' =>  $games_price,
        'games_publisher' =>  $games_publisher,
        'games_developer' =>  $games_developer
    );

    //Encode the array into JSON.
    $jsonDataEncoded = json_encode($jsonData);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Pastikan mengirim dengan method POST
    curl_setopt($ch, CURLOPT_POST, true);

    // Attach our encoded JSON string to the POST fields.
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

    // Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 

    // Execute the request
    $result = curl_exec($ch);
    $result = json_decode($result, true);

    curl_close($ch);

    // Tampilkan return statusnya, apakah sukses atau tidak
    print("<center><br>Status: {$result["status"]} "); 
    print("<br>Message: {$result["message"]} "); 
    echo "<br>Sukses terkirim ke ubuntu server !";
    echo "<br><a href=selectGamesView.php> OK </a>";
}
?>
