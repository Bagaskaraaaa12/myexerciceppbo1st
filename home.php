<!DOCTYPE html>
<html>
<head>
    <title>Contoh Produk</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            margin-top: 50px;
        }
    </style>
</head>
<body>
<h1 style="font-family : arial"> Selamat datang, kamu sekarang berada di page home </h1>

<p>Pada laman kali ini, Aku akan membuat beberapa uji coba dari tugas pak Syahru yang berada di edlink</p><br>
<p>Pertama aku akan membuat sebuah percobaan untuk menghitung luas persegi panjang</p>
<?php
// index.php
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
<div><strong><?= $hasil ?>

<p> selanjutnya, aku akan membuat sebuah program dimana aku akan menghitung sebuah class produk dengan harga, stok, dan merk yang ada</p>
<?php
class Produk {
    public $nama;
    public $harga;
    public $stok;

    public function tampilkanInfo() {
        return "Produk: $this->nama dengan Harga: Rp $this->harga, Mempunyai sisa Stok: $this->stok";
    }

    public function beliProduk($jumlah) {
        if ($jumlah > $this->stok) {
            return "Maaf, stok tidak cukup untuk membeli $jumlah item.";
        } else {
           $this->stok -= $jumlah;
            $total = $this->harga * $jumlah;
            return "Anda berhasil membeli $jumlah $this->nama dengan total harga Rp $total. Sisa stok: $this->stok";
        }
    }
}
$produk1 = new Produk();
$produk1->nama = "Chitato";
$produk1->harga = 10000;
$produk1->stok = 50;
echo "<div>";
echo $produk1->tampilkanInfo();
echo "<br><br>";
echo $produk1->beliProduk(3);
echo "<br><br>";
echo $produk1->tampilkanInfo();
echo "</div>";
?>



</body>
</html>

