<?php
session_start();
include_once '../config.php';
$pdo = connectDB();

// Mengambil ID produk dari parameter URL
$id_produk = isset($_GET['id']) ? $_GET['id'] : 0;


if ($id_produk > 0) {
   
    if (isset($_SESSION['keranjang'][$id_produk])) {
        $_SESSION['keranjang'][$id_produk] += 1;
    } else {
        $_SESSION['keranjang'][$id_produk] = 1;
    }

    // Memberikan pesan alert dan mengarahkan ke halaman keranjang
    echo "<script>alert('Produk telah berhasil masuk ke keranjang belanja');</script>";
    echo "<script>location='keranjang.php';</script>";
} else {
  
    echo "<script>alert('ID produk tidak valid');</script>";
    echo "<script>location='index.php';</script>";
}
?>
