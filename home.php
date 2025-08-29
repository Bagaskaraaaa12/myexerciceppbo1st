<?php
class produk {
    // Property
    public $merk;
    public $harga;
    public $stok;

    // Method
    public function beli() {
        return "anda membeli barang $this->merk seharga $this->harga yang memiliki sisa stok $this->stok, sekarang sisa stok yang ada adalah $stok-1";
    }
}

Membuat Object
<?php
// Membuat objek dari class produk
$merk1 = new produk();
$merk1->merk = "chitato";
$merk1->harga = 10000;
$merk1->stok = 50;

echo $mobil1->jalan(); 
