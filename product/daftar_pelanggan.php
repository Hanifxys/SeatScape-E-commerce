<?php
session_start();
include_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['daftar'])) {
        $nama_pelanggan = $_POST['nama_pelanggan'];
        $email_pelanggan = $_POST['email_pelanggan'];
        $password_pelanggan = password_hash($_POST['password_pelanggan'], PASSWORD_DEFAULT);
        $telepon_pelanggan = $_POST['telepon_pelanggan'];

        $pdo = connectDB();

        try {
            $query = "INSERT INTO pelanggan (nama_pelanggan, email_pelanggan, password_pelanggan, telepon_pelanggan) 
                      VALUES (:nama_pelanggan, :email_pelanggan, :password_pelanggan, :telepon_pelanggan)";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':nama_pelanggan', $nama_pelanggan, PDO::PARAM_STR);
            $stmt->bindParam(':email_pelanggan', $email_pelanggan, PDO::PARAM_STR);
            $stmt->bindParam(':password_pelanggan', $password_pelanggan, PDO::PARAM_STR);
            $stmt->bindParam(':telepon_pelanggan', $telepon_pelanggan, PDO::PARAM_STR);

            if ($stmt->execute()) {
                // Pendaftaran berhasil, redirect ke halaman login.php
                header("Location: login.php?registrasi=berhasil");
                exit;
            } else {
                echo 'Gagal melakukan pendaftaran pelanggan.';
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo 'Formulir tidak dikirim dengan benar.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">    
    <style>
        h2 {
    text-align: center;
}
</style>
</head>

<body>
    <?php include '../Templates/navbar.php'; ?>
    <h2>Daftar Pelanggan</h2>

    <div class="login-container">
        <div class="login-card">
    <form action="" method="post">
        <label for="nama">Nama:</label>
        <input type="text" name="nama_pelanggan" required>

        <label for="email">Email:</label>
        <input type="email" name="email_pelanggan" required>

        <label for="password">Password:</label>
        <input type="password" name="password_pelanggan" required>

        <label for="telepon">Telepon/HP:</label>
        <input type="text" name="telepon_pelanggan" required>

        <button type="submit" name="daftar">Daftar</button>
    </form>
</div>
</div>
   
</body>

</html>
