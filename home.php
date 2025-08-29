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
<p>Pada laman kali ini, kamu akan aku arahin untuk melihat stok dan harga yang tersedia apabila kamu membeli sebuah produk dengan jumlaah tertetuu</p>
    
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

