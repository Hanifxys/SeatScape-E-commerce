<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <nav>
    <div class="">
        <a href="../product/indexs.php">SuitScape</a>
    </div>
        <ul>
            <li><a href="../product/indexs.php">Home</a></li>
            <li><a href="../product/index.php">Products</a></li>
            <li><a href="keranjang.php">Keranjang</a></li>

            <?php if (isset($_COOKIE['login_status']) && $_COOKIE['login_status'] === 'success'): ?>
                <li><a href="logout.php" id="logoutLink">Logout</a></li>
            <?php else: ?>
                <li class="hide-on-cookie"><a href="login.php" id="loginLink">Login</a></li>
                <li class="hide-on-cookie"><a href="daftar_pelanggan.php" id="daftarLink">Daftar</a></li>
            <?php endif; ?>

            <li><a href="checkout.php">Checkout</a></li>
            <li>
            <a href="../product/contact.php">Contact</a>
        </li>
        </ul>
        <div class="burger-menu">&#9776;</div>
    </nav>

    <script>
        const burgerMenu = document.querySelector('.burger-menu');
        const navUl = document.querySelector('nav ul');
    
        burgerMenu.addEventListener('click', () => {
            navUl.classList.toggle('show');
        });
    </script>    
</body>
</html>
