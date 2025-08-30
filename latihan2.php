<!DOCTYPE html>
<html>
<head>
    <title>Produk</title>
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
        .tampil {
            display: inline-block; /* biar jadi kotak */
            padding: 20px;
            margin: 20px auto;
            background: rgba(194, 68, 68, 0.8);
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.3);
            text-align: left; /* biar tulisan rata kiri */
            font-family: monospace; /* biar mirip gaya rumus */
            color: navy;
        }
        

    </style>
</head>
<body>
<h1> Selamat datang di Latihan 2</h1>
<p>pada laman ini, kamu akan mengetahui apa nama merk, harga, dan stok dari sebuah produk</p>

<?php
class Produk {
    public $nama;
    public $harga;
    public $stok;

    public function tampilkanInfo() {
        return "<div class='tampil'>
        Kami mempunyai sebuah Produk: $this->nama <br> 
        Harganya : Rp $this->harga,<br> 
        Sisa Stok: $this->stok
    </div>";
    }
    public function beliProduk($jumlah) {
        if ($jumlah > $this->stok) {
            return "Maaf, stok tidak cukup untuk membeli $jumlah item.";
        } else {
           $this->stok -= $jumlah;
            $total = $this->harga * $jumlah;
            return "Anda berhasil membeli $jumlah buah  $this->nama dengan total harga Rp $total. <br> Sisa stok $this->nama adalah : $this->stok";
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

<p>Jika anda sudah membeli, maka anda bisa kembali ke menu HOME dibawah ini ya</p>
<div class="menu">
<a href="home.php"> HOME </a>
</div>
</body>
</html>
