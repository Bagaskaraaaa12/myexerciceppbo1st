<!DOCTYPE html>
<html>
<head>
    <title>Contoh Produk</title>
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
            background: rgba(255, 255, 255, 0.8); /* kotak semi transparan */
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
<h1 style="font-family : arial"> Selamat datang, kamu sekarang berada di page home </h1>
<p>silahkan pilih opsi yang anda inginkan dibawah ini</p>
<div class="menu">
<a href="latihan1.php"> latihan 1 </a><br>
<a href="latihan2.php"> latihan 2 </a><br>
<a href="latihan3.php"> latihan 3 </a>
    </div>
</body>
</html>

