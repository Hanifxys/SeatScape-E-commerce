<?php

require_once 'config.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Anda harus login terlebih dahulu');</script>";
    header('location:login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
    
</head>
<body>

<div class="sidenav">
    <?php
    $menuItems = ['home', 'produk', 'pembelian', 'pelanggan', 'Logout'];

    foreach ($menuItems as $menuItem) {
        echo "<a href='index.php?page={$menuItem}'>" . ucfirst($menuItem) . "</a>";
    }
    ?>
</div>

<div class="content">
    <h2>Welcome to Admin Dashboard</h2>
    <?php
    
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';


    switch ($page) {
        case 'home':
            include 'pages/home.php';
            break;
        case 'produk':
            include 'pages/produk.php';
            break;
        case 'pembelian':
            include 'pages/pembelian.php';
            break;
        case 'pelanggan':
            include 'pages/pelanggan.php';
            break;
        case 'Logout':
            include 'pages/Logout.php';
            break;
        case 'detail_pembelian':
            include 'detail_pembelian.php';
            break;
         case 'tambah_product':
                include 'tambah_product.php';
                break;
        case 'edit_product':
                include 'edit_product.php';
                break;
        case 'hapus_product':
                    include 'hapus_product.php';
                    break;
        case 'hapus_pelanggan':
                        include 'hapus_pelanggan.php';
                        break;
        default:
            echo '<p>Page not found.</p>';
            break;
    }
    ?>
</div>

</body>
</html>
