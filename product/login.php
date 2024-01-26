<?php
session_start();
include_once '../config.php';
$pdo = connectDB();



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form login
    $email = $_POST['email_pelanggan'];
    $password = $_POST['password_pelanggan'];
    $remember_me = isset($_POST['remember_me']) ? true : false;

    // Query untuk mengecek keberadaan pelanggan dengan email dan password yang sesuai
    $stmt = $pdo->prepare("SELECT * FROM pelanggan WHERE email_pelanggan = :email AND password_pelanggan = :password");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Cek apakah login berhasil
    if ($stmt->rowCount() > 0) {
        // Login berhasil
        $pelanggan = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set session pelanggan
        $_SESSION['id_pelanggan'] = $pelanggan['id_pelanggan'];
        $_SESSION['nama_pelanggan'] = $pelanggan['nama_pelanggan'];
        $_SESSION['email_pelanggan'] = $pelanggan['email_pelanggan'];
        $_SESSION['telepon_pelanggan'] = $pelanggan['telepon_pelanggan'];

       
if ($remember_me) {
    setcookie("login_status", "success", time() + 24 * 60 * 60, "/");
}


        // Redirect ke checkout.php
        header("Location: checkout.php");
        exit();
    } else {
        // Login gagal
        echo '<script>alert("Login gagal. Periksa kembali email dan password Anda."); window.location.href = "login.php";</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelanggan</title>
    <style>
        h2 {
            text-align: center;
        }

        .login-container {
            text-align: center;
            margin-top: 50px;
        }

        .login-card {
            width: 300px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <?php include '../Templates/navbar.php'; ?>

    <h2>Login Pelanggan</h2>
    <div class="login-container">
        <div class="login-card">
            <form method="post" action="">
                <label for="email_pelanggan">Email:</label>
                <input type="email" name="email_pelanggan" required>

                <label for="password_pelanggan">Password:</label>
                <input type="password" name="password_pelanggan" required>

                <label for="remember_me">
                    <input type="checkbox" name="remember_me"> Remember Me
                </label>

                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>
