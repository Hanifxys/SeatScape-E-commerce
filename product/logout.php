<?php

session_start();


$_SESSION = array();


setcookie('login_status', '', time() - 7600, '/');

session_destroy();

echo "<script>alert('Anda berhasil logout');</script>";
echo "<script>location='index.php';</script>";
