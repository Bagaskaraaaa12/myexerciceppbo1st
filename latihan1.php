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
$luas = $panjang * $lebar;
$keliling = 2 * ($panjang + $lebar);
?>
    <div>
    Hasil dari luas persegi panjang dengan panjang 
    <?= $panjang ?> cm dan lebar <?= $lebar ?> cm adalah:
    </div><br>
    <div><strong><?= $luas ?> <br>
    <div>
    Kemudian, hasil dari keliling persegi panjang dengan panjang
    <?= $panjang ?> cm dan lebar <?= $lebar ?> cm adalah:
    </div><br>
    <div><strong><?= $keliling ?> <br>
    <h2> Begitu  hasilnya, kamu bisa return ke menu home untuk melihat latihan yang lain ya! </h2>

    <a href="home.php"> Home </a>
</body>

    </html>
