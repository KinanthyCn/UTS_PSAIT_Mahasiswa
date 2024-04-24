<?php

$nim = $_GET['nim'];
$kode_mk = $_GET['kode_mk'];

// Pastikan sesuai dengan alamat endpoint dari REST API di ubuntu
$url = 'http://localhost/sait_client_case3/uts_sait_mahasiswa_api/mahasiswa_api.php?nim=' . $nim . '&kode_mk=' . $kode_mk;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_URL, $url);
// Pastikan method nya adalah DELETE
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
$result = json_decode($result, true);

curl_close($ch);

// Tampilkan return statusnya, apakah sukses atau tidak
echo "<center><br>status : {$result["status"]} ";
echo "<br>";
echo "message : {$result["message"]} ";

echo "<br>Sukses menghapus data di ubuntu server !";
echo "<br><a href=selectMahasiswaView.php> OK </a>";
?>
