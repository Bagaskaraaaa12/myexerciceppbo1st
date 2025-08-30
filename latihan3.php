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

// Kalau form dikirim
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
</head>
<body>
    <h1>Form Login</h1>
    <form method="post">
        Username: <input type="text" name="username"><br><br>
        Password: <input type="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>

    <p><?= $result ?></p>
</body>
</html>

