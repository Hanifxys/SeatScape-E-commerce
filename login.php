<?php
session_start();

// Include the database connection file
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    // Ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Koneksi ke database
        $pdo = connectDB();

        // Query SQL untuk melakukan login
        $query = "SELECT * FROM admin WHERE username = :username AND password = :password";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['user_id'] = $user['id_admin'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            header("Location: index.php"); // Redirect ke halaman index.php
            exit();
        } else {
            $error_message = "Username atau password salah.";
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(#141e30, #243b55);
        }

        .login-box {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 400px;
            padding: 40px;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, .5);
            box-sizing: border-box;
            box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
            border-radius: 10px;
        }

        .login-box h2 {
            margin: 0 0 30px;
            padding: 0;
            color: #F1EEE6;
            text-align: center;
        }

        .login-box .user-box {
            position: relative;
        }

        .login-box .user-box input {
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            color: #F1EEE6;
            margin-bottom: 30px;
            border: none;
            border-bottom: 1px solid #F1EEE6;
            outline: none;
            background: transparent;
        }

        .login-box .user-box label {
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px 0;
            font-size: 16px;
            color: #F1EEE6;
            pointer-events: none;
            transition: .5s;
        }

        .login-box .user-box input:focus~label,
        .login-box .user-box input:valid~label {
            top: -20px;
            left: 0px;
            color: #03E9F4;
            font-size: 12px;
        }

        .login-box form a {
            position: relative;
            display: inline-block;
            padding: 10px 20px;
            color: #03E9F4;
            font-size: 16px;
            text-decoration: none;
            text-transform: uppercase;
            overflow: hidden;
            transition: .5s;
            margin-top: 40px;
            letter-spacing: 4px;
        }

        .login-box form a:hover {
            background: #03E9F4;
            color: #F1EEE6;
            border-radius: 5px;
            box-shadow: 0 0 5px #03E9F4, 0 0 25px #03E9F4, 0 0 50px #03E9F4, 0 0 100px #03E9F4;
        }

        .login-box a span {
            position: absolute;
            display: block;
        }

        .login-box a span:nth-child(1) {
            top: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #03e9f4);
            animation: btn-anim1 1s linear infinite;
        }

        @keyframes btn-anim1 {
            0% {
                left: -100%;
            }

            50%, 100% {
                left: 100%;
            }
        }

        .login-box span:nth-child(2) {
            top: -100%;
            right: 0;
            width: 2px;
            height: 100%;
            background: linear-gradient(180deg, transparent, #03E9F4);
            animation: btn-anim2 1s linear infinite;
            animation-delay: .25s;
        }

        @keyframes btn-anim2 {
            0% {
                top: -100%;
            }

            50%, 100% {
                top: 100%;
            }
        }

        .login-box span:nth-child(3) {
            bottom: 0;
            tight: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(270deg, transparent, #03E9F4);
            animation: btn-anim3 1s linear infinite;
            animation-delay: .5s;
        }

        @keyframes btn-anim3 {
            0% {
                right: -100%;
            }

            50%, 100% {
                right: 100%;
            }
        }

        .login-box span:nth-child(4) {
            bottom: -100%;
            left: 0;
            width: 2px;
            height: 100%;
            background: linear-gradient(360deg, transparent, #30E9F4);
            animation: btn-anim4 1s linear infinite;
            animation-delay: .75s;
        }

        @keyframes btn-anim4 {
            0% {
                bottom: -100%;
            }

            50%, 100% {
                bottom: 100%;
            }
        }

        .welcome-message {
            text-align: center;
            color: #F1EEE6;
            margin-top: 20px;
        }

        .login-box button {
    position: relative;
    display: inline-block;
    padding: 10px 20px;
    color: #F1EEE6;
    font-size: 16px;
    text-decoration: none;
    text-transform: uppercase;
    overflow: hidden;
    transition: .5s;
    letter-spacing: 4px;
    border: 2px solid #03E9F4;
    background: transparent;
    cursor: pointer;
}
.login-box {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 400px;
    padding: 40px;
    background: rgba(0, 0, 0, .5);
    box-sizing: border-box;
    box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
    border-radius: 10px;
    text-align: center;
    color: #F1EEE6;
    margin: auto;
}

.login-box button:hover {
    color: #03E9F4;
    background: #F1EEE6;
    border: 2px solid #F1EEE6;
    border-radius: 5px;
    box-shadow: 0 0 5px #03E9F4, 0 0 25px #03E9F4, 0 0 50px #03E9F4, 0 0 100px #03E9F4;
}
    </style>
</head>

<body>
    <div class="login-box">
        <h2>Login</h2>
        <form method="post" action="">
            <div class="user-box">
                <input type="text" name="username" required="">
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="">
                <label>Password</label>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
        <?php
        if (isset($_SESSION['username'])) {
            echo "<p class='welcome-message'>Welcome to Dashboard, Admin {$_SESSION['username']} at Seatscape!</p>";
        }
        ?>
    </div>
</body>

</html>
