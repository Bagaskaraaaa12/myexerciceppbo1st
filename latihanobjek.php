<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
// Buat class mobil
class Mobil {
  // buat property untuk class laptop
  var $pemilik;
  var $merk;
  var $warna;
  //Buat method untuk class mobil
  function hidupkan_mobil(){
    return "Hidupkan Mobil anda";
  }


  function matikan_mobil(){
    return "Matikan Mobil anda";
  }
}
// buat objek dari class laptop (instansiasi)
$mobil_syahrul = new Mobil();
//Set property
$mobil_syahrul->pemilik = "Syahrukhan";
$mobil_syahrul->merk = "Leopard";
$mobil_syahrul->warna = "Merah Merona";

// tampilkan property
echo $mobil_syahrul->pemilik;
echo "\n";
echo $mobil_syahrul->merk;
echo "\n";

echo $mobil_syahrul->warna;
echo "\n";
// tampilkan method
echo $mobil_syahrul->hidupkan_mobil();
echo "\n";
echo $mobil_syahrul->matikan_mobil();

echo "\n";
echo "br";
// Buat class mobil
class mobill
{
  // buat property untuk class laptop
  var $pemilik;
  var $merk;
  var $warna;
  //Buat method untuk class mobil
  function hidupkan_mobil()
  {
    return "Hidupkan Mobil anda";
  }
  function matikan_mobil()
  {


    return "Matikan Mobil anda";
  }
}
// buat objek dari class laptop (instansiasi)
$mobil_syahrul = new mobill();
$mobil_rahma = new mobill();
$mobil_yuda = new mobill();
// set property
$mobil_syahrul->pemilik = "Syahrukhan";
$mobil_rahma->pemilik = "Rahmadhan";
$mobil_yuda->pemilik = "perang";
// tampilkan property
echo $mobil_syahrul->pemilik; //syahrul
echo "\n";
echo $mobil_rahma->pemilik; //rahma
echo "\n";
echo $mobil_yuda->pemilik; //yuda
echo "\n";

?>

<?php
class akun {
    var $email;
    var $username;
    var $password;

    function login_berhasil()
    {
    return ", anda berhasil login!";
    }
}

$email_pertama = new akun();
$username_pertama = new akun();
$password_pertama = new akun();

$email_pertama->email = "budi@gmail.com";
$username_pertama->username = "budi";
$password_pertama->password = "123";

echo $email_pertama->email;
echo "\n";
echo $username_pertama->username;
echo "\n";
echo $password_pertama->password;
echo "\n";
?>

<div>
    <p> tekan logo dibawah jika anda ingin kembali ke menu home</p>
    <a href="home.php"> Home </a>
</div>
</body>
</html>
