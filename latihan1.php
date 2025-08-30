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
        h1 {
            color: navy;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.6);
        }
        p {
            color: navy;
        }
        .menu {
            display: flex;
            justify-content: center;
            gap: 20px; 
            margin-top: 30px;
        }
        .menu a {
            display: inline-block;
            padding: 20px 40px;
            background: rgba(145, 62, 62, 0.8); /* kotak semi transparan */
            border-radius: 12px;
            text-decoration: none;
            font-weight: bold;
            color: #fffdfdff;
            transition: 0.3s;
            box-shadow: 0px 4px 10px rgba(96, 26, 26, 0.3);
        }
        .menu a:hover {
            background: linear-gradient(135deg, #9d99ffff, #ffffffff);
            color: black;
            transform: translateY(-5px); 
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.83);
        }
        .rumus {
            display: inline-block; /* biar jadi kotak */
            padding: 20px;
            margin: 20px auto;
            background: rgba(255,255,255,0.8);
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.3);
            text-align: left; /* biar tulisan rata kiri */
            font-family: monospace; /* biar mirip gaya rumus */
            color: navy;
        }
    </style>
</head>
<body>
<h1 style="font-family : arial"> Selamat datang, kamu sekarang berada di latihan pertama </h1>
<p>Mari kita membuat sebuah perhitungan sebuah persegi panjang</p>
<?php
// index.php
$panjang = 5;
$lebar = 10;
$luas = $panjang * $lebar;
$keliling = 2 * ($panjang + $lebar);
?>

    <p>Jika sebuah persegi panjang memiliki</p>
    <p>Panjang : 5 CM    |   Tinggi  : 10 CM </p>
    <p> Berapakah Luas dan Keliling persegi panjang tersebut?</p>
    <div class="rumus">
            Rumus persegi panjang <br>
        Luas        =   Panjang x lebar <br>
        Keliling    = 2 * (panjang+lebar) <br>
    </div>
    <div>
    Hasil dari luas persegi panjang dengan panjang 
    <?= $panjang ?> cm dan lebar <?= $lebar ?> cm adalah: <?= $luas ?> <br>
    </div><br>
    <div>
    Kemudian, hasil dari keliling persegi panjang dengan panjang
    <?= $panjang ?> cm dan lebar <?= $lebar ?> cm adalah : <?= $keliling ?> <br>
    </div>
    <p> Jadi, begitu ya cara menghitungnya. Jika kamu ingin kembali ke menu home, tekan dibawah ini</p>
    <div class="menu">
    <a href="home.php"> HOME </a>
    </div>
</body>

    </html>
