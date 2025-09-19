<?php

class Mobil {
    public $pemilik;
    public $merk;
    public $warna;

     public function hidupkan_mobil () {
        return "hidupkan mobil";
     }
     public function matikan_mobil () {
        return "matikan  mobil";
     }
}

$mobilsahroni = new Mobil();
echo $mobilsahroni -> hidupkan_mobil();

echo "\n";

?>
