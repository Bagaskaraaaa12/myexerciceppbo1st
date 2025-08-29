<?php
// index.php
$nama = "Bagaskara";
$panjang = 5;
$lebar = 10;
$hasil = $panjang * $lebar;
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
        </div>
    </div>
      <div>
    Hasil dari perhitungan sebuah persegi panjang dengan panjang 
    <?= $panjang ?> dan lebar <?= $lebar ?> adalah:
</div>
<h1><strong><?= $hasil ?></strong></h1>
    
    <div>Jika kamu ingin pindah laman,  silahkan tekan link home dibawah ya!
    </div>      
  <a href="home.php">HOME</a>
</body>
</html>
