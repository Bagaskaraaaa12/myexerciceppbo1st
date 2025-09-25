
<?php
class Bunga {
    private $nama;
    private $warna;
    private $harga;

    // Constructor: otomatis dijalankan saat objek dibuat
    public function __construct($nama, $warna, $harga) {
        $this->nama = $nama;
        $this->warna = $warna;
        $this->harga = $harga;
        echo "Objek bunga {$this->nama} telah dibuat!<br>";
    }

    // Method biasa
    public function tampilkanInfo() {
        return "Bunga {$this->nama} berwarna {$this->warna} dengan harga Rp {$this->harga}<br>";
    }

    // Destructor: otomatis dijalankan saat objek dihancurkan
    public function __destruct() {
        echo "Objek bunga {$this->nama} telah dihancurkan.<br>";
    }
}

// Membuat objek
$bunga1 = new Bunga("violet", "red", 20000);
echo $bunga1->tampilkanInfo();

$bunga2 = new Bunga("rose", "blue", 30000);
echo $bunga2->tampilkanInfo();

// Hapus salah satu objek manual
unset($bunga1);

echo "Program selesai dijalankan.<br>";
?>

