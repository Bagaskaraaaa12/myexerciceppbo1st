<?php
class Buku {
    public $judul;
    public $penulis;
    public $tahun;

    public function __construct($judul, $penulis, $tahun) {
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->tahun = $tahun;
    }

    public function tampilkanInfo() {
        return "Judul: {$this->judul}, Penulis: {$this->penulis}, Tahun: {$this->tahun}";
    }
}

class Perpustakaan {
    private $daftarBuku = [];

    public function tambahBuku(Buku $buku) {
        $this->daftarBuku[] = $buku;
    }

    public function tampilkanBuku() {
        if (empty($this->daftarBuku)) {
            echo "Tidak ada buku dalam perpustakaan.<br>";
        } else {
            foreach ($this->daftarBuku as $buku) {
                echo $buku->tampilkanInfo() . "<br>";
            }
        }
    }
}

$perpus = new Perpustakaan();

$buku1 = new Buku("Bumi", "Tere Liye", );
$buku2 = new Buku("Bulan", "Tere Liye", );
$buku3 = new Buku("Matahari", "Tere Liye", );

$perpus->tambahBuku($buku1);
$perpus->tambahBuku($buku2);
$perpus->tambahBuku($buku3);

echo "<h3>Daftar Buku di Perpustakaan:</h3>";
$perpus->tampilkanBuku();
?>