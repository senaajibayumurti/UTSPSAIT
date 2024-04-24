<?php

$games_id = $_GET['games_id'];

// Pastikan sesuai dengan alamat endpoint dari REST API di ubuntu
$url = 'http://localhost/psait_pert_7/mahasiswa_api.php?games_id=' . $games_id;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
// Pastikan method nya adalah DELETE
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
$result = json_decode($result, true);

curl_close($ch);

// Tampilkan return statusnya, apakah sukses atau tidak
print("<center><br>Status: {$result["status"]} "); 
print("<br>Message: {$result["message"]} "); 
echo "<br>Sukses menghapus data di ubuntu server !";
echo "<br><a href=selectGamesView.php> OK </a>";

?>
