<?php
// index.php
$nama = "Bagaskara";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Website PHP di Hugging Face</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .container { max-width: 600px; margin: 0 auto; }
        .box { background: #f0f8ff; padding: 20px; border-radius: 10px; margin-top: 20px; }

        h1 {
            color: maroon;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.6);
        }
        p {
            color: maroon;
        }
        .menu {
            display: flex;
            justify-content: column;
            gap: 20px; 
            margin-top: 30px;
        }
        .menu a {
            display: inline-block;
            padding: 20px 40px;
            background: rgba(145, 62, 62, 0.8); /* kotak semi transparan */
            border-radius: 12px;
            text-decoration: none;
            font-weight: bold;
            color: #fffdfdff;
            transition: 0.3s;
            box-shadow: 0px 4px 10px rgba(96, 26, 26, 0.3);
        }
        .menu a:hover {
            background: linear-gradient(135deg, #e59292ff, #ffffffff);
            color: black;
            transform: translateY(-5px); 
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.83);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selamat Datang di Website Tugas Rifa Dwinanda Bagaskara!</h1>
    </div>
    <div>Jika kamu ingin pindah laman untuk melihat tugas yang telah aku kerjakan,  silahkan tekan link home dibawah ya!
    </div><br>
    <div class="menu">
  <a href="home.php">HOME</a>
    </div>
</body>
</html>