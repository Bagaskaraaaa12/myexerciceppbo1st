<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
// Buat class mobil
class Mobil {
  // buat property untuk class laptop
  var $pemilik;
  var $merk;
  var $warna;
  //Buat method untuk class mobil
  function hidupkan_mobil(){
    return "Hidupkan Mobil anda";
  }


  function matikan_mobil(){
    return "Matikan Mobil anda";
  }
}
// buat objek dari class laptop (instansiasi)
$mobil_syahrul = new Mobil();
//Set property
$mobil_syahrul->pemilik = "Syahrukhan";
$mobil_syahrul->merk = "Leopard";
$mobil_syahrul->warna = "Merah Merona";

// tampilkan property
echo $mobil_syahrul->pemilik;
echo "\n";
echo $mobil_syahrul->merk;
echo "\n";

echo $mobil_syahrul->warna;
echo "\n";
// tampilkan method
echo $mobil_syahrul->hidupkan_mobil();
echo "\n";
echo $mobil_syahrul->matikan_mobil();

?>

<div>
    <p> tekan logo dibawah jika anda ingin kembali ke menu home</p>
    <div>
        link modul bs diakses di https://bit.ly/Prak5PBO
    </div>
    <a href="home.php"> Home </a>
</div>
</body>
</html>
