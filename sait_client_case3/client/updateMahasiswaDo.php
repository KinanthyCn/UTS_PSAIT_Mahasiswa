<?php

if(isset($_POST['submit']))
{    

$nim = $_POST['nim'];
$kode_mk = $_POST['kode_mk'];
$nilai = $_POST['nilai'];


//Pastikan sesuai dengan alamat endpoint dari REST API di ubuntu
$url='http://localhost/sait_client_case3/uts_sait_mahasiswa_api/mahasiswa_api.php?nim='.$nim.'&kode_mk='.$kode_mk.'&nilai='.$nilai;
$ch = curl_init($url);
//kirimkan data yang akan di update
$jsonData = array(
    'nim' =>  $nim,
    'kode_mk' =>  $kode_mk,
    'nilai' =>  $nilai,
);

//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData, true);


curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, true);

//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 

$result = curl_exec($ch);
$result = json_decode($result, true);
curl_close($ch);

//var_dump($result);
print("<center><br>status :  {$result["status"]} "); 
print("<br>");
print("message :  {$result["message"]} "); 
 echo "<br>Sukses mengupdate data di MySql server !";
 echo "<br><a href=selectMahasiswaView.php> OK </a>";
}
?>

 