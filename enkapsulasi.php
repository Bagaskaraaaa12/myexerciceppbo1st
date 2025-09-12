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

<?php
// buat class mobil
class mobil
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
$mobil_yuda = new mobil();
// jalankan method akses_pemilik()
echo $mobil_yuda->akses_pemilik(); // "yuda"
echo "\n";
// jalankan method paksa_hidup()
echo $mobil_yuda->paksa_hidup(); // "Hidupkan Mobil"

?>

<div>
    <p> tekan logo dibawah jika anda ingin kembali ke menu home</p>
    <a href="home.php"> Home </a>
</div>
</body>
</html>
