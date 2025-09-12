<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
//Buat Class Mobil
class Mobil
{
    // buat public property
    public $pemilik;
    //Buat public method
    public function hidupkan_mobil()
    {
        return "Hidupkan Mesin Mobil";
    }
}
//Buat objek dari class mobil (instansiasi)
$mobil_yuda = new mobil();
//Set Property
$mobil_yuda->pemilik = "Syahrukhan";
//Tampilkan property
echo $mobil_yuda->pemilik; //Syahrukhan
//Tampilkan Method
echo $mobil_yuda->hidupkan_mobil(); //hidupkan mobil

?>

<br>

<?php
// buat class mobil
class mobill
{
  // buat protected property
  protected $pemilik = "yuda";
  public function akses_pemilik()
  {
    return $this->pemilik;
  }
  protected function hidupkan_mobil()
  {
    return "Hidupkan Mobil";
  }
  public function paksa_hidup()
  {
    return $this->hidupkan_mobil();
  }
}
// buat objek dari class mobil (instansiasi)
$mobil_yuda = new mobill();
// jalankan method akses_pemilik()
echo $mobil_yuda->akses_pemilik(); // "yuda"
echo "\n";
// jalankan method paksa_hidup()
echo $mobil_yuda->paksa_hidup(); // "Hidupkan Mobil"

?>

<br>

<?php
//Buat class motor
class motor
{
  //property dengan hak akses protected
  protected $jenis_mesin = "Yamaha CB JKT 48";
}
//buat class yamaha
class yamaha extends motor
{
  public function tampilkan_jenismesin()
  {
    return $this->jenis_mesin;
  }
}
//buat objek dari class yamaha (instantiation)
$yamaha_yuda = new yamaha();
//jalankan method
echo $yamaha_yuda->tampilkan_jenismesin(); //“Yamaha CB JKT 48”
?>

<br>

<?php
//buat class kendaraan
class kendaraann
{
  // property dengan hak akses private
  private $jenis_mesin = "AKA 748 TURBO JET NUKLIR";
  public function tampilkan_mesin()
  {
    return $this->jenis_mesin;
  }
}
//buat class motor
class motorr extends kendaraann
{
  public function tampilkan_mesin()
  {
    return $this->jenis_mesin;
  }
}
// buat objek dari class motor (instantiation)
$kendaraan_motor = new kendaraann();
$motor_honda = new motorr();
//jalankan method dari class kendaraan
echo $kendaraan_motor->tampilkan_mesin(); //AKA 748 TURBO
// JET NUKLIR
//jalankan method dari class motor (error)
echo $motor_honda->tampilkan_mesin();
//notice:Undefined property: motor::$jenis_mesin
?>

<div>
    <p> tekan logo dibawah jika anda ingin kembali ke menu home</p>
    <a href="home.php"> Home </a>
</div>
</body>
</html>
