<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
//Buat Class Mobil
class Mobil
{
    // buat public property
    public $pemilik;
    //Buat public method
    public function hidupkan_mobil()
    {
        return "Hidupkan Mesin Mobil";
    }
}
//Buat objek dari class mobil (instansiasi)
$mobil_yuda = new mobil();
//Set Property
$mobil_yuda->pemilik = "Syahrukhan";
//Tampilkan property
echo $mobil_yuda->pemilik; //Syahrukhan
//Tampilkan Method
echo $mobil_yuda->hidupkan_mobil(); //hidupkan mobil

?>
<div>
    <p> tekan logo dibawah jika anda ingin kembali ke menu home</p>
    <a href="home.php"> Home </a>
</div>
</body>
</html>
