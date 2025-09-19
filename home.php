<!DOCTYPE html>
<html>
<head>
    <title>Contoh Produk</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f5f7fa;
        }
        h1 {
            color: navy;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.6);
            margin-bottom: 10px;
        }
        p {
            color: navy;
        }

        /* kotak pembungkus tiap bagian */
        .section {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 15px;
            margin: 20px auto;
            width: 70%;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.3);
        }

        /* grid untuk menu */
        .menu {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* 2 kolom */
            gap: 20px;
            justify-items: center; /* biar tombol di tengah */
            margin-top: 20px;
        }

        /* tombol */
        .menu a {
            display: inline-block;
            text-align: center;
            padding: 15px 20px;
            width: 160px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            text-decoration: none;
            font-weight: bold;
            color: #333;
            transition: 0.3s;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.3);
        }
        .menu a:hover {
            background: linear-gradient(135deg, #9a92e5ff, #ffffffff);
            color: black;
            transform: translateY(-5px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.83);
        }
    </style>
</head>
<body>
    <h1>Selamat datang, kamu sekarang berada di page home</h1>

    <div class="section">
        <p>Dibawah ini terdapat beberapa tugas dari praktikum 3 yang telah dikerjakan</p>
        <div class="menu">
            <a href="latihan1.php"> LATIHAN 1 </a>
            <a href="latihan2.php"> LATIHAN 2 </a>
            <a href="latihan3.php"> LATIHAN 3 </a>
            <a href="tugasmandiri.php"> Tugas Mandiri </a>
            <a href="enkapsulasi.php"> Enkapsulasi </a>
            <a href="this.php"> Variabel This </a>
            <a href="praktikum51.php"> Praktikum 5.1 </a>
            <a href="praktikum52.php"> Praktikum 5.2 </a>
        </div>
    </div>

    <div class="section">
        <p>Dibawah ini terdapat tugas teori pemrograman berorientasi projek</p>
        <div class="menu">
            <a href="objeksegitiga.php"> Objek Segitiga </a>
            <a href="classsegitiga.php"> Class Segitiga </a>
            <a href="latihanobjek.php"> Latihan Objek </a>
        </div>
    </div>

    <div class="section">
        <p>Jika kamu ingin kembali ke menu index, silahkan tekan opsi dibawah ini</p>
        <div class="menu">
            <a href="index.php"> INDEX </a>
        </div>
    </div>
</body>
</html>
