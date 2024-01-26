<?php
function connectDB() {
    try {
        // Menggunakan PDO untuk koneksi ke database
        $dsn = "mysql:host=localhost;port=3307;dbname=seatscape";
        $username = "root"; // Ganti dengan username database Anda
        $password = ""; // Ganti dengan password database Anda        
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        $pdo = new PDO($dsn, $username, $password, $options);
    
        return $pdo;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}
