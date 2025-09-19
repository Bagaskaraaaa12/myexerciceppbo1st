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
<h1 style="font-family : arial"> Selamat datang, kamu sekarang berada di praktikum 5.2 </h1>
<p>Mari kita membuat sebuah Ubah class Mahasiswa sehingga IPK bersifat protected dan password bersifat private. Tambahkan method untuk menampilkan keduanya sesuai aturan hak akses.</p>
<?php
class Mahasiswa {
    var $nama;
    var $nim;
    var $prodi;

    protected $ipk;       
    private $password;  

    protected function getNilaiIPK() {
        return "Nilai IPK mahasiswa adalah $this->ipk";
    }

    private function getPassword() {
        return "Password akun mahasiswa adalah $this->password";
    }

    function setNilaiIPK($ipk) {
        $this->ipk = $ipk;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    public function tampilkanIPK() {
        return $this->getNilaiIPK();
    }

    public function tampilkanPassword() {
        return $this->getPassword();
    }
}

$m1 = new Mahasiswa();
$m1->nama = "Rifa";
$m1->nim = "H1101241023";
$m1->prodi = "Sistem Informasi";
$m1->setNilaiIPK(3.8);
$m1->setPassword("123");

$m2 = new Mahasiswa();
$m2->nama = "Rasyid";
$m2->nim = "H1101241049";
$m2->prodi = "Sistem Informasi";
$m2->setNilaiIPK(3.7);
$m2->setPassword("456");

$m3 = new Mahasiswa();
$m3->nama = "Nabil";
$m3->nim = "H1101241046";
$m3->prodi = "Sistem Informasi";
$m3->setNilaiIPK(3.75);
$m3->setPassword("789");

// Simpan ke array untuk looping
$daftarMahasiswa = [$m1, $m2, $m3];

// Tampilkan data
foreach ($daftarMahasiswa as $mhs) {
    echo "Nama: {$mhs->nama}<br>";
    echo "NIM: {$mhs->nim}<br>";
    echo "Prodi: {$mhs->prodi}<br>";
    echo $mhs->tampilkanIPK() . "<br>";
    echo $mhs->tampilkanPassword() . "<br><br>";
}
?>


  <p>Jika anda sudah melihat hasilnya, maka anda bisa kembali ke menu HOME dibawah ini ya</p>
<div class="menu">
<a href="home.php"> HOME </a>
</div>
</body>
</html>
