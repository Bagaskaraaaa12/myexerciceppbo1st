<?php
// index.php
$nama = "Peserta Praktik";
$waktu = date("Y-m-d H:i:s");
$panjang = 5;
$lebar = 10;
$hasil = panjang * lebar;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Website PHP di Hugging Face</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .container { max-width: 600px; margin: 0 auto; }
        .box { background: #f0f8ff; padding: 20px; border-radius: 10px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selamat Datang di Website Bagaskara!</h1>
        <p>pada laman web ini kamu akan diajari tentang bagaimana cara menghitung luas persegi panjang! wahai <strong><?= htmlspecialchars($nama) ?></strong></p>
        <div class="box">
            <p>Waktu server: <code><?= $waktu ?></code></p>
            <p>Dijalankan di <strong>Docker</strong> di Hugging Face Spaces ✅</p>
             <h1>hasil dari</h1>
        <p<strong><?= htmlspecialchars($panjang) ?></strong></p>
         <p<strong><?= htmlspecialchars($lebar) ?></strong></p>  
        <div>$hasil</div>
            <div> silahkan tekan link home dibawah ya!
            </div>      
        </div>
    </div>
  <a href="/home.php">HOME</a>
</body>
</html>
