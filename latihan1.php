<!DOCTYPE html>
<html>
<head>
    <title>Persegi Panjang</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            margin-top: 50px;
        }
    </style>
</head>
<body>
<h1 style="font-family : arial"> Selamat datang, kamu sekarang berada di latihan pertama </h1>
<p>Pada laman kali ini, Aku akan membuat beberapa uji coba dari tugas pak Syahru yang berada di edlink</p>
<p>Disini, aku akan membuat sebuah percobaan untuk menghitung luas persegi panjang</p>
<?php
// index.php
$panjang = 5;
$lebar = 10;
$hasil = $panjang * $lebar;
?>
    <div>
    Hasil dari luas perhitungan sebuah persegi panjang dengan panjang 
    <?= $panjang ?> dan lebar <?= $lebar ?> adalah:
    </div>
    <div><strong><?= $hasil ?> <br>
</body>

    </html>
