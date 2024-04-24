<?php

if(isset($_POST['submit']))
{    
    $nim = $_POST['nim'];
    $kode_mk = $_POST['kode_mk'];
    $nilai = $_POST['nilai'];

    // Pastikan sesuai dengan alamat endpoint dari REST API di ubuntu
    $url = 'http://localhost/UTSPSAIT/nilai_mahasiswa_api.php';
    $ch = curl_init($url);
    
    // Data yang akan dikirim ke REST API, dengan format JSON
    $jsonData = array(
        'nim' =>  $nim,
        'kode_mk' =>  $kode_mk,
        'nilai' =>  $nilai,
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
    echo "<br><a href=selectNilaiView.php> OK </a>";
}
?>
