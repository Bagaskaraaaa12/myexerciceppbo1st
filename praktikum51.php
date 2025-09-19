<?php
class Mahasiswa {
    public $nama;
    public $nim;
    public $prodi;
    public $angkatan;
    public $keterangan;

    public function __construct($nama, $nim, $prodi, $angkatan, $keterangan) {
        $this->nama = $nama;
        $this->nim = $nim;
        $this->prodi = $prodi;
        $this->angkatan = $angkatan;
        $this->keterangan = $keterangan;
    }

    public function getKeterangan() {
        return "Mahasiswa {$this->nama} statusnya adalah {$this->keterangan}.";
    }
}

$mhs1 = new Mahasiswa("Rifa", "H1101241023", "Sistem Informasi", 2024, "Aktif");
$mhs2 = new Mahasiswa("Rasyid", "H1101241049", "Sistem Informasi", 2024, "Cuti");
$mhs3 = new Mahasiswa("Nabil", "H1101241000", "Sistem Komputer", 2024, "Keluar");

echo $mhs1->getKeterangan() . "<br>";
echo $mhs2->getKeterangan() . "<br>";
echo $mhs3->getKeterangan() . "<br>";
?>