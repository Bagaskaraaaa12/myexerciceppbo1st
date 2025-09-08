<?php
class User {
    private $username = "Rifa";
    private $password = "Sisteminformasi";

    public function login($username, $password) {
        if ($username === $this->username && $password === $this->password) {
            return "Login berhasil. Selamat datang, $username!";
        } else {
            return "Login gagal. Username atau password salah.";
        }
    }
}
$result = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUser = $_POST["username"];
    $inputPass = $_POST["password"];

    $user = new User();
    $result = $user->login($inputUser, $inputPass);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Sederhana</title>
    <style>
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
    <h1>Form Login</h1>
    <form method="post">
        Username: <input type="text" name="username"><br><br>
        Password: <input type="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>

    <p><?= $result ?></p>
    <p> jika anda ingin menuju ke menu home tekan tombol dibawah ini </p>
    <div class="menu">
        <a href="home.php"> HOME </div>
</body>
</html>

