<?php
session_start();
include_once '../config.php';
$pdo = connectDB();


$id_produk = $_GET['id_produk'];

unset($_SESSION['keranjang'][$id_produk]);

echo "<script>alert('Product dihapus dari keranjang');</script>";
echo "<script>window.location='index.php';</script>";