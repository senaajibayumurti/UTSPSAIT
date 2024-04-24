<?php

$nim = $_GET['nim'];
$kode_mk = $_GET['kode_mk'];

// Pastikan sesuai dengan alamat endpoint dari REST API di ubuntu
$url = 'http://localhost/psait_uts/mahasiswa_api.php?nim='.$nim.'&kode_mk='.$kode_mk.'';    

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
// Pastikan method nya adalah DELETE
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
$result = json_decode($result, true);

curl_close($ch);

// Tampilkan return statusnya, apakah sukses atau tidak
// TODO = Fixing "Trying to access array offset on value of type null in line 22 and 24", it prevents on deleting the data
print("<center><br>Status: {$result["status"]} "); 
print("<br>");  
print("message :  {$result["message"]} "); 

echo "<br>Sukses menghapus data di ubuntu server !";
echo "<br><a href=selectNilaiView.php> OK </a>";

?>