<?php
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Website PHP di Hugging Face</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
    </style>
class Produk {
    // Property
    public $nama;
    public $harga;
    public $stok;

    // Method tampilkanInfo
    public function tampilkanInfo() {
        return "Produk: $this->nama dengan Harga: Rp $this->harga, Mempunyai sisa Stok: $this->stok";
    }

    // Method beliProduk
    public function beliProduk($jumlah) {
        if ($jumlah > $this->stok) {
            return "Maaf, stok tidak cukup untuk membeli $jumlah item.";
        } else {
            $this->stok -= $jumlah;
            return "Anda berhasil membeli $jumlah $this->nama. Sisa stok: $this->stok";
        }
    }
}

// Membuat objek dari class Produk
$produk1 = new Produk();
$produk1->nama = "Chitato";
$produk1->harga = 10000;
$produk1->stok = 50;

// Tes method
echo $produk1->tampilkanInfo();
echo "<br>";
echo $produk1->beliProduk(3);
echo "<br>";
echo $produk1->tampilkanInfo();
?>
