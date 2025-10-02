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
<h1 style="font-family : arial"> Selamat datang, kamu sekarang berada di praktikum 6 </h1>
<p>Mari kita membuat sebuah objek PHP dengan class Bunga menggunakan constructor dan destructor!.</p>
<?php
class Bunga {
    private $nama;
    private $warna;
    private $harga;

    public function __construct($nama, $warna, $harga) {
        $this->nama = $nama;
        $this->warna = $warna;
        $this->harga = $harga;
        echo "Objek bunga {$this->nama} telah dibuat!<br>";
    }
    public function tampilkanInfo() {
        return "Bunga {$this->nama} berwarna {$this->warna} dengan harga Rp {$this->harga}<br>";
    }
    public function __destruct() {
        echo "Objek bunga {$this->nama} telah dihancurkan.<br>";
    }
}

$bunga1 = new Bunga("violet", "red", 20000);
echo $bunga1->tampilkanInfo();


$bunga2 = new Bunga("rose", "blue", 30000);
echo $bunga2->tampilkanInfo();

unset($bunga1);


echo "Program selesai dijalankan.<br>";
?>



  <p>Jika anda sudah melihat hasilnya, maka anda bisa kembali ke menu HOME dibawah ini ya</p>
<div class="menu">
<a href="home.php"> HOME </a>
</div>
</body>
</html>
